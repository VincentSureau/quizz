  <div class="card-columns">

    <?php foreach($quizzes as $quizz): ?>
    <div class="card w-100">
      <div class="card-header">
        <h5 class="card-title"><a class="text-dark" href="<?= $basePath ?>/quiz/<?= $quizz->getid() ?>"><?= $quizz->getTitle() ?></a></h5>
      </div>
      <div class="card-body">
        <h6 class="card-subtitle mb-2 "><?= $quizz->getDescription() ?></h6>
        <a href="<?= $basePath ?>/profile/<?= $quizz->getAuthorId() ?>" class="card-link text-secondary">by <?= $quizz->getAuthorFirstName() ?> <?= $quizz->getAuthorLastName() ?></a>
      </div>
    </div>
    <?php endforeach ?>
  </div>