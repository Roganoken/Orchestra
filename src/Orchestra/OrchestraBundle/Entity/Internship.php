<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Internship
 *
 * @ORM\Table(name="internship")
 * @ORM\Entity
 */
class Internship
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
     * @var \DateTime $started
     *
     * @ORM\Column(name="started", type="date", nullable=false)
     */
    private $started;

    /**
     * @var integer $duration
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var Company
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Company")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     * })
     */
    private $company;

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
     * Set started
     *
     * @param \DateTime $started
     * @return Internship
     */
    public function setStarted($started)
    {
        $this->started = $started;
    
        return $this;
    }

    /**
     * Get started
     *
     * @return \DateTime 
     */
    public function getStarted()
    {
        return $this->started;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return Internship
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    
        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set company
     *
     * @param Orchestra\OrchestraBundle\Entity\Company $company
     * @return Internship
     */
    public function setCompany(\Orchestra\OrchestraBundle\Entity\Company $company = null)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get company
     *
     * @return Orchestra\OrchestraBundle\Entity\Company 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set user
     *
     * @param Orchestra\OrchestraBundle\Entity\User $user
     * @return Internship
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