<?php $this->extend('base') ?>

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
          <p><?= esc(lang('Text.desc')) ?></p>
        </div>
      </div>

      <div class="row">
        <div 
         class="swiper main-swiper py-4" 
         data-aos="fade-up" 
         data-aos-delay="600"
        >
          <div class="swiper-wrapper d-flex border-animation-left">
            <div class="swiper-slide">
              <div class="banner-item image-zoom-effect">
                <div class="image-holder">
                  <a href="<?= route_to('item.show', 'abc-123-efg') ?>">
                    <img 
                      src="/assets/images/items/presentation-cap-1.jpg" 
                      alt="product"
                      class="img-fluid"
                    />
                  </a>
                </div>

                <div class="banner-content py-4">
                  <h5 class="element-title text-uppercase">
                    Des chapeaux sophistiqués
                  </h5>

                  <p>
                    Nous sommes habitué à créer des chapeaux aux finissions impéccables.
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="banner-item image-zoom-effect">
                <div class="image-holder">
                  <a href="<?= route_to('item.show', 'abc-123-efg') ?>">
                    <img 
                     src="/assets/images/items/presentation-cap-2.jpg" 
                     alt="product" 
                     class="img-fluid"
                    >
                  </a>
                </div>

                <div class="banner-content py-4">
                  <h5 class="element-title text-uppercase">
                    Des chapeaux de hautes haute-qualités
                  </h5>

                  <p>
                    Confectionnez chez nous des chapeaux soigneusement 
                    conçus
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="banner-item image-zoom-effect">
                <div class="image-holder">
                  <a href="<?= route_to('item.show', 'abc-123-efg') ?>">
                    <img 
                     src="/assets/images/items/presentation-cap-3.jpg" 
                     alt="product" 
                     class="img-fluid"
                    >
                  </a>
                </div>
                <div class="banner-content py-4">
                  <h5 class="element-title text-uppercase">
                    Vos mariages et évènements
                  </h5>

                  <p>
                    pour vos dotes, marriages ou funérailles, nous saurons vous 
                    satisfaire.
                  </p>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="banner-item image-zoom-effect">
                <div class="image-holder">
                  <a href="<?= route_to('item.show', 'abc-123-efg') ?>">
                    <img 
                      src="/assets/images/items/chapeaux-12.jpg" 
                      alt="product" 
                      class="img-fluid"
                    >
                  </a>
                </div>

                <div class="banner-content py-4">
                  <h5 class="element-title text-uppercase">
                    Pour vos soirées et fetes
                  </h5>

                  <p>
                    Démarquez vous dans les soirées, fetes avec un chapeau éclatant et 
                    authentique.
                  </p>
                </div>
              </div>
            </div>
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

  <section id="our-collections" class="new-arrival product-carousel pt-5 pb-2 position-relative overflow-hidden">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
        <h4 class="text-uppercase">
          Notre Collection de chapeaux
        </h4>

        <a href="/" class="btn-link">
          Me Confectionner un chapeau
          <i class="fa fa-arrow-right"></i>
        </a>
      </div>

      <div class="swiper product-swiper open-up" data-aos="zoom-out">
        <div class="swiper-wrapper d-flex">
          
          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect" liked>
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-1.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>

                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fs-5 fa fa-heart"></i>
                </a>

                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">
                      15.000 F 
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-2.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="#" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/details-item.html">
                      15.000 F 
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-3.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="#" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">
                      15.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-4.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>

                <a href="#" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>

                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/details-item.html">
                      15.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-5.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="#" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/details-item.html">
                      15.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-8.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="#" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/details-item.html">
                      15.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-7.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">
                      15.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

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

  <section id="caps-collection-2" class="new-arrival product-carousel pt-2 pb-5 position-relative overflow-hidden">
    <div class="container">
      <div class="d-flex flex-wrap justify-content-between align-items-center mt-5 mb-3">
        <h4 class="text-uppercase">
          Des chapeaux de haute-qualités
        </h4>

        <a href="/" class="btn-link">
          Me Confectionner un chapeau
          <i class="fa fa-arrow-right"></i>
        </a>
      </div>

      <div class="swiper product-swiper open-up" data-aos="zoom-out">
        <div class="swiper-wrapper d-flex">
          
          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-9.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>

                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>

                <div class="product-content">
                  <h5 class="element-title text-uppercase fs-5 mt-3">
                    <a href="/">
                      15.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-10.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">
                      15.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-11-.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">
                      10.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-12.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>

                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>

                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">
                      15.000F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-15.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">
                      15.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-16.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">Crop sweater</a>
                  </h5>
                  <a href="#" class="text-decoration-none" data-after="Add to cart"><span>$70.00</span></a>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-17.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">Crop sweater</a>
                  </h5>
                  <a href="#" class="text-decoration-none" data-after="Add to cart"><span>$70.00</span></a>
                </div>
              </div>
            </div>
          </div>

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
        </svg>
      </div>
    </div>
  </section>

  <section id="caps-collection-3" class="new-arrival product-carousel pt-2 pb-5 position-relative overflow-hidden">
    <div class="container">
      <div class="swiper product-swiper open-up" data-aos="zoom-out">
        <div class="swiper-wrapper d-flex">
          
          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-9.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>

                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>

                <div class="product-content">
                  <h5 class="element-title text-uppercase fs-5 mt-3">
                    <a href="/">
                      15.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-10.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">
                      15.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-11-.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">
                      10.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-12.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>

                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>

                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">
                      15.000F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-15.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">
                      15.000 F
                    </a>
                  </h5>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-16.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">Crop sweater</a>
                  </h5>
                  <a href="#" class="text-decoration-none" data-after="Add to cart"><span>$70.00</span></a>
                </div>
              </div>
            </div>
          </div>

          <div class="swiper-slide">
            <div class="product-item image-zoom-effect link-effect">
              <div class="image-holder position-relative">
                <a href="details-item.html">
                  <img 
                   src="/assets/images/items/chapeaux-17.jpg" 
                   alt="categories" 
                   class="product-image img-fluid"
                  >
                </a>
                <a href="/" class="btn-icon btn-wishlist">
                  <i class="fa fa-heart fs-5" ></i>
                </a>
                <div class="product-content">
                  <h5 class="text-uppercase fs-5 mt-3">
                    <a href="/">Crop sweater</a>
                  </h5>
                  <a href="#" class="text-decoration-none" data-after="Add to cart"><span>$70.00</span></a>
                </div>
              </div>
            </div>
          </div>

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
        </svg>
      </div>
    </div>
  </section>

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
                Chez Charel Chapeaux, nous mettons l'accent sur le détail. Chaque fil, 
                chaque tissu est soigneusement posé pour un résultat impeccable. 
                
                <br><br>
                Pour tous vos événements, mariages, soirées, nous créons des chapeaux 
                uniques et sur-mesure. 
              </p>
              <br><br>

              <a 
               href="https://maps.app.goo.gl/YhBaLaymwSvbmUYp7" 
               target="_blank"
              >
                <i class="fa fa-map-pin"></i>
                Express Union Biteng, Yaoundé, Cameroun
              </a>
              <br><br>

              <a href="tel:237699967512" class="btn btn-lg btn-dark text-uppercase">
                Appelez-nous
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="testimonials py-5 bg-light">
    <div class="section-header text-center mt-5">
      <h3 class="section-title text-uppercase">
        Des Clients Satisfaits
      </h3>
    </div>
    
    <div class="swiper testimonial-swiper overflow-hidden my-5">
      <div class="swiper-wrapper d-flex">
        <div class="swiper-slide">
          <div class="testimonial-item text-center">
            <blockquote>
              <p>
                “Les finissions de mon chapeau de marriage étaient impéccables.
                Je suis une cliente satisfaite”
              </p>

              <div class="review-title text-uppercase">
                Chrystelle
              </div>
            </blockquote>
          </div>
        </div>

        <div class="swiper-slide">
          <div class="testimonial-item text-center">
            <blockquote>
              <p>
                “Ma femme et moi avons confectionné un chapeau chez Charel Chapeaux. C'était 
                très jolie."
              </p>
              <div class="review-title text-uppercase">
                Steve
              </div>
            </blockquote>
          </div>
        </div>
        <div class="swiper-slide">
          <div class="testimonial-item text-center">
            <blockquote>
              <p>
                “On sent l'amour du détail dans tout ce qu'ils produisent. Je devenu 
                une fidèle cliente.”
              </p>
              
              <div class="review-title text-uppercase">
                Mama Thérèse
              </div>
            </blockquote>
          </div>
        </div>
      </div>
    </div>
    <div class="testimonial-swiper-pagination d-flex justify-content-center mb-5"></div>
  </section>

  <section class="newsletter bg-light" style="background: url(/assets/img/pattern-bg.png) no-repeat;">
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
               href="htpps://wa.me/237699967512" 
               class="btn btn-dark w-100 m-2" 
               target="_blank"
              >
                <i class="fab fa-whatsapp"></i>
                WhatsApp
              </a>
            </div>
            
            <div class="col-md-6">
              <a 
               href="tel:237699967512" 
               class="btn btn-dark w-100 m-2" 
               target="_blank"
              >
                <i class="fa fa-phone"></i>
                Appel : +237 699 96 75 12
              </a>
            </div>
          </div>

          <div class="row mb-5">
            <div class="col-md-6">
              <a 
               href="https://facebook.com/profile.php?id=100063837618193" 
               class="btn btn-dark w-100 m-2"
               target="_blank"
              >
                <i class="fab fa-facebook"></i>
                Facebook
              </a>
            </div>
            <div class="col-md-6">
              <a 
               href="https://instagram.com/charelchapeaux" 
               class="btn btn-dark w-100 m-2"
               target="_blank"
              >
                <i class="fab fa-instagram"></i>
                Instagram
              </a>
            </div>
          </div>

          <form id="contact-us" class="d-flex flex-wrap justify-content-center">
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

                  <span class="invalid-feedback"></span>
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

                  <span class="invalid-feedback"></span>
                </div>
              </div>
            </div>

            <button class="btn btn-dark btn-lg text-uppercase w-100 mt-2">
              Nous Contacter
            </button>
          </form>

          <div id="success-contact" class="d-flex w-100 flex-column align-items-center bg-white p-3 h-auto d-none">
            <p>
              <i class="fs-1 fa fa-headphones-alt"></i>
              <i class="fs-1 fa fa-check-circle text-success"></i>
            </p>
            <p class="text-center">
              Notre service client à été notifié, vous serez contacté dans quelques 
              minutes.
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

<?php $this->section('script') ?>
  <script src="/assets/js/app.js"></script>
<?php $this->endSection('script') ?>

</body>
</html>