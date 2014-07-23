<?php

namespace Prodi\TauenoBundle\Document;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceMany;

/**
 * @MongoDB\Document(repositoryClass="Prodi\TauenoBundle\Repository\SellerRepository")
 */
class Seller implements AdvancedUserInterface, \Serializable {

    /**
     * @MongoDB\Id
     */
    protected $id;

    /**
     * @MongoDB\Field(type="string")
     */
    private $username;

    /**
     * @MongoDB\Field(type="string")
     */
    private $name;

    /**
     * @MongoDB\Field(type="string")
     */
    private $lastname;

    /**
     * @Assert\Email()
     * @MongoDB\Field(type="string")
     */
    private $email;

    /**
     * @MongoDB\boolean
     */
    private $enabled;

    /**
     * @MongoDB\Field(type="string")
     */
    private $password;

    /**
     * @MongoDB\Field(type="string")
     */
    private $passforgt;

    /**
     * @MongoDB\Field(type="string")
     */
    private $salt;

    /**
     * @ReferenceMany(targetDocument="Role")
     */
    private $user_roles;

    /**
     * @MongoDB\Field(type="string")
     */
    private $address;

    /**
     * @MongoDB\Field(type="string")
     */
    private $movil;

    /**
     * @MongoDB\Field(type="string")
     */
    private $phone;

    /**
     * @OneToMany(targetEntity="Message", mappedBy="seller")
     */
    public $messages;

    /**
     * @MongoDB\boolean
     */
    protected $accountNonExpired;

    /**
     * @MongoDB\boolean
     */
    protected $credentialsNonExpired;

    /**
     * @MongoDB\boolean
     */
    protected $accountNonLocked;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->user_roles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enabled = true;
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->accountNonExpired = true;
        $this->accountNonLocked = true;
        $this->credentialsNonExpired = true;
    }

    /**
     * Set password
     *
     * @param string $password
     */
    public function setPassword($password) {
        $confg = Yaml::parse(__DIR__ . '/../../../../app/config/security.yml');
        $params = $confg['security']['encoders'][get_class($this)];

        $encode = new MessageDigestPasswordEncoder(
                $params['algorithm'], true, $params['iterations']
        );
        $this->password = $encode->encodePassword($password, $this->salt);
//        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    function equals(UserInterface $user) {
        if (!$user instanceof Seller)
            return false;

        if ($this->password !== $user->getPassword())
            return false;
        if ($this->getSalt() !== $user->getSalt())
            return false;
//        if ($this->getToken() !== $user->getToken())
//            return false;
        if ($this->enabled !== $user->isEnabled())
            return false;

        return true;
    }

    public function __toString() {
        return $this->email;
    }

    public function getRoles() {
        $roles = array();
        foreach ($this->user_roles as $role) {
            $roles[] = $role->getRole();
        }

        return $roles;
    }

    public function getAvatar() {
        return "avatar.png";
    }

    public function eraseCredentials() {
        
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getUsername() {
        return $this->email;
    }

    public function isAccountNonExpired() {
        return $this->accountNonExpired;
    }

    public function isAccountNonLocked() {
        return $this->accountNonLocked;
    }

    public function isCredentialsNonExpired() {
        return $this->credentialsNonExpired;
    }

    public function isEnabled() {
        return $this->enabled;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Seller
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Seller
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
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
     * Set lastname
     *
     * @param string $lastname
     * @return Seller
     */
    public function setLastname($lastname) {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Seller
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return Seller
     */
    public function setEnabled($enabled) {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean 
     */
    public function getEnabled() {
        return $this->enabled;
    }

    /**
     * Set passforgt
     *
     * @param string $passforgt
     * @return Seller
     */
    public function setPassforgt($passforgt) {
        $this->passforgt = $passforgt;

        return $this;
    }

    /**
     * Get passforgt
     *
     * @return string 
     */
    public function getPassforgt() {
        return $this->passforgt;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Seller
     */
    public function setSalt($salt) {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set movil
     *
     * @param string $movil
     * @return Seller
     */
    public function setMovil($movil) {
        $this->movil = $movil;

        return $this;
    }

    /**
     * Get movil
     *
     * @return string 
     */
    public function getMovil() {
        return $this->movil;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Seller
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set accountNonExpired
     *
     * @param boolean $accountNonExpired
     * @return Seller
     */
    public function setAccountNonExpired($accountNonExpired) {
        $this->accountNonExpired = $accountNonExpired;

        return $this;
    }

    /**
     * Get accountNonExpired
     *
     * @return boolean 
     */
    public function getAccountNonExpired() {
        return $this->accountNonExpired;
    }

    /**
     * Set credentialsNonExpired
     *
     * @param boolean $credentialsNonExpired
     * @return Seller
     */
    public function setCredentialsNonExpired($credentialsNonExpired) {
        $this->credentialsNonExpired = $credentialsNonExpired;

        return $this;
    }

    /**
     * Get credentialsNonExpired
     *
     * @return boolean 
     */
    public function getCredentialsNonExpired() {
        return $this->credentialsNonExpired;
    }

    /**
     * Set accountNonLocked
     *
     * @param boolean $accountNonLocked
     * @return Seller
     */
    public function setAccountNonLocked($accountNonLocked) {
        $this->accountNonLocked = $accountNonLocked;

        return $this;
    }

    /**
     * Get accountNonLocked
     *
     * @return boolean 
     */
    public function getAccountNonLocked() {
        return $this->accountNonLocked;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return self
     */
    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    /**
     * Get address
     *
     * @return string $address
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * Add user_roles
     *
     * @param Prodi\TauenoBundle\Document\Role $userRoles
     */
    public function addUserRole(\Prodi\TauenoBundle\Document\Role $userRoles) {
        $this->user_roles[] = $userRoles;
    }

    /**
     * Remove user_roles
     *
     * @param <variableType$userRoles
     */
    public function removeUserRole(\Prodi\TauenoBundle\Document\Role $userRoles) {
        $this->user_roles->removeElement($userRoles);
    }

    /**
     * Get user_roles
     *
     * @return Doctrine\Common\Collections\Collection $userRoles
     */
    public function getUserRoles() {
        return $this->user_roles;
    }

    /**
     * Serializes the content of the current User object
     * @return string
     */
    public function serialize() {
        return \json_encode(
                array($this->username, $this->password, $this->salt,
                    $this->user_roles, $this->id));
    }

    /**
     * Unserializes the given string in the current User object
     * @param serialized
     */
    public function unserialize($serialized) {
        list($this->username, $this->password, $this->salt,
                $this->user_roles, $this->id) = \json_decode(
                $serialized);
    }
    
    
    public function getChatUser(){
        $array = explode(".", $this->email);
        return str_replace("@", "_", $array[0]);
    }

}
