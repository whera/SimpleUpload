<?php

namespace WSW\SimpleUpload\Support;

use RuntimeException;

/**
 * Class Text
 * @package WSW\SimpleUpload\Support
 */
abstract class Text
{
    /**
     * @param string $string
     * @param string $delimiter
     * @param array $replace
     * @return string
     * @throws RuntimeException
     */
    public static function slug($string, $delimiter = '-', array $replace = []) {
        if (!extension_loaded('iconv')) {
            throw new RuntimeException('iconv module not loaded');
        }

        $oldLocale = setlocale(LC_ALL, '0');
        setlocale(LC_ALL, 'en_US.UTF-8');
        $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);

        if (!empty($replace)) {
            $clean = str_replace($replace, '', $clean);
        }

        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
        $clean = strtolower($clean);
        $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
        $clean = trim($clean, $delimiter);

        setlocale(LC_ALL, $oldLocale);
        return $clean;
    }
}
