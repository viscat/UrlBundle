<?php
/**
 * User: gerard
 * Date: 24/12/14
 * Time: 15:08
 */

namespace Parsingcorner\UrlBundle\Tests\Model;


use Parsingcorner\UrlBundle\Tests\AppKernel;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class IntegrationWebTestCase extends WebTestCase
{
    protected static function createKernel(array $options = array()) {
        return new AppKernel(isset($options['config']) ? $options['config'] : 'config.yml');
    }
} 