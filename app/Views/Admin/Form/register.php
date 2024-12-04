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

                <form class="user">
                    <div class="form-group">
                        <input 
                            type="text" 
                            class="form-control form-control-user" 
                            id="name"
                            required
                            placeholder="Votre nom"
                        />
                    </div>

                    <div class="form-group">
                        <input 
                            type="email" 
                            class="form-control form-control-user" 
                            id="email" 
                            required
                            placeholder="Email Address"
                        />
                    </div>

                    <div class="form-group">
                        <input 
                            type="password" 
                            class="form-control form-control-user" 
                            id="password" 
                            placeholder="Mot de passe"
                            required
                        />
                    </div>

                    <div class="form-group">
                        <input 
                            type="password" 
                            class="form-control form-control-user" 
                            id="password-verification" 
                            placeholder="Entrez encore le mot de passe"
                            required
                        />
                    </div>

                        <!-- Show password  -->
                        <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input 
                                type="checkbox" 
                                class="custom-control-input" 
                                id="show-password"
                                required
                            />

                            <label 
                                class="custom-control-label" 
                                for="show-password"
                            >
                                Afficher le mot de passe
                            </label>
                        </div>
                    </div>

                    <a href="login.html" class="btn btn-primary btn-user btn-block">
                        Register Account
                    </a>
                </form>
                <hr>

                <div class="text-center">
                    Vous avez déjà un compte ?
                    <a href="login.html">
                        Connectez-vous
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php $this->endSection('content') ?>

<?php $this->section('title') ?>
    <title>Charel Chapeaux | S'enrégistrer</title>
<?php $this->endSection('title') ?>