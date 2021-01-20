<?php

use Google\Cloud\Vision\V1\ImageAnnotatorClient;

class DocAnalyzer extends ImageAnnotatorClient
{
 
    public function getText($image)
    {
        $response = $this->documentTextDetection($image);
        return $response->getFullTextAnnotation()->getText();
    }

    public function getNames($text)
    {
        $clean_text = $this->cleanText($text);
        $pattern = "/(?=[A-ZÁÀ ÃÉÈÊÍÏÓÔÕÖÚÇÑ])([A-ZÁÀ ÃÉÈÊÍÏÓÔÕÖÚÇÑ\s]{3,})/";
        preg_match_all($pattern, $clean_text, $out, PREG_PATTERN_ORDER);
        return $out[0];
    }

    private function cleanText($text) 
    {
        $start = strpos($text, "MATRÍCULA:");
        $mid = substr($text, $start + 11);
        $end = strpos($mid, "REGISTRO CIVIL");
        return substr($mid, 0, $end);
    }
}