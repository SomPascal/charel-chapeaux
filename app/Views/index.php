<?php

use CodeIgniter\I18n\Time;
use Config\Contact;

helper(['text', 'number', 'description']);
?>

<?php $this->extend('base') ?>

<?php $this->section('meta-description') ?>
  <meta 
   name="description" 
   content="<?= esc(get_desc(needle: 'meta', haystack: $descriptions) ?? 'Création, vente de chapeaux, sacs et bijoux au cameroun et yaoundé en particulier.') ?>"
  >
<?php $this->endSection('meta-description') ?>

<?php $this->section('title') ?>
  <title>
    Charel Chapeaux | Création, vente de chapeaux, sacs et bijoux
  </title>
<?php $this->endSection('title') ?>

<?php $this->section('content') ?>
  <section id="billboard" class="bg-light py-5">
    <div class="container">
      <div class="row justify-content-center">
        <h1 
         class="section-title text-center mt-4" 
         data-aos="fade-up"
         style="font-family: 'header-name-font';"
        >
          Charel Chapeaux
        </h1>
        <div 
         class="col-md-6 text-center" 
         data-aos="fade-up" 
         data-aos-delay="300"
        >
          <p><?= esc(get_desc(needle: 'main', haystack: $descriptions)) ?></p>
        </div>
      </div>

      <?php if(count($header_items) > 0): ?>
        <div class="row">
          <div 
           class="swiper main-swiper py-4" 
           data-aos="fade-up" 
           data-aos-delay="600"
          >
            <div class="swiper-wrapper d-flex border-animation-left">
              <?php foreach ($header_items as $item): ?>
                <div class="swiper-slide">
                  <div class="banner-item image-zoom-effect">
                    <div class="image-holder">
                      <a href="<?= route_to('item.show', $item->id) ?>">
                        <img 
                          src="<?= route_to('item.pic', $item->item_pic_id) ?>" 
                          alt="product"
                          class="img-fluid"
                        />
                      </a>
                    </div>
    
                    <div class="banner-content py-4">
                      <h5 class="element-title text-uppercase">
                        <?= esc($item->name) ?>
                      </h5>
    
                      <p><?= esc($item->description) ?></p>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
            
            <div class="swiper-pagination"></div>
          </div>
  
          <div class="icon-arrow icon-arrow-left">
            <svg width="50" height="50" viewBox="0 0 24 24">
              <use xlink:href="#arrow-left"></use>
            </svg>
          </div>
  
          <div class="icon-arrow icon-arrow-right">
            <svg width="50" height="50" viewBox="0 0 24 24">
              <use xlink:href="#arrow-right"></use>
            </svg></div>
        </div>
      <?php else: ?>
        <?php if (auth()->loggedIn()): ?>
          <div class="container">
            <div class="alert alert-info text-center">
              <p>
                Veuillez ajouter des articles
              </p>

              <a href="<?= route_to('admin.item.create') ?>" role="button" class="btn btn-dark">
                Ajouter 
                <i class="fa fa-circle-plus"></i>
              </a>
            </div>
          </div>
        <?php endif ?>
      <?php endif ?>
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

  <?php if (count($items) > 0): ?>
    <?php $i = 0 ?>
    <?php foreach(array_chunk($items, 7) as $chuncked_item): ?>
      <section 
       <?= attrs([
        'id="our-collections"' => $i == 0,
        'id="caps-collection-2"' => $i == 1,
        'id="caps-collection-3"' => $i == 2
       ]) ?>
       class="new-arrival product-carousel pt-5 pb-2 position-relative overflow-hidden"
      >
        <div class="container">
          <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
            <h4 class="text-uppercase">
              Notre Collection de chapeaux
            </h4>
    
            <!-- <a href="/" class="btn-link">
              Me Confectionner un chapeau
              <i class="fa fa-arrow-right"></i>
            </a> -->
          </div>
    
          <div class="swiper product-swiper open-up" data-aos="zoom-out">
            <div class="swiper-wrapper d-flex">
              <?php foreach($chuncked_item as $item): ?>
                <div class="swiper-slide">
                  <div class="product-item image-zoom-effect link-effect" liked>
                    <div class="image-holder position-relative">
                      <a href="<?= route_to('item.show', $item->id) ?>">
                        <img 
                        src="<?= route_to('item.pic', $item->item_pic_id) ?>" 
                        alt="<?= esc(character_limiter($item->name, 18, '...')) ?>" 
                        class="product-image img-fluid"
                        >
                      </a>
      
                      <div class="product-content">
                        <h5 class="text-uppercase fs-5 mt-3">
                          <a href="/">
                            <?= esc(number_to_currency($item->price, XAF)) ?>
                          </a>
                        </h5>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
            </div>
    
            <div class="swiper-pagination"></div>
          </div>
    
          <div class="icon-arrow icon-arrow-left blur-effet">
            <svg width="50" height="50" viewBox="0 0 24 24">
              <use xlink:href="#arrow-left"></use>
            </svg>
          </div>
    
          <div class="icon-arrow icon-arrow-right">
            <svg width="50" height="50" viewBox="0 0 24 24">
              <use xlink:href="#arrow-right"></use>
            </svg>
          </div>
        </div>
      </section>
      <?php $i++ ?>
    <?php endforeach ?>
  <?php else: ?>
    <?php if (auth()->loggedIn()): ?>
      <section class="container my-5">
        <p class="alert alert-info text-center">
          <i class="fa fa-circle-info fs-1 text-left"></i>
          <br>

          <span>
            Aucun article enrégistré.
          </span>
          <br>

          <a href="<?= route_to('admin.item.create') ?>" class="btn btn-dark">
            Créer un article
            <i class="fa fa-circle-plus"></i>
          </a>
        </p>
      </section>
    <?php endif ?>
  <?php endif ?>

  <section class="collection bg-light position-relative py-5">
    <div class="container">
      <div class="row">
        <div class="title-xlarge text-uppercase txt-fx domino">Collection</div>
        <div class="collection-item d-flex flex-wrap my-5">
          <div class="col-md-6 column-container">
            <div class="image-holder">
              <img 
               src="/assets/images/charel-chapeaux-owner.jpg"
               alt="collection" 
               class="product-image img-fluid"
              >
            </div>
          </div>
          <div class="col-md-6 column-container bg-white">
            <div class="collection-content p-3 m-0 m-md-5">
              <h4 class="element-title text-uppercase">
                À Propos de Charel Chapeaux
              </h4>

              <p>
                Conception, Création, Vente.
              </p>
              <hr>
              <br>

              <p>
                <?= nl2br(esc(get_desc(needle: 'main', haystack: $descriptions))) ?>
              </p>
              <br><br>

              <a 
               href="<?= route_to('goto', 'map') ?>" 
              >
                <i class="fa fa-map-pin"></i>
                <?= esc(get_contact('location')) ?>
              </a>
              <br><br>

              <a 
               href="<?= route_to('goto', 'phone') ?>" 
               class="btn btn-lg btn-dark text-uppercase"
              >
                Appelez-nous
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <?php if (count($testimonials) > 0): ?>
    <section class="testimonials py-5 bg-light">
      <div class="section-header text-center mt-5">
        <h3 class="section-title text-uppercase">
          Des Clients Satisfaits
        </h3>
      </div>
      
      <div class="swiper testimonial-swiper overflow-hidden my-5">
        <div class="swiper-wrapper d-flex">
          <?php foreach($testimonials as $testimonial): ?>
            <div class="swiper-slide">
              <div class="testimonial-item text-center">
                <blockquote>
                  <p>
                    “<?= esc($testimonial->content) ?>”
                  </p>
    
                  <div class="review-title text-uppercase">
                    <?= esc($testimonial->name) ?>
                  </div>

                  <?php if (auth()->loggedIn()): ?>
                    <div class="review-title text-uppercase">
                      <?= esc(Time::createFromFormat('Y-m-d H:i:s', $testimonial->created_at)->humanize()) ?>
                    </div>
                  <?php endif ?>
                </blockquote>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>

      <div class="testimonial-swiper-pagination d-flex justify-content-center mb-5"></div>
    </section>
  <?php else: ?>
    <?php if (auth()->loggedIn()): ?>
      <section class="container my-5">
        <p class="alert alert-info text-center">
          <i class="fa fa-circle-info fs-1 text-left"></i>
          <br>

          <span>
            Aucun Témoignage enrégistré.
          </span>
          <br>

          <a href="<?= route_to('admin.testimonial.create') ?>" class="btn btn-dark">
            Créer une 
            <i class="fa fa-circle-plus"></i>
          </a>
        </p>
      </section>
    <?php endif ?>
  <?php endif ?>

  <section id="contact-us" class="newsletter bg-light" style="background: url(/assets/img/pattern-bg.png) no-repeat;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 py-5 my-5">
          <div class="subscribe-header text-center pb-3">
            <h3 class="section-title text-uppercase">
              Contactez-nous
            </h3>
          </div>

          <div class="row">
            <div class="col-md-6">
              <a 
               href="<?= route_to('goto', 'whatsapp') ?>" 
               class="btn btn-dark w-100 m-2" 
              >
                <i class="fab fa-whatsapp"></i>
                WhatsApp
              </a>
            </div>
            
            <div class="col-md-6">
              <a 
               href="<?= route_to('goto', 'phone') ?>" 
               class="btn btn-dark w-100 m-2" 
              >
                <i class="fa fa-phone"></i>
                Appel : <?= esc(get_contact('phone', Contact::$phone)) ?>
              </a>
            </div>
          </div>

          <div class="row mb-5">
            <div class="col-md-6">
              <a 
               href="<?= route_to('goto', 'facebook') ?>" 
               class="btn btn-dark w-100 m-2"
              >
                <i class="fab fa-facebook"></i>
                Facebook
              </a>
            </div>
            <div class="col-md-6">
              <a 
               href="<?= route_to('goto', 'instagram') ?>" 
               class="btn btn-dark w-100 m-2"
              >
                <i class="fab fa-instagram"></i>
                Instagram
              </a>
            </div>
          </div>

          <?php if(session()->get(CONTACT_SENT) !== true): ?>
            <form 
             method="post" 
             action="<?= route_to('contact.store') ?>"
             id="contact-us" 
             <?= classes([
              'd-flex',
              'flex-wrap',
              'justify-content-center',
              'mb-3'
             ]) ?>
            >
              <p class="alert alert-danger d-none"></p>
  
              <div class="row w-100">
                <div class="col-md-6">
                  <div class="input-group has-validation mb-3">
                    <span class="input-group-text">
                      Nom
                    </span>
  
                    <input 
                      type="text"
                      placeholder="Ex: Chrystelle" 
                      aria-label="Votre nom" 
                      id="name"
                      class="form-control form-control-lg"
                      minlength="3"
                      maxlength="24"
                      required
                    >
  
                    <p class="invalid-feedback"></p>
                  </div>
                </div>
  
                <div class="col-md-6">
                  <div class="input-group has-validation mb-3">
                    <span class="input-group-text">
                      237
                    </span>
  
                    <input 
                      type="text"
                      placeholder="Votre numéro" 
                      aria-label="Votre numéro" 
                      id="phone"
                      class="form-control form-control-lg"
                      required
                    >
  
                    <p class="invalid-feedback"></p>
                  </div>
                </div>
              </div>
  
              <button type="submit" class="btn btn-dark btn-lg text-uppercase w-100 mt-2">
                Nous Contacter
              </button>
            </form>
          <?php endif ?>

            <p 
             id="contact-sent-success"
             <?= classes([
              'alert',
              'alert-success',
              'd-none' => session()->get(CONTACT_SENT) !== true
             ]) ?>
            >
              <i class="fa fa-circle-check fs-2"></i>
              <br>
              Notre equipe a été contacté avec succès et ils vous ferons signe 
              dans quelques minutes.
              <br>
              Merci
            </p>
        </div>
      </div>
    </div>
  </section>

<?php $this->endSection('content') ?>

<?php $this->section('script') ?>
  <script src="/assets/js/app.js"></script>
<?php $this->endSection('script') ?>

</body>
</html>