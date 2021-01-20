<?php

# includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';

require_once('DocAnalyzer.php');

function processDoc($doc) {

    switch ($doc['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            throw new RuntimeException('Unknown errors.');
    }

    # instantiates a client
    $docAnalyzer = new DocAnalyzer();
    $image = file_get_contents($doc['tmp_name']);

    $text = $docAnalyzer->getText($image);
    $json = json_encode($docAnalyzer->getNames($text), JSON_INVALID_UTF8_SUBSTITUTE);
    return $json;
}

if (!empty($_FILES['certidao'])) {
    echo(processDoc($_FILES['certidao']));
}