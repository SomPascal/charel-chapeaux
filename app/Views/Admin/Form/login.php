<?php $this->extend('Admin/Form/base') ?>

<?php $this->section('title') ?>
    <title>Charel Chapeaux | LogIn</title>
<?php $this->endSection('title') ?>

<?php $this->section('content') ?>
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-login-image">
            <img 
                class="img-fluid"
                src="/assets/Admin/img/presentation-cap-1.jpg" 
                alt="Charel Chapeaux"
            />
        </div>

        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">
                        Bon retour !
                    </h1>
                </div>

                <form 
                 class="user" 
                 id="login" 
                 method="post" 
                 action="<?= url_to('admin.att-login') ?>"
                >
                    <div class="form-group">
                        <input 
                            type="email" 
                            class="form-control form-control-user"
                            id="email" 
                            aria-describedby="emailHelp"
                            placeholder="Votre Email"
                            required
                        />

                        <p class="invalid-feedback"></p>
                    </div>

                    <div class="form-group">
                        <input 
                            type="password" 
                            class="form-control form-control-user"
                            id="password" 
                            placeholder="Password"
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

                    <!-- Remember Me  -->
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input 
                                type="checkbox" 
                                class="custom-control-input" 
                                id="remember"
                                checked
                                required
                            />

                            <label 
                                class="custom-control-label" 
                                for="remember"
                                >Remember Me</label>
                        </div>
                    </div>

                    <button 
                        type="submit" 
                        href="index.html"
                        class="btn btn-primary btn-user btn-block"
                    >
                        Login
                        <i class="fa fa-sign-in-alt"></i>
                    </button>
                </form>

                <hr>
                <div class="text-center">
                    <a 
                        href="forgot-password.html"
                    >Forgot Password?</a>
                </div>
            </div>
        </div>
    </div>
<?php $this->endSection('content') ?>

<?php $this->section('script') ?>
    <script type="module" src="/assets/admin/js/login.js"></script>
<?php $this->endSection('script') ?>