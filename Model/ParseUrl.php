<?php

namespace Kolekti\UrlBundle\Model;

use Kolekti\UrlBundle\Entity\Url;

class ParseUrl{

    /**
     * Array with all the tlds
     * @var Array 
     */
    private $_topLvlDomains;   

    /**     
     * @param array $topLvlDomains to set the tld array list
     */
    public function __construct($topLvlDomains)
    {
       $this->_topLvlDomains = $topLvlDomains;
    }
   
    /**     
     * @param Url $urlEntity
     * @return Url
     */
    public function parseUrl(Url $urlEntity)
    {                       
        $this->_setUrlParts($urlEntity);
        return $urlEntity;
    }
    
    /**     
     * @param Url $urlEntity set the main variables for Url entity
     */
    private function _setUrlParts(Url &$urlEntity)
    {               
        $domainParts = $urlEntity->getDomainParts(); 
        
        if (count($domainParts) > 2 && $this->_checkTld($domainParts[1] . "." . $domainParts[0])) {   
            $urlEntity->setTld($domainParts[1] . "." . $domainParts[0]);
            $urlEntity->setDomain($domainParts[2]);  
        }
        else{
            $urlEntity->setTld($domainParts[0]);
            $urlEntity->setDomain($domainParts[1]);  
        }
        
        $subdomain = preg_replace('|\.$|', '', str_ireplace($urlEntity->getDomain() . '.' . $urlEntity->getTld(), '', $urlEntity->getCleanHost()));       
        $urlEntity->setSubdomain($subdomain);        
    }
    
    /**     
     * Checks if the tld exists in the array. This function checks by letter to make the function more efficient
     * 
     * @param Url $urlEntity
     * @return boolean
     */
    private function _checkTld($tldCheck)
    {             
        return array_key_exists($tldCheck, $this->_topLvlDomains);
    }
}

?>
