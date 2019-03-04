<nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
  <a class="navbar-brand" href="<?= $basePath ?>/">O'Quiz</a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarToggler">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <span class="nav-link disabled">Bonjour</span>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?= $basePath ?>/"><i class="fas fa-home"></i> Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $basePath ?>/login"><i class="fas fa-sign-in-alt"></i> Se connecter</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= $basePath ?>/sign-up"><i class="fas fa-user-plus"></i> S'inscrire</a>
      </li>
    </ul>
  </div>
</nav>