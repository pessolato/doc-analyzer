<?php

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Language\LanguageClient;

$language = new LanguageClient();

class DocAnalyzer
{
    private $vi;
    private $nl;

    public function __construct()
    {
        $this->vi = new ImageAnnotatorClient();
        $this->nl = new LanguageClient();
    }
 
    public function getText($image)
    {
        $response = $this->vi->documentTextDetection($image);
        return $response->getFullTextAnnotation()->getText();
    }

    public function getNames($text)
    {
        $annotation = $this->nl->analyzeEntities($text);
        $res = array();
        foreach ($annotation->entities() as $entity) {
            //$res[] = [$entity['type']];
            if ($entity['type'] === 'PERSON')
            $res[] = $entity['name'];
        }
        return $res;
    }
/*
    public function getNames($text)
    {
        $clean_text = $this->cleanText($text);
        $pattern = "/(?=[A-ZÁÀ ÃÉÈÊÍÏÓÔÕÖÚÇÑ])([A-ZÁÀ ÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]{3,})/";
        preg_match_all($pattern, $clean_text, $out, PREG_PATTERN_ORDER);
        return $out[0];
    }
*/
    private function cleanText($text) 
    {
        $start = strpos($text, "MATRÍCULA:");
        $mid = substr($text, $start + 11);
        $end = strpos($mid, "REGISTRO CIVIL");
        return substr($mid, 0, $end);
    }
}