<?php $this->extend('Admin/Form/base') ?>

<?php $this->section('content') ?>
    <div class="row">
        <div class="col-lg-6 d-none d-lg-block bg-password-image">
            <img 
                src="/assets/img/chapeau-illustration.jpg" 
                alt="" class="img-fluid"
            />
        </div>
        <div class="col-lg-6">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">
                        Mot de passe oublié ?
                    </h1>

                    <p class="mb-4">
                        Entrez juste votre 
                        adrèsse email en bas et nous vous enverrons un pin code pour 
                        reinitialiser votre mot de passe!
                    </p>
                </div>

                <form class="user">
                    <div class="form-group">
                        <input 
                            type="email" 
                            class="form-control form-control-user"
                            id="exampleInputEmail" 
                            aria-describedby="emailHelp"
                            placeholder="Enter Email Address..."
                        />
                    </div>

                    <a href="login.html" class="btn btn-primary btn-user btn-block">
                        Recevoir le code
                    </a>
                </form>
                <hr>
                <div class="text-center">
                    Vous vous rappelez de votre mot de passe ?
                    <a href="login.html">Connectez-vous</a>
                </div>
            </div>
        </div>
    </div>
<?php $this->endSection('content') ?>