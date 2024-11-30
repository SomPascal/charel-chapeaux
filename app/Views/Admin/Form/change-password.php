<?php $this->extend('Admin/Form/base') ?>

<?php $this->section('content') ?>
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-password-image">
            <img 
                src="/assets/Admin/img/presentation-cap-1.jpg" 
                alt="" class="img-fluid"
            />
        </div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center mb-3">
                    <h1 class="h4 text-gray-900">
                        Changer le mot de passe
                    </h1>
                </div>

                <form 
                 class="user" 
                 id="change-password" 
                 action="<?= route_to('admin.att-change-pswd') ?>"
                 method="post"
                >
                    <p class="alert alert-danger d-none"></p>

                    <div class="form-group">
                        <input 
                            type="password" 
                            class="form-control form-control-user"
                            id="current-password" 
                            placeholder="Mot de passe actuel..."
                            show-password
                            required
                        />

                        <p class="invalid-feedback"></p>
                    </div>
                    
                    <div class="form-group">
                        <input 
                            type="password" 
                            class="form-control form-control-user"
                            id="new-password" 
                            placeholder="Nouveau mot de passe ..."
                            show-password
                            required
                        />

                        <p class="invalid-feedback"></p>
                    </div>

                    <div class="form-group">
                        <input 
                            type="password" 
                            class="form-control form-control-user"
                            id="new-password-confirm" 
                            placeholder="Nouveau mot de passe encore..."
                            show-password
                            required
                        />

                        <p class="invalid-feedback"></p>
                    </div>

                    <!-- Show password  -->
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input 
                                type="checkbox" 
                                class="custom-control-input" 
                                id="show-password"
                                show-password-trigger
                            />

                            <label 
                                class="custom-control-label" 
                                for="show-password"

                            >
                                Afficher le mot de passe
                            </label>
                        </div>
                    </div>

                    <button 
                     class="btn btn-primary btn-user btn-block"
                     type="submit"
                    >
                        Changer le mot de passe 
                    </button>

                    <hr>

                    <a 
                     href="javascript:void(0)"
                     onclick="history.back()"
                     class="btn btn-secondary btn-user btn-block"
                    >
                        Annuler
                    </a>
                </form>
            </div>
        </div>
    </div>
<?php $this->endSection('content') ?>

<?php $this->section('script') ?>
    <script type="module" src="/assets/Admin/js/change-password.js"></script>
<?php $this->endSection('script') ?>