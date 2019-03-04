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

      if(!isset($_POST['question']) || empty(trim($_POST['question']))){
        $errorList[] = 'Veuillez renseigner une question';
      } else {
        $question->setQuestion(trim(filter_input(INPUT_POST, 'question', FILTER_SANITIZE_STRING)));
      };

      if(!isset($_POST['level']) || empty(trim($_POST['level']))){
        $errorList[] = 'Veuillez selectionner une difficulté';
      } else {
        $question->setLevelId(trim(filter_input(INPUT_POST, 'level', FILTER_VALIDATE_INT)));
      };

      if(!isset($_POST['prop1']) || empty(trim($_POST['prop1']))){
        $errorList[] = 'Veuillez renseigner une réponse (1)';
      } else {
        $question->setProp1(trim(filter_input(INPUT_POST, 'prop1', FILTER_SANITIZE_STRING)));
      };

      if(!isset($_POST['prop2']) || empty(trim($_POST['prop2']))){
        $errorList[] = 'Veuillez renseigner une réponse (2)';
      } else {
        $question->setProp2(trim(filter_input(INPUT_POST, 'prop2', FILTER_SANITIZE_STRING)));
      };

      if(!isset($_POST['prop3']) || empty(trim($_POST['prop3']))){
        $errorList[] = 'Veuillez renseigner une réponse (3)';
      } else {
        $question->setProp3(trim(filter_input(INPUT_POST, 'prop3', FILTER_SANITIZE_STRING)));
      };

      if(!isset($_POST['prop4']) || empty(trim($_POST['prop4']))){
        $errorList[] = 'Veuillez renseigner une réponse (4)';
      } else {
        $question->setProp4(trim(filter_input(INPUT_POST, 'prop4', FILTER_SANITIZE_STRING)));
      };
    }

    if(empty($errorList)) {
      $isInserted = $quiz->insert();
      if($isInserted) {
       $question->setQuizId($quiz->getId());
        $questionsInserted = $question->insert();
      }
      static::sendJson([
          'code' => 1,
          'redirect' => '/eval-php/evaluation-back-oquiz-VincentSureau/public/my-account'
      ]);
    } else {
      static::sendJson([
        'code' => 2,
        'errorList' => $errorList
      ]);
    }
  }