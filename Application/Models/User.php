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

    public function setUsername($username) {
      $this->username = $username;
    }

    public function setPassword($password) {
      $this->password = $password;
    }

    public function setSteamId($steam_id) {
        $this->steam_id = $steam_id;
    }

    public function setSteamAvatar($steam_avatar) {
        $this->steam_avatar = $steam_avatar;
    }

    public function getSteamAvatar() {
        return $this->steam_avatar;
    }

    public function getPosts() {
      return $this->posts;
    }

    public function getUserRole() {
        return $this->userRoles;
    }

    public function getId() {
      return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }


}
