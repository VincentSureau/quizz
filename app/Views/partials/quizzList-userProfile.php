  <div class="card-columns">

    <?php foreach($quizzes as $quizz): ?>
    <div class="card w-100">
      <div class="card-header">
        <h5 class="card-title"><a class="text-dark" href="<?= $basePath ?>/quiz/<?= $quizz->getid() ?>"><?= $quizz->getTitle() ?></a></h5>
      </div>
      <div class="card-body">
        <h6 class="card-subtitle mb-2 "><?= $quizz->getDescription() ?></h6>
        <div class="text-right">
          <a href="<?= $basePath ?>/edit-quiz/<?= $quizz->getid() ?>" class="btn btn-primary my-1 edit-link">Modifier</a>
          <a href="<?= $basePath ?>/delete-quiz/<?= $quizz->getid() ?>" class="btn btn-danger my-1 delete-link">Supprimer</a>
        </div>
      </div>
    </div>
    <?php endforeach ?>
  </div>