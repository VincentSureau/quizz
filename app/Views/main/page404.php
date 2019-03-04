<?= $this->layout('forbidden-layout', ['myTitle' => 'Forbidden']); ?>

<!-- content -->

<div class='d-flex flex-column justify-content-center align-items-center py-5'>
<h1 class="forbidden mb-5">ERREUR 404</h1>  
<div class="d-flex justify-content-center border-thick w-60 p-2 mb-2">
    <p class="forbidden my-3">*</p>
    <p class="forbidden ml-2 my-3">I'm fine. thanks.</p>
  </div>
  <div class="d-flex justify-content-center pt-3"><img src="<?= $basePath ?>/assets/images/napstablook.gif" alt="404"></div>
</div>