<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FR3D\LdapBundle\Model\LdapUserInterface;
use FOS\UserBundle\Entity\User as BaseUser;


/**
 * Orchestra\OrchestraBundle\Entity\User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User extends BaseUser implements LdapUserInterface
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string $firstname
     *
     * @ORM\Column(name="firstname", type="string", length=32, nullable=true)
     */
    private $firstname;

    /**
   * Ldap Object Distinguished Name
   * @var string $dn
   */
    protected $dn;
    
    /**
     * @var string $lastname
     *
     * @ORM\Column(name="lastname", type="string", length=32, nullable=true)
     */
    private $lastname;

    /**
     * @var \DateTime $birthdate
     *
     * @ORM\Column(name="birthdate", type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @var integer $photo
     *
     * @ORM\Column(name="photo", type="integer", nullable=true)
     */
    private $photo;

    /**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=16, nullable=true)
     */
    private $phone;

    /**
     * @var string $mobilePhone
     *
     * @ORM\Column(name="mobile_phone", type="string", length=16, nullable=true)
     */
    private $mobilePhone;

    /**
     * @var string $ldap
     *
     * @ORM\Column(name="ldap", type="string", length=256, nullable=true)
     */
    private $ldap;

    /**
     * @var \DateTime $connected
     *
     * @ORM\Column(name="connected", type="datetime", nullable=true)
     */
    private $connected;

    /**
     * @var \DateTime $created
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var boolean $isProfesseur
     *
     * @ORM\Column(name="is_professeur", type="boolean", nullable=true)
     */
    private $isProfesseur;

    /**
     * @var boolean $isEleve
     *
     * @ORM\Column(name="is_eleve", type="boolean", nullable=true)
     */
    private $isEleve;

    /**
     * @var boolean $isContact
     *
     * @ORM\Column(name="is_contact", type="boolean", nullable=true)
     */
    private $isContact;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Access", mappedBy="user")
     */
    private $access;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Company", mappedBy="user")
     */
    private $company;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Course", mappedBy="user")
     */
    private $course;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Position", mappedBy="user")
     */
    private $position;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Image", inversedBy="user")
     * @ORM\JoinTable(name="user_has_image",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="image_id", referencedColumnName="id")
     *   }
     * )
     */
    private $image;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Livre", inversedBy="user")
     * @ORM\JoinTable(name="user_livre",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="livre_id", referencedColumnName="id")
     *   }
     * )
     */
    private $livre;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Module", inversedBy="user")
     * @ORM\JoinTable(name="user_module",
     *   joinColumns={
     *     @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     *   }
     * )
     */
    private $module;

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
     * @var Sex
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Sex")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sex_id", referencedColumnName="id")
     * })
     */
    private $sex;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->access = new \Doctrine\Common\Collections\ArrayCollection();
        $this->company = new \Doctrine\Common\Collections\ArrayCollection();
        $this->course = new \Doctrine\Common\Collections\ArrayCollection();
        $this->position = new \Doctrine\Common\Collections\ArrayCollection();
        $this->image = new \Doctrine\Common\Collections\ArrayCollection();
        $this->livre = new \Doctrine\Common\Collections\ArrayCollection();
        $this->module = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;
    
        return $this;
    }

    /**
     * Get username
     *
     * @return string 
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    
        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set photo
     *
     * @param integer $photo
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    
        return $this;
    }

    /**
     * Get photo
     *
     * @return integer 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
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
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set mobilePhone
     *
     * @param string $mobilePhone
     * @return User
     */
    public function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;
    
        return $this;
    }

    /**
     * Get mobilePhone
     *
     * @return string 
     */
    public function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    /**
     * Set ldap
     *
     * @param string $ldap
     * @return User
     */
    public function setLdap($ldap)
    {
        $this->ldap = $ldap;
    
        return $this;
    }

    /**
     * Get ldap
     *
     * @return string 
     */
    public function getLdap()
    {
        return $this->ldap;
    }
    
    
  /**
   * {@inheritDoc}
   */
  public function setDn($dn)
  {
    $this->dn = $dn;
  }

  /**
   * {@inheritDoc}
   */
  public function getDn()
  {
    return $this->dn;
  }

    /**
     * Set connected
     *
     * @param \DateTime $connected
     * @return User
     */
    public function setConnected($connected)
    {
        $this->connected = $connected;
    
        return $this;
    }

    /**
     * Get connected
     *
     * @return \DateTime 
     */
    public function getConnected()
    {
        return $this->connected;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return User
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
     * @return User
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
     * Set isProfesseur
     *
     * @param boolean $isProfesseur
     * @return User
     */
    public function setIsProfesseur($isProfesseur)
    {
        $this->isProfesseur = $isProfesseur;
    
        return $this;
    }

    /**
     * Get isProfesseur
     *
     * @return boolean 
     */
    public function getIsProfesseur()
    {
        return $this->isProfesseur;
    }

    /**
     * Set isEleve
     *
     * @param boolean $isEleve
     * @return User
     */
    public function setIsEleve($isEleve)
    {
        $this->isEleve = $isEleve;
    
        return $this;
    }

    /**
     * Get isEleve
     *
     * @return boolean 
     */
    public function getIsEleve()
    {
        return $this->isEleve;
    }

    /**
     * Set isContact
     *
     * @param boolean $isContact
     * @return User
     */
    public function setIsContact($isContact)
    {
        $this->isContact = $isContact;
    
        return $this;
    }

    /**
     * Get isContact
     *
     * @return boolean 
     */
    public function getIsContact()
    {
        return $this->isContact;
    }

    /**
     * Add access
     *
     * @param Orchestra\OrchestraBundle\Entity\Access $access
     * @return User
     */
    public function addAcces(\Orchestra\OrchestraBundle\Entity\Access $access)
    {
        $this->access[] = $access;
    
        return $this;
    }

    /**
     * Remove access
     *
     * @param Orchestra\OrchestraBundle\Entity\Access $access
     */
    public function removeAcces(\Orchestra\OrchestraBundle\Entity\Access $access)
    {
        $this->access->removeElement($access);
    }

    /**
     * Get access
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getAccess()
    {
        return $this->access;
    }

    /**
     * Add company
     *
     * @param Orchestra\OrchestraBundle\Entity\Company $company
     * @return User
     */
    public function addCompany(\Orchestra\OrchestraBundle\Entity\Company $company)
    {
        $this->company[] = $company;
    
        return $this;
    }

    /**
     * Remove company
     *
     * @param Orchestra\OrchestraBundle\Entity\Company $company
     */
    public function removeCompany(\Orchestra\OrchestraBundle\Entity\Company $company)
    {
        $this->company->removeElement($company);
    }

    /**
     * Get company
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Add course
     *
     * @param Orchestra\OrchestraBundle\Entity\Course $course
     * @return User
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
     * Add position
     *
     * @param Orchestra\OrchestraBundle\Entity\Position $position
     * @return User
     */
    public function addPosition(\Orchestra\OrchestraBundle\Entity\Position $position)
    {
        $this->position[] = $position;
    
        return $this;
    }

    /**
     * Remove position
     *
     * @param Orchestra\OrchestraBundle\Entity\Position $position
     */
    public function removePosition(\Orchestra\OrchestraBundle\Entity\Position $position)
    {
        $this->position->removeElement($position);
    }

    /**
     * Get position
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Add image
     *
     * @param Orchestra\OrchestraBundle\Entity\Image $image
     * @return User
     */
    public function addImage(\Orchestra\OrchestraBundle\Entity\Image $image)
    {
        $this->image[] = $image;
    
        return $this;
    }

    /**
     * Remove image
     *
     * @param Orchestra\OrchestraBundle\Entity\Image $image
     */
    public function removeImage(\Orchestra\OrchestraBundle\Entity\Image $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Add livre
     *
     * @param Orchestra\OrchestraBundle\Entity\Livre $livre
     * @return User
     */
    public function addLivre(\Orchestra\OrchestraBundle\Entity\Livre $livre)
    {
        $this->livre[] = $livre;
    
        return $this;
    }

    /**
     * Remove livre
     *
     * @param Orchestra\OrchestraBundle\Entity\Livre $livre
     */
    public function removeLivre(\Orchestra\OrchestraBundle\Entity\Livre $livre)
    {
        $this->livre->removeElement($livre);
    }

    /**
     * Get livre
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getLivre()
    {
        return $this->livre;
    }

    /**
     * Add module
     *
     * @param Orchestra\OrchestraBundle\Entity\Module $module
     * @return User
     */
    public function addModule(\Orchestra\OrchestraBundle\Entity\Module $module)
    {
        $this->module[] = $module;
    
        return $this;
    }

    /**
     * Remove module
     *
     * @param Orchestra\OrchestraBundle\Entity\Module $module
     */
    public function removeModule(\Orchestra\OrchestraBundle\Entity\Module $module)
    {
        $this->module->removeElement($module);
    }

    /**
     * Get module
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set address
     *
     * @param Orchestra\OrchestraBundle\Entity\Address $address
     * @return User
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
     * Set sex
     *
     * @param Orchestra\OrchestraBundle\Entity\Sex $sex
     * @return User
     */
    public function setSex(\Orchestra\OrchestraBundle\Entity\Sex $sex = null)
    {
        $this->sex = $sex;
    
        return $this;
    }

    /**
     * Get sex
     *
     * @return Orchestra\OrchestraBundle\Entity\Sex 
     */
    public function getSex()
    {
        return $this->sex;
    }
}