<nav class="navbar navbar-expand-lg bg-light text-uppercase fs-6 p-3 border-bottom align-items-center">
    <div class="container-fluid">
      <div class="row justify-content-between align-items-center w-100">
        <div class="col-auto">
          <a class="navbar-brand text-white" href="<?= base_url(request()->getLocale()) ?>">
            <img 
             src="/assets/images/cc-logo.png" 
             alt="Charel Chapeaux Logo" 
            />
          </a>
        </div>

        <div class="col-auto">
          <button 
           class="navbar-toggler" 
           type="button" 
           data-bs-toggle="offcanvas" 
           data-bs-target="#offcanvasNavbar"
           aria-controls="offcanvasNavbar"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
            aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
            </div>

            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 gap-1 gap-md-5 pe-3">
                <li class="nav-item">
                  <a class="nav-link" href="<?= base_url(request()->getLocale()) ?>">
                    Accueil
                  </a>
                </li>

                <li class="nav-item">
                  <a 
                   class="nav-link" 
                   href="<?= base_url(request()->getLocale()) ?>#our-collections"
                  >
                    Collections
                  </a>
                </li>

                <li class="nav-item dropdown">
                  <a 
                   class="nav-link dropdown-toggle" 
                   href="#" 
                   id="dropdownBlog" 
                   data-bs-toggle="dropdown"
                   aria-haspopup="true" 
                   aria-expanded="false"
                  >
                    RÉSEAUX SOCIAUX 
                  </a>

                  <ul 
                   class="dropdown-menu list-unstyled" 
                   aria-labelledby="dropdownBlog"
                  >
                    <li>
                      <a 
                       href="<?= route_to('goto', 'facebook') ?>" 
                       class="dropdown-item item-anchor"
                       target="_blank"
                      >
                      <i class="fab fa-facebook"></i>
                      Facebook
                      </a>
                    </li>

                    <li>
                      <a 
                       href="<?= route_to('goto', 'instagram') ?>" 
                       class="dropdown-item item-anchor"
                       target="_blank"
                      >
                      <i class="fab fa-instagram"></i>
                      Instagram
                      </a>
                    </li>

                    <li>
                      <a 
                       href="<?= route_to('goto', 'whatsapp') ?>" 
                       class="dropdown-item item-anchor"
                      >
                      <i class="fab fa-whatsapp"></i>
                        WhatsApp
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item">
                  <a 
                   class="nav-link" 
                   href="<?= base_url(request()->getLocale()) ?>#contact-us"
                  >
                    Contactez-nous
                  </a>
                </li>

                <li class="nav-item dropdown">
                  <a 
                   class="nav-link dropdown-toggle" 
                   href="#" 
                   id="dropdownBlog" 
                   data-bs-toggle="dropdown"
                   aria-haspopup="true" 
                   aria-expanded="false"
                  >
                    Lang 
                    <i class="fa fa-language"></i>
                  </a>

                  <ul 
                   class="dropdown-menu list-unstyled" 
                   aria-labelledby="dropdownBlog"
                  >
                    <?php foreach(config('Config\App')->supportedLocales as $locale): ?>
                      <li>
                        <a 
                         href="<?= base_url($locale) ?>" 
                         class="dropdown-item item-anchor"
                        >
                          <?= esc($locale) ?>
                        </a>
                      </li>
                    <?php endforeach ?>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</nav>