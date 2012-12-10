<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Sex
 *
 * @ORM\Table(name="sex")
 * @ORM\Entity
 */
class Sex
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
     * @var string $gender
     *
     * @ORM\Column(name="gender", type="string", length=16, nullable=false)
     */
    private $gender;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", length=16, nullable=false)
     */
    private $title;

    /**
     * @var string $titleAbbrev
     *
     * @ORM\Column(name="title_abbrev", type="string", length=16, nullable=false)
     */
    private $titleAbbrev;



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
     * Set gender
     *
     * @param string $gender
     * @return Sex
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Sex
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set titleAbbrev
     *
     * @param string $titleAbbrev
     * @return Sex
     */
    public function setTitleAbbrev($titleAbbrev)
    {
        $this->titleAbbrev = $titleAbbrev;
    
        return $this;
    }

    /**
     * Get titleAbbrev
     *
     * @return string 
     */
    public function getTitleAbbrev()
    {
        return $this->titleAbbrev;
    }
}