<?php
    if (defined("PHP_BINARY")) {
        $string = PHP_BINARY;
    } else {
        $string = '/path/to/php';
    }

    if (function_exists('mb_convert_encoding')) {
        $string = mb_convert_encoding($string, 'UTF-8');
    } else {
        $string = utf8_encode($string);
    }

    if (extension_loaded('mbstring')) {
        echo mb_detect_encoding($string);
    }

    if (!class_exists('Symfony\Component\Yaml\Dumper', FALSE)) {
        require_once 'Symfony/Component/Yaml/Dumper.php';
    }

    if (!interface_exists('PHP_CompatInfo_Reference', FALSE)) {
        require_once 'Bartlett/PHP/CompatInfo/Reference.php';
    }

    var_dump($string . PHP_EOL);
