<?php

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class DocAnalyzer extends ImageAnnotatorClient
{
    public function getText($image)
    {
        $response = $this->documentTextDetection($image);
        return $response->getTextAnnotations();
    }
}