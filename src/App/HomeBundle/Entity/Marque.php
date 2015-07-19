<?php

namespace App\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marque
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\HomeBundle\Entity\MarqueRepository")
 */
class Marque
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
    mappedBy="marque")
    */
    private $autos;
    
     /**
    * @ORM\OneToMany(targetEntity="App\HomeBundle\Entity\Modele",
    mappedBy="marques")
    */
    private $mymodel;

    
    
  
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->autos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->mymodel = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nom
     *
     * @param string $nom
     * @return Marque
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
     * Add autos
     *
     * @param \App\HomeBundle\Entity\Auto $autos
     * @return Marque
     */
    public function addAuto(\App\HomeBundle\Entity\Auto $autos)
    {
        $this->autos[] = $autos;

        return $this;
    }

    /**
     * Remove autos
     *
     * @param \App\HomeBundle\Entity\Auto $autos
     */
    public function removeAuto(\App\HomeBundle\Entity\Auto $autos)
    {
        $this->autos->removeElement($autos);
    }

    /**
     * Get autos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAutos()
    {
        return $this->autos;
    }

    /**
     * Add mymodel
     *
     * @param \App\HomeBundle\Entity\Modele $mymodel
     * @return Marque
     */
    public function addMymodel(\App\HomeBundle\Entity\Modele $mymodel)
    {
        $this->mymodel[] = $mymodel;

        return $this;
    }

    /**
     * Remove mymodel
     *
     * @param \App\HomeBundle\Entity\Modele $mymodel
     */
    public function removeMymodel(\App\HomeBundle\Entity\Modele $mymodel)
    {
        $this->mymodel->removeElement($mymodel);
    }

    /**
     * Get mymodel
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMymodel()
    {
        return $this->mymodel;
    }
}
