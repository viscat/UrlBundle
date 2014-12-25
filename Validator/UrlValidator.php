<?php

namespace Parsingcorner\UrlBundle\Validator;

use Parsingcorner\UrlBundle\Entity\Url;
use Symfony\Component\Validator\ExecutionContextInterface;

final class UrlValidator {
    
    private static $_instance;

    private function __construct() {}
    private function __clone() {}

    public static function init()
    {
            return (!(self::$_instance instanceof self)) ? new self : self::$_instance;
    }

    public function validateUrl(Url $urlEntity, ExecutionContextInterface $context)
    {
            $this->_checkUrlStructure($urlEntity, $context); 
            $this->_checkUrlLength($urlEntity, $context);   
            $this->_checkUrlValidLimiters($urlEntity, $context);
            $this->_checkNodes($urlEntity, $context);
    }
    
    private function _setNewViolation(ExecutionContextInterface $context, $var, $message)
    {
        $context->addViolationAt(
                $var,
                $message
            );
    }
    
    private function _checkUrlStructure(Url $urlEntity, ExecutionContextInterface $context)
    {
        if(!preg_match('|^https?://|', $urlEntity->getUrl()))
                $this->_setNewViolation($context, '_url', 'The url should have the http protocol');
    }
    
    private function _checkUrlLength(Url $urlEntity, ExecutionContextInterface $context)
    {
        if(strlen($urlEntity->getCleanHost()) < 2)
            $this->_setNewViolation($context, '_url', 'The url must be longer than 1 char');
    }
    
    private function _checkUrlValidLimiters(Url $urlEntity, ExecutionContextInterface $context)
    {
        if(!preg_match('|^[A-Z0-9].*?[A-Z0-9]$|i', $urlEntity->getCleanHost()))
            $this->_setNewViolation($context, '_url', 'The url must start and end with a char or number');
    }
    
    private function _checkNodes(Url $urlEntity, ExecutionContextInterface $context)
    {
        if(count($urlEntity->getDomainParts()) < 2)
            $this->_setNewViolation($context, '_url', 'The url must have at least 2 nodes');
    }    
}

?>
