<?php

# includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';

require_once('DocAnalyzer.php');

# instantiates a client
$docAnalyzer = new DocAnalyzer();

# the name of the image file to annotate
$fileName = 'file_source/source.jpg';

# prepare the image to be annotated
$image = file_get_contents($fileName);

var_dump($docAnalyzer->getText($image));
