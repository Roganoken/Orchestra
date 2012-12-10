<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\DiplomaUser
 *
 * @ORM\Table(name="diploma_user")
 * @ORM\Entity
 */
class DiplomaUser
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
     * @var \DateTime $issueDate
     *
     * @ORM\Column(name="issue_date", type="date", nullable=true)
     */
    private $issueDate;

    /**
     * @var Diploma
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Diploma")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="diploma_id", referencedColumnName="id")
     * })
     */
    private $diploma;

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
     * Set issueDate
     *
     * @param \DateTime $issueDate
     * @return DiplomaUser
     */
    public function setIssueDate($issueDate)
    {
        $this->issueDate = $issueDate;
    
        return $this;
    }

    /**
     * Get issueDate
     *
     * @return \DateTime 
     */
    public function getIssueDate()
    {
        return $this->issueDate;
    }

    /**
     * Set diploma
     *
     * @param Orchestra\OrchestraBundle\Entity\Diploma $diploma
     * @return DiplomaUser
     */
    public function setDiploma(\Orchestra\OrchestraBundle\Entity\Diploma $diploma = null)
    {
        $this->diploma = $diploma;
    
        return $this;
    }

    /**
     * Get diploma
     *
     * @return Orchestra\OrchestraBundle\Entity\Diploma 
     */
    public function getDiploma()
    {
        return $this->diploma;
    }

    /**
     * Set user
     *
     * @param Orchestra\OrchestraBundle\Entity\User $user
     * @return DiplomaUser
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