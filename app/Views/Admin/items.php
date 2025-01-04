<?php

use App\Models\CategoryModel;
use App\Models\ItemModel;
use App\Models\ItemsVisitsModel;

 helper(['text', 'number']) ?>
<?php $this->extend('Admin/base') ?>

<?php $this->section('content') ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex align-items-end justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-0 text-gray-800">
                    Mes Articles
                </h1>

                <p class="opacity-75">
                    <?= esc($num_of_items) ?> articles enregistrés.
                </p>
            </div>
            
            <a href="<?= route_to('admin.item.create') ?>" role="button" class="btn btn-primary btn-sm btn-icon-split">
                <span class="icon">
                    <i class="fa fa-plus"></i>
                </span>

                <span class="text">
                    Ajouter
                </span>
            </a>
        </div>
    </div>
    <!-- /.container-fluid -->

    <!-- CAPS POPULARITY  -->
    <div class="container py-4" id="caps-popularity">
        <div class="row">
            <div class="col-md-6">
                <!-- Page Heading -->
                <h3 class="h5 mb-4 text-gray-800 text-uppercase">
                    Les 03 Chapeaux les plus populaires 
                    <i class="fas fa-arrow-up"></i>
                </h3>
        
                <?php if(count($popular_items) > 0): ?>
                    <!-- Slider main container -->
                    <div class="swiper mb-3 pb-5">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
        
                            <?php foreach($popular_items as $popular_item): ?>
                                <div class="swiper-slide">
                                    <div class="card shadow">
                                        <a href="<?= route_to('item.show', $popular_item->id) ?>">
                                            <img 
                                            src="<?= route_to('item.pic', $popular_item->item_pic_id) ?>" 
                                            class="card-img-top img-fluid img-fluid" 
                                            alt="<?= esc(character_limiter($popular_item->description, 125, '...')) ?>"
                                            />
                                        </a>
                                        
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?= esc($popular_item->name) ?> 
                                            </h5>
                
                                            <span>
                                                <i class="fa fa-eye"></i>
                                                <label>
                                                    <?= esc(number_format(model(ItemsVisitsModel::class)
                                                        ->visits($popular_item->id))) 
                                                    ?>
                                                </label>
                                            </span>
                
                                            <p>
                                                <?= esc(number_to_currency($popular_item->price, XAF)) ?> 
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
            
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                <?php else: ?>
                    <p class="bg-light">
                        Aucun article 
                    </p>
                <?php endif ?>
            </div>

            <div class="col-md-6">
                <h3 class="h5 mb-4 text-gray-800 text-uppercase">
                    Les 03 Chapeaux les mois populaires 
                    <i class="fas fa-arrow-down"></i>
                </h3>
        
                <!-- Slider main container -->
                <?php if(count($unpopular_items) > 0): ?>
                    <!-- Slider main container -->
                    <div class="swiper mb-3 pb-5">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
        
                            <?php foreach($unpopular_items as $unpopular_item): ?>
                                <div class="swiper-slide">
                                    <div class="card shadow">
                                        <img 
                                        src="<?= route_to('item.pic', $unpopular_item->item_pic_id) ?>" 
                                        class="card-img-top img-fluid img-fluid" 
                                        alt="<?= esc(character_limiter($unpopular_item->description, 125, '...')) ?>"
                                        />
                                        
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?= esc($unpopular_item->name) ?> 
                                            </h5>
                
                                            <span>
                                                <i class="fa fa-eye"></i>
                                                <label>
                                                    <?= esc(number_format(model(ItemsVisitsModel::class)
                                                        ->visits($unpopular_item->id))) 
                                                    ?>
                                                </label>
                                            </span>
                
                                            <p>
                                                <?= esc(number_to_currency($unpopular_item->price, XAF)) ?> 
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
            
                        <!-- If we need pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                <?php else: ?>
                    <p class="bg-light">
                        Aucun article 
                    </p>
                <?php endif ?>
            </div>
        </div>

    </div>

    <section class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">
            Mes Articles
        </h1>

        <div class="card show w-100 mb-4" id="find-items">
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                <div class="input-group w-75 mb-2">
                    <div class="input-group-prepend">
                        <span 
                        class="input-group-text" 
                        id="basic-addon1"
                        >
                            <i class="fa fa-search"></i>
                        </span>
                    </div>

                    <input 
                    type="text"
                    class="form-control"
                    placeholder="Trouver les chapeaux"
                    aria-label="Username"
                    aria-describedby="basic-addon1"
                    readonly
                    />

                    <button 
                     type="button" 
                     data-toggle="modal"
                     data-target="#search-admin-modal"
                     class="d-none"
                     id="show-search-item-modal"
                    ></button>
                </div>

                <div class="d-flex">
                    <a href="<?= route_to('admin.item.create') ?>" role="button" class="btn btn-sm btn-primary btn-icon-split m-2">
                        <span class="icon">
                            <i class="fa fa-plus"></i>
                        </span>

                        <span class="text">
                            Ajouter
                        </span>
                    </a>

                    <!-- Small button groups (default and split) -->
                    <div class="btn-group btn-sm">
                        <button 
                         class="btn btn-secondary btn-sm dropdown-toggle" 
                         type="button" 
                         data-toggle="dropdown" 
                         aria-expanded="false"
                        >
                            Catégories
                        </button>

                        <ul 
                         class="dropdown-menu" 
                         id="list-categories" 
                         update-action="<?= route_to('admin.category.update') ?>"
                         create-action="<?= route_to('admin.category.create') ?>"
                        >
                            <?php foreach($categories as $category): ?>
                                <li class="dropdown-item" id="category-<?= esc($category->code) ?>">
                                    <p class="d-inline-block mb-0">
                                        <?= esc($category->name) ?>
                                    </p>
                                    (<?= esc($category->num_items ?? 0) ?>) 

                                    <div>
                                        <button 
                                         type="button" 
                                         class="btn btn-sm btn-danger" 
                                         data-toggle="modal"
                                         data-target="#delete-category-modal"
                                         delete
                                        >
                                            <i class="fa fa-trash"></i>
                                        </button>

                                        <button 
                                         type="button" 
                                         class="btn btn-sm btn-secondary" 
                                         data-toggle="modal"
                                         data-target="#add-category"
                                         update
                                        >
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div>
                                </li>
                            <?php endforeach ?>

                            <div class="dropdown-divider"></div>
                            <li 
                             <?= classes([
                                'dropdown-item',
                                'w-100',
                                'disabled' => count($categories) > 10
                             ]) ?>
                            >
                                <button 
                                 <?= classes([
                                    'btn',
                                    'btn-sm',
                                    'btn-secondary',
                                    'my-0',
                                    'w-100',
                                    'disabled' => count($categories) > 10
                                 ]) ?>
                                 id="add-category-btn"

                                 <?= attr(count($categories) > 10, 'disabled') ?>
                                 data-toggle="modal"
                                 data-target="#add-category"
                                >
                                    <i class="fa fa-plus"></i>
                                    Ajouter
                                </button>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div id="list-items">
            <?php foreach(array_chunk($items, 8) as $chunked_items): ?>
                <div class="swiper mb-3 pb-4 position-relative">
                    <ul class="swiper-wrapper mb-3">
                        <?php foreach($chunked_items as $item): ?>
                            <li class="swiper-slide">
                                <div 
                                 <?= classes([
                                    'card',
                                    'shadow',
                                    'opacity-50' => $item->is_hidden == true
                                 ]) ?> 
                                 id="item-<?= esc($item->id, 'attr') ?>"
                                >
                                    <a href="<?= route_to('item.show', $item->id) ?>">
                                        <img 
                                         src="<?= route_to('item.pic', $item->item_pic_id) ?>" 
                                         class="card-img-top img-fluid" 
                                         alt="<?= esc(character_limiter($item->name, 25, '...')) ?>"
                                        />
                                    </a>
            
                                    <div class="card-body">
                                        <h6 class="card-title h6 fw-bold text-uppercase mb-0" style="font-weight: bold;">
                                            <?= esc(character_limiter($item->name, 125, '...')) ?>
                                            <?php if ($item->is_hidden): ?>
                                                <span class="fs-6">
                                                    (Caché)
                                                </span>
                                            <?php endif ?>
                                        </h6>
            
                                        <div class="d-flex gap-0 flex-row justify-content-between fs-7">
                                            <p class="mb-0">
                                                <i class="fa fa-eye"></i>
                                                <label>
                                                    <?= esc(number_format(model(ItemsVisitsModel::class)
                                                        ->visits($item->id))) 
                                                    ?>
                                                </label>
                                            </p>

                                        </div>
                                        <p class="mb-0">
                                            Categorie: <?= esc($item->category ?? 'Autre') ?>
                                        </p>
            
                                        <p class="mb-0 fw-bold">
                                            <?= esc(number_to_currency($item->price, XAF)) ?> F
                                        </p>
            
                                        <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
                                            
                                            <button 
                                             class="btn btn-sm btn-danger m-1"
                                             data-toggle="modal"
                                             data-target="#delete-item-modal"
                                             delete
                                            >
                                                Supprimer
                                            </button>

                                            <button 
                                             class="btn btn-sm btn-secondary m-1"
                                             data-toggle="modal"
                                             data-target="#<?= $item->is_hidden ? 'show-item-modal' : 'hide-item-modal' ?>"

                                             <?= attr($item->is_hidden, 'show', 'hide') ?> 
                                            >
                                                <?= $item->is_hidden ? 'Afficher' : 'Cacher' ?>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>

                    <div class="swiper-pagination"></div>
                </div>
            <?php endforeach ?>
        </div>

        <?= $items_pager->links() ?>
    </section>

    <?= $this->include('Admin/Parts/search-items-modal') ?>
    <?= $this->include('Admin/Parts/hide-item-modal') ?>
    <?= $this->include('Admin/Parts/add-category-modal') ?>
    <?= $this->include('Admin/Parts/delete-category-modal') ?>
    <?= $this->include('Admin/Parts/show-item-modal') ?>
    <?= $this->include('Admin/Parts/delete-item-modal') ?>
<?php $this->endSection('content') ?>

<?php $this->section('script') ?>
    <script type="module" src="<?= base_url('assets/Admin/js/items.js') ?>"></script>
<?php $this->endSection('script') ?>