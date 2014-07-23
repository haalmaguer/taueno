<?php

namespace Prodi\TauenoBundle\Document;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\OneToMany;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ORM\Mapping as ORM;

/**
 * @MongoDB\Document(repositoryClass="Prodi\TauenoBundle\Repository\UserRepository")
 */
class User implements AdvancedUserInterface {

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
     * @MongoDB\boolean
     */
    private $enabled;

    /**
     * @ORM\ManyToMany(targetEntity="\Prodi\TauenoBundle\Document\Role")
     * @ORM\JoinTable(name="customer_roles",
     *     joinColumns={@ORM\JoinColumn(name="customer_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    protected $user_roles;

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
        if (!$user instanceof User)
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
        return $this->user_roles->toArray();
    }

    public function getAvatar() {
        return "avatar.png";
    }

    public function eraseCredentials() {
        
    }

    public function getPassword() {
        
    }

    public function getSalt() {
        
    }

    public function getUsername() {
        
    }

    public function isAccountNonExpired() {
        
    }

    public function isAccountNonLocked() {
        
    }

    public function isCredentialsNonExpired() {
        
    }

    /**
     * Set username
     *
     * @param string $username
     * @return User
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
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
     * @return User
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
     * @return User
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
     * Set passforgt
     *
     * @param string $passforgt
     * @return User
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
     * @return User
     */
    public function setSalt($salt) {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set accountNonExpired
     *
     * @param boolean $accountNonExpired
     * @return User
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
     * @return User
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
     * @return User
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
     * Add user_roles
     *
     * @param \Prodi\TauenoBundle\Document\Role $userRoles
     * @return User
     */
    public function addUserRole(\Prodi\TauenoBundle\Document\Role $userRoles) {
        $this->user_roles[] = $userRoles;

        return $this;
    }

    /**
     * Remove user_roles
     *
     * @param \Prodi\TauenoBundle\Document\Role $userRoles
     */
    public function removeUserRole(\Prodi\TauenoBundle\Document\Role $userRoles) {
        $this->user_roles->removeElement($userRoles);
    }

    /**
     * Get user_roles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUserRoles() {
        return $this->user_roles;
    }

    public function isEnabled() {
        
    }


    /**
     * Set enabled
     *
     * @param boolean $enabled
     * @return self
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
        return $this;
    }

    /**
     * Get enabled
     *
     * @return boolean $enabled
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}
