<button type="button" class="btn btn-primary show">Je créé un nouveau quiz</button>
<div class="container col-12 col-md-8 col-lg-6">

  <form action="<?= $basePath ?>/create-quiz" id="form" class="d-none pt-5">
   <h2>Créer un Quiz</h2>

    <div id="alerts" class="text-light h5 mb-4 px-4 pb-3"></div>
    <input id="authorId" name="authorId" type="hidden" value="<?= $authorId ?>">
    <div class="form-group">
      <label for="title">Titre</label>
      <input type="text" class="form-control" placeholder="Titre" name="title">
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <input type="text" class="form-control" placeholder="Description" name="description">
    </div>
    <div class="form-group">
      <label for="level">Difficulté</label>
      <select class="form-control" id="level" name="level">
        <?php foreach($levels as $level): ?>
          <option value="<?= $level->getId() ?> " <?= ($level->getId() == 1)? 'selected' : '' ?>><?= $level->getName() ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="form-group">
      <label for="question">Question</label>
      <textarea name="question" id="question" class="form-control" cols="30" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="prop1">Réponse 1</label>
      <input type="text" class="form-control" placeholder="Réponse 1" name="prop1">
    </div>
    <div class="form-group">
      <label for="prop2">Réponse 2</label>
      <input type="text" class="form-control" placeholder="Réponse 2" name="prop2">
    </div>
    <div class="form-group">
      <label for="prop3">Réponse 3</label>
      <input type="text" class="form-control" placeholder="Réponse 3" name="prop3">
    </div>
    <div class="form-group">
      <label for="prop4">Réponse 4</label>
      <input type="text" class="form-control" placeholder="Réponse 4" name="prop4">
    </div>
    <div class="form-check mb-2">
      <input type="checkbox" class="form-check-input" name="CGUCheck" id="CGUCheck">
      <label class="form-check-label" for="CGUCheck">J'accepte les conditions d'utilisation de Quizz O'Clock</label>
    </div>
    <div class="form-group ">
      <button type="submit" class="btn btn-primary col-12 col-md-2 my-1">Envoyer</button>
      <button type="button" class="btn btn-danger cancel col-12 col-md-2 my-1">Annuler</button>
    </div>


  </form>

</div>