<?php

namespace WSW\SimpleUpload\Services;

use InvalidArgumentException;
use League\Flysystem\AdapterInterface;
use League\Flysystem\Filesystem;
use RuntimeException;
use WSW\SimpleUpload\Entities\Upload;
use WSW\SimpleUpload\Factories\Entities\UploadFactory;
use WSW\SimpleUpload\Support\Text;
use WSW\SimpleUpload\Traits\Upload\Path;
use WSW\SimpleUpload\Traits\Upload\Validations;

/**
 * Class SimpleUpload
 * @package WSW\SimpleUpload\Services
 */
class SimpleUpload
{
    use Validations;
    use Path;

    /**
     * @var Upload
     */
    private $upload;

    /**
     * @var Filesystem
     */
    private $file_system;

    /**
     * @var Translator
     */
    private $translator;

    /**
     * @var string
     */
    private $newName;

    /**
     * @var array
     */
    private $allowed_extensions = [];

    /**
     * @param array $upload
     * @param AdapterInterface $adapter
     * @param Translator|null $translator
     */
    public function __construct(array $upload, AdapterInterface $adapter, Translator $translator = null)
    {
        $this->translator  = $translator ?: Translator::locate();
        $this->file_system = new Filesystem($adapter);
        $this->upload      = UploadFactory::createFromArray($upload, $this->translator);
    }

    /**
     * @param array $upload
     * @param AdapterInterface $adapter
     * @param Translator|null $translator
     * @return self
     */
    public static function create(array $upload, AdapterInterface $adapter, Translator $translator = null)
    {
        return new self($upload, $adapter, $translator);
    }

    /**
     * @param $name
     * @return self
     */
    public function setName($name)
    {
        $this->newName = pathinfo($name, PATHINFO_FILENAME);
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->newName;
    }

    /**
     * @param array $ext
     * @return self
     */
    public function setAllowedExtensions(array $ext)
    {
        $this->allowed_extensions = array_map(function ($value) {
            return mb_strtolower($value);
        }, $ext);

        return $this;
    }

    public function send()
    {
        return $this->sendUpload();
    }


    private function isValid()
    {
        if (!$this->extensionIsValid($this->upload->getFileExtension(), $this->allowed_extensions)) {
            unlink($this->upload->getTmpName());

            $msg = sprintf(
                $this->translator->getMessage('validations.invalidExtension'),
                implode(', ', $this->allowed_extensions)
            );

            throw new InvalidArgumentException($msg, 400);
        }

        return true;
    }

    /**
     * @return string
     */
    private function newNameFile()
    {
        $fileName = (is_null($this->newName)) ? Text::slug($this->upload->getFileName()) : $this->getName();
        return $fileName . '.' . mb_strtolower($this->upload->getFileExtension());
    }

    private function sendUpload()
    {
        if ($this->file_system->has($this->newNameFile())) {
            $this->file_system->delete($this->newNameFile());
        }

        if ($this->isValid()) {
            $content = file_get_contents($this->upload->getTmpName());
            return $this->file_system->write($this->newNameFile(), $content);
        }
    }
}
