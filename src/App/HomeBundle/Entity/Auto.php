<?php

namespace App\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auto
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\HomeBundle\Entity\AutoRepository")
 */
class Auto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbporte", type="integer", nullable=true)
     */
    private $nbporte;
    
    
     /**
     * @var integer
     *
     * @ORM\Column(name="prix", type="float")
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbcylindre", type="integer", nullable=true)
     */
    private $nbcylindre;

    /**
     * @var string
     *
     * @ORM\Column(name="energie", type="string", length=255, nullable=true)
     */
    private $energie;

    /**
     * @var integer
     *
     * @ORM\Column(name="puissance", type="integer", nullable=true)
     */
    private $puissance;

    /**
     * @var string
     *
     * @ORM\Column(name="boite", type="string", length=255, nullable=true)
     */
    private $boite;

   /**
   * @ORM\OneToOne(targetEntity="App\HomeBundle\Entity\Image", cascade={"persist"})
   * @ORM\JoinColumn(nullable=true)
   */
    private $image;
    
     /**
    * @ORM\ManyToOne(targetEntity="App\HomeBundle\Entity\Marque",
    inversedBy="autos")
    * @ORM\JoinColumn(nullable=true)
    */
    private $marque;
    
     /**
    * @ORM\ManyToOne(targetEntity="App\UserBundle\Entity\User",
    inversedBy="autosuser")
    * @ORM\JoinColumn(nullable=true)
    */
    private $user;
        
    /**
    * @ORM\ManyToOne(targetEntity="App\HomeBundle\Entity\Modele",
    inversedBy="mautos")
    * @ORM\JoinColumn(nullable=true)
    */
    private $modele;
    
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
     * @return Auto
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
     * Set description
     *
     * @param string $description
     * @return Auto
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
     * Set nbporte
     *
     * @param integer $nbporte
     * @return Auto
     */
    public function setNbporte($nbporte)
    {
        $this->nbporte = $nbporte;

        return $this;
    }

    /**
     * Get nbporte
     *
     * @return integer 
     */
    public function getNbporte()
    {
        return $this->nbporte;
    }

    /**
     * Set prix
     *
     * @param float $prix
     * @return Auto
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set nbcylindre
     *
     * @param integer $nbcylindre
     * @return Auto
     */
    public function setNbcylindre($nbcylindre)
    {
        $this->nbcylindre = $nbcylindre;

        return $this;
    }

    /**
     * Get nbcylindre
     *
     * @return integer 
     */
    public function getNbcylindre()
    {
        return $this->nbcylindre;
    }

    /**
     * Set energie
     *
     * @param string $energie
     * @return Auto
     */
    public function setEnergie($energie)
    {
        $this->energie = $energie;

        return $this;
    }

    /**
     * Get energie
     *
     * @return string 
     */
    public function getEnergie()
    {
        return $this->energie;
    }

    /**
     * Set puissance
     *
     * @param integer $puissance
     * @return Auto
     */
    public function setPuissance($puissance)
    {
        $this->puissance = $puissance;

        return $this;
    }

    /**
     * Get puissance
     *
     * @return integer 
     */
    public function getPuissance()
    {
        return $this->puissance;
    }

    /**
     * Set boite
     *
     * @param string $boite
     * @return Auto
     */
    public function setBoite($boite)
    {
        $this->boite = $boite;

        return $this;
    }

    /**
     * Get boite
     *
     * @return string 
     */
    public function getBoite()
    {
        return $this->boite;
    }

    /**
     * Set marque
     *
     * @param \App\HomeBundle\Entity\Marque $marque
     * @return Auto
     */
    public function setMarque(\App\HomeBundle\Entity\Marque $marque = null)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \App\HomeBundle\Entity\Marque 
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set modele
     *
     * @param \App\HomeBundle\Entity\Modele $modele
     * @return Auto
     */
    public function setModele(\App\HomeBundle\Entity\Modele $modele = null)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return \App\HomeBundle\Entity\Modele 
     */
    public function getModele()
    {
        return $this->modele;
    }

    /**
     * Set image
     *
     * @param \App\HomeBundle\Entity\Image $image
     * @return Auto
     */
    public function setImage(\App\HomeBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \App\HomeBundle\Entity\Image 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set user
     *
     * @param \App\UserBundle\Entity\User $user
     * @return Auto
     */
    public function setUser(\App\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \App\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
