<?= $this->layout('layout', ['myTitle' => 'Quizz']); ?>

<!-- define section -->

<?php $this->start('form-opening') ?>
  <form action="<?= $basePath ?>/check-quiz/<?= $quiz->getId() ?>" method="post">
<?php $this->stop() ?>

<?php $this->start('form-closing') ?>
  <?php if(!isset($score)): ?>
    <button type="submit" class="btn btn-primary w-100">OK</button>
  <?php endif ?>
</form>
  <?php if(isset($score)): ?>
    <div class="score">
      <h3 class="text-center">
        <?= $score ?>/<?= count($questions) ?> Bonne(s) réponse(s)
      </h3>
    </div>
  <?php endif ?>
<?php $this->stop() ?>


<!-- content -->

<div class="container">
  <?php if($connectedUser): ?>
    <?= $this->section('form-opening') ?>
  <?php endif ?>
  <div>
    <div class="d-flex align-items-center">
      <h1 class="d-inline-flex"><?= $quiz->getTitle() ?></h1>
      <div class="d-inline-flex"><span class="badge badge-pill badge-secondary ml-3"><?= count($questions) ?> questions</span></div>
    </div>
    
    <h2><?= $quiz->getDescription() ?></h2>
    <p>by <?= $quiz->getAuthorFirstName() ?> <?= $quiz->getAuthorLastName() ?></p>
  </div>


  <div class="card-columns">

    <?php foreach($questions as $question): ?>
      <?php $answers = [];
            for($index = 1; $index <= 4; $index++) {
              $method = 'getProp' . $index;
              $answers[] = $question->$method();
            }
            shuffle($answers);
      ?>
      <?php if($connectedUser && isset($score)): ?>
        <?= $this->insert('partials/questionsCardsResult', ['question' => $question, 'answers' => $answers, 'questions' => $questions, 'quiz' => $quiz, 'questionAnswers' => $questionAnswers]) ?>
      <?php elseif($connectedUser): ?>
        <?= $this->insert('partials/questionsCardsConnected', ['question' => $question, 'answers' => $answers]) ?>
      <?php else: ?>
        <?= $this->insert('partials/questionsCardsNotConnected', ['question' => $question, 'answers' => $answers]) ?>
      <?php endif ?>
    <?php endforeach ?>

  </div>

  <?php if($connectedUser): ?>
  <?= $this->section('form-closing') ?>
  <?php endif ?>
</div>
