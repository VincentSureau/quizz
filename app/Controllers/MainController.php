<?php
namespace Quizzoclock\Controllers;

use Quizzoclock\Models\QuizModel;

class MainController extends CoreController {
  public function home() {
    $quizzes = QuizModel::findAll();
    $this->show('main/home', ['quizzes' => $quizzes]);
  }

  public function page404() {
    header("HTTP/1.0 404 Not Found");
    $this->show('main/page404');
  }
}