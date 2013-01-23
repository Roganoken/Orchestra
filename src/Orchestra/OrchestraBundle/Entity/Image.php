<?php

namespace Orchestra\OrchestraBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orchestra\OrchestraBundle\Entity\Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity
 */
class Image
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
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=45, nullable=false)
     */
    private $titre;

    /**
     * @var string $descriptif
     *
     * @ORM\Column(name="descriptif", type="text", nullable=false)
     */
    private $descriptif;

    /**
     * @var \DateTime $dateCreation
     *
     * @ORM\Column(name="date_creation", type="date", nullable=false)
     */
    private $dateCreation;

    /**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=45, nullable=false)
     */
    private $url;

    /**
     * @var string $taille
     *
     * @ORM\Column(name="taille", type="string", length=45, nullable=true)
     */
    private $taille;

    /**
     * @var string $poids
     *
     * @ORM\Column(name="poids", type="string", length=45, nullable=true)
     */
    private $poids;

    /**
     * @var string $logiciel
     *
     * @ORM\Column(name="logiciel", type="string", length=45, nullable=true)
     */
    private $logiciel;

    /**
     * @var string $motCle
     *
     * @ORM\Column(name="mot_cle", type="string", length=45, nullable=true)
     */
    private $motCle;

    /**
     * @var datetime $created
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

    /**
     * @var datetime $updated
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var boolean $isPortfolio
     *
     * @ORM\Column(name="is_portfolio", type="boolean", nullable=true)
     */
    private $isPortfolio;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\Commentaire", inversedBy="image")
     * @ORM\JoinTable(name="image_commentaire",
     *   joinColumns={
     *     @ORM\JoinColumn(name="image_id", referencedColumnName="id")
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
     * @ORM\ManyToMany(targetEntity="Orchestra\OrchestraBundle\Entity\User", mappedBy="image")
     */
    private $user;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="Orchestra\OrchestraBundle\Entity\Media")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="media_id", referencedColumnName="id")
     * })
     */
    private $media;
    
    /**
     * @Assert\File(
     *     maxSize="3M",
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
     * Set titre
     *
     * @param string $titre
     * @return Image
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
     * Set descriptif
     *
     * @param string $descriptif
     * @return Image
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;
    
        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string 
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Image
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    
        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set taille
     *
     * @param string $taille
     * @return Image
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;
    
        return $this;
    }

    /**
     * Get taille
     *
     * @return string 
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set poids
     *
     * @param string $poids
     * @return Image
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;
    
        return $this;
    }

    /**
     * Get poids
     *
     * @return string 
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set logiciel
     *
     * @param string $logiciel
     * @return Image
     */
    public function setLogiciel($logiciel)
    {
        $this->logiciel = $logiciel;
    
        return $this;
    }

    /**
     * Get logiciel
     *
     * @return string 
     */
    public function getLogiciel()
    {
        return $this->logiciel;
    }

    /**
     * Set motCle
     *
     * @param string $motCle
     * @return Image
     */
    public function setMotCle($motCle)
    {
        $this->motCle = $motCle;
    
        return $this;
    }

    /**
     * Get motCle
     *
     * @return string 
     */
    public function getMotCle()
    {
        return $this->motCle;
    }

    /**
     * Set created
     *
     * @param string $created
     * @return Image
     */
    public function setCreated($created)
    {
        $this->created = $created;
    
        return $this;
    }

    /**
     * Get created
     *
     * @return string 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param string $updated
     * @return Image
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    
        return $this;
    }

    /**
     * Get updated
     *
     * @return string 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set isPortfolio
     *
     * @param boolean $isPortfolio
     * @return Image
     */
    public function setIsPortfolio($isPortfolio)
    {
        $this->isPortfolio = $isPortfolio;
    
        return $this;
    }

    /**
     * Get isPortfolio
     *
     * @return boolean 
     */
    public function getIsPortfolio()
    {
        return $this->isPortfolio;
    }

    /**
     * Add commentaire
     *
     * @param Orchestra\OrchestraBundle\Entity\Commentaire $commentaire
     * @return Image
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
     * @return Image
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
     * Set media
     *
     * @param Orchestra\OrchestraBundle\Entity\Media $media
     * @return Image
     */
    public function setMedia(\Orchestra\OrchestraBundle\Entity\Media $media = null)
    {
        $this->media = $media;
    
        return $this;
    }

    /**
     * Get media
     *
     * @return Orchestra\OrchestraBundle\Entity\Media 
     */
    public function getMedia()
    {
        return $this->media;
    }
    
    
    public function getAbsolutePath()
    {
        return null === $this->url ? null : $this->getUploadRootDir().'/'.$this->url;
    }

    public function getWebPath()
    {
        return null === $this->url ? null : $this->getUploadDir().'/'.$this->url;
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
        return 'image';
    }
    
    public function uploadProfilePicture($user)
    {

        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->file) {
            return;
        }
        
        $imagename = $user.sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
        
        // move copie le fichier présent chez le client dans le répertoire indiqué.
        $this->file->move($this->getUploadRootDir(), $imagename);

        // On sauvegarde le nom de fichier
        $this->url = $imagename;
        
        // La propriété file ne servira plus
        $this->file = null;
    }
}