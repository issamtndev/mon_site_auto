<?php

namespace App\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="App\HomeBundle\Entity\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Image
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
   * @ORM\Column(name="url", type="string", length=255)
   */
  private $url;

  /**
   * @ORM\Column(name="alt", type="string", length=255)
   */
  private $alt;

  private $file;

  // On ajoute cet attribut pour y stocker temporairement le nom du fichier
  private $tempFilename;

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
   * Set url
   *
   * @param string $url
   *
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
   * Set alt
   *
   * @param string $alt
   *
   * @return Image
   */
  public function setAlt($alt)
  {
    $this->alt = $alt;

    return $this;
  }

  /**
   * Get alt
   *
   * @return string
   */
  public function getAlt()
  {
    return $this->alt;
  }

  public function getFile()
  {
    return $this->file;
  }

  // On modifie le setter de File, pour prendre en compte l'upload d'un fichier lorsqu'il en existe dÃ©jÃ  un autre
  public function setFile(UploadedFile $file)
  {
    $this->file = $file;

    // On vÃ©rifie si on avait dÃ©jÃ  un fichier pour cette entitÃ©
    if (null !== $this->url) {
      // On sauvegarde l'extension du fichier pour le supprimer plus tard
      $this->tempFilename = $this->url;

      // On rÃ©initialise les valeurs des attributs url et alt
      $this->url = null;
      $this->alt = null;
    }
  }

  /**
   * @ORM\PrePersist()
   * @ORM\PreUpdate()
   */
  public function preUpload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif)
    if (null === $this->file) {
      return;
    }

    // Le nom du fichier est son id, on doit juste stocker Ã©galement son extension
    // Pour faire propre, on devrait renommer cet attribut en Â« extension Â», plutÃ´t que Â« url Â»
    $this->url = $this->file->guessExtension();

    // Et on gÃ©nÃ¨re l'attribut alt de la balise <img>, Ã  la valeur du nom du fichier sur le PC de l'internaute
    $this->alt = $this->file->getClientOriginalName();
  }

  /**
   * @ORM\PostPersist()
   * @ORM\PostUpdate()
   */
  public function upload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif)
    if (null === $this->file) {
      return;
    }

    // Si on avait un ancien fichier, on le supprime
    if (null !== $this->tempFilename) {
      $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
      if (file_exists($oldFile)) {
        unlink($oldFile);
      }
    }

    // On dÃ©place le fichier envoyÃ© dans le rÃ©pertoire de notre choix
    $this->file->move(
      $this->getUploadRootDir(), // Le rÃ©pertoire de destination
      $this->id.'.'.$this->url   // Le nom du fichier Ã  crÃ©er, ici Â« id.extension Â»
    );
  }

  /**
   * @ORM\PreRemove()
   */
  public function preRemoveUpload()
  {
    // On sauvegarde temporairement le nom du fichier, car il dÃ©pend de l'id
    $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
  }

  /**
   * @ORM\PostRemove()
   */
  public function removeUpload()
  {
    // En PostRemove, on n'a pas accÃ¨s Ã  l'id, on utilise notre nom sauvegardÃ©
    if (file_exists($this->tempFilename)) {
      // On supprime le fichier
      unlink($this->tempFilename);
    }
  }

  public function getUploadDir()
  {
    // On retourne le chemin relatif vers l'image pour un navigateur
    return 'uploads/img';
  }
  
  public function getWebPath()
  {
    // On retourne le chemin relatif vers l'image pour un navigateur
    return "../../../../web/".$this->getUploadDir().'/'.$this->id.'.'.$this->url;
  }

  protected function getUploadRootDir()
  {
    // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
  }
}
