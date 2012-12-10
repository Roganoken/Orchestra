<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\SocialNetwork
 *
 * @ORM\Table(name="social_network")
 * @ORM\Entity
 */
class SocialNetwork
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=32, nullable=false)
     */
    private $name;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=256, nullable=false)
     */
    private $url;

    /**
     * @var string $baseUrl
     *
     * @ORM\Column(name="base_url", type="string", length=256, nullable=false)
     */
    private $baseUrl;

    /**
     * @var string $shareUrl
     *
     * @ORM\Column(name="share_url", type="string", length=256, nullable=true)
     */
    private $shareUrl;

    /**
     * @var string $logo
     *
     * @ORM\Column(name="logo", type="string", length=45, nullable=true)
     */
    private $logo;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return SocialNetwork
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return SocialNetwork
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set baseUrl
     *
     * @param string $baseUrl
     * @return SocialNetwork
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    
        return $this;
    }

    /**
     * Get baseUrl
     *
     * @return string 
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * Set shareUrl
     *
     * @param string $shareUrl
     * @return SocialNetwork
     */
    public function setShareUrl($shareUrl)
    {
        $this->shareUrl = $shareUrl;
    
        return $this;
    }

    /**
     * Get shareUrl
     *
     * @return string 
     */
    public function getShareUrl()
    {
        return $this->shareUrl;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return SocialNetwork
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    
        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }
}