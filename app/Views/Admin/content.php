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
                <div class="col-md-6">
                    <form action="#" method="post" class="mb-3">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-between">
                                    <h5 class="text-uppercase">
                                        Description Principal
                                    </h5>

                                    <button 
                                        type="button"
                                        class="btn btn-sm btn-secondary btn-icon-split"
                                        data-target="#historyModal"
                                        data-toggle="modal"
                                    >
                                        <span class="icon">
                                            <i class="fas fa-history"></i>
                                        </span>

                                        <span class="text">
                                            Historique
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <textarea 
                                    name="" 
                                    id="main-desc"
                                    class="form-control" 
                                    readonly 
                                    required
                                >Hello World</textarea>
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

                                <button 
                                    type="button"
                                    class="btn btn-sm btn-primary btn-icon-split"
                                    data-toggle="modal"
                                    data-target="#extend-desc"
                                >
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>

                                    <span class="text">
                                        Modifier
                                    </span>
                                </button>

                                <button 
                                    type="button"
                                    class="btn btn-sm btn-danger btn-icon-split"
                                    data-target="#deleteTestimonialsModal"
                                    data-toggle="modal"
                                >
                                    <span class="icon">
                                        <i class="fas fa-trash"></i>
                                    </span>

                                    <span class="text">
                                        Supprimer
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-md-6">
                    <form action="#" method="post" class="mb-3">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="text-uppercase">
                                        Description du site 
                                    </h5>
        
                                    <button 
                                        type="button"
                                        class="btn btn-sm btn-secondary btn-icon-split"
                                        data-target="#historyModal"
                                        data-toggle="modal"
                                    >
                                        <span class="icon">
                                            <i class="fas fa-history"></i>
                                        </span>

                                        <span class="text">
                                            Historique
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <textarea 
                                    name="" 
                                    id="main-desc"
                                    class="form-control" 
                                    readonly 
                                    required
                                >Hello World</textarea>
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

                                <button 
                                    type="button"
                                    class="btn btn-sm btn-primary btn-icon-split"
                                    data-toggle="modal"
                                    data-target="#extend-testimonials"
                                >
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>

                                    <span class="text">
                                        Modifier
                                    </span>
                                </button>

                                <button 
                                    type="button"
                                    class="btn btn-sm btn-danger btn-icon-split"
                                    data-target="#deleteTestimonialsModal"
                                    data-toggle="modal"
                                >
                                    <span class="icon">
                                        <i class="fas fa-trash"></i>
                                    </span>

                                    <span class="text">
                                        Supprimer
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="my-5" id="testimonials">
            <h2 class="h3 mb-2 text-gray-800 text-uppercase">
                Temoignages Clients 
            </h2>

            <p class="mb-3">
                Vous comptez presentement 07 temoignages enregistres.
            </p>


            <!-- Slider main container -->
            <div class="swiper w-100">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                <!-- Slides -->
                    <div class="swiper-slide">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="text-capitalize">
                                        De Steve
                                    </h5>

                                    <button 
                                        type="button"
                                        class="btn btn-sm btn-secondary btn-icon-split"
                                        data-target="#historyModal"
                                        data-toggle="modal"
                                    >
                                        <span class="icon">
                                            <i class="fa fa-history"></i>
                                        </span>

                                        <span class="text">
                                            Historique
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <textarea 
                                    name="" 
                                    id="" 
                                    class="form-control"
                                    rows="4"
                                    readonly
                                    required
                                >Lorem ipsum dolor sit amet consectetur adipisicing elit. Quos voluptatum fuga quae animi cum quis illum atque, saepe iure earum nulla amet quam nostrum sunt quisquam totam quod fugit architecto vitae. Numquam saepe, quidem quia totam voluptatum quam amet. Sed ipsum fugit iure accusamus aliquid molestias id ipsam repellat cumque.</textarea>
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

                                <button 
                                    type="button"
                                    class="btn btn-sm btn-primary btn-icon-split"
                                    data-toggle="modal"
                                    data-target="#extend-testimonials"
                                >
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>

                                    <span class="text">
                                        Modifier
                                    </span>
                                </button>

                                <button 
                                    type="button"
                                    class="btn btn-sm btn-danger btn-icon-split"
                                    data-target="#deleteTestimonialsModal"
                                    data-toggle="modal"
                                >
                                    <span class="icon">
                                        <i class="fas fa-trash"></i>
                                    </span>

                                    <span class="text">
                                        Supprimer
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="text-capitalize">
                                        De Chrystelle
                                    </h5>

                                    <button 
                                        type="button"
                                        class="btn btn-sm btn-secondary btn-icon-split"
                                        data-target="#historyModal"
                                        data-toggle="modal"
                                    >
                                        <span class="icon">
                                            <i class="fas fa-history"></i>
                                        </span>
                                        
                                        <span class="text">
                                            Historique
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <textarea 
                                    name="" 
                                    id="" 
                                    class="form-control"
                                    rows="4"
                                    readonly
                                    required
                                >Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis hic repellendus, dicta magni et rem deleniti, ullam at voluptatibus incidunt quasi nam maiores accusantium? Tempore, debitis. Ullam quaerat sequi blanditiis quas cum, consequuntur incidunt quidem perferendis voluptates quia facilis enim rem autem dolorem assumenda odio iste? Obcaecati libero odio, alias consequuntur, voluptate fugit nostrum enim unde reiciendis inventore, facere quae!</textarea>
                            </div>

                            <div class="card-footer">
                                <button 
                                    type="button"
                                    class="btn btn-sm btn-secondary btn-icon-split"
                                    data-target="#extend-testimonials"
                                    data-toggle="modal"
                                >
                                    <span class="icon">
                                        <i class="fas fa-expand-alt"></i>
                                    </span>

                                    <span class="text">
                                        Agrandir
                                    </span>
                                </button>

                                <button 
                                    class="btn btn-sm btn-primary btn-icon-split"
                                    data-toggle="modal"
                                    data-target="#extend-testimonials"
                                >
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>

                                    <span class="text">
                                        Modifier
                                    </span>
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-sm btn-danger btn-icon-split"
                                    data-target="#deleteTestimonialsModal"
                                    data-toggle="modal"
                                >
                                    <span class="icon">
                                        <i class="fas fa-trash"></i>
                                    </span>

                                    <span class="text">
                                        Supprimer
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="text-capitalize">
                                        De Loic
                                    </h5>

                                    <button 
                                        type="button"
                                        class="btn btn-sm btn-secondary btn-icon-split"
                                        data-target="#historyModal"
                                        data-toggle="modal"
                                    >
                                        <span class="icon">
                                            <i class="fas fa-history"></i>
                                        </span>

                                        <span class="text">
                                            Historique
                                        </span>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <textarea 
                                    name="" 
                                    id="" 
                                    class="form-control"
                                    rows="4"
                                    readonly
                                    required
                                >Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat ipsa, officiis ab adipisci dolor quo error nihil reiciendis neque accusamus iusto deleniti dignissimos, at unde odit autem repellat. Blanditiis sed eaque ex, excepturi laudantium ad voluptatem vitae rem at voluptas quo ducimus dolorem soluta commodi quidem nulla perferendis eum omnis? Illum ab ipsum delectus, voluptatibus, temporibus enim iure, corporis nobis sunt dolor porro quod ipsam ad. Velit architecto cumque nihil, quasi itaque id minus quo at fugiat maxime. Possimus delectus nostrum, magni officia eligendi libero qui laboriosam quod excepturi quas quis cupiditate veniam quaerat perspiciatis quae mollitia veritatis illum eos!</textarea>
                            </div>

                            <div class="card-footer">
                                <button 
                                    type="button"
                                    class="btn btn-sm btn-secondary btn-icon-split"
                                    data-target="#extend-testimonials"
                                    data-toggle="modal"
                                >
                                    <span class="icon">
                                        <i class="fas fa-expand-alt"></i>
                                    </span>

                                    <span class="text">
                                        Agrandir
                                    </span>
                                </button>

                                <button 
                                    class="btn btn-sm btn-primary btn-icon-split"
                                    data-toggle="modal"
                                    data-target="#extend-testimonials"
                                >
                                    <span class="icon">
                                        <i class="fas fa-edit"></i>
                                    </span>

                                    <span class="text">
                                        Modifier
                                    </span>
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-sm btn-danger btn-icon-split"
                                    data-target="#deleteTestimonialsModal"
                                    data-toggle="modal"
                                >
                                    <span class="icon">
                                        <i class="fas fa-trash"></i>
                                    </span>

                                    <span class="text">
                                        Supprimer
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
<?php $this->endSection('content') ?>