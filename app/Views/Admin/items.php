<?php $this->extend('Admin/base') ?>

<?php $this->section('content') ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-flex align-items-end justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Mes Articles
            </h1>
            
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
        <!-- Page Heading -->
        <h3 class="h5 mb-4 text-gray-800 text-uppercase">
            Les 03 Chapeaux les plus populaires 
            <i class="fas fa-arrow-up"></i>
        </h3>

        <!-- Slider main container -->
        <div class="swiper mb-3">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img 
                                src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                                class="img-fluid" 
                                alt="..."
                                />
                            </div>

                            <h5 class="card-title">
                                Chapeaux 
                            </h5>

                            <span>
                                <i class="fa fa-eye"></i>
                                <label>16</label>
                            </span>

                            <p>
                                15.000F
                            </p>

                            <div class="d-flex flex-wrap gap-2">
                                <button 
                                class="btn btn-sm btn-secondary btn-icon-split m-1"
                                >
                                    <span class="icon">
                                        <i class="fas fa-expand-alt"></i>
                                    </span>

                                    <span class="text">
                                        Agrandir
                                    </span>
                                </button>

                                <button 
                                class="btn btn-sm btn-danger btn-icon-split m-1"
                                >
                                    <span class="icon">
                                        <i class="fa fa-trash"></i>
                                    </span>

                                    <span class="text">
                                        Supprimer
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img 
                                src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                                class="img-fluid" 
                                alt="..."
                                />
                            </div>

                            <h5 class="card-title">
                                Chapeaux 
                            </h5>

                            <p>
                                15.000F
                            </p>

                            <div class="d-flex flex-wrap gap-2">
                                <button 
                                class="btn btn-sm btn-secondary btn-icon-split m-1"
                                >
                                    <span class="icon">
                                        <i class="fas fa-expand-alt"></i>
                                    </span>

                                    <span class="text">
                                        Agrandir
                                    </span>
                                </button>

                                <button 
                                class="btn btn-sm btn-danger btn-icon-split m-1"
                                >
                                    <span class="icon">
                                        <i class="fa fa-trash"></i>
                                    </span>

                                    <span class="text">
                                        Supprimer
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img 
                                src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                                class="img-fluid" 
                                alt="..."
                                />
                            </div>

                            <h5 class="card-title">
                                Chapeaux 
                            </h5>

                            <p>
                                15.000F
                            </p>

                            <div class="d-flex flex-wrap gap-2">
                                <button 
                                class="btn btn-sm btn-secondary btn-icon-split m-1"
                                >
                                    <span class="icon">
                                        <i class="fas fa-expand-alt"></i>
                                    </span>

                                    <span class="text">
                                        Agrandir
                                    </span>
                                </button>

                                <button 
                                class="btn btn-sm btn-danger btn-icon-split m-1"
                                >
                                    <span class="icon">
                                        <i class="fa fa-trash"></i>
                                    </span>

                                    <span class="text">
                                        Supprimer
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
        </div>

        <h3 class="h5 mb-4 text-gray-800 text-uppercase">
            Les 03 Chapeaux les mois populaires 
            <i class="fas fa-arrow-down"></i>
        </h3>

        <!-- Slider main container -->
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img 
                                src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                                class="img-fluid" 
                                alt="..."
                                />
                            </div>

                            <h5 class="card-title">
                                Chapeaux 
                            </h5>

                            <p>
                                15.000F
                            </p>

                            <div class="d-flex flex-wrap gap-2">
                                <button 
                                class="btn btn-sm btn-secondary btn-icon-split m-1"
                                >
                                    <span class="icon">
                                        <i class="fas fa-expand-alt"></i>
                                    </span>

                                    <span class="text">
                                        Agrandir
                                    </span>
                                </button>

                                <button 
                                class="btn btn-sm btn-danger btn-icon-split m-1"
                                >
                                    <span class="icon">
                                        <i class="fa fa-trash"></i>
                                    </span>

                                    <span class="text">
                                        Supprimer
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img 
                                src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                                class="img-fluid" 
                                alt="..."
                                />
                            </div>

                            <h5 class="card-title">
                                Chapeaux 
                            </h5>

                            <p>
                                15.000F
                            </p>

                            <div class="d-flex flex-wrap gap-2">
                                <button 
                                class="btn btn-sm btn-secondary btn-icon-split m-1"
                                >
                                    <span class="icon">
                                        <i class="fas fa-expand-alt"></i>
                                    </span>

                                    <span class="text">
                                        Agrandir
                                    </span>
                                </button>

                                <button 
                                class="btn btn-sm btn-danger btn-icon-split m-1"
                                >
                                    <span class="icon">
                                        <i class="fa fa-trash"></i>
                                    </span>

                                    <span class="text">
                                        Supprimer
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="swiper-slide">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="card-img-top">
                                <img 
                                src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                                class="img-fluid" 
                                alt="..."
                                />
                            </div>

                            <h5 class="card-title">
                                Chapeaux 
                            </h5>

                            <p>
                                15.000F
                            </p>

                            <div class="d-flex flex-wrap gap-2">
                                <button 
                                class="btn btn-sm btn-secondary btn-icon-split m-1"
                                >
                                    <span class="icon">
                                        <i class="fas fa-expand-alt"></i>
                                    </span>

                                    <span class="text">
                                        Agrandir
                                    </span>
                                </button>

                                <button 
                                class="btn btn-sm btn-danger btn-icon-split m-1"
                                >
                                    <span class="icon">
                                        <i class="fa fa-trash"></i>
                                    </span>

                                    <span class="text">
                                        Supprimer
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>

    <div class="container py-4">
        <h1 class="h3 mb-4 text-gray-800">
            Mes Articles
        </h1>

        <div class="card show w-100">
            <div class="card-body d-flex flex-wrap justify-content-between align-items-center">
                <div class="input-group w-75">
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
                    />
                </div>

                <button class="btn btn-sm btn-primary btn-icon-split m-2">
                    <span class="icon">
                        <i class="fa fa-plus"></i>
                    </span>

                    <span class="text">
                        Ajouter
                    </span>
                </button>
            </div>
        </div>

        <ul class="row py-3 gap-5">
            <li class="col-xl-3 col-sm-6 card shadow">
                <div class="card-body">
                    <div class="card-img-top">
                        <img 
                        src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                        class="img-fluid" 
                        alt="..."
                        />
                    </div>

                    <h5 class="card-title">
                        Chapeaux 
                    </h5>

                    <span>
                        <i class="fa fa-eye"></i>
                        <label>16</label>
                    </span>

                    <p>
                        15.000F
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button 
                        class="btn btn-sm btn-secondary btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fas fa-expand-alt"></i>
                            </span>

                            <span class="text">
                                Agrandir
                            </span>
                        </button>

                        <button 
                        class="btn btn-sm btn-danger btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>

                            <span class="text">
                                Supprimer
                            </span>
                        </button>
                    </div>
                </div>
            </li>

            <li class="col-xl-3 col-sm-6 card shadow">
                <div class="card-body">
                    <div class="card-img-top">
                        <img 
                        src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                        class="img-fluid" 
                        alt="..."
                        />
                    </div>

                    <h5 class="card-title">
                        Chapeaux 
                    </h5>

                    <span>
                        <i class="fa fa-eye"></i>
                        <label>16</label>
                    </span>

                    <p>
                        15.000F
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button 
                        class="btn btn-sm btn-secondary btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fas fa-expand-alt"></i>
                            </span>

                            <span class="text">
                                Agrandir
                            </span>
                        </button>

                        <button 
                        class="btn btn-sm btn-danger btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>

                            <span class="text">
                                Supprimer
                            </span>
                        </button>
                    </div>
                </div>
            </li>

            <li class="col-xl-3 col-sm-6 card shadow">
                <div class="card-body">
                    <div class="card-img-top">
                        <img 
                        src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                        class="img-fluid" 
                        alt="..."
                        />
                    </div>

                    <h5 class="card-title">
                        Chapeaux 
                    </h5>

                    <span>
                        <i class="fa fa-eye"></i>
                        <label>16</label>
                    </span>

                    <p>
                        15.000F
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button 
                        class="btn btn-sm btn-secondary btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fas fa-expand-alt"></i>
                            </span>

                            <span class="text">
                                Agrandir
                            </span>
                        </button>

                        <button 
                        class="btn btn-sm btn-danger btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>

                            <span class="text">
                                Supprimer
                            </span>
                        </button>
                    </div>
                </div>
            </li>

            <li class="col-xl-3 col-sm-6 card shadow">
                <div class="card-body">
                    <div class="card-img-top">
                        <img 
                        src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                        class="img-fluid" 
                        alt="..."
                        />
                    </div>

                    <h5 class="card-title">
                        Chapeaux 
                    </h5>

                    <span>
                        <i class="fa fa-eye"></i>
                        <label>16</label>
                    </span>

                    <p>
                        15.000F
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button 
                        class="btn btn-sm btn-secondary btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fas fa-expand-alt"></i>
                            </span>

                            <span class="text">
                                Agrandir
                            </span>
                        </button>

                        <button 
                        class="btn btn-sm btn-danger btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>

                            <span class="text">
                                Supprimer
                            </span>
                        </button>
                    </div>
                </div>
            </li>
        </ul>

        <ul class="row py-3 gap-5">
            <li class="col-xl-3 col-sm-6 card shadow">
                <div class="card-body">
                    <div class="card-img-top">
                        <img 
                        src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                        class="img-fluid" 
                        alt="..."
                        />
                    </div>

                    <h5 class="card-title">
                        Chapeaux 
                    </h5>

                    <span>
                        <i class="fa fa-eye"></i>
                        <label>16</label>
                    </span>

                    <p>
                        15.000F
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button 
                        class="btn btn-sm btn-secondary btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fas fa-expand-alt"></i>
                            </span>

                            <span class="text">
                                Agrandir
                            </span>
                        </button>

                        <button 
                        class="btn btn-sm btn-danger btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>

                            <span class="text">
                                Supprimer
                            </span>
                        </button>
                    </div>
                </div>
            </li>

            <li class="col-xl-3 col-sm-6 card shadow">
                <div class="card-body">
                    <div class="card-img-top">
                        <img 
                        src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                        class="img-fluid" 
                        alt="..."
                        />
                    </div>

                    <h5 class="card-title">
                        Chapeaux 
                    </h5>

                    <span>
                        <i class="fa fa-eye"></i>
                        <label>16</label>
                    </span>

                    <p>
                        15.000F
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button 
                        class="btn btn-sm btn-secondary btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fas fa-expand-alt"></i>
                            </span>

                            <span class="text">
                                Agrandir
                            </span>
                        </button>

                        <button 
                        class="btn btn-sm btn-danger btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>

                            <span class="text">
                                Supprimer
                            </span>
                        </button>
                    </div>
                </div>
            </li>

            <li class="col-xl-3 col-sm-6 card shadow">
                <div class="card-body">
                    <div class="card-img-top">
                        <img 
                        src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                        class="img-fluid" 
                        alt="..."
                        />
                    </div>

                    <h5 class="card-title">
                        Chapeaux 
                    </h5>

                    <span>
                        <i class="fa fa-eye"></i>
                        <label>16</label>
                    </span>

                    <p>
                        15.000F
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button 
                        class="btn btn-sm btn-secondary btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fas fa-expand-alt"></i>
                            </span>

                            <span class="text">
                                Agrandir
                            </span>
                        </button>

                        <button 
                        class="btn btn-sm btn-danger btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>

                            <span class="text">
                                Supprimer
                            </span>
                        </button>
                    </div>
                </div>
            </li>

            <li class="col-xl-3 col-sm-6 card shadow">
                <div class="card-body">
                    <div class="card-img-top">
                        <img 
                        src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                        class="img-fluid" 
                        alt="..."
                        />
                    </div>

                    <h5 class="card-title">
                        Chapeaux 
                    </h5>

                    <span>
                        <i class="fa fa-eye"></i>
                        <label>16</label>
                    </span>

                    <p>
                        15.000F
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button 
                        class="btn btn-sm btn-secondary btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fas fa-expand-alt"></i>
                            </span>

                            <span class="text">
                                Agrandir
                            </span>
                        </button>

                        <button 
                        class="btn btn-sm btn-danger btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>

                            <span class="text">
                                Supprimer
                            </span>
                        </button>
                    </div>
                </div>
            </li>
        </ul>

        <ul class="row py-3 gap-5">
            <li class="col-xl-3 col-sm-6 card shadow">
                <div class="card-body">
                    <div class="card-img-top">
                        <img 
                        src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                        class="img-fluid" 
                        alt="..."
                        />
                    </div>

                    <h5 class="card-title">
                        Chapeaux 
                    </h5>

                    <span>
                        <i class="fa fa-eye"></i>
                        <label>16</label>
                    </span>

                    <p>
                        15.000F
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button 
                        class="btn btn-sm btn-secondary btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fas fa-expand-alt"></i>
                            </span>

                            <span class="text">
                                Agrandir
                            </span>
                        </button>

                        <button 
                        class="btn btn-sm btn-danger btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>

                            <span class="text">
                                Supprimer
                            </span>
                        </button>
                    </div>
                </div>
            </li>

            <li class="col-xl-3 col-sm-6 card shadow">
                <div class="card-body">
                    <div class="card-img-top">
                        <img 
                        src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                        class="img-fluid" 
                        alt="..."
                        />
                    </div>

                    <h5 class="card-title">
                        Chapeaux 
                    </h5>

                    <span>
                        <i class="fa fa-eye"></i>
                        <label>16</label>
                    </span>

                    <p>
                        15.000F
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button 
                        class="btn btn-sm btn-secondary btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fas fa-expand-alt"></i>
                            </span>

                            <span class="text">
                                Agrandir
                            </span>
                        </button>

                        <button 
                        class="btn btn-sm btn-danger btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>

                            <span class="text">
                                Supprimer
                            </span>
                        </button>
                    </div>
                </div>
            </li>

            <li class="col-xl-3 col-sm-6 card shadow">
                <div class="card-body">
                    <div class="card-img-top">
                        <img 
                        src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                        class="img-fluid" 
                        alt="..."
                        />
                    </div>

                    <h5 class="card-title">
                        Chapeaux 
                    </h5>

                    <span>
                        <i class="fa fa-eye"></i>
                        <label>16</label>
                    </span>

                    <p>
                        15.000F
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button 
                        class="btn btn-sm btn-secondary btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fas fa-expand-alt"></i>
                            </span>

                            <span class="text">
                                Agrandir
                            </span>
                        </button>

                        <button 
                        class="btn btn-sm btn-danger btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>

                            <span class="text">
                                Supprimer
                            </span>
                        </button>
                    </div>
                </div>
            </li>

            <li class="col-xl-3 col-sm-6 card shadow">
                <div class="card-body">
                    <div class="card-img-top">
                        <img 
                        src="<?= base_url('assets/Admin/img/chapeau-illustration.jpg') ?>" 
                        class="img-fluid" 
                        alt="..."
                        />
                    </div>

                    <h5 class="card-title">
                        Chapeaux 
                    </h5>

                    <span>
                        <i class="fa fa-eye"></i>
                        <label>16</label>
                    </span>

                    <p>
                        15.000F
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <button 
                        class="btn btn-sm btn-secondary btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fas fa-expand-alt"></i>
                            </span>

                            <span class="text">
                                Agrandir
                            </span>
                        </button>

                        <button 
                        class="btn btn-sm btn-danger btn-icon-split m-1"
                        >
                            <span class="icon">
                                <i class="fa fa-trash"></i>
                            </span>

                            <span class="text">
                                Supprimer
                            </span>
                        </button>
                    </div>
                </div>
            </li>
        </ul>
    </div>
<?php $this->endSection('content') ?>