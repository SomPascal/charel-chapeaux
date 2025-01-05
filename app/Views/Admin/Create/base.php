<!DOCTYPE html>
<html lang="<?= service('request')->getLocale() ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?= $this->renderSection('title') ?>

    <!-- Custom fonts for this template-->
    <link href="/assets/Admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
     href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
     rel="stylesheet"
    >

    <!-- Custom styles for this template-->
    <link href="/assets/Admin/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/Admin/css/style.css">
    <?= csrf_meta() ?>

</head>

<body style="background-color: #f2f2f2;">    
    <section id="create-form" class="container">
        <?= $this->renderSection('form') ?>

            <nav class="w-100 rounded shadow sticky-top bg-light p-3 mt-3 mb-3 d-flex justify-content-between">
                <a class="btn btn-dark" href="javascript:void(0)" onclick="history.back()">
                    <i class="fa fa-arrow-circle-left"></i>
                    Retour
                </a>

                <?= $this->renderSection('title') ?>

                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i>
                    Poster
                </button>
            </nav>

            <p class="alert alert-danger d-none"></p>
        
            <div>
                <?= $this->renderSection('content') ?>
            </div>
        </form>
    </section>

    <?= $this->include('Admin/Parts/add-category-modal') ?>
    <?= $this->include('Admin/Parts/notification') ?>
    <?= $this->include('Admin/Parts/scripts') ?>
    <script type="module" src="<?= base_url('assets/Admin/js/handle-description.js') ?>"></script>

    <?= $this->renderSection('script') ?>

</body>