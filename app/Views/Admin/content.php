<?php helper(['description']) ?>

<?php $this->extend('Admin/base') ?>

<?php $this->section('content') ?>
    <section class="container-fluid">
        <!-- Admins Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">
                Contenu du site
            </h1>
        </div>

        <div class="my-5" id="site-desc">
            
            <div class="row">
                <div 
                 class="swiper main-swiper py-4" 
                >
                    <div class="swiper-wrapper d-flex border-animation-left">
                        <div class="swiper-slide">
                            <div class="mb-3">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <h5 class="text-uppercase">
                                                Description Principal
                                            </h5>
                                        </div>
                                    </div>
    
                                    <div class="card-body">
                                        <textarea 
                                            id="main-desc"
                                            class="form-control" 
                                            readonly 
                                        ><?= esc(get_desc(needle: 'main', haystack: $descriptions)) ?></textarea>
                                    </div>
    
                                    <div class="card-footer">
                                        <button 
                                            type="button"
                                            class="btn btn-sm btn-secondary btn-icon-split"
                                            data-target="#extend-desc"
                                            data-toggle="modal"
                                        >
                                            <span class="icon">
                                                <i class="fas fa-expand-alt"></i>
                                            </span>
    
                                            <span class="text">
                                                Agrandir
                                            </span>
                                        </button>
    
                                        <a 
                                            href="<?= route_to('admin.description.modify', 'main') ?>"
                                            role="button"
                                            class="btn btn-sm btn-primary btn-icon-split"
                                        >
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
    
                                            <span class="text">
                                                Modifier
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="swiper-slide">
                            <div class="mb-3">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="text-uppercase">
                                                A propos
                                            </h5>
                                        </div>
                                    </div>
    
                                    <div class="card-body">
                                        <textarea 
                                            id="main-desc"
                                            class="form-control" 
                                            readonly 
                                        ><?= esc(get_desc(needle: 'about', haystack: $descriptions)) ?></textarea>
                                    </div>
    
                                    <div class="card-footer">
                                        <button 
                                            type="button"
                                            class="btn btn-sm btn-secondary btn-icon-split"
                                            data-target="#extend-desc"
                                            data-toggle="modal"
                                        >
                                            <span class="icon">
                                                <i class="fas fa-expand-alt"></i>
                                            </span>
    
                                            <span class="text">
                                                Agrandir
                                            </span>
                                        </button>
    
                                        <a 
                                            href="<?= route_to('admin.description.modify', 'about') ?>"
                                            role="button"
                                            class="btn btn-sm btn-primary btn-icon-split"
                                        >
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
    
                                            <span class="text">
                                                Modifier
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="swiper-slide">
                            <div class="mb-3">
                                <div class="card shadow">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="text-uppercase">
                                                Description Google
                                            </h5>
                                        </div>
                                    </div>
    
                                    <div class="card-body">
                                        <textarea 
                                            name="" 
                                            id="main-desc"
                                            class="form-control" 
                                            readonly 
                                            required
                                        ><?= esc(get_desc(needle: 'meta', haystack: $descriptions)) ?></textarea>
                                    </div>
    
                                    <div class="card-footer">
                                        <button 
                                            type="button"
                                            class="btn btn-sm btn-secondary btn-icon-split"
                                            data-target="#extend-desc"
                                            data-toggle="modal"
                                        >
                                            <span class="icon">
                                                <i class="fas fa-expand-alt"></i>
                                            </span>
    
                                            <span class="text">
                                                Agrandir
                                            </span>
                                        </button>
    
                                        <a 
                                            href="<?= route_to('admin.description.modify', 'meta') ?>"
                                            role="button"
                                            class="btn btn-sm btn-primary btn-icon-split"
                                        >
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
    
                                            <span class="text">
                                                Modifier
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>

        <div class="my-5" id="testimonials">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="h3 mb-2 text-gray-800 text-uppercase">
                    Témoignages Clients 
                </h2>

                <?php if (auth()->user()->inGroup('superadmin')): ?>
                    <a 
                     href="<?= route_to('admin.testimonial.create') ?>" 
                     role="button" 
                     class="btn btn-sm btn-primary"
                    >
                        Ajouter
                        <i class="fa fa-plus"></i>
                    </a>
                <?php endif ?>
            </div>

            <p class="mb-3">
                <?= esc(count($testimonials)) ?> 
                témoignages enregistrés.
            </p>

            <!-- Slider main container -->
            <div class="swiper w-100">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                <!-- Slides -->
                    <?php foreach($testimonials as $testimonial): ?>
                        <div class="swiper-slide">
                            <div class="card shadow" id="testimonial-<?= esc($testimonial->id, 'attr') ?>">
                                <div class="card-header">
                                    <h5 class="text-capitalize">
                                        <?= esc($testimonial->name) ?>
                                    </h5>
                                </div>
    
                                <div class="card-body">
                                    <textarea 
                                        class="form-control"
                                        rows="4"
                                        readonly
                                    ><?= esc($testimonial->content) ?></textarea>
                                </div>
    
                                <?php if (auth()->user()->inGroup('superadmin')): ?>
                                    <div class="card-footer">
                                        <a 
                                            href="<?= route_to('admin.testimonial.modify', $testimonial->id) ?>"
                                            role="button"
                                            class="btn btn-sm btn-primary btn-icon-split"
                                        >
                                            <span class="icon">
                                                <i class="fas fa-edit"></i>
                                            </span>
        
                                            <span class="text">
                                                Modifier
                                            </span>
                                        </a>
    
                                        <button 
                                            type="button"
                                            class="btn btn-sm btn-danger btn-icon-split"
                                            data-target="#delete-testimonial-modal"
                                            data-toggle="modal"
                                            delete
                                        >
                                            <span class="icon">
                                                <i class="fas fa-trash"></i>
                                            </span>
        
                                            <span class="text">
                                                Supprimer
                                            </span>
                                        </button>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    <?= $this->include('Admin/Parts/delete-testimonial-modal') ?>
<?php $this->endSection('content') ?>

<?php $this->section('script') ?>
    <script type="module" src="<?= base_url('assets/Admin/js/content.js') ?>"></script>
<?php $this->endSection('script') ?>