<?php

namespace WSW\SimpleUpload\Services;

use InvalidArgumentException;
use League\Flysystem\AdapterInterface;
use League\Flysystem\Filesystem;
use RuntimeException;
use WSW\SimpleUpload\Entities\File;
use WSW\SimpleUpload\Entities\Upload;
use WSW\SimpleUpload\Factories\Entities\FileFactory;
use WSW\SimpleUpload\Factories\Entities\UploadFactory;
use WSW\SimpleUpload\Support\Text;
use WSW\SimpleUpload\Traits\Upload\Path;
use WSW\SimpleUpload\Traits\Upload\Validations;

/**
 * Class SimpleUpload
 * @package WSW\SimpleUpload\Services
 */
class SimpleUpload extends AbstractUpload
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

        $this->setAdapter($this->file_system->getAdapter());
        $this->setError($this->upload->getError());
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
        $this->allowed_extensions = array_map(function($value) {
            return mb_strtolower($value);
        }, $ext);

        return $this;
    }

    /**
     * @return File
     */
    public function send()
    {
        return FileFactory::createFromObject($this->sendUpload());
    }

    /**
     * @return Filesystem
     */
    public function getFileSystem()
    {
        return $this->file_system;
    }

    /**
     * @return Translator
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * @return bool
     */
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

        if ($this->uploadWithError()) {
            $msg = $this->translator->getMessage('errors.upload.' . $this->upload->getError());
            throw new RuntimeException($msg, 500);
        }

        return true;
    }

    /**
     * @return string
     */
    public function getNewNameFile()
    {
        $fileName = (is_null($this->newName)) ? Text::slug($this->upload->getFileName()) : $this->getName();
        return $fileName . '.' . mb_strtolower($this->upload->getFileExtension());
    }

    /**
     * @return self
     */
    private function sendUpload()
    {
        if ($this->file_system->has($this->getNewNameFile())) {
            $this->file_system->delete($this->getNewNameFile());
        }

        if ($this->isValid()) {
            $content = file_get_contents($this->upload->getTmpName());
            $this->file_system->write($this->getNewNameFile(), $content);
        }

        return $this;
    }
}
