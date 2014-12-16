<?php

namespace Kolekti\UrlBundle\Entity;

use Kolekti\AttributeValidationBundle\Model\AttributeValidator;
use Symfony\Component\Validator\ExecutionContextInterface;
use Kolekti\UrlBundle\Validator\UrlValidator;

class Url
{
    /**
     * raw url
     * 
     * @var string
     */
    private $_url;

    /**
     * Url domain
     * 
     * @var string
     */
    private $_domain;

    /**
     * Url subdomain, can be null
     * 
     * @var string
     */
    private $_subdomain;

    /**
     * Url top level domain
     * 
     * @var string
     */
    private $_tld;
    
    /**
     * String that only contais the domain, subdomain (optional) and the tld of the Url
     * 
     * @var string 
     */
    private $_cleanHost;
    
    /**
     *
     * Array position for each different value in clean Host. it contains the domain, subdomain (optional) and the tld.
     * 
     * @var array
     */
    private $_domainParts;
        
    /**
     * Search in google url by site
     * @var string 
     */
    private $_searchInGoogle;
    
    /**
     * @todo private $_parameters that will include all the url parameters
     */
        
    /**
     * Set default values for not nullable keys
     */
    public function __construct($url)
    {
        $this->_setUrl($url);        
        $this->_setCleanHost($this->getUrl());
        $this->_setDomainParts($this->getCleanHost());
        $this->_setSearchInGoogle($url);
        AttributeValidator::validateAttributes($this); 
    }

    /**
     * Set the main url
     * 
     * @param string $url
     */
    private function _setUrl($url)
    {
        $this->_url = trim($url);
    }
    
    /**
     * Get _url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->_url;
    }
    
    /**
     * Set _domain
     *
     * @param string $domain
     * @return Url
     */
    public function setDomain($domain)
    {
        $this->_domain = $domain;
        
        return $this;
    }

    /**
     * Get _domain
     *
     * @return string 
     */
    public function getDomain()
    {
        return $this->_domain;
    }

    /**
     * Set _subdomain
     *
     * @param string $subdomain
     * @return Url
     */
    public function setSubdomain($subdomain)
    {
        $this->_subdomain = $subdomain;

        return $this;
    }
    
    /**
     * Get _subdomain
     *
     * @return string 
     */
    public function getSubdomain()
    {
        return $this->_subdomain;
    }

    /**
     * Set _tld
     *
     * @param string $tld
     * @return Url
     */
    public function setTld($tld)
    {
        $this->_tld = $tld;

        return $this;
    }

    /**
     * Get _tld
     *
     * @return string 
     */
    public function getTld()
    {
        return $this->_tld;
    }

    /**
     * Set _cleanHost    
     */
    private function _setCleanHost($url)
    {
        $this->_cleanHost = preg_replace('|^https?://|', '', $url);
        $this->_cleanHost = preg_replace('|^www\.|', '', $this->_cleanHost);       
        $this->_cleanHost = preg_replace('|/.*?$|', '', $this->_cleanHost); 
    }
    
    /**
     * Get _cleanUrl
     *
     * @return string 
     */
    public function getCleanHost()
    {
        return $this->_cleanHost;
    }
    
    /**
     * Set _domainParts
     */
    private function _setDomainParts($cleanHost)
    {
        $this->_domainParts = array_reverse(explode('.', $cleanHost));
    }

    /**
     * Get _domainParts
     *
     * @return array 
     */
    public function getDomainParts()
    {
        return $this->_domainParts;
    }
    
    /**
     * 
     * @param ExecutionContextInterface $context
     */
    public function validateUrl(ExecutionContextInterface $context)
    {
        $urlValidator = UrlValidator::init();
        $urlValidator->validateUrl($this, $context);
    }
    
    /**
     * Set _searchInGoogle
     * 
     * @param type $url
     * @return \Kolekti\UrlBundle\Entity\Url
     */
    private function _setSearchInGoogle($url)
    {
        $this->_searchInGoogle = 'https://www.google.es/#hl=en&output=search&sclient=psy-ab&q=site:'.$url.'&oq=site:'.$url;       
        return $this;
    }
    
    /**
     * Get _searchInGoogle
     * @return string
     */
    public function getSearchInGoogle()
    {
        return $this->_searchInGoogle;
    }
        
}
