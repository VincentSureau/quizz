<?= $this->layout('layout', ['myTitle' => 'Connexion']); ?>

<!-- content -->

<div class="container col-12 col-md-8 col-lg-6">

  <h1>Connectez-vous à votre compte</h1>
  <form action="<?= $basePath ?>/sign-in" id="form">
    <div id="alerts" class="text-light h5 my-4 px-4 py-3"></div>
    <div class="form-group">
      <label for="Email">Email address</label>
      <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
      <small id="emailHelp" class="form-text text-muted">Nous ne vendons pas vos données ;).</small>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</div>

