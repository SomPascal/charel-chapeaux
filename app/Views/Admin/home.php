<?php

use App\Models\VisitorModel;

helper(['contact'])
?>

<?php $this->extend('Admin/base') ?>

<?php $this->section('title') ?>
    <title>
        Charel Chapeaux | Admin
    </title>
<?php $this->endSection('title') ?>

<?php $this->section('content') ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Admins Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">
                Administrateurs
            </h1>

            <?php if (auth()->user()->inGroup('superadmin')): ?>
                <button 
                 data-toggle="modal"
                 data-target="#invitation-link"
                 class="btn btn-sm btn-primary btn-icon-split"
                >
                    <span class="icon">
                        <i class="fa fa-user-plus"></i>
                    </span>
    
                    <span class="text">
                        Ajouter
                    </span>
                </button>
            <?php endif ?>
        </div>

        <p>
            Il y'a actuellement <?= esc(count($admins)) ?> 
            administrateur(s).
        </p>

        <?php if (count($admins) > 0): ?>
            <?php foreach(array_chunk($admins, 2) as $chunked_admins): ?>
                <div class="row mb-3">
                    <?php foreach($chunked_admins as $admin): ?>
                        <div class="col-md-6">
                            <div 
                                class="card border-left-secondary shadow mb-3" 
                                email="<?= esc($admin->email, 'attr') ?>"
                                username="<?= esc($admin->username, 'attr') ?>" 
                                admin-id="<?= esc($admin->id, 'attr') ?>"
                                invitedBy="<?= esc($admin->inviter_username, 'attr') ?>"
                                myself="<?= $admin->id == user_id() ?>"
                                group="<?= esc($admin->group, 'attr') ?>"
                                created-at="<?= esc($admin->created_at, 'attr') ?>"
                                admin-card
                            >
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <h5 class="h5 d-flex flex-wrap justify-content-between">
                                                <?= esc($admin->username) ?>
                                                <?= ($admin->id == user_id()) ? '(Moi)' : null ?>

                                                <?php if (isset($admin->inviter_username)): ?>
                                                    <p class="mb-0">
                                                        Invité par: 
                                                        <span class="text-primary">
                                                            <b><?= esc($admin->inviter_username) ?></b>
                                                        </span>
                                                    </p>
                                                <?php endif ?>
                                            </h5>
    
    
                                            <div class="d-flex flex-wrap">
                                                <button 
                                                    show-admin
                                                    class="btn 
                                                    btn-secondary 
                                                    btn-sm btn-icon-split m-1"
                                                    data-toggle="modal"
                                                    data-target="#admin-details"
                                                >
                                                    <span class="icon">
                                                        <i class="fa fa-expand-alt"></i>
                                                    </span>
    
                                                    <span class="text">
                                                        Agrandir
                                                    </span>
                                                </button>
                                                <?php if ($admin->id != user_id() && auth()->user()->inGroup('superadmin')): ?>
                                                    <button 
                                                        type="button"
                                                        data-toggle="modal"
                                                        data-target="#ban-admin-modal"
                                                        class="btn btn-sm btn-danger btn-icon-split m-1"
                                                        ban-admin
                                                    >
                                                        <span class="icon">
                                                            <i class="fa fa-trash"></i>
                                                        </span>
    
                                                        <span class="text">
                                                            Expulser
                                                        </span>
                                                    </button>
    
                                                    <!-- Role Modificator -->
                                                    <div class="btn-group btn-sm" admin-role>
                                                        <button type="button" class="btn btn-sm btn-secondary disabled">
                                                            <i class="fa fa-user-edit"></i>
                                                            Role
                                                        </button>
    
                                                        <button 
                                                            type="button" 
                                                            class="btn btn-secondary btn-sm dropdown-toggle dropdown-toggle-split" 
                                                            data-toggle="dropdown" 
                                                            aria-expanded="false"
                                                        >
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
    
                                                        <ul class="dropdown-menu">
                                                            <?php foreach(config('Config\AuthGroups')->groups as $role => $desc): ?>
                                                                <?php if(user_id() != $admin->id): ?>
                                                                    <li 
                                                                     data-toggle="modal"
                                                                     data-target="#change-admin-role"
                                                                     value="<?= esc($role) ?>"
                                                                     class="cursor-pointer dropdown-item <?= ($admin->group == $role) ? 'disabled' : null ?>"
                                                                     <?= ($admin->group == $role) ? 'disabled' : null ?> 
                                                                    >
                                                                        <?= esc($desc['title']) ?>
                                                                        <?= ($admin->group == $role) ? '(Actuel)' : null ?>
                                                                    </li>
                                                                <?php endif ?>
                                                            <?php endforeach ?>
                                                        </ul>
                                                    </div>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        
                                        <div class="col-auto">
                                            <?php if ($admin->group == 'superadmin'): ?>
                                                <i class="fas fa-crown fa-2x text-warning-100"></i>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <p class="alert alert-danger w-100 text-uppercase text-center">
                Pas d'administrateurs
            </p>
        <?php endif ?>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800 text-uppercase">
                Tableau de bord
            </h1>

            <button 
                data-target="#report-type"
                data-toggle="modal"
                class="d-none d-sm-inline-block btn btn-sm btn-icon-split btn-success shadow-sm"
            >
                <span class="icon">
                    <i class="fas fa-download fa-sm text-white-50"></i>
                </span> 

                <span class="text">
                    Télécharger le rapport (Excel)
                </span>
            </button>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Visites (jour)
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= esc(number_format(model(VisitorModel::class)->todayVisits())) ?>
                                </div>
                            </div>

                            <div class="col-auto">
                                <i class="fas fa-link fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Calls (Per Week) -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Appels (Par jour)
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= esc(get_visits($redirections, 'phone')) ?>
                                </div>
                            </div>

                            <div class="col-auto">
                                <i class="fa fa-phone fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- WhatsApp (Per Weeks)  -->
            <div class="col-xl-4 col-md-4 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    WhatsApp (Par jour)
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= esc(get_visits($redirections, 'whatsapp')) ?>
                                </div>
                            </div>

                            <div class="col-auto">
                                <i class="fab fa-whatsapp fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Instagram (Per Weeks) -->
            <div class="col-xl-3 col-md-3 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Instagram (Par jour)
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= esc(get_visits($redirections, 'instagram')) ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fab fa-instagram fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Google Maps (Per Weeks) -->
            <div class="col-xl-3 col-md-3 mb-4">
                <div class="card border-left-dark shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">
                                    Google Maps (Par jour)
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?= esc(get_visits($redirections, 'map')) ?>
                                </div>
                            </div>

                            <div class="col-auto">
                                <i class="fas fa-map-marked fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->include('Admin/Parts/site-links') ?>

        <?= $this->include('Admin/Parts/contacts') ?>
    </div>

    <?= $this->include('Admin/Parts/admin-details-modal') ?>
    <?= $this->include('Admin/Parts/invitation-link-modal') ?>
    <?= $this->include('Admin/Parts/change-contacts-modal') ?>
    <?= $this->include('Admin/Parts/change-admin-role-modal') ?>
<?php $this->endSection('content') ?>

<?php $this->section('script') ?>
    <script type="module" src="<?= base_url('assets/Admin/js/script.js') ?>"></script>
<?php $this->endSection('script') ?>