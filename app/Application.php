<?php

Namespace Quizzoclock;

use AltoRouter;

class Application {

  private $router;

  private $config;

  public function __construct() {
    $this->router = new AltoRouter();

    $config = parse_ini_file(__DIR__ . '/config.ini',true);

    $this->config = $config;

    $this->router->setBasePath($config['BASE_PATH']);

    $this->defineRoutes();
  }

  public function defineRoutes() {
    $this->router->map('GET', '/', 'MainController#home', 'main_home');
    $this->router->map('GET', '/quiz/[i:id]', 'QuizController#start', 'quiz_page');
    $this->router->map('GET', '/sign-up', 'UserController#displaySignUpForm', 'sign_up_form');
    $this->router->map('GET', '/login', 'UserController#displaySignInForm', 'sign_in_form');
    $this->router->map('POST', '/register', 'UserController#signUp', 'sign_up');
    $this->router->map('POST', '/sign-in', 'UserController#signIn', 'sign_in');
    $this->router->map('GET', '/logout', 'UserController#logout', 'logout');
    $this->router->map('GET', '/my-account', 'UserController#userAccount', 'account_page');
    $this->router->map('POST', '/check-quiz/[i:id]', 'QuizController#checkAnswers', 'quiz_result');
    $this->router->map('GET', '/profile/[i:id]', 'UserController#displayProfile', 'user_profile');
    $this->router->map('POST', '/create-quiz', 'QuizController#createQuiz', 'create_quiz');
    $this->router->map('GET|POST', '/edit-quiz/[i:id]', 'QuizController#edit', 'edit_quiz');
    $this->router->map('GET|POST', '/delete-quiz/[i:id]', 'QuizController#delete', 'delete_quiz');

  }

  public function run() {
    $match =  $this->router->match();

    if ($match) {
      list($controllerName, $methodName) = explode('#', $match['target']);
      $controllerName = 'Quizzoclock\Controllers\\'. $controllerName;
      $controller = new $controllerName($this);
      $controller->$methodName($match['params']);
    } else {
      $controller = new Controllers\MainController($this);
      $controller->page404();
    }
  }

  /**
   * Get the value of router
   */ 
  public function getRouter()
  {
    return $this->router;
  }

  /**
   * Set the value of router
   *
   * @return  self
   */ 
  public function setRouter($router)
  {
    $this->router = $router;

    return $this;
  }

  /**
   * Get the value of config
   */ 
  public function getConfig()
  {
    return $this->config;
  }

  /**
   * Set the value of config
   *
   * @return  self
   */ 
  public function setConfig($config)
  {
    $this->config = $config;

    return $this;
  }
}