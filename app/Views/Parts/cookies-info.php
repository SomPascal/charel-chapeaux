<?php if (session()->get(ACCEPTED_COOKIE) !== true): ?>
  <section>
      <form method="post" action="<?= route_to('cookie.accept') ?>" class="cookies-info">
        <i class="fs-2 p-2 fa fa-cookie text-center text-dark"></i>
  
        <p class="text-center">
          Cette plateforme utilise des cookies dans le seul but 
          de s'améliorer et d'optimiser l'expérience utilisateur.
        </p>
  
        <button type="button" class="text-uppercase btn btn-dark w-100">
          D'accord
        </button>
      </form>
  </section>
<?php endif ?>