<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Region
 *
 * @ORM\Table(name="region")
 * @ORM\Entity
 */
class Region
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
     * @var string $regNum
     *
     * @ORM\Column(name="reg_num", type="string", length=8, nullable=false)
     */
    private $regNum;

    /**
     * @var string $ucName
     *
     * @ORM\Column(name="uc_name", type="string", length=64, nullable=false)
     */
    private $ucName;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var Country
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Country")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $country;



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
     * Set regNum
     *
     * @param string $regNum
     * @return Region
     */
    public function setRegNum($regNum)
    {
        $this->regNum = $regNum;
    
        return $this;
    }

    /**
     * Get regNum
     *
     * @return string 
     */
    public function getRegNum()
    {
        return $this->regNum;
    }

    /**
     * Set ucName
     *
     * @param string $ucName
     * @return Region
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
     * Set name
     *
     * @param string $name
     * @return Region
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
     * Set country
     *
     * @param Orchestra\OrchestraBundle\Entity\Country $country
     * @return Region
     */
    public function setCountry(\Orchestra\OrchestraBundle\Entity\Country $country = null)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return Orchestra\OrchestraBundle\Entity\Country 
     */
    public function getCountry()
    {
        return $this->country;
    }
}