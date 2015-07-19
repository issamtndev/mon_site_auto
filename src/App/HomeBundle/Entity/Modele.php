<?php

namespace App\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modele
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\HomeBundle\Entity\ModeleRepository")
 */
class Modele
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
    * @ORM\OneToMany(targetEntity="App\HomeBundle\Entity\Auto",
    mappedBy="modele")
    */
    private $mautos;
    
    /**
    * @ORM\ManyToOne(targetEntity="App\HomeBundle\Entity\Marque",
    inversedBy="mymodel")
    * @ORM\JoinColumn(nullable=true)
    */
    private $marques;
    
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
     * Set nom
     *
     * @param string $nom
     * @return Modele
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mautos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add mautos
     *
     * @param \App\HomeBundle\Entity\Auto $mautos
     * @return Modele
     */
    public function addMauto(\App\HomeBundle\Entity\Auto $mautos)
    {
        $this->mautos[] = $mautos;

        return $this;
    }

    /**
     * Remove mautos
     *
     * @param \App\HomeBundle\Entity\Auto $mautos
     */
    public function removeMauto(\App\HomeBundle\Entity\Auto $mautos)
    {
        $this->mautos->removeElement($mautos);
    }

    /**
     * Get mautos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMautos()
    {
        return $this->mautos;
    }

    /**
     * Add models
     *
     * @param \App\HomeBundle\Entity\Marque $models
     * @return Modele
     */
    public function addModel(\App\HomeBundle\Entity\Marque $models)
    {
        $this->models[] = $models;

        return $this;
    }

    /**
     * Remove models
     *
     * @param \App\HomeBundle\Entity\Marque $models
     */
    public function removeModel(\App\HomeBundle\Entity\Marque $models)
    {
        $this->models->removeElement($models);
    }

    /**
     * Get models
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * Set marques
     *
     * @param \App\HomeBundle\Entity\Marque $marques
     * @return Modele
     */
    public function setMarques(\App\HomeBundle\Entity\Marque $marques = null)
    {
        $this->marques = $marques;

        return $this;
    }

    /**
     * Get marques
     *
     * @return \App\HomeBundle\Entity\Marque 
     */
    public function getMarques()
    {
        return $this->marques;
    }
}
