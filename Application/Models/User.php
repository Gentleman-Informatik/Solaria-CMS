<?php

namespace Solaria\Application\Models;

use Solaria\Framework\Application\Mvc\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="user")
 **/
class User extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $steam_id;

    /** @Column(type="string") **/
    protected $steam_avatar;

    /** @Column(type="string") **/
    protected $username;

    /** @Column(type="string") **/
    protected $password;

    /** @Column(type="string") **/
    protected $email;

    /** @Column(type="integer") **/
    protected $isValid;

    /** @Column(type="string") **/
    protected $banned;

    /** @Column(type="integer") **/
    protected $registerDate;

    /** @Column(type="integer") **/
    protected $lastActivityTime;

    /**
     * One User has Many Posts.
     * @OneToMany(targetEntity="Solaria\Application\Models\Post", mappedBy="user_id")
     */
    protected $posts = null;

    /**
     * One User has Many UserRole ids.
     * @OneToMany(targetEntity="Solaria\Application\Models\UserRole", mappedBy="user")
     */
    protected $userRoles = null;

    public function __construct() {
      $this->posts      = new ArrayCollection();
      $this->userRoles  = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSteamId() {
        return $this->steam_id;
    }

    /**
     * @param mixed $steam_id
     */
    public function setSteamId($steam_id) {
        $this->steam_id = $steam_id;
    }

    /**
     * @return mixed
     */
    public function getSteamAvatar() {
        return $this->steam_avatar;
    }

    /**
     * @param mixed $steam_avatar
     */
    public function setSteamAvatar($steam_avatar) {
        $this->steam_avatar = $steam_avatar;
    }

    /**
     * @return mixed
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getisValid() {
        return $this->isValid;
    }

    /**
     * @param mixed $isValid
     */
    public function setIsValid($isValid) {
        $this->isValid = $isValid;
    }

    /**
     * @return mixed
     */
    public function getBanned() {
        return $this->banned;
    }

    /**
     * @param mixed $banned
     */
    public function setBanned($banned) {
        $this->banned = $banned;
    }

    /**
     * @return mixed
     */
    public function getRegisterDate() {
        return $this->registerDate;
    }

    /**
     * @param mixed $registerDate
     */
    public function setRegisterDate($registerDate) {
        $this->registerDate = $registerDate;
    }

    /**
     * @return mixed
     */
    public function getLastActivityTime() {
        return $this->lastActivityTime;
    }

    /**
     * @param mixed $lastActivityTime
     */
    public function setLastActivityTime($lastActivityTime) {
        $this->lastActivityTime = $lastActivityTime;
    }



}
