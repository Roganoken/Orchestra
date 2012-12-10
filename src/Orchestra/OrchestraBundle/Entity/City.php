<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\City
 *
 * @ORM\Table(name="city")
 * @ORM\Entity
 */
class City
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
     * @var string $postalCode
     *
     * @ORM\Column(name="postal_code", type="string", length=8, nullable=false)
     */
    private $postalCode;

    /**
     * @var string $ucArt
     *
     * @ORM\Column(name="uc_art", type="string", length=8, nullable=true)
     */
    private $ucArt;

    /**
     * @var string $ucName
     *
     * @ORM\Column(name="uc_name", type="string", length=64, nullable=false)
     */
    private $ucName;

    /**
     * @var string $art
     *
     * @ORM\Column(name="art", type="string", length=8, nullable=true)
     */
    private $art;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var Department
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Department")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     * })
     */
    private $department;



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
     * Set postalCode
     *
     * @param string $postalCode
     * @return City
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    
        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set ucArt
     *
     * @param string $ucArt
     * @return City
     */
    public function setUcArt($ucArt)
    {
        $this->ucArt = $ucArt;
    
        return $this;
    }

    /**
     * Get ucArt
     *
     * @return string 
     */
    public function getUcArt()
    {
        return $this->ucArt;
    }

    /**
     * Set ucName
     *
     * @param string $ucName
     * @return City
     */
    public function setUcName($ucName)
    {
        $this->ucName = $ucName;
    
        return $this;
    }

    /**
     * Get ucName
     *
     * @return string 
     */
    public function getUcName()
    {
        return $this->ucName;
    }

    /**
     * Set art
     *
     * @param string $art
     * @return City
     */
    public function setArt($art)
    {
        $this->art = $art;
    
        return $this;
    }

    /**
     * Get art
     *
     * @return string 
     */
    public function getArt()
    {
        return $this->art;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return City
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
     * Set department
     *
     * @param Orchestra\OrchestraBundle\Entity\Department $department
     * @return City
     */
    public function setDepartment(\Orchestra\OrchestraBundle\Entity\Department $department = null)
    {
        $this->department = $department;
    
        return $this;
    }

    /**
     * Get department
     *
     * @return Orchestra\OrchestraBundle\Entity\Department 
     */
    public function getDepartment()
    {
        return $this->department;
    }
}