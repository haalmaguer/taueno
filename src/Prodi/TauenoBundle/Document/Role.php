<?php

namespace Prodi\TauenoBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;
use Symfony\Component\Security\Core\Role\RoleInterface;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(repositoryClass="Prodi\TauenoBundle\Repository\RoleRepository")
 * 
 */
class Role implements RoleInterface, \Serializable {

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
    protected $description;

    
    /**
     * @ReferenceMany(targetDocument="Seller")
    */
    private $users;
    
    
    
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription() {
        return $this->description;
    }

    public function getRole() {
        return $this->name;
    }

    public function __toString() {
        return $this->name;
    }

    public function serialize() {
        /*
         * ! Don't serialize $users field !
         */
        return \serialize(array(
            $this->id,
            $this->name
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized) {
        list(
                $this->id,
                $this->name
                ) = \unserialize($serialized);
    }

    public function __construct()
    {
        $this->users = $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    
    

    /**
     * Add users
     *
     * @param Prodi\TauenoBundle\Document\Seller $users
     */
    public function addUser(\Prodi\TauenoBundle\Document\Seller $users)
    {
        $this->users[] = $users;
    }

    /**
    * Remove users
    *
    * @param <variableType$users
    */
    public function removeUser(\Prodi\TauenoBundle\Document\Seller $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return Doctrine\Common\Collections\Collection $users
     */
    public function getUsers()
    {
        return $this->users;
    }
}
