<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\SocialNetworkUser
 *
 * @ORM\Table(name="social_network_user")
 * @ORM\Entity
 */
class SocialNetworkUser
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
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=256, nullable=false)
     */
    private $url;

    /**
     * @var SocialNetwork
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\SocialNetwork")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="social_network_id", referencedColumnName="id")
     * })
     */
    private $socialNetwork;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * Set url
     *
     * @param string $url
     * @return SocialNetworkUser
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
     * Set socialNetwork
     *
     * @param Orchestra\OrchestraBundle\Entity\SocialNetwork $socialNetwork
     * @return SocialNetworkUser
     */
    public function setSocialNetwork(\Orchestra\OrchestraBundle\Entity\SocialNetwork $socialNetwork = null)
    {
        $this->socialNetwork = $socialNetwork;
    
        return $this;
    }

    /**
     * Get socialNetwork
     *
     * @return Orchestra\OrchestraBundle\Entity\SocialNetwork 
     */
    public function getSocialNetwork()
    {
        return $this->socialNetwork;
    }

    /**
     * Set user
     *
     * @param Orchestra\OrchestraBundle\Entity\User $user
     * @return SocialNetworkUser
     */
    public function setUser(\Orchestra\OrchestraBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return Orchestra\OrchestraBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}