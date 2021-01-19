<?php

# includes the autoloader for libraries installed with composer
require __DIR__ . '/vendor/autoload.php';

# imports the Google Cloud client library
use Google\Cloud\Vision\V1\ImageAnnotatorClient;

# instantiates a client
$imageAnnotator = new ImageAnnotatorClient();

# the name of the image file to annotate
$fileName = 'file_source/source.jpg';

# prepare the image to be annotated
$image = file_get_contents($fileName);

# performs label detection on the image file
$response = $imageAnnotator->documentTextDetection($image);
$texts = $response->getTextAnnotations();

if ($texts) {
    echo(PHP_EOL);
} else {
    echo('No text found' . PHP_EOL);
}