<?= $this->layout('layout', ['myTitle' => 'Accueil']); ?>

<!-- content -->
<div class="container">

<h1>Bienvenue sur O'Quiz</h1>
<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequuntur recusandae, vitae accusamus itaque numquam cupiditate, magnam aliquam velit suscipit, nihil fugit voluptates similique fugiat. Eius beatae, distinctio inventore obcaecati mollitia voluptates eum harum tempora eligendi perferendis iste, adipisci ipsa. Officiis sed nesciunt minus sunt animi saepe voluptas harum fugiat numquam?</p>

<?= $this->insert('partials/quizzList', ['quizzes' => $quizzes]) ?>

</div>
