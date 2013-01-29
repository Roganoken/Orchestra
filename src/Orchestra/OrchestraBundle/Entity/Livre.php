<?php

namespace Orchestra\OrchestraBundle\Entity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Livre
 *
 * @ORM\Table(name="livre")
 * @ORM\Entity
 */
class Livre
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
     * @var string $isbn
     *
     * @ORM\Column(name="isbn", type="string", length=45, nullable=true)
     */
    private $isbn;

    /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=45, nullable=false)
     */
    private $titre;

    /**
     * @var text $resume
     *
     * @ORM\Column(name="resume", type="text", nullable=false)
     */
    private $resume;

    /**
     * @var \DateTime $annee
     *
     * @ORM\Column(name="annee", type="date", nullable=true)
     */
    private $annee;

    /**
     * @var string $illustration
     *
     * @ORM\Column(name="illustration", type="string", length=45, nullable=true)
     */
    private $illustration;

    /**
     * @var string $dateReservation
     *
     * @ORM\Column(name="date_reservation", type="date", nullable=true)
     */
    private $dateReservation;

    /**
     * @var string $dateEmprunt
     *
     * @ORM\Column(name="date_emprunt", type="date", nullable=true)
     */
    private $dateEmprunt;

    /**
     * @var string $dateRetour
     *
     * @ORM\Column(name="date_retour", type="date", nullable=true)
     */
    private $dateRetour;

    /**
     * @var string $codeBarre
     *
     * @ORM\Column(name="code_barre", type="string", length=45, nullable=true)
     */
    private $codeBarre;

    /**
     * @var boolean $active
     *
     * @ORM\Column(name="active", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var \DateTime $created
     *
     * @ORM\Column(name="created", type="date", nullable=true)
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @ORM\Column(name="updated", type="date", nullable=true)
     */
    private $updated;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Commentaire", inversedBy="livre")
     * @ORM\JoinTable(name="livre_commentaire",
     *   joinColumns={
     *     @ORM\JoinColumn(name="livre_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="commentaire_id", referencedColumnName="id")
     *   }
     * )
     */
    private $commentaire;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\User", mappedBy="livre")
     */
    private $user;

    /**
     * @var Auteur
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Auteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="auteur_id", referencedColumnName="id")
     * })
     */
    private $auteur;

    /**
     * @var Genre
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Genre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="genre_id", referencedColumnName="id")
     * })
     */
    private $genre;
    
    
    /**
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg"}
     * )
     *
     * @var File $file
     */
    public $file;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commentaire = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set isbn
     *
     * @param string $isbn
     * @return Livre
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    
        return $this;
    }

    /**
     * Get isbn
     *
     * @return string 
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Set titre
     *
     * @param string $titre
     * @return Livre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get titre
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set resume
     *
     * @param string $resume
     * @return Livre
     */
    public function setResume($resume)
    {
        $this->resume = $resume;
    
        return $this;
    }

    /**
     * Get resume
     *
     * @return string 
     */
    public function getResume()
    {
        return $this->resume;
    }

    /**
     * Set annee
     *
     * @param \DateTime $annee
     * @return Livre
     */
    public function setAnnee($annee)
    {    	    	 
        $this->annee = $annee;
    
        return $this;
    }

    /**
     * Get annee
     *
     * @return \DateTime 
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set illustration
     *
     * @param string $illustration
     * @return Livre
     */
    public function setIllustration($illustration)
    {
        $this->illustration = $illustration;
    
        return $this;
    }

    /**
     * Get illustration
     *
     * @return string 
     */
    public function getIllustration()
    {
        return $this->illustration;
    }

    /**
     * Set dateReservation
     *
     * @param string $dateReservation
     * @return Livre
     */
    public function setDateReservation($dateReservation)
    {
    	
        $this->dateReservation = $dateReservation;
    
        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return string 
     */
    public function getDateReservation()
    {
    	
        return $this->dateReservation;
    }

    /**
     * Set dateEmprunt
     *
     * @param string $dateEmprunt
     * @return Livre
     */
    public function setDateEmprunt($dateEmprunt)
    {
        $this->dateEmprunt = $dateEmprunt;
    
        return $this;
    }

    /**
     * Get dateEmprunt
     *
     * @return string 
     */
    public function getDateEmprunt()
    {
        return $this->dateEmprunt;
    }

    /**
     * Set dateRetour
     *
     * @param string $dateRetour
     * @return Livre
     */
    public function setDateRetour($dateRetour)
    {
        $this->dateRetour = $dateRetour;
    
        return $this;
    }

    /**
     * Get dateRetour
     *
     * @return string 
     */
    public function getDateRetour()
    {
        return $this->dateRetour;
    }

    /**
     * Set codeBarre
     *
     * @param string $codeBarre
     * @return Livre
     */
    public function setCodeBarre($codeBarre)
    {
        $this->codeBarre = $codeBarre;
    
        return $this;
    }

    /**
     * Get codeBarre
     *
     * @return string 
     */
    public function getCodeBarre()
    {
        return $this->codeBarre;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Livre
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Livre
     */
    public function setCreated($created)
    {
    	$this->created = $created;
    	//$this->setCreated(new \Datetime()); 
    	   
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
     * @return Livre
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    	//$this->setUpdated(new \Datetime());
    	
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
      * Add commentaire
      *
      * @param Orchestra\OrchestraBundle\Entity\Commentaire $commentaire
      * @return Livre
      */
     public function addCommentaire(\Orchestra\OrchestraBundle\Entity\Commentaire $commentaire)
     {
         $this->commentaire[] = $commentaire;
    
         return $this;
     }

     /**
      * Remove commentaire
      *
      * @param Orchestra\OrchestraBundle\Entity\Commentaire $commentaire
      */
     public function removeCommentaire(\Orchestra\OrchestraBundle\Entity\Commentaire $commentaire)
     {
         $this->commentaire->removeElement($commentaire);
     }

     /**
      * Get commentaire
      *
      * @return Doctrine\Common\Collections\Collection 
      */
     public function getCommentaire()
     {
         return $this->commentaire;
     }

     /**
      * Add user
      *
      * @param Orchestra\OrchestraBundle\Entity\User $user
      * @return Livre
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
     * Set auteur
     *
     * @param Orchestra\OrchestraBundle\Entity\Auteur $auteur
     * @return Livre
     */
    public function setAuteur(\Orchestra\OrchestraBundle\Entity\Auteur $auteur = null)
    {
        $this->auteur = $auteur;
    
        return $this;
    }

    /**
     * Get auteur
     *
     * @return Orchestra\OrchestraBundle\Entity\Auteur 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Set genre
     *
     * @param Orchestra\OrchestraBundle\Entity\Genre $genre
     * @return Livre
     */
    public function setGenre(\Orchestra\OrchestraBundle\Entity\Genre $genre = null)
    {
        $this->genre = $genre;
    
        return $this;
    }

    /**
     * Get genre
     *
     * @return Orchestra\OrchestraBundle\Entity\Genre 
     */
    public function getGenre()
    {
        return $this->genre;
    }
    
    
    
    public function getAbsolutePath()
    {
        return null === $this->photo ? null : $this->getUploadRootDir().'/'.$this->photo;
    }

    public function getWebPath()
    {
        return null === $this->photo ? null : $this->getUploadDir().'/'.$this->photo;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'bibliotheque';
    }
    
    
    public function uploadPicture()
    {

        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->file) {
            return;
        }
        
        $photoname = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
        
        // move copie le fichier présent chez le client dans le répertoire indiqué.
        $this->file->move($this->getUploadRootDir(), $photoname);

        // On sauvegarde le nom de fichier
        $this->illustration = $photoname;
        
        // La propriété file ne servira plus
        $this->file = null;
    }
    
    
    
}