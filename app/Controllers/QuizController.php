<?php
namespace Quizzoclock\Controllers;

use Quizzoclock\Models\QuestionModel;
use Quizzoclock\Models\QuizModel;
use Quizzoclock\Utils\User;

class QuizController extends CoreController {
  public function start($params) {
    $quiz = QuizModel::find($params['id']);
    if(empty($quiz)) {
      $this->forbidden();
    } else {
      $questions = QuestionModel::findQuestionsById($params['id']);
      $this->show('quizz/show', ['questions' => $questions, 'quiz' => $quiz]);
    }
  }

  public function checkAnswers($params) {
    $quiz = QuizModel::find($params['id']);
    if(empty($quiz) || empty($_POST)) {
      $this->forbidden();
    } else {
      $questions = QuestionModel::findQuestionsById($params['id']);
      $answers = [];
      foreach($_POST as $questionIndex => $answer) {
        $questionAnswers[filter_var($questionIndex, FILTER_SANITIZE_NUMBER_INT)] = [
          'userAnswer' => filter_var($answer, FILTER_SANITIZE_STRING),
          'rightAnswer' => filter_var(QuestionModel::findAnswerById($questionIndex), FILTER_SANITIZE_STRING)
        ];
      }
      $results = [];
      foreach($questionAnswers as $question => $answer) {
        $results[$question] = ($answer['userAnswer'] == $answer['rightAnswer'])? 'true' : 'false';
      }
      $countScore = array_count_values($results);
      if(isset($countScore['true'])) {
        $score = $countScore['true'];
      } else {
        $score = 0;
      }
      
      $questions = QuestionModel::findQuestionsById($params['id']);
      $this->show('quizz/show', ['questions' => $questions, 'quiz' => $quiz, 'score' => $score, 'questionAnswers' => $questionAnswers]);
    }
  }

  public function createQuiz() {
    $quiz = new QuizModel;
    $question = new QuestionModel;
    $isInserted = false;

    $errorList = [];
    if(!isset($_POST) || empty($_POST)) {
      $errorList[] = 'Veuillez compléter le formulaire';
    } elseif (!isset($_POST['authorId']) || empty(trim($_POST['authorId']))) {
      $errorList[] = 'Merci de ne pas modifier le questionnaire (valeur supprimée)';
    } else {
      $quiz->setAuthorId(filter_input(INPUT_POST, 'authorId', FILTER_VALIDATE_INT));
      if (!$quiz->getAuthorId()) {
        $errorList['authorId'] = 'Merci de ne pas modifier le questionnaire (valeur modifiée)';
      }

      if(!isset($_POST['title']) || empty(trim($_POST['title']))){
        $errorList[] = 'Veuillez renseigner un titre';
      } else {
        $quiz->setTitle(trim(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING)));
      };
      
      if(!isset($_POST['description']) || empty(trim($_POST['description']))){
        $errorList[] = 'Veuillez renseigner une description';
      } else {
        $quiz->setDescription(trim(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING)));
      };

      if(!isset($_POST['CGUCheck']) || ($_POST['CGUCheck']) != 'on'){
        $errorList[] = 'Veuillez accepter les conditions générales d\'utilisation';
      };
    }

    if(empty($errorList)) {
      $isInserted = $quiz->insert();
      if($isInserted) {
        static::sendJson([
          'code' => 1,
          'redirect' => '/eval-php/evaluation-back-oquiz-VincentSureau/public/my-account',
          'succesMessage' => 'Le quiz a bien été créé'
        ]);
      } else {
        $errorList['Une erreur s\'est produite'];
        static::sendJson([
          'code' => 2,
          'errorList' => $errorList
        ]);
      }
    } else {
      static::sendJson([
        'code' => 2,
        'errorList' => $errorList
      ]);
    }
  }

  public function delete($params) {
    $user = User::getConnectedUser();
    if(empty($user)){
      $this->show('main/forbidden');
      static::sendJson([
        'code' => 2,
        'redirect' => '/eval-php/evaluation-back-oquiz-VincentSureau/public/forbidden'
      ]);
    } elseif(!isset($params['id']) || !is_numeric($params['id'])) {
      $this->show('main/forbidden');
      static::sendJson([
        'code' => 2,
        'redirect' => '/eval-php/evaluation-back-oquiz-VincentSureau/public/forbidden'
      ]);
    } else {
      $userId = $user->getId();
      $quizId = $params['id'];
      $quiz = QuizModel::findByUserAndId($userId, $quizId);
      if(!$quiz) {
        $this->show('main/forbidden');
        static::sendJson([
          'code' => 2,
          'redirect' => '/eval-php/evaluation-back-oquiz-VincentSureau/public/forbidden'
        ]);
      } else {
        QuestionModel::deleteByQuizId($quizId);
        $quiz->delete();
        static::sendJson([
        'code' => 1,
        ]);
      }
    }

  }
}