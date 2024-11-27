<?php $this->extend('Admin/base') ?>

<?php $this->section('title') ?>
    <title>
        Charel Chapeaux | 404
    </title>
<?php $this->endSection('title') ?>

<?php $this->section('content') ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- 404 Error Text -->
        <div class="text-center">
            <div class="error mx-auto" data-text="404">
                404
            </div>

            <p class="lead text-gray-800 mb-5">
                Cette page n'existe pas.
            </p>

            <p class="text-gray-500 mb-0">
                Vous vous etes perdu. cliquez sur le lien ci-dessous 
                pour retourner à l'acceuil
            </p>

            <a href="<?= route_to('admin.home') ?>">
                <i class="fa fa-arrow-circle-left"></i>
                Back to Dashboard
            </a>
        </div>
    </div>
    <!-- /.container-fluid -->
<?php $this->endSection('content') ?>

<?php $this->section('script') ?>
    <!-- Script Section  -->
<?php $this->endSection('script') ?>