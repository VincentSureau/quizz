    <div class="card w-100" style="width: 18rem;">
      <div class="card-header">
        <h5 class="card-title"><?= $question->getQuestion() ?></h5>
        <span class="badge badge-success level-<?= $question->getLevelId() ?>"><?= $question->getLevelName() ?></span>
        <?php if(!isset($questionAnswers[$question->getId()]["userAnswer"])): ?>
          <p class="mb-0 mt-2 text-danger">Vous n'avez pas répondu à cette question</p>
        <?php endif ?>
      </div>

      <div class="card-body">
          <?php foreach($answers as $index => $answer):?>
          <?php $rightAnswer = ($question->getProp1() == $answer);
          if(isset($questionAnswers[$question->getId()]["userAnswer"])){
            if($rightAnswer && $questionAnswers[$question->getId()]["userAnswer"] == filter_var($answer, FILTER_SANITIZE_STRING)) {
              $textColorAndStyle = 'text-success font-weight-bold';
            } elseif ($questionAnswers[$question->getId()]["userAnswer"] == filter_var($answer, FILTER_SANITIZE_STRING)) {
              $textColorAndStyle = 'text-danger font-weight-bold';
            } else {
              $textColorAndStyle = 'text-dark';
            }
          } else {
            $textColorAndStyle = 'text-dark';
          }

          ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="<?= $question->getId() ?>" id="question-<?= $question->getId() ?>-prop-<?= $index + 1 ?>" value="<?= $answer ?>" disabled <?= ($rightAnswer)? 'checked' : '' ?>>
                <label class="form-check-label <?= $textColorAndStyle ?>" for="question-<?= $question->getId() ?>-prop-<?= $index + 1 ?>">
                  <?= $answer ?>
                </label>
            </div>
          <?php endforeach ?>
      </div>
    </div>