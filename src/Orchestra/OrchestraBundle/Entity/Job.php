<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Job
 *
 * @ORM\Table(name="job")
 * @ORM\Entity
 */
class Job
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
     * @ORM\Column(name="started", type="date", nullable=true)
     */
    private $started;

    /**
     * @var \DateTime $ended
     *
     * @ORM\Column(name="ended", type="date", nullable=true)
     */
    private $ended;

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
     * @var Contract
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Contract")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contract_id", referencedColumnName="id")
     * })
     */
    private $contract;

    /**
     * @var Position
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Position")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     * })
     */
    private $position;



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
     * @return Job
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
     * Set ended
     *
     * @param \DateTime $ended
     * @return Job
     */
    public function setEnded($ended)
    {
        $this->ended = $ended;
    
        return $this;
    }

    /**
     * Get ended
     *
     * @return \DateTime 
     */
    public function getEnded()
    {
        return $this->ended;
    }

    /**
     * Set company
     *
     * @param Orchestra\OrchestraBundle\Entity\Company $company
     * @return Job
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
     * @return Job
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

    /**
     * Set contract
     *
     * @param Orchestra\OrchestraBundle\Entity\Contract $contract
     * @return Job
     */
    public function setContract(\Orchestra\OrchestraBundle\Entity\Contract $contract = null)
    {
        $this->contract = $contract;
    
        return $this;
    }

    /**
     * Get contract
     *
     * @return Orchestra\OrchestraBundle\Entity\Contract 
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set position
     *
     * @param Orchestra\OrchestraBundle\Entity\Position $position
     * @return Job
     */
    public function setPosition(\Orchestra\OrchestraBundle\Entity\Position $position = null)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return Orchestra\OrchestraBundle\Entity\Position 
     */
    public function getPosition()
    {
        return $this->position;
    }
}