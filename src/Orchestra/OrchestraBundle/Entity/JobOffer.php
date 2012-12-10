<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\JobOffer
 *
 * @ORM\Table(name="job_offer")
 * @ORM\Entity
 */
class JobOffer
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
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=32, nullable=false)
     */
    private $title;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=8182, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime $start
     *
     * @ORM\Column(name="start", type="date", nullable=true)
     */
    private $start;

    /**
     * @var integer $duration
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var float $remuneration
     *
     * @ORM\Column(name="remuneration", type="float", nullable=true)
     */
    private $remuneration;

    /**
     * @var integer $visits
     *
     * @ORM\Column(name="visits", type="integer", nullable=false)
     */
    private $visits;

    /**
     * @var string $comment
     *
     * @ORM\Column(name="comment", type="string", length=2048, nullable=true)
     */
    private $comment;

    /**
     * @var boolean $active
     *
     * @ORM\Column(name="active", type="boolean", nullable=false)
     */
    private $active;

    /**
     * @var boolean $deleted
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted;

    /**
     * @var \DateTime $created
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @ORM\Column(name="updated", type="datetime", nullable=false)
     */
    private $updated;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Diploma", mappedBy="jobOffers")
     */
    private $diploma;

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
     * @var Contract
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Contract")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="contract_id", referencedColumnName="id")
     * })
     */
    private $contract;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diploma = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

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
     * Set title
     *
     * @param string $title
     * @return JobOffer
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return JobOffer
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set start
     *
     * @param \DateTime $start
     * @return JobOffer
     */
    public function setStart($start)
    {
        $this->start = $start;
    
        return $this;
    }

    /**
     * Get start
     *
     * @return \DateTime 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return JobOffer
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
     * Set remuneration
     *
     * @param float $remuneration
     * @return JobOffer
     */
    public function setRemuneration($remuneration)
    {
        $this->remuneration = $remuneration;
    
        return $this;
    }

    /**
     * Get remuneration
     *
     * @return float 
     */
    public function getRemuneration()
    {
        return $this->remuneration;
    }

    /**
     * Set visits
     *
     * @param integer $visits
     * @return JobOffer
     */
    public function setVisits($visits)
    {
        $this->visits = $visits;
    
        return $this;
    }

    /**
     * Get visits
     *
     * @return integer 
     */
    public function getVisits()
    {
        return $this->visits;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return JobOffer
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    
        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return JobOffer
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return JobOffer
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;
    
        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return JobOffer
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return JobOffer
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Add diploma
     *
     * @param Orchestra\OrchestraBundle\Entity\Diploma $diploma
     * @return JobOffer
     */
    public function addDiploma(\Orchestra\OrchestraBundle\Entity\Diploma $diploma)
    {
        $this->diploma[] = $diploma;
    
        return $this;
    }

    /**
     * Remove diploma
     *
     * @param Orchestra\OrchestraBundle\Entity\Diploma $diploma
     */
    public function removeDiploma(\Orchestra\OrchestraBundle\Entity\Diploma $diploma)
    {
        $this->diploma->removeElement($diploma);
    }

    /**
     * Get diploma
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getDiploma()
    {
        return $this->diploma;
    }

    /**
     * Set company
     *
     * @param Orchestra\OrchestraBundle\Entity\Company $company
     * @return JobOffer
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
     * Set contract
     *
     * @param Orchestra\OrchestraBundle\Entity\Contract $contract
     * @return JobOffer
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
}