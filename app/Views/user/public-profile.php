<?= $this->layout('layout', ['myTitle' => 'Profil de '. $user->getLast_name() . ' ' . $user->getFirst_name()]); ?>

<!-- content -->
<div class="container">

<h1>Profil</h1>
<p>Son nom : <?= $user->getLast_name() ?></p>
<p>Son prénom : <?= $user->getFirst_name() ?></p>
<p>Ses Quizz :</p>

<?php if(!empty($quizzes)): ?>
<?= $this->insert('partials/quizzList', ['quizzes' => $quizzes]) ?>
<?php else: ?>
<p>Cet utilisateur n'a publié aucun quiz pour le moment</p>
<?php endif ?>
</div>