<?php

namespace Kolekti\UrlBundle\Tests\Mocks;

use Kolekti\UrlBundle\Entity\Url;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UrlEntityMocks extends WebTestCase
{

    public function getBasicEntity()
    {
        $urlEntity = new Url('http://www.foo.fakeurlfortestingandstufffoobaralsfksdfhowiuh.com');
        $urlEntity->setDomain('fakeurlfortestingandstufffoobaralsfksdfhowiuh');
        $urlEntity->setSubdomain('foo');
        $urlEntity->setTld('com');
        
        return $urlEntity;
    }

}