<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message")
 * @ORM\Entity
 */
class Message
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var text
     *
     * @ORM\Column(name="contenu", type="text", nullable=false)
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;
    
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="frompersonneid", referencedColumnName="id", nullable=false)
     * })
     */
    
    private $fromPersonneId;
    
    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="topersonneid", referencedColumnName="id", nullable=false)
     * })
     */
    private $toPersonneId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isRead", type="boolean")
     */
    private $isRead;


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
     * Set contenu
     *
     * @param string $contenu
     * @return Message
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    
        return $this;
    }

    /**
     * Get contenu
     *
     * @return string 
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Message
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }
    
    /**
     * Set fromPersonneId
     *
     * @param Orchestra\OrchestraBundle\Entity\User $fromPersonneId
     * @return Message
     */
    public function setFromPersonneId(\Orchestra\OrchestraBundle\Entity\User $fromPersonneId = null)
    {
        $this->fromPersonneId = $fromPersonneId;
    
        return $this;
    }

    /**
     * Get fromPersonneId
     *
     * @return Orchestra\OrchestraBundle\Entity\User 
     */
    public function getFromPersonneId()
    {
        return $this->fromPersonneId;
    }
    
    /**
     * Set toPersonneId
     *
     * @param Orchestra\OrchestraBundle\Entity\User $toPersonneId
     * @return Message
     */
    public function setToPersonneId(\Orchestra\OrchestraBundle\Entity\User $toPersonneId = null)
    {
        $this->toPersonneId = $toPersonneId;
    
        return $this;
    }

    /**
     * Get toPersonneId
     *
     * @return Orchestra\OrchestraBundle\Entity\User 
     */
    public function getToPersonneId()
    {
        return $this->toPersonneId;
    }

    /**
     * Set isRead
     *
     * @param boolean $isRead
     * @return Message
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;
    
        return $this;
    }

    /**
     * Get isRead
     *
     * @return boolean 
     */
    public function getIsRead()
    {
        return $this->isRead;
    }
}