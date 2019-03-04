<?= $this->layout('layout', ['myTitle' => 'Mon profil']); ?>

<!-- content -->
<div class="container">
<h1>Mon profil</h1>
<p>Mon nom : <?= $connectedUser->getLast_name() ?></p>
<p>Mon prénom : <?= $connectedUser->getFirst_name() ?></p>
<p>Mes Quizz :</p>
<?php if(!empty($quizzes)): ?>
<?= $this->insert('partials/quizzList-userProfile', ['quizzes' => $quizzes]) ?>
<?php else: ?>
<p>Vous n'avez publié aucun quizz pour le moment. Lancez-vous ! </p>
<?php endif ?>

<?= $this->insert('partials/quizzCreation-form', ['authorId' => $connectedUser->getId(), 'levels' => $levels]) ?>

</div>