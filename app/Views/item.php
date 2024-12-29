<?php
helper(['text', 'number']);

use App\Models\ItemsVisitsModel;
use CodeIgniter\I18n\Time;
use Config\Contact;
?>

<?php $this->extend('base') ?>

<?php $this->section('content') ?>
  <a class="btn btn-dark mt-2 ms-2" href="javascript:void(0)" role="button" onclick="history.back()">
    <i class="fa fa-arrow-left"></i>
    Retour
  </a>

  <div id="item-details" class="container p-md-5 p-sm-1">
    <div class="row p-3">
      <div class="col-md-6">
        <?php if(count($item_pics) > 1): ?>
          <div class="swiper">
            <div class="swiper-wrapper p-md-3">
              <?php foreach($item_pics as $item_pic): ?>
                <div class="swiper-slide">
                  <div class="image-holder mb-3" enlarge>
                    <img 
                      src="<?= route_to('item.pic', $item_pic->id) ?>" 
                      alt="<?= esc(character_limiter($item->name, 125, '...')) ?>" 
                      class="img-fluid"
                    />
                  </div>
                </div>
              <?php endforeach ?>
            </div>

            <div class="swiper-pagination"></div>
          </div>
        <?php else: ?>
          <div class="image-holder mb-3" enlarge>
            <img 
              src="<?= route_to('item.pic', $item_pics[0]->id) ?>" 
              alt="<?= esc(character_limiter($item->name, 125, '...')) ?>" 
              class="img-fluid"
            />
            </div>
        <?php endif ?>
      </div>

      <div class="col-md-6">
        <h5 class="text-uppercase text-left mb-0">
          <?= esc(character_limiter($item->name, 125, '...')) ?>
        </h5>

        <p class="opacity-75 mb-0">
          Catégorie: <?= esc($item->category) ?>
        </p>

        <?php if($item->is_hidden): ?>
          <span class="opacity-75 mb-3 small fs-6 text-danger">
            Caché <i class="fa fa-ban"></i>
          </span>
        <?php endif ?>

        <p class="mt-2"><?= esc(character_limiter($item->description, 300, '...')) ?></p>

        <?php if (auth()->loggedIn()): ?>
          <div class="bg-light p-3 rounded-2 d-flex align-items-center justify-content-around mb-3">
            <p class="mb-0">
              <i class="fa fa-eye"></i> 
              <?= esc(number_format(model(ItemsVisitsModel::class)->visits($item->id))) ?>
            </p>

            <p class="mb-0">
              <i class="fa fa-clock"></i> 
              <?= Time::createFromFormat('Y-m-d H:i:s', $item->created_at)->humanize() ?>
            </p>
        </div>

        <div class="d-flex align-items-center justify-content-start gap-3 mb-1">
          <button class="btn btn-danger btn-sm">
            <i class="fa fa-trash"></i>
            Supprimer 
          </button> 

          <button class="btn btn-dark btn-sm">
            <i class="fa fa-times"></i>
            Cacher
          </button>
        </div>

        <?php endif ?>
        <hr>

        <h5 class="text-uppercase text-left">
          <?= esc(number_to_currency($item->price, XAF)) ?>
        </h5>

        <div class="row w-100 mt-5 cta">
          <div class="col-md-6">
            <a 
            href="<?= sprintf('%s?item=%s', route_to('goto', 'whatsapp'), $item->id) ?>" 
            target="_blank" 
            class="btn btn-success text-uppercase w-100 m-1"
            >
              <i class="fab fa-whatsapp"></i>
              WhatsApp
            </a>
          </div>

          <div class="col-md-6">
            <a href="<?= sprintf('%s?item=%s', route_to('goto', 'phone'), $item->id) ?>" class="btn btn-dark text-uppercase w-100 m-1">
              <i class="fa fa-phone"></i>
              Appeler
            </a>
          </div>
        </div>
        
      </div>
    </div>
    <hr>
  </div>

  <?php if ((count($item_props) - 1) > 0): ?>
    <section 
     id="caps-proposition" 
     class="new-arrival product-carousel pt-2 pb-5 position-relative overflow-hidden"
    >
      <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
          <h4 class="text-uppercase">
            Vous pouvez aussi aimer
          </h4>
  
          <a href="/" class="btn-link">
            Me Confectionner un chapeau
            <i class="fa fa-arrow-right"></i>
          </a>
        </div>

        <div class="swiper product-swiper open-up" data-aos="zoom-out">
          <div class="swiper-wrapper d-flex">
            
            <?php foreach($item_props as $item_prop): ?>
              <?php if($item->id == $item_prop->id) { continue; } ?>

              <div class="swiper-slide">
                <div class="product-item image-zoom-effect link-effect">
                  <div class="image-holder position-relative">
                    <a href="<?= route_to('item.show', $item_prop->id) ?>">
                      <img 
                      src="<?= route_to('item.pic', $item_prop->item_pic_id) ?>" 
                      alt="<?= esc(character_limiter($item_prop->name, 125, '...'), 'attr') ?>" 
                      class="product-image img-fluid"
                      >
                    </a>
    
                    <div class="product-content">
                      <h5 class="element-title text-uppercase fs-5 mt-3">
                        <?= esc(number_to_currency($item_prop->price, XAF)) ?>
                      </h5>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach ?>
          </div>
        </div>
  
        <div class="icon-arrow icon-arrow-left">
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
      <hr>
    </section>
  <?php endif ?>
<?php $this->endSection('content') ?>

  <!-- <a 
   href="/" 
   class="call-cta-btn btn btn-dark"
  >
    <i class="fa fa-arrow-left"></i>
    Retour
  </a> -->