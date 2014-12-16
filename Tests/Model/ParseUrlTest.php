<?php

namespace Kolekti\UrlBundle\Tests\Model;

use Kolekti\UrlBundle\Entity\Url;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ParseUrlTest extends WebTestCase
{      
    /**
     * @var Url 
     */
    private $_url;
    
    /**
     * @var parseUrl 
     */
    private $_parseUrl;
    
    /**
     * Set up the obj for every test
     */
    protected function setUp()
    {        
        $client = static::createClient();
        $this->_parseUrl = $client->getContainer()->get('parseUrlTld'); 
        $this->_url = new Url('http://www.google.es');
    }

    /**
     * Tears down the objs in every test
     */
    protected function tearDown()
    {           
        unset($this->_url);
        unset($this->_parseUrl);
    }
    
    /**
     * Test the parseUrl public function
     */
    public function testParseUrl()
    {   
       $urlTest = $this->_parseUrl->parseUrl($this->_url);
       $this->assertEquals('http://www.google.es', $urlTest->getUrl());  
       $this->assertEquals('google', $urlTest->getDomain());
       $this->assertEquals('', $urlTest->getSubdomain());
       $this->assertEquals('es', $urlTest->getTld());
       $this->assertEquals('google.es', $urlTest->getCleanHost());
       $this->assertEquals(array('es', 'google'), $urlTest->getDomainParts());
       $this->assertEquals('https://www.google.es/#hl=en&output=search&sclient=psy-ab&q=site:http://www.google.es&oq=site:http://www.google.es', $urlTest->getSearchInGoogle());
    }  
}
?>
