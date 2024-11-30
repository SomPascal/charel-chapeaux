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
                        Changer votre nom d'utilisateur
                    </h1>
                </div>

                <form 
                 class="user" 
                 id="change-username" 
                 action="<?= route_to('admin.att-change-username') ?>"
                 method="post"
                >
                    <p class="alert alert-danger d-none"></p>

                    <div class="form-group">
                        <input 
                            type="text" 
                            class="form-control form-control-user"
                            id="username" 
                            placeholder="Nouveau nom d'utilisateur"
                            minlength="3"
                            maxlength="24"
                            required
                        />

                        <p class="invalid-feedback"></p>
                    </div>
                    
                    <div class="form-group">
                        <input 
                            type="password" 
                            class="form-control form-control-user"
                            id="password" 
                            placeholder="Votre mot de passe ..."
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
                        Changer le nom d'utilisateur 
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
    <script type="module" src="/assets/Admin/js/change-username.js"></script>
<?php $this->endSection('script') ?>