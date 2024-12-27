<footer id="footer" class="mt-5">
    <div class="container">
      <div class="row d-flex flex-wrap justify-content-between py-5">
        <div class="col-md-3 col-sm-6">
          <div class="footer-menu footer-menu-001">
            <div class="footer-intro mb-4">
              <a href="<?= base_url(request()->getLocale()) ?>">
                <img 
                 src="/assets/images/cc-logo.png" 
                 alt="Logo Charel Chapeaux"
                >
              </a>
            </div>

            <p>
              C'est le détail qui fait toute la différence.
            </p>

            <div class="social-links">
              <ul class="list-unstyled d-flex flex-wrap gap-3">
                <li>
                  <a 
                   href="https://wa.me/<?= esc(get_contact('whatsapp'), 'attr') ?>" 
                   class="text-secondary fs-3"
                   target="_blank"
                  >
                    <i class="fab fa-whatsapp"></i>
                  </a>
                </li>

                <li>
                  <a 
                   href="<?= esc(get_contact('facebook')) ?>" 
                   class="text-secondary fs-3"
                   target="_blank"
                  >
                    <i class="fab fa-facebook"></i>
                  </a>
                </li>

                <li>
                  <a 
                   href="<?= esc(get_contact('instagram')) ?>" 
                   class="text-secondary fs-3"
                   target="_blank"
                  >
                    <i class="fab fa-instagram"></i>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="footer-menu footer-menu-002">
            <h5 class="widget-title text-uppercase mb-4">
              Liens
            </h5>

            <ul class="menu-list list-unstyled text-uppercase border-animation-left fs-6">
              <li class="menu-item">
                <a 
                 href="<?= base_url(request()->getLocale()) ?>" 
                 class="item-anchor"
                >
                  Accueil
                </a>
              </li>

              <li class="menu-item">
                <a 
                 href="<?= base_url(request()->getLocale().'#our-collections') ?>" 
                 class="item-anchor"
                >
                  Nos collections
                </a>
              </li>

              <li class="menu-item">
                <a 
                 href="<?= base_url(request()->getLocale().'#contact-us') ?>" 
                 class="item-anchor"
                >
                  Contactez-nous
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="footer-menu footer-menu-002">
            <h5 class="widget-title text-uppercase mb-4">
              RÉSEAUX SOCIAUX
            </h5>

            <ul class="menu-list list-unstyled text-uppercase border-animation-left fs-6">
              <li class="menu-item">
                <a 
                 href="https://wa.me/<?= esc(get_contact('whatsapp')) ?>" 
                 class="item-anchor"
                 target="_blank"
                >
                  WhatsApp
                </a>
              </li>

              <li class="menu-item">
                <a 
                 href="<?= esc(get_contact('facebook')) ?>" 
                 class="item-anchor"
                 target="_blank"
                >
                  Facebook
                </a>
              </li>

              <li class="menu-item">
                <a 
                 href="<?= esc(get_contact('instagram')) ?>" 
                 class="item-anchor"
                 target="_blank"
                >
                  Instagram
                </a>
              </li>

              <li class="menu-item">
                <a 
                 href="<?= esc(get_contact('map')) ?>" 
                 class="item-anchor"
                 target="_blank"
                >
                  Google MAPS
                </a>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-md-3 col-sm-6">
          <div class="footer-menu footer-menu-004 border-animation-left">
            <h5 class="widget-title text-uppercase mb-4">
              Appelez-nous
            </h5>

            <p>
              Avez-vous des questions ? 
              <a 
               href="tel:<?= esc(get_contact('phone'), 'attr') ?>" 
               class="item-anchor"
              >
                <?= esc(get_contact('phone')) ?>
              </a>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="border-top py-4">
      <div class="containe d-flex justify-content-center align-items-center">
        <p class="text-center">
          © Copyright 2024 Charel Chapeaux. 
          All rights reserved. 
        </p>
      </div>
    </div>
</footer>