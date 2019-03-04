    <div class="card w-100" style="width: 18rem;">
      <div class="card-header">
        <h5 class="card-title"><?= $question->getQuestion() ?></h5>
        <span class="badge badge-success level-<?= $question->getLevelId() ?>"><?= $question->getLevelName() ?></span>
      </div>
      <div class="card-body">
        <ol>
          <?php foreach($answers as $answer): ?>
          <li><?= $answer ?></li>
          <?php endforeach ?>
        </ol>
      </div>
    </div>