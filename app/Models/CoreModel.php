<?php
namespace Quizzoclock\Models;
use Quizzoclock\Utils\Database;
use PDO;
abstract class CoreModel {
    /** @var int */
    protected $id;
    
    abstract protected function insert();
    
    abstract protected function update();
    
    public static function findAll(){
      $sql = 'SELECT *
              FROM ' . static::TABLE_NAME .
              ' ORDER BY id DESC';
      $pdo = Database::getPDO();
      $pdoStatement = $pdo->query($sql);
      $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
      return $result;   
    }

    public static function find($id){
        $sql = 'SELECT *
                FROM ' . static::TABLE_NAME .
              ' WHERE id = :id';
 
        $pdo = Database::getPDO();
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
        $pdoStatement->execute();

        $result = $pdoStatement->fetchObject(static::class);
        return $result;  
    }

    public function delete(){
        $sql = '
              DELETE FROM ' . static::TABLE_NAME .
            ' WHERE id = :id';
        
        $pdo = Database::getPDO();
        
        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
        $pdoStatement->execute();
        
        $affectedRow = $pdoStatement->rowCount();
        if($affectedRow < 1 ){
            return false;
        }
        return true;
    }

    /**
    * Get the value of id
    */ 
    public function getId()
    {
          return $this->id;
    }

    /**
    * Set the value of id
    *
    * @return  self
    */ 
    public function setId($id)
    {
          $this->id = $id;

          return $this;
    }
}