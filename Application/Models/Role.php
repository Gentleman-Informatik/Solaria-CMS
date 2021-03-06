<?php

namespace Solaria\Application\Models;

use Solaria\Framework\Application\Mvc\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="role")
 **/
class Role extends BaseModel {

    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="string") **/
    protected $name;

    /** @Column(type="integer") **/
    protected $parent_id;
    /**
     * One Role has Many UserRole.
     * @OneToMany(targetEntity="Solaria\App\Models\UserRole", mappedBy="role")
     */
    //protected $userRoles = null;

    /**
     * One Role has Many UserRole.
     * @OneToMany(targetEntity="Solaria\Application\Models\RolePermission", mappedBy="role")
     */
    protected $rolePermission = null;

    /**
     * One Category has Many Categories.
     * @OneToMany(targetEntity="Solaria\Application\Models\Role", mappedBy="extend")
     */
    protected $extendRole = null;

    /**
     * Many Responses have One Post.
     * @ManyToOne(targetEntity="Solaria\Application\Models\Role", inversedBy="extendRole")
     * @JoinColumn(name="parent_id", referencedColumnName="id")
     */
    protected $extend = null;

    public function __construct() {
        //$this->userRoles  = new ArrayCollection();
        $this->rolePermission  = new ArrayCollection();
        $this->extendRole = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getUserRole() {
        return $this->userRoles;
    }

    public function getRolePermission() {
        return $this->rolePermission;
    }

    public function getResourceRole() {
        return $this->resourceRole;
    }

    public function getExtendRole() {
        return $this->extendRole;
    }

    public function getExtendId() {
        return $this->extend_id;
    }

    public function setName($name) {
        $this->name = $name;
    }
}
