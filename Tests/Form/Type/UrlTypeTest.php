<?php

namespace ParsingCorner\UrlBundle\Tests\Form\Type;

use Symfony\Component\Form\Test\TypeTestCase;
use Parsingcorner\UrlBundle\Form\Type\UrlType;
use Parsingcorner\UrlBundle\Entity\Url;

class UrlTypeTest extends TypeTestCase
{      
    /**
     * Tests the UrlType form
     */
    public function testUrlType()
    {   
        $type = new UrlType();
        $form = $this->factory->create($type);
        
        $formData = array(
            'url' => 'http://google.es',            
        );

        $form->submit($formData);

        $object = new Url('http://google.es');
        
        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }  
}
?>