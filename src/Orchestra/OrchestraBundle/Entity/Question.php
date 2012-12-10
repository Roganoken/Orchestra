<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Question
 *
 * @ORM\Table(name="question")
 * @ORM\Entity
 */
class Question
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
     * @var string $question
     *
     * @ORM\Column(name="question", type="string", length=45, nullable=true)
     */
    private $question;

    /**
     * @var Sondage
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Sondage")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sondage_id", referencedColumnName="id")
     * })
     */
    private $sondage;



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
     * Set question
     *
     * @param string $question
     * @return Question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return string 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set sondage
     *
     * @param Orchestra\OrchestraBundle\Entity\Sondage $sondage
     * @return Question
     */
    public function setSondage(\Orchestra\OrchestraBundle\Entity\Sondage $sondage = null)
    {
        $this->sondage = $sondage;
    
        return $this;
    }

    /**
     * Get sondage
     *
     * @return Orchestra\OrchestraBundle\Entity\Sondage 
     */
    public function getSondage()
    {
        return $this->sondage;
    }
}