<?php

namespace App;

class PageContentParser {
    
    protected $content;
    
    /**
    * Contruct a page content parser given the contents        
     * @param  String $content The page content to parse
     * @return void
     */
    public function __construct($content) {
        $this->content = $content;
    }
    
    
    /**
     * Get x number of tags for the content
     * Scans text for repeated words and returns the $numTags most common
     * @param  Integer  $numTags Number of tags to return
     * @return String[] Array of tag names
     */
    public function getTags($numTags) {
        $explodedContent = explode(" ", $this->content);
        
        $wordsSoFar = array();
        
        foreach($explodedContent as $word) {
            //Only store words > 3 chars to avoid on, the, if etc
            if(strlen($word) > 3) {
                if(array_key_exists($word, $wordsSoFar) ) {
                    $wordsSoFar[$word]++;
                }
                else {
                    $wordsSoFar[$word] = 1;
                }
            }
        }
        
        //Sort the array preserving keys
        arsort($wordsSoFar);
        
        $topXTags = array();
        
        $count = 0;
        foreach($wordsSoFar as $word => $freq) {
            if($count == $numTags) break;
            $topXTags[] = $word;
            $count++;
        }
        
        return $topXTags;
        //dd($this->content);
    }
}
