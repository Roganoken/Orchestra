<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Address
 *
 * @ORM\Table(name="address")
 * @ORM\Entity
 */
class Address
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
     * @var string $address1
     *
     * @ORM\Column(name="address1", type="string", length=256, nullable=false)
     */
    private $address1;

    /**
     * @var string $address2
     *
     * @ORM\Column(name="address2", type="string", length=256, nullable=true)
     */
    private $address2;

    /**
     * @var string $address3
     *
     * @ORM\Column(name="address3", type="string", length=256, nullable=true)
     */
    private $address3;

    /**
     * @var string $other
     *
     * @ORM\Column(name="other", type="string", length=4096, nullable=true)
     */
    private $other;

    /**
     * @var boolean $isActive
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    private $isActive;

    /**
     * @var boolean $isDeleted
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=false)
     */
    private $isDeleted;

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
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\City")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     * })
     */
    private $city;



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
     * Set address1
     *
     * @param string $address1
     * @return Address
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    
        return $this;
    }

    /**
     * Get address1
     *
     * @return string 
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return Address
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    
        return $this;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set address3
     *
     * @param string $address3
     * @return Address
     */
    public function setAddress3($address3)
    {
        $this->address3 = $address3;
    
        return $this;
    }

    /**
     * Get address3
     *
     * @return string 
     */
    public function getAddress3()
    {
        return $this->address3;
    }

    /**
     * Set other
     *
     * @param string $other
     * @return Address
     */
    public function setOther($other)
    {
        $this->other = $other;
    
        return $this;
    }

    /**
     * Get other
     *
     * @return string 
     */
    public function getOther()
    {
        return $this->other;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Address
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
     * Set isDeleted
     *
     * @param boolean $isDeleted
     * @return Address
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
    
        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return boolean 
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Address
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
     * @return Address
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
     * Set city
     *
     * @param Orchestra\OrchestraBundle\Entity\City $city
     * @return Address
     */
    public function setCity(\Orchestra\OrchestraBundle\Entity\City $city = null)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return Orchestra\OrchestraBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }
}