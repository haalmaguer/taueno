<?php

namespace Prodi\TauenoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;

/**
 * @MongoDB\Document(repositoryClass="Prodi\TauenoBundle\Repository\EventRepository")
 */
class Event {

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $title;

    /**
     * @MongoDB\Field(type="string")
     */
    private $description;

    /**
     * @MongoDB\Field(type="float")
     */
    private $price;

    /**
     * @MongoDB\Field(type="string")
     */
    private $currency;

    /**
     * @MongoDB\Field(type="string")
     */
    private $status;

    /**
     * @MongoDB\Field(type="string")
     */
    private $location;

    /**
     * @MongoDB\Field(type="int")
     */
    private $tauenos;

    /**
     * @MongoDB\Field(type="int")
     */
    private $visits;

    /**
     * @MongoDB\Field(type="date")
     */
    private $publish_date;

    /**
     * @MongoDB\Field(type="date")
     */
    private $start_date;
    
    /**
     * @MongoDB\Field(type="date")
     */
    private $end_date;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private $active;

    /**
     * @MongoDB\Field(type="boolean")
     */
    private $report;

    /**
     * @MongoDB\Field(type="float")
     */
    private $score;

    /**
     * @MongoDB\Field(type="string")
     */
    private $owner;

    /**
     * @ReferenceMany(targetDocument="Tag", inversedBy="anuncios")
     */
    public $tags;


    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set title
     *
     * @param string $title
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return float $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return self
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Get currency
     *
     * @return string $currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return self
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * Get status
     *
     * @return string $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return self
     */
    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    /**
     * Get location
     *
     * @return string $location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set tauenos
     *
     * @param int $tauenos
     * @return self
     */
    public function setTauenos($tauenos)
    {
        $this->tauenos = $tauenos;
        return $this;
    }

    /**
     * Get tauenos
     *
     * @return int $tauenos
     */
    public function getTauenos()
    {
        return $this->tauenos;
    }

    /**
     * Set visits
     *
     * @param int $visits
     * @return self
     */
    public function setVisits($visits)
    {
        $this->visits = $visits;
        return $this;
    }

    /**
     * Get visits
     *
     * @return int $visits
     */
    public function getVisits()
    {
        return $this->visits;
    }

    /**
     * Set publish_date
     *
     * @param date $publishDate
     * @return self
     */
    public function setPublishDate($publishDate)
    {
        $this->publish_date = $publishDate;
        return $this;
    }

    /**
     * Get publish_date
     *
     * @return date $publishDate
     */
    public function getPublishDate()
    {
        return $this->publish_date;
    }

    /**
     * Set start_date
     *
     * @param date $startDate
     * @return self
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;
        return $this;
    }

    /**
     * Get start_date
     *
     * @return date $startDate
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set end_date
     *
     * @param date $endDate
     * @return self
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;
        return $this;
    }

    /**
     * Get end_date
     *
     * @return date $endDate
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return self
     */
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean $active
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set report
     *
     * @param boolean $report
     * @return self
     */
    public function setReport($report)
    {
        $this->report = $report;
        return $this;
    }

    /**
     * Get report
     *
     * @return boolean $report
     */
    public function getReport()
    {
        return $this->report;
    }

    /**
     * Set score
     *
     * @param float $score
     * @return self
     */
    public function setScore($score)
    {
        $this->score = $score;
        return $this;
    }

    /**
     * Get score
     *
     * @return float $score
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set owner
     *
     * @param string $owner
     * @return self
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
        return $this;
    }

    /**
     * Get owner
     *
     * @return string $owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Add tags
     *
     * @param Prodi\TauenoBundle\Document\Tag $tags
     */
    public function addTag(\Prodi\TauenoBundle\Document\Tag $tags)
    {
        $this->tags[] = $tags;
    }

    /**
    * Remove tags
    *
    * @param <variableType$tags
    */
    public function removeTag(\Prodi\TauenoBundle\Document\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return Doctrine\Common\Collections\Collection $tags
     */
    public function getTags()
    {
        return $this->tags;
    }
}
