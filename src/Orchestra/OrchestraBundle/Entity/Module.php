<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Module
 *
 * @ORM\Table(name="module")
 * @ORM\Entity
 */
class Module
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
     * @var string $intitule
     *
     * @ORM\Column(name="intitule", type="string", length=45, nullable=false)
     */
    private $intitule;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var \DateTime $date
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime $date_fin
     *
     * @ORM\Column(name="date_fin", type="datetime", nullable=false)
     */
    private $date_fin;

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
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\User", mappedBy="module")
     */
    private $user;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_user_id", referencedColumnName="id")
     * })
     */
    private $moduleUser;

    /**
     * @var Salle
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Salle")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="salle_id", referencedColumnName="id")
     * })
     */
    private $salle;

    /**
     * Constructor
     */
    public function __construct()
    {
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
     * Set intitule
     *
     * @param string $intitule
     * @return Module
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;
    
        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Module
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Module
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
     * @return Module
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
     * Add user
     *
     * @param Orchestra\OrchestraBundle\Entity\User $user
     * @return Module
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
     * Set moduleUser
     *
     * @param Orchestra\OrchestraBundle\Entity\User $moduleUser
     * @return Module
     */
    public function setModuleUser(\Orchestra\OrchestraBundle\Entity\User $moduleUser = null)
    {
        $this->moduleUser = $moduleUser;
    
        return $this;
    }

    /**
     * Get moduleUser
     *
     * @return Orchestra\OrchestraBundle\Entity\User 
     */
    public function getModuleUser()
    {
        return $this->moduleUser;
    }

    /**
     * Set salle
     *
     * @param Orchestra\OrchestraBundle\Entity\Salle $salle
     * @return Module
     */
    public function setSalle(\Orchestra\OrchestraBundle\Entity\Salle $salle = null)
    {
        $this->salle = $salle;
    
        return $this;
    }

    /**
     * Get salle
     *
     * @return Orchestra\OrchestraBundle\Entity\Salle 
     */
    public function getSalle()
    {
        return $this->salle;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Module
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
     * Set date_fin
     *
     * @param \DateTime $dateFin
     * @return Module
     */
    public function setDateFin($dateFin)
    {
        $this->date_fin = $dateFin;
    
        return $this;
    }

    /**
     * Get date_fin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->date_fin;
    }
}