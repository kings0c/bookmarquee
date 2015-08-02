<?php

namespace App;

use Goutte\Client as Goutte;

class RemotePage {
    
    protected $title;
    protected $content;
    
    /**
     * Contruct a new page object. Grabs the page using Goetta and parses it for title, and h1-h4 + p contents
     * @param  String $url The url to parse
     * @return true on successful parse, false on error
     */
    public function __construct($url) {
        $client = new Goutte();
        
        $this->content = array();
        
        $crawler = $client->request('GET', $url);
        
        $noError = true;
        
        try {
            $this->title = $crawler->filter('title')->text();

            $crawler->filter('title, p, h1, h2, h3, h4')->each(function ($node) {
                if($node->text()) {
                    $this->content[] = $node->text();
                }
            });
        }
        catch(\InvalidArgumentException $e) {
            print "Error parsing page: " . $e->getMessage();
            $noError = false;
        }
        
        return $noError;
    }
    
    public function getTitle() {
        return $this->title;   
    }
    
    public function getContent() {
        return implode(" ", $this->content);
    }
}
