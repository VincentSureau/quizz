<?php

namespace Quizzoclock\Models;

use Quizzoclock\Utils\Database;

use PDO;

class QuizModel extends CoreModel {
  protected $title;

  protected $description;

  protected $authorId;

  protected $authorFirstName;

  protected $authorLastName;


  const TABLE_NAME = 'quizzes';

  public static function find($id){
    $sql = 'SELECT
            `quizzes`.`id`,
            `quizzes`.`title`,
            `quizzes`.`description`,
            `quizzes`.`id_author` AS authorId,
            `users`.`first_name` AS authorFirstName,
            `users`.`last_name` AS authorLastName
            FROM ' . static::TABLE_NAME .
            ' INNER JOIN `users` ON `quizzes`.`id_author` = `users`.`id` 
            WHERE `quizzes`.`id` = :id
          ';

    $pdo = Database::getPDO();
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
    $pdoStatement->execute();

    $result = $pdoStatement->fetchObject(static::class);
    return $result;  
  }

  public static function findAll(){
    $sql = 'SELECT 
            `quizzes`.`id`,
            `quizzes`.`title`,
            `quizzes`.`description`,
            `quizzes`.`id_author` AS authorId,
            `users`.`first_name` AS authorFirstName,
            `users`.`last_name` AS authorLastName
            FROM ' . static::TABLE_NAME .
            ' INNER JOIN `users` ON `quizzes`.`id_author` = `users`.`id`
            ORDER BY id ASC';
    $pdo = Database::getPDO();
    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
    return $result;   
  }

  public static function findByUser($userId){
    $sql = 'SELECT 
            `quizzes`.`id`,
            `quizzes`.`title`,
            `quizzes`.`description`,
            `quizzes`.`id_author` AS authorId,
            `users`.`first_name` AS authorFirstName,
            `users`.`last_name` AS authorLastName
            FROM ' . static::TABLE_NAME .
            ' INNER JOIN `users` ON `quizzes`.`id_author` = `users`.`id`
            WHERE `quizzes`.`id_author` = :userId
            ORDER BY id ASC';
    $pdo = Database::getPDO();
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindValue(':userId', $userId, PDO::PARAM_INT);
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
    return $result;   
  }

    public static function findByUserAndId($userId, $id){
    $sql = 'SELECT 
            `quizzes`.`id`,
            `quizzes`.`title`,
            `quizzes`.`description`,
            `quizzes`.`id_author` AS authorId,
            `users`.`first_name` AS authorFirstName,
            `users`.`last_name` AS authorLastName
            FROM ' . static::TABLE_NAME .
            ' INNER JOIN `users` ON `quizzes`.`id_author` = `users`.`id`
            WHERE `quizzes`.`id_author` = :userId AND `quizzes`.`id` = :id
            ORDER BY id ASC';
    $pdo = Database::getPDO();
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindValue(':userId', $userId, PDO::PARAM_INT);
    $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
    $pdoStatement->execute();
    $result = $pdoStatement->fetchObject(static::class);
    return $result;   
  }

  public function insert() {
      $sql = '
      INSERT INTO ' . self::TABLE_NAME . ' (
        `title`
        ,`description`
        ,`id_author`
        )
      VALUES (
        :title
        ,:description
        ,:authorId
        )
    ';

    $pdo = Database::getPDO();

    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindParam(':title', $this->title, PDO::PARAM_STR);
    $pdoStatement->bindParam(':description', $this->description, PDO::PARAM_STR);
    $pdoStatement->bindParam(':authorId', $this->authorId, PDO::PARAM_INT);

    $pdoStatement->execute();

    $insertedRow = $pdoStatement->rowCount();

    if($insertedRow < 1 ){
      return false;
    }

    $this->id = $pdo->lastInsertId();
    return true;
  }

  protected function update() {
    // toDo
  }

  // public static function delete() {
  //   $sql = ' DELETE FROM '  . self::TABLE_NAME . 
  //   ' WHERE `id` = :id 
  //   ';

  //   $pdo = Database::getPDO();

  //   $pdoStatement = $pdo->prepare($sql);
  //   $pdoStatement->bindParam(':id', $this->id, PDO::PARAM_INT);
  //   $pdoStatement->execute();
  // }


  /**
   * Get the value of title
   */ 
  public function getTitle()
  {
    return $this->title;
  }

  /**
   * Set the value of title
   *
   * @return  self
   */ 
  public function setTitle($title)
  {
    $this->title = $title;

    return $this;
  }

  /**
   * Get the value of description
   */ 
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */ 
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get the value of authorId
   */ 
  public function getAuthorId()
  {
    return $this->authorId;
  }

  /**
   * Set the value of authorId
   *
   * @return  self
   */ 
  public function setAuthorId($authorId)
  {
    $this->authorId = $authorId;

    return $this;
  }

  /**
   * Get the value of authorFirstName
   */ 
  public function getAuthorFirstName()
  {
    return $this->authorFirstName;
  }

  /**
   * Set the value of authorFirstName
   *
   * @return  self
   */ 
  public function setAuthorFirstName($authorFirstName)
  {
    $this->authorFirstName = $authorFirstName;

    return $this;
  }

  /**
   * Get the value of authorLastName
   */ 
  public function getAuthorLastName()
  {
    return $this->authorLastName;
  }

  /**
   * Set the value of authorLastName
   *
   * @return  self
   */ 
  public function setAuthorLastName($authorLastName)
  {
    $this->authorLastName = $authorLastName;

    return $this;
  }
}