<?php
namespace Quizzoclock\Controllers;

use Quizzoclock\Models\UserModel;
use Quizzoclock\Models\QuizModel;
use Quizzoclock\Models\QuestionModel;
use Quizzoclock\Models\LevelModel;
use Quizzoclock\Utils\User;
use Quizzoclock\Controllers\MainController;

class UserController extends CoreController {
  public function displaySignInForm() {
    $user = User::getConnectedUser();
    if (!empty($user)) {
      $this->forbidden();
    } else {
      $this->show('user/signin');
    }
  }

  public function displaySignUpForm() {
    $user = User::getConnectedUser();
    if (!empty($user)) {
      $this->forbidden();
    } else {
     $this->show('user/signup');
    }
  }

  public function logout() {
    User::disconnect();
    header('Location: /eval-php/evaluation-back-oquiz-VincentSureau/public');
  }

  public function signIn() {

    $errorList = [];
    if(!empty($_POST)){
      $email = (isset($_POST['email'])) ? $_POST['email'] : '';
      $passwordLogin = (isset($_POST['password'])) ? $_POST['password'] : '';

      if(empty($errorList)){
        $userModel = UserModel::find($email);
          if(!empty($userModel)){
            $passwordInBdd = $userModel->getPassword();
            if(password_verify($passwordLogin ,$passwordInBdd)){
              User::connect($userModel);
              static::sendJson([
                'code' => 1,
                'redirect' => '/eval-php/evaluation-back-oquiz-VincentSureau/public/',
                'succesMessage' => 'Connexion réussie'
              ]);

            } else {
                $errorList[]= "L'identifiant ou le mot de passe est incorrect";
                static::sendJson([
                  'code' => 2,
                  'errorList' => $errorList
                  ]);
            }
        } else {
            $errorList[]= "L'identifiant ou le mot de passe est incorrect";
            static::sendJson([
              'code' => 2,
              'errorList' => $errorList
              ]);
        }
      }
    } 
  }

  public function signUp() {
    $errorList = [];
    if(!empty($_POST)){
      if(isset($_POST['email'])) {
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        if (!$email) {
          $errorList['email'] = 'Veuillez saisir un email valide';
        }
      } else {
        $errorList['email'] = 'Veuillez indiquer votre email';
      }

      if(isset($_POST['prenom']) && !empty($_POST['prenom'])) {
        $firstName = filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_STRING);
      } else {
        $errorList['prenom'] = 'Veuillez indiquer votre prénom';
      }
      if(isset($_POST['nom']) && !empty($_POST['nom'])) {
        $lastName = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
      } else {
        $errorList['nom'] = 'Veuillez indiquer votre nom';
      }

      if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['confirmedPassword']) && !empty($_POST['confirmedPassword'])) {
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $confirmedPassword = filter_input(INPUT_POST, 'confirmedPassword', FILTER_SANITIZE_STRING);
        if ($password !== $confirmedPassword) {
          $errorList['password'] = 'Les mots de passe ne sont pas identiques';
          $password = false;
          $confirmedPassword = false;
        }
      } else {
        if (!isset($_POST['password']) || empty($_POST['password'])) {
          $errorList['password'] = 'Veuillez choisir un mot de passe';
        }
        if (!isset($_POST['confirmedPassword']) || empty($_POST['confirmedPassword'])) {
          $errorList['confirmedPassword'] = 'Veuillez confirmer votre mot de passe';
        }
      }

      if(isset($_POST['CGUCheck'])) {
        $CGU = filter_input(INPUT_POST, 'CGUCheck', FILTER_SANITIZE_STRING);
        if ($CGU === "on") {
          $CGUAccepted = true;
        } else {
          $CGUAccepted = false;
          $errorList['CGUCheck'] = 'Veuillez ne pas pirater mon formulaire';
        }
      } else {
        $CGUAccepted = false;
        $errorList['CGUCheck'] = 'Vous devez accepter les conditions générales d\'utilisation pour vous inscrire';
      }
    }

    if(empty($errorList)) {
      $searchExistingAccount = UserModel::find($email);

      if($searchExistingAccount) {
        $errorList['emailInBDD'] = 'Un compte avec cet email existe déjà';
        static::sendJson([
          'code' => 2,
          'errorList' => $errorList
        ]);
      
      } else {
        $newAccount = new UserModel();
        $newAccount->setFirst_name($firstName);
        $newAccount->setLast_name($lastName);
        $newAccount->setEmail($email);
        $newAccount->setPassword(password_hash($password, PASSWORD_DEFAULT));

        $newAccount->insert();

        User::connect($newAccount);
        static::sendJson([
          'code' => 1,
          'redirect' => '/eval-php/evaluation-back-oquiz-VincentSureau/public/',
          'succesMessage' => 'Inscription réussie'
        ]);
      }
    } else {
      static::sendJson([
        'code' => 2,
        'errorList' => $errorList
        ]);
    }
  }

  public function userAccount() {
    $user = User::getConnectedUser();
    if (empty($user)) {
      $this->forbidden();
    } else {
      $userId = $user->getId();
      $quizzes = QuizModel::findByUser($userId);
      $levels = LevelModel::findAll();
      $this->show('user/profile', ['quizzes' => $quizzes, 'levels' => $levels]);
    }
  }

  public function displayProfile($params) {
    if (empty($params['id'])) {
      $this->forbidden();
    } else {
      $id = $params['id'];
      $user = UserModel::findById($id);
      $quizzes = QuizModel::findByUser($id);
      if(!empty($user)) {
        $this->show('user/public-profile', ['user' => $user, 'quizzes' => $quizzes]);
      } else {
        $this->forbidden();
      }
    }
  }
}