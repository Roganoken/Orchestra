<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity
 */
class Company
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
     * @var string $website
     *
     * @ORM\Column(name="website", type="string", length=256, nullable=true)
     */
    private $website;

    /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=256, nullable=true)
     */
    private $email;

    /**
     * @var integer $logo
     *
     * @ORM\Column(name="logo", type="integer", nullable=true)
     */
    private $logo;

    /**
     * @var \DateTime $issueDate
     *
     * @ORM\Column(name="issue_date", type="date", nullable=true)
     */
    private $issueDate;

    /**
     * @var string $siret
     *
     * @ORM\Column(name="siret", type="string", length=16, nullable=true)
     */
    private $siret;

    /**
     * @var string $siren
     *
     * @ORM\Column(name="siren", type="string", length=16, nullable=true)
     */
    private $siren;

    /**
     * @var boolean $isActive
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;

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
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Field", inversedBy="company")
     * @ORM\JoinTable(name="company_field",
     *   joinColumns={
     *     @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="field_id", referencedColumnName="id")
     *   }
     * )
     */
    private $field;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Sector", inversedBy="company")
     * @ORM\JoinTable(name="company_sector",
     *   joinColumns={
     *     @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="sector_id", referencedColumnName="id")
     *   }
     * )
     */
    private $sector;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\User", inversedBy="company")
     * @ORM\JoinTable(name="company_user",
     *   joinColumns={
     *     @ORM\JoinColumn(name="company_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   }
     * )
     */
    private $user;

    /**
     * @var Address
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address_id", referencedColumnName="id")
     * })
     */
    private $address;

    /**
     * @var Legal
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Legal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="legal_id", referencedColumnName="id")
     * })
     */
    private $legal;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->field = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sector = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Company
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
     * Set website
     *
     * @param string $website
     * @return Company
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    
        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Company
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set logo
     *
     * @param integer $logo
     * @return Company
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    
        return $this;
    }

    /**
     * Get logo
     *
     * @return integer 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set issueDate
     *
     * @param \DateTime $issueDate
     * @return Company
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
     * Set siret
     *
     * @param string $siret
     * @return Company
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;
    
        return $this;
    }

    /**
     * Get siret
     *
     * @return string 
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set siren
     *
     * @param string $siren
     * @return Company
     */
    public function setSiren($siren)
    {
        $this->siren = $siren;
    
        return $this;
    }

    /**
     * Get siren
     *
     * @return string 
     */
    public function getSiren()
    {
        return $this->siren;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Company
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Company
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
     * @return Company
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
     * Add field
     *
     * @param Orchestra\OrchestraBundle\Entity\Field $field
     * @return Company
     */
    public function addField(\Orchestra\OrchestraBundle\Entity\Field $field)
    {
        $this->field[] = $field;
    
        return $this;
    }

    /**
     * Remove field
     *
     * @param Orchestra\OrchestraBundle\Entity\Field $field
     */
    public function removeField(\Orchestra\OrchestraBundle\Entity\Field $field)
    {
        $this->field->removeElement($field);
    }

    /**
     * Get field
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Add sector
     *
     * @param Orchestra\OrchestraBundle\Entity\Sector $sector
     * @return Company
     */
    public function addSector(\Orchestra\OrchestraBundle\Entity\Sector $sector)
    {
        $this->sector[] = $sector;
    
        return $this;
    }

    /**
     * Remove sector
     *
     * @param Orchestra\OrchestraBundle\Entity\Sector $sector
     */
    public function removeSector(\Orchestra\OrchestraBundle\Entity\Sector $sector)
    {
        $this->sector->removeElement($sector);
    }

    /**
     * Get sector
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * Add user
     *
     * @param Orchestra\OrchestraBundle\Entity\User $user
     * @return Company
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

    /**
     * Set address
     *
     * @param Orchestra\OrchestraBundle\Entity\Address $address
     * @return Company
     */
    public function setAddress(\Orchestra\OrchestraBundle\Entity\Address $address = null)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return Orchestra\OrchestraBundle\Entity\Address 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set legal
     *
     * @param Orchestra\OrchestraBundle\Entity\Legal $legal
     * @return Company
     */
    public function setLegal(\Orchestra\OrchestraBundle\Entity\Legal $legal = null)
    {
        $this->legal = $legal;
    
        return $this;
    }

    /**
     * Get legal
     *
     * @return Orchestra\OrchestraBundle\Entity\Legal 
     */
    public function getLegal()
    {
        return $this->legal;
    }
}