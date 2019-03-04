<?php

namespace Quizzoclock\Models;

use Quizzoclock\Utils\Database;

use PDO;

class LevelModel extends CoreModel {
  protected $name;

  const TABLE_NAME = 'levels';

  public static function find($id){
    $sql = 'SELECT
            `levels`.`id`,
            `levels`.`name`
            FROM ' . static::TABLE_NAME .
            ' WHERE `levels`.`id` = :id
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
            `levels`.`id`,
            `levels`.`name`

            FROM ' . static::TABLE_NAME .
            ' ORDER BY id ASC';
    $pdo = Database::getPDO();
    $pdoStatement = $pdo->query($sql);
    $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
    return $result;   
  }

  public function insert() {
    // toDo
  }

  protected function update() {
    // toDo
  }


  /**
   * Get the value of name
   */ 
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */ 
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }
}