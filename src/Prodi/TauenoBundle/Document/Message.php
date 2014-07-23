<?php

namespace Prodi\TauenoBundle\Document;

use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(repositoryClass="Prodi\TauenoBundle\Repository\MessageRepository")
 */
class Message {

    /**
     * @MongoDB\Id
     */
    protected $id;

   /**
     * @MongoDB\Field(type="string")
     */
    private $text;

    /**
     * @ManyToOne(targetEntity="Seller")
     * @JoinColumn(name="seller_id", referencedColumnName="id")
     */
    private $seller;

   

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
     * Set text
     *
     * @param string $text
     * @return self
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Get text
     *
     * @return string $text
     */
    public function getText()
    {
        return $this->text;
    }
}
