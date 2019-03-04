<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <a class="navbar-brand" href="<?= $basePath ?>/">O'Quiz</a>  
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarToggler">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <span class="nav-link disabled">Bonjour <?= $connectedUser->getFirst_name() ?></span>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?= $basePath ?>/"><i class="fas fa-home"></i> Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $basePath ?>/my-account"><i class="fas fa-user"></i> Mon Compte</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $basePath ?>/logout"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
      </li>
    </ul>
  </div>
</nav>