<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Department
 *
 * @ORM\Table(name="department")
 * @ORM\Entity
 */
class Department
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
     * @var string $deptNum
     *
     * @ORM\Column(name="dept_num", type="string", length=8, nullable=false)
     */
    private $deptNum;

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
     * @var Region
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Region")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     * })
     */
    private $region;



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
     * Set deptNum
     *
     * @param string $deptNum
     * @return Department
     */
    public function setDeptNum($deptNum)
    {
        $this->deptNum = $deptNum;
    
        return $this;
    }

    /**
     * Get deptNum
     *
     * @return string 
     */
    public function getDeptNum()
    {
        return $this->deptNum;
    }

    /**
     * Set ucName
     *
     * @param string $ucName
     * @return Department
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
     * @return Department
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
     * Set region
     *
     * @param Orchestra\OrchestraBundle\Entity\Region $region
     * @return Department
     */
    public function setRegion(\Orchestra\OrchestraBundle\Entity\Region $region = null)
    {
        $this->region = $region;
    
        return $this;
    }

    /**
     * Get region
     *
     * @return Orchestra\OrchestraBundle\Entity\Region 
     */
    public function getRegion()
    {
        return $this->region;
    }
}