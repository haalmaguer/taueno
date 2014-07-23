<?php

namespace Prodi\TauenoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;

/**
 * @MongoDB\Document(repositoryClass="Prodi\TauenoBundle\Repository\CategoryRepository")
 */
class Category {

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
    protected $type;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $color;

    /**
     * @ReferenceMany(targetDocument="Anuncio")
     */
    private $anuncios;

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return self
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return self
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set color
     *
     * @param string $color
     * @return self
     */
    public function setColor($color) {
        $this->color = $color;
        return $this;
    }

    /**
     * Get color
     *
     * @return string $color
     */
    public function getColor() {
        return $this->color;
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
    
    public function __toString() {
        return "".$this->name;
    }
    
}
