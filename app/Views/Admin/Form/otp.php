<?php $this->extend('Admin/Form/base') ?>

<?php $this->section('title') ?>
    <title>Charel Chapeaux | OTP</title>
<?php $this->endSection('title') ?>

<?php $this->section('script') ?>
    <script type="module" src="/assets/admin/js/check-otp.js"></script>
<?php $this->endSection('script') ?>

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
                        Activez votre compte !
                    </h1>

                    <p>
                        Nous avons envoyé un code à 
                        <?= esc($user->email) ?>
                    </p>
                </div>

                <form 
                 class="user" 
                 id="verify-email" 
                 method="post" 
                 action="<?= url_to('auth-action-verify') ?>"
                >
                    <p class="alert alert-danger d-none"></p>
                    
                    <div class="form-group">
                        <input 
                            type="text" 
                            class="form-control form-control-user"
                            id="code" 
                            aria-describedby="OneTimeCode"
                            placeholder="Entrez le code"
                            maxlength="6"
                            minlength="6"
                            required
                        />

                        <p class="invalid-feedback"></p>
                    </div>

                    <button 
                     type="submit" 
                     class="btn btn-primary btn-user btn-block"
                    >
                        Valider
                        <i class="fa fa-lock"></i>
                    </button>

                    <button 
                     type="button" 
                     class="btn btn-secondary btn-block rounded-pill" 
                     resend-code 
                     disabled
                    >
                        Resend Code
                    </button>
                    <p>
                        Vous pourrez renvoyer le code dans 
                        <span 
                         resend-after
                        >
                            <?= esc($resendAfter) ?>
                        </span>
                        secondes
                    </p>
                </form>
            </div>
        </div>
    </div>
<?php $this->endSection('content') ?>