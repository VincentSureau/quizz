    <div class="card w-100" style="width: 18rem;">
      <div class="card-header">
        <h5 class="card-title"><?= $question->getQuestion() ?></h5>
        <span class="badge badge-success level-<?= $question->getLevelId() ?>"><?= $question->getLevelName() ?></span>
      </div>
      <div class="card-body">
          <?php foreach($answers as $index => $answer): ?>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="<?= $question->getId() ?>" id="question-<?= $question->getId() ?>-prop-<?= $index + 1 ?>" value="<?= $answer ?>">
                <label class="form-check-label" for="question-<?= $question->getId() ?>-prop-<?= $index + 1 ?>">
                  <?= $answer ?>
                </label>
            </div>
          <?php endforeach ?>
      </div>
    </div>