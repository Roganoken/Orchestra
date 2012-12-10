<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Diploma
 *
 * @ORM\Table(name="diploma")
 * @ORM\Entity
 */
class Diploma
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
     * @var string $fullName
     *
     * @ORM\Column(name="full_name", type="string", length=64, nullable=false)
     */
    private $fullName;

    /**
     * @var string $certificationName
     *
     * @ORM\Column(name="certification_name", type="string", length=64, nullable=true)
     */
    private $certificationName;

    /**
     * @var \DateTime $certificationDate
     *
     * @ORM\Column(name="certification_date", type="date", nullable=true)
     */
    private $certificationDate;

    /**
     * @var boolean $final
     *
     * @ORM\Column(name="final", type="boolean", nullable=false)
     */
    private $final;

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
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Course", mappedBy="diploma")
     */
    private $course;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\JobOffer", inversedBy="diploma")
     * @ORM\JoinTable(name="diploma_job_offer",
     *   joinColumns={
     *     @ORM\JoinColumn(name="diploma_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="job_offers_id", referencedColumnName="id")
     *   }
     * )
     */
    private $jobOffers;

    /**
     * @var Degree
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Degree")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="degree_id", referencedColumnName="id")
     * })
     */
    private $degree;

    /**
     * @var Field
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Field")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="field_id", referencedColumnName="id")
     * })
     */
    private $field;

    /**
     * @var Speciality
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Speciality")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="speciality_id", referencedColumnName="id")
     * })
     */
    private $speciality;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->course = new \Doctrine\Common\Collections\ArrayCollection();
        $this->jobOffers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set fullName
     *
     * @param string $fullName
     * @return Diploma
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    
        return $this;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set certificationName
     *
     * @param string $certificationName
     * @return Diploma
     */
    public function setCertificationName($certificationName)
    {
        $this->certificationName = $certificationName;
    
        return $this;
    }

    /**
     * Get certificationName
     *
     * @return string 
     */
    public function getCertificationName()
    {
        return $this->certificationName;
    }

    /**
     * Set certificationDate
     *
     * @param \DateTime $certificationDate
     * @return Diploma
     */
    public function setCertificationDate($certificationDate)
    {
        $this->certificationDate = $certificationDate;
    
        return $this;
    }

    /**
     * Get certificationDate
     *
     * @return \DateTime 
     */
    public function getCertificationDate()
    {
        return $this->certificationDate;
    }

    /**
     * Set final
     *
     * @param boolean $final
     * @return Diploma
     */
    public function setFinal($final)
    {
        $this->final = $final;
    
        return $this;
    }

    /**
     * Get final
     *
     * @return boolean 
     */
    public function getFinal()
    {
        return $this->final;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Diploma
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
     * @return Diploma
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
     * Add course
     *
     * @param Orchestra\OrchestraBundle\Entity\Course $course
     * @return Diploma
     */
    public function addCourse(\Orchestra\OrchestraBundle\Entity\Course $course)
    {
        $this->course[] = $course;
    
        return $this;
    }

    /**
     * Remove course
     *
     * @param Orchestra\OrchestraBundle\Entity\Course $course
     */
    public function removeCourse(\Orchestra\OrchestraBundle\Entity\Course $course)
    {
        $this->course->removeElement($course);
    }

    /**
     * Get course
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * Add jobOffers
     *
     * @param Orchestra\OrchestraBundle\Entity\JobOffer $jobOffers
     * @return Diploma
     */
    public function addJobOffer(\Orchestra\OrchestraBundle\Entity\JobOffer $jobOffers)
    {
        $this->jobOffers[] = $jobOffers;
    
        return $this;
    }

    /**
     * Remove jobOffers
     *
     * @param Orchestra\OrchestraBundle\Entity\JobOffer $jobOffers
     */
    public function removeJobOffer(\Orchestra\OrchestraBundle\Entity\JobOffer $jobOffers)
    {
        $this->jobOffers->removeElement($jobOffers);
    }

    /**
     * Get jobOffers
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getJobOffers()
    {
        return $this->jobOffers;
    }

    /**
     * Set degree
     *
     * @param Orchestra\OrchestraBundle\Entity\Degree $degree
     * @return Diploma
     */
    public function setDegree(\Orchestra\OrchestraBundle\Entity\Degree $degree = null)
    {
        $this->degree = $degree;
    
        return $this;
    }

    /**
     * Get degree
     *
     * @return Orchestra\OrchestraBundle\Entity\Degree 
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * Set field
     *
     * @param Orchestra\OrchestraBundle\Entity\Field $field
     * @return Diploma
     */
    public function setField(\Orchestra\OrchestraBundle\Entity\Field $field = null)
    {
        $this->field = $field;
    
        return $this;
    }

    /**
     * Get field
     *
     * @return Orchestra\OrchestraBundle\Entity\Field 
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set speciality
     *
     * @param Orchestra\OrchestraBundle\Entity\Speciality $speciality
     * @return Diploma
     */
    public function setSpeciality(\Orchestra\OrchestraBundle\Entity\Speciality $speciality = null)
    {
        $this->speciality = $speciality;
    
        return $this;
    }

    /**
     * Get speciality
     *
     * @return Orchestra\OrchestraBundle\Entity\Speciality 
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }
}