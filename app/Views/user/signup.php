<?= $this->layout('layout', ['myTitle' => 'Inscription']); ?>

<!-- content -->

<div class="container col-12 col-md-8 col-lg-6">

  <h1>Inscrivez-vous à Quizz O'Clock</h1>

  <form action="<?= $basePath ?>/register" id="form">
    <div id="alerts" class="text-light h5 my-4 px-4 py-3"></div>
    <div class="form-group form-row">
      <div class="col">
        <label for="prenom">Prénom</label>
        <input type="text" class="form-control" placeholder="Prénom" name="prenom">
      </div>
      <div class="col">
        <label for="nom">Nom</label>
        <input type="text" class="form-control" placeholder="Nom" name="nom">
      </div>
    </div>
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">Nous ne vendons pas vos données ;).</small>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <div class="form-group">
      <label for="confirmedPassword">Confirm Password</label>
      <input type="password" class="form-control" name="confirmedPassword" placeholder="Password">
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" name="CGUCheck" id="CGUCheck">
      <label class="form-check-label" for="CGUCheck">J'accepte les conditions d'utilisation de Quizz O'Clock</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>

