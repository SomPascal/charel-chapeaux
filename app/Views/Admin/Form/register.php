<?php $this->extend('Admin/Form/base') ?>

<?php $this->section('content') ?>
    <!-- Nested Row within Card Body -->
    <div class="row">
        <div class="col-lg-5 d-none d-lg-block bg-register-image">
            <img
             src="/assets/Admin/img/presentation-cap-1.jpg" 
             alt="Illustration Chapeau"
             class="img-fluid"
            />
        </div>

        <div class="col-lg-7">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">
                        Créez votre compte administrateur
                    </h1>

                    <?php if(session()->has('success')): ?>
                        <p class="alert alert-success">
                            <?= esc(session()->get('success')) ?>
                        </p>
                    <?php endif ?>
                </div>

                <form 
                 action="<?= route_to('admin.att-register') ?>" 
                 method="post"
                 class="user" 
                 id="register"
                >
                    <p class="mb-3 alert alert-danger d-none"></p>

                    <div class="form-group">
                        <input 
                            type="text" 
                            class="form-control form-control-user" 
                            id="username"
                            required
                            placeholder="Nom d'utilisateur"
                        />

                        <p class="invalid-feedback"></p>
                    </div>

                    <div class="form-group">
                        <input 
                         type="email" 
                         class="form-control form-control-user" 
                         id="email" 
                         required
                         placeholder="Email"
                        />

                        <p class="invalid-feedback"></p>
                    </div>

                    <div class="form-group">
                        <input 
                         type="password" 
                         class="form-control form-control-user" 
                         id="password" 
                         placeholder="Mot de passe"
                         show-password
                         required
                        />

                        <p class="invalid-feedback"></p>
                    </div>

                    <div class="form-group">
                        <input 
                         type="password" 
                         class="form-control form-control-user" 
                         id="password-confirm" 
                         show-password
                         placeholder="Encore le mot de passe"
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

                    <!-- Remember Me  -->
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input 
                             type="checkbox" 
                             class="custom-control-input" 
                             id="remember"
                            />

                            <label 
                             class="custom-control-label" 
                             for="remember"
                            >Se souvenir de moi</label>
                        </div>
                    </div>

                    <button 
                     type="submit"
                     class="btn btn-primary btn-user btn-block"
                     id="submit"
                    >
                        S'enregister
                    </button>
                </form>
                <hr>

                <div class="text-center">
                    Vous avez déjà un compte ?
                    <a href="<?= route_to('admin.login') ?>">
                        connectez-vous
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $this->endSection('content') ?>

<?php $this->section('title') ?>
    <title>Charel Chapeaux | S'enrégistrer</title>
<?php $this->endSection('title') ?>

<?php $this->section('script') ?>
    <script type="module" src="/assets/admin/js/register.js"></script>
<?php $this->endSection('script') ?>