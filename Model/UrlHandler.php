<?php

namespace Kolekti\UrlBundle\Model;

use Kolekti\UrlBundle\Entity\Url;
use Kolekti\UrlBundle\Model\ParseUrl;

class UrlHandler
{     
    /**
    * parseUrlTld service
    * @var ParseUrl
    */
    private $_parserUrl;
    
    /**   
     * @param ParseUrl $parseUrl to get the domain adn tld parts
     */
    public function __construct(ParseUrl $parseUrl)
    {
        $this->_parserUrl = $parseUrl;
    }

    /**   
     * @param string $url new url
     * @return Url
     */
    public function createNewUrl($url) 
    {        
        $urlEntity = new Url($url); 
        return $this->setUrlInfo($urlEntity);
    }
    
    /**     
     * @param Url $urlEntity
     * @return Url
     */
    private function setUrlInfo(Url $urlEntity)
    {
        return $this->_parserUrl->parseUrl($urlEntity);
    }
}
