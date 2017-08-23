<?php

namespace Solaria\Application\Models;

use Solaria\Framework\Application\Mvc\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @Entity @Table(name="topic")
 **/
class Topic extends BaseModel {

  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /** @Column(type="string") **/
  protected $name;

  /** @Column(type="integer") **/
  protected $enabled;

  /** @Column(name="created", type="datetime")*/
  protected $created;

  /**
   * One Topic has Many Posts.
   * @OneToMany(targetEntity="Solaria\Application\Models\Post", mappedBy="topic")
   */
  protected $posts = null;


  public function __construct() {
    $this->posts = new ArrayCollection();
  }

  public static function findActiveTopic() {
      return self::findBy(array('enabled' => 1));
  }

  //Only use this in view!!!
  public function getTopics() {
      $result = 0;
      foreach ($this->getPosts() as $post) {
          if($post->getPostId() == null) {
              $result ++;
          }
      }
      return $result;
  }

  public function getCategoryId() {
    return $this->category_id;
  }

  public function addCategory($category) {
    $this->usedCategory[] = $category;
  }

  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getEnabled() {
    return $this->enabled;
  }

  public function getCreated() {
      return $this->created;
  }

  public function getCategory() {
    return $this->category;
  }

  public function getPosts() {
    return $this->posts;
  }

  public function setName($name) {
      $this->name = $name;
  }

  public function setCategory($category) {
      $this->category = $category;
  }

}
