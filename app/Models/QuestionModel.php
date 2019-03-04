<?php

namespace Quizzoclock\Models;

use Quizzoclock\Utils\Database;

use PDO;

class QuestionModel extends CoreModel {
  protected $quizId;

  protected $question;

  protected $prop1;

  protected $prop2;

  protected $prop3;

  protected $prop4;

  protected $levelId;

  protected $anecdote;

  protected $wiki;

  protected $levelName;


  const TABLE_NAME = 'questions';

  public static function findQuestionsById($quizId){
    $sql = 'SELECT 
            `questions`.`id`,
            `questions`.`id_quiz` AS quizId,
            `questions`.`question`,
            `questions`.`prop1`,
            `questions`.`prop2`,
            `questions`.`prop3`,
            `questions`.`prop4`,
            `questions`.`id_level` AS levelId,
            `questions`.`anecdote`,
            `questions`.`wiki`,
            `levels`.`name` AS levelName
            FROM ' . static::TABLE_NAME .
            ' INNER JOIN `levels` ON `questions`.`id_level` = `levels`.`id` 
            WHERE `id_quiz` = :quizId
            ORDER BY `questions`.`id` ASC';
    $pdo = Database::getPDO();
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindValue(':quizId', $quizId, PDO::PARAM_INT);
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll(PDO::FETCH_CLASS, static::class);
    return $result;   
  }

  public static function findAnswerById($id) {
    $sql = 'SELECT
              `questions`.`prop1`
        FROM ' . static::TABLE_NAME . ' 
        WHERE `id` = :id 
    ';

    $pdo = Database::getPDO();
    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindValue(':id', $id, PDO::PARAM_INT);
    $pdoStatement->execute();
    $result = $pdoStatement->fetchObject(static::class);
    return $result->getProp1();
  }

  public function insert() {
          $sql = '
      INSERT INTO ' . self::TABLE_NAME . ' (
        `question`
        ,`prop1`
        ,`prop2`
        ,`prop3`
        ,`prop4`
        ,`id_level`
        ,`id_quiz`
        )
      VALUES (
        :question
        ,:prop1
        ,:prop2
        ,:prop3
        ,:prop4
        ,:levelId
        ,:quizId
        )
    ';

    $pdo = Database::getPDO();

    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindParam(':question', $this->question, PDO::PARAM_STR);
    $pdoStatement->bindParam(':prop1', $this->prop1, PDO::PARAM_STR);
    $pdoStatement->bindParam(':prop2', $this->prop2, PDO::PARAM_STR);
    $pdoStatement->bindParam(':prop3', $this->prop3, PDO::PARAM_STR);
    $pdoStatement->bindParam(':prop4', $this->prop4, PDO::PARAM_STR);
    $pdoStatement->bindParam(':quizId', $this->quizId, PDO::PARAM_INT);
    $pdoStatement->bindParam(':levelId', $this->levelId, PDO::PARAM_INT);

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

  public static function deleteByQuizId($quizId) {
    $sql = ' DELETE FROM '  . self::TABLE_NAME . 
    ' WHERE `id_quiz` = :quizId 
    ';

    $pdo = Database::getPDO();

    $pdoStatement = $pdo->prepare($sql);
    $pdoStatement->bindParam(':quizId', $quizId, PDO::PARAM_INT);
    $pdoStatement->execute();
  }


  /**
   * Get the value of quizId
   */ 
  public function getQuizId()
  {
    return $this->quizId;
  }

  /**
   * Set the value of quizId
   *
   * @return  self
   */ 
  public function setQuizId($quizId)
  {
    $this->quizId = $quizId;

    return $this;
  }

  /**
   * Get the value of question
   */ 
  public function getQuestion()
  {
    return $this->question;
  }

  /**
   * Set the value of question
   *
   * @return  self
   */ 
  public function setQuestion($question)
  {
    $this->question = $question;

    return $this;
  }

  /**
   * Get the value of prop1
   */ 
  public function getProp1()
  {
    return $this->prop1;
  }

  /**
   * Set the value of prop1
   *
   * @return  self
   */ 
  public function setProp1($prop1)
  {
    $this->prop1 = $prop1;

    return $this;
  }

  /**
   * Get the value of prop2
   */ 
  public function getProp2()
  {
    return $this->prop2;
  }

  /**
   * Set the value of prop2
   *
   * @return  self
   */ 
  public function setProp2($prop2)
  {
    $this->prop2 = $prop2;

    return $this;
  }

  /**
   * Get the value of prop3
   */ 
  public function getProp3()
  {
    return $this->prop3;
  }

  /**
   * Set the value of prop3
   *
   * @return  self
   */ 
  public function setProp3($prop3)
  {
    $this->prop3 = $prop3;

    return $this;
  }

  /**
   * Get the value of prop4
   */ 
  public function getProp4()
  {
    return $this->prop4;
  }

  /**
   * Set the value of prop4
   *
   * @return  self
   */ 
  public function setProp4($prop4)
  {
    $this->prop4 = $prop4;

    return $this;
  }


  /**
   * Get the value of anecdote
   */ 
  public function getAnecdote()
  {
    return $this->anecdote;
  }

  /**
   * Set the value of anecdote
   *
   * @return  self
   */ 
  public function setAnecdote($anecdote)
  {
    $this->anecdote = $anecdote;

    return $this;
  }

  /**
   * Get the value of wiki
   */ 
  public function getWiki()
  {
    return $this->wiki;
  }

  /**
   * Set the value of wiki
   *
   * @return  self
   */ 
  public function setWiki($wiki)
  {
    $this->wiki = $wiki;

    return $this;
  }

  /**
   * Get the value of levelName
   */ 
  public function getLevelName()
  {
    return $this->levelName;
  }

  /**
   * Set the value of levelName
   *
   * @return  self
   */ 
  public function setLevelName($levelName)
  {
    $this->levelName = $levelName;

    return $this;
  }

  /**
   * Get the value of levelId
   */ 
  public function getLevelId()
  {
    return $this->levelId;
  }

  /**
   * Set the value of levelId
   *
   * @return  self
   */ 
  public function setLevelId($levelId)
  {
    $this->levelId = $levelId;

    return $this;
  }
}