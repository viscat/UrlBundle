<?php

namespace Kolekti\UrlBundle\Tests\Model;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class urlHandlerTest extends WebTestCase
{          
    /**
     * @var UrlHandler 
     */
    private $_urlHandler;
    
    /**
     * Set up the obj for every test
     */
    protected function setUp()
    {        
        $client = static::createClient();         
        $this->_urlHandler = $client->getContainer()->get('urlHandler');        
    }

    /**
     * Tears down the objs in every test
     */
    protected function tearDown()
    {       
        unset($this->_urlHandler);
    }
    
    /**
     * tests the createNewUrl public function
     */
    public function testCreateNewUrl()
    {   
       $urlTest = $this->_urlHandler->createNewUrl('http://www.google.es');
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
