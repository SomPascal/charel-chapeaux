<?php $this->extend('base') ?>

<?php $this->section('content') ?>
  <section id="billboard" class="bg-light py-5">
    <div class="container">
      <div class="row justify-content-center">
        <h1 
          class="section-title text-center text-uppercase mt-4 opacity-100" 
          data-aos="fade-up"
        >
          Cette page n'existe pas !
        </h1>

        <div class="col-md-6 text-center" data-aos="fade-up" data-aos-delay="300">
          <p>
            Vous vous etes surement égaré lors de votre visite de 
            site web. Veuillez cliquer sur rentrer à l'acceuil. 
          </p>

          <a href="<?= base_url(service('request')->getLocale()) ?>" class="btn btn-dark btn-lg">
            <i class="fa fa-home"></i>
            Accueil 
          </a>
        </div>
      </div>
    </div>
  </section>

  <section class="features py-5">
    <div class="container">
      <div class="row justify-content-around align-items-start">
        <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="0">
          <div class="py-5">
            <i class="fs-1 fa fa-pencil"></i>

            <h4 class="element-title text-capitalize my-3">
              Nous Confectionnons
            </h4>

            <p>
              En fonction de vos besoins, nous vous 
              confectionnons des chapeaux de qualité.
            </p>
          </div>
        </div>

        <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="300">
          <div class="py-5">
            <svg width="38" height="38" viewBox="0 0 24 24">
              <use xlink:href="#shopping-bag"></use>
            </svg>

            <h4 class="element-title text-capitalize my-3">
              Nous créons
            </h4>
            <p>
              Chez nous vous trouverez le chapeau dont vous avez besoin.
            </p>
          </div>
        </div>

        <div class="col-md-3 text-center" data-aos="fade-in" data-aos-delay="600">
          <div class="py-5">
            <i class="fs-1 fa fa-cart-shopping"></i>

            <h4 class="element-title text-capitalize my-3">
              Nous Vendons
            </h4>
            <p>
              Besoin d'acheter des chapeaux déjà conçus ? Vous etes au bon 
              endroit
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <a 
   href="tel:237699967512" 
   class="call-cta-btn btn btn-dark"
  >
    <i class="fa fa-phone"></i>
    Appelez-nous
  </a>
<?php $this->endSection('content') ?>