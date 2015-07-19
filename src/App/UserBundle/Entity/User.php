<?php

namespace App\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
    * @ORM\OneToMany(targetEntity="App\HomeBundle\Entity\Auto",
    mappedBy="user")
    */
    private $autosuser;
    
    public function __construct()
    {
        parent::__construct();
        // your own logic
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
     * Add autosuser
     *
     * @param \App\HomeBundle\Entity\Auto $autosuser
     * @return User
     */
    public function addAutosuser(\App\HomeBundle\Entity\Auto $autosuser)
    {
        $this->autosuser[] = $autosuser;

        return $this;
    }

    /**
     * Remove autosuser
     *
     * @param \App\HomeBundle\Entity\Auto $autosuser
     */
    public function removeAutosuser(\App\HomeBundle\Entity\Auto $autosuser)
    {
        $this->autosuser->removeElement($autosuser);
    }

    /**
     * Get autosuser
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAutosuser()
    {
        return $this->autosuser;
    }
}
