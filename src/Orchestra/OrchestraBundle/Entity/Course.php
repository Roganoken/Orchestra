<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Course
 *
 * @ORM\Table(name="course")
 * @ORM\Entity
 */
class Course
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
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var string $fullName
     *
     * @ORM\Column(name="full_name", type="string", length=256, nullable=true)
     */
    private $fullName;

    /**
     * @var string $description
     *
     * @ORM\Column(name="description", type="string", length=2048, nullable=false)
     */
    private $description;

    /**
     * @var string $exam
     *
     * @ORM\Column(name="exam", type="string", length=512, nullable=true)
     */
    private $exam;

    /**
     * @var string $program
     *
     * @ORM\Column(name="program", type="text", nullable=true)
     */
    private $program;

    /**
     * @var integer $duration
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var \DateTime $start
     *
     * @ORM\Column(name="start", type="datetime", nullable=true)
     */
    private $start;

    /**
     * @var \DateTime $end
     *
     * @ORM\Column(name="end", type="datetime", nullable=true)
     */
    private $end;

    /**
     * @var integer $coefficient
     *
     * @ORM\Column(name="coefficient", type="integer", nullable=true)
     */
    private $coefficient;

    /**
     * @var boolean $isQualifying
     *
     * @ORM\Column(name="is_qualifying", type="boolean", nullable=false)
     */
    private $isQualifying;

    /**
     * @var boolean $isFede
     *
     * @ORM\Column(name="is_fede", type="boolean", nullable=false)
     */
    private $isFede;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Diploma", inversedBy="course")
     * @ORM\JoinTable(name="course_diploma",
     *   joinColumns={
     *     @ORM\JoinColumn(name="course_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="diploma_id", referencedColumnName="id")
     *   }
     * )
     */
    private $diploma;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\User", inversedBy="course")
     * @ORM\JoinTable(name="course_user",
     *   joinColumns={
     *     @ORM\JoinColumn(name="course_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   }
     * )
     */
    private $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->diploma = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Course
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
     * Set fullName
     *
     * @param string $fullName
     * @return Course
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
     * Set description
     *
     * @param string $description
     * @return Course
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
     * Set exam
     *
     * @param string $exam
     * @return Course
     */
    public function setExam($exam)
    {
        $this->exam = $exam;
    
        return $this;
    }

    /**
     * Get exam
     *
     * @return string 
     */
    public function getExam()
    {
        return $this->exam;
    }

    /**
     * Set program
     *
     * @param string $program
     * @return Course
     */
    public function setProgram($program)
    {
        $this->program = $program;
    
        return $this;
    }

    /**
     * Get program
     *
     * @return string 
     */
    public function getProgram()
    {
        return $this->program;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return Course
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
     * Set start
     *
     * @param \DateTime $start
     * @return Course
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
     * Set end
     *
     * @param \DateTime $end
     * @return Course
     */
    public function setEnd($end)
    {
        $this->end = $end;
    
        return $this;
    }

    /**
     * Get end
     *
     * @return \DateTime 
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Set coefficient
     *
     * @param integer $coefficient
     * @return Course
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;
    
        return $this;
    }

    /**
     * Get coefficient
     *
     * @return integer 
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * Set isQualifying
     *
     * @param boolean $isQualifying
     * @return Course
     */
    public function setIsQualifying($isQualifying)
    {
        $this->isQualifying = $isQualifying;
    
        return $this;
    }

    /**
     * Get isQualifying
     *
     * @return boolean 
     */
    public function getIsQualifying()
    {
        return $this->isQualifying;
    }

    /**
     * Set isFede
     *
     * @param boolean $isFede
     * @return Course
     */
    public function setIsFede($isFede)
    {
        $this->isFede = $isFede;
    
        return $this;
    }

    /**
     * Get isFede
     *
     * @return boolean 
     */
    public function getIsFede()
    {
        return $this->isFede;
    }

    /**
     * Add diploma
     *
     * @param Orchestra\OrchestraBundle\Entity\Diploma $diploma
     * @return Course
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
     * Add user
     *
     * @param Orchestra\OrchestraBundle\Entity\User $user
     * @return Course
     */
    public function addUser(\Orchestra\OrchestraBundle\Entity\User $user)
    {
        $this->user[] = $user;
    
        return $this;
    }

    /**
     * Remove user
     *
     * @param Orchestra\OrchestraBundle\Entity\User $user
     */
    public function removeUser(\Orchestra\OrchestraBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getUser()
    {
        return $this->user;
    }
}