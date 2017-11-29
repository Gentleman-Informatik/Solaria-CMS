<?php

namespace Solaria\Application\Models;

use Solaria\Framework\Application\Mvc\BaseModel;
use Doctrine\Common\Collections\ArrayCollection;

//@AS_TODO: Move this out of the post model!
use Solaria\Framework\Core\Application;

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

  //Only call this in the view!
  public function getLatestPost($topicId) {
      $em = Application::$di->get('EntityManager');
      $qb = $em->createQueryBuilder();
      $qb->select('p')
      ->from('Solaria\Application\Models\Post', 'p')
      ->where('p.topic_id = :identifier')
      ->andWhere('p.post_id IS NULL')
      ->orderBy('p.created', 'DESC')
      ->setMaxResults(1)
      ->setParameter('identifier', $topicId);
      $query = $qb->getQuery();
      return $query->getResult();
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

  public function setEnabled($enabled) {
    $this->enabled = $enabled;
  }

  public function setCreated($created) {
    $this->created = $created;
  }

  public function setCategory($category) {
      $this->category = $category;
  }

}
