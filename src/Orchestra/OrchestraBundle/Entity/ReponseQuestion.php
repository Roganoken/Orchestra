<?php

namespace Orchestra\OrchestraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\ReponseQuestion
 *
 * @ORM\Table(name="reponse_question")
 * @ORM\Entity
 */
class ReponseQuestion
{
    /**
     * @var Reponse
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Reponse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reponse_id", referencedColumnName="id")
     * })
     */
    private $reponse;

    /**
     * @var Question
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Question")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     * })
     */
    private $question;

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
     * Set reponse
     *
     * @param Orchestra\OrchestraBundle\Entity\Reponse $reponse
     * @return ReponseQuestion
     */
    public function setReponse(\Orchestra\OrchestraBundle\Entity\Reponse $reponse)
    {
        $this->reponse = $reponse;
    
        return $this;
    }

    /**
     * Get reponse
     *
     * @return Orchestra\OrchestraBundle\Entity\Reponse 
     */
    public function getReponse()
    {
        return $this->reponse;
    }

    /**
     * Set question
     *
     * @param Orchestra\OrchestraBundle\Entity\Question $question
     * @return ReponseQuestion
     */
    public function setQuestion(\Orchestra\OrchestraBundle\Entity\Question $question)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return Orchestra\OrchestraBundle\Entity\Question 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set user
     *
     * @param Orchestra\OrchestraBundle\Entity\User $user
     * @return ReponseQuestion
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