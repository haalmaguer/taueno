<?php

namespace Prodi\TauenoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;

/**
 * @MongoDB\Document(repositoryClass="Prodi\TauenoBundle\Repository\TagRepository")
 */
class Tag {

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $name;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $value;
    
    
    /**
     * @ReferenceMany(targetDocument="Anuncio", mappedBy="tags")
     */
    public $anuncios;
    
    public function __toString() {
        return $this->value;
    }

   
    

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Get value
     *
     * @return string $value
     */
    public function getValue()
    {
        return $this->value;
    }
    public function __construct()
    {
        $this->anuncios = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add anuncios
     *
     * @param Prodi\TauenoBundle\Document\Anuncio $anuncios
     */
    public function addAnuncio(\Prodi\TauenoBundle\Document\Anuncio $anuncios)
    {
        $this->anuncios[] = $anuncios;
    }

    /**
    * Remove anuncios
    *
    * @param <variableType$anuncios
    */
    public function removeAnuncio(\Prodi\TauenoBundle\Document\Anuncio $anuncios)
    {
        $this->anuncios->removeElement($anuncios);
    }

    /**
     * Get anuncios
     *
     * @return Doctrine\Common\Collections\Collection $anuncios
     */
    public function getAnuncios()
    {
        return $this->anuncios;
    }
}
