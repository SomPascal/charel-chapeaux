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

    <!-- Swiper bundle  -->
    <link rel="stylesheet" href="/assets/vendor/swiper/swiper-bundle.min.css" />

    <!-- Custom styles for this template-->
    <link href="/assets/Admin/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/Admin/css/style.css">
    <?= csrf_meta() ?>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?= $this->include('Admin/Parts/sidebar') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?= $this->include('Admin/Parts/navbar') ?>

                <?php if(session()->has('success')): ?>
                    <p class="alert alert-success m-3">
                        <i class="fa fa-check"></i>
                        <?= esc(session()->get('success')) ?>
                    </p>
                <?php endif ?>

                <?php if(session()->has('error')): ?>
                    <p class="alert alert-danger m-3">
                        <i class="fa fa-times"></i>
                        <?= esc(session()->get('error')) ?>
                    </p>
                <?php endif ?>

                <?= $this->renderSection('content') ?>
            </div>
            <!-- End of Main Content -->

            <?= $this->include('Admin/Parts/footer') ?>
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <?= $this->include('Admin/Parts/scroll-to-top') ?>
    <?= $this->include('Admin/Parts/logout-modal') ?>
    <?= $this->include('Admin/Parts/ban-admin-modal') ?>
    <?= $this->include('Admin/Parts/invitation-link-modal') ?>
    <?= $this->include('Admin/Parts/see-website') ?>
    <?= $this->include('Admin/Parts/notification') ?>

    <?= $this->include('Admin/Parts/scripts') ?>

    <script <?= csp_script_nonce() ?> >
        document.querySelector('#sidebarToggleTop')?.click()
    </script>

    <?php $this->renderSection('script') ?>

</body>

</html>