<!DOCTYPE html>
<html lang="<?= request()->getLocale() ?>">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?= $this->renderSection('title') ?>

    <!-- Custom fonts for this template-->
    <link 
     href="/assets/Admin/vendor/fontawesome-free/css/all.min.css" 
     rel="stylesheet" 
     type="text/css"
    />

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- FONT AWESOME  -->
    <link rel="stylesheet" href="/assets/Admin/vendor/fontawesome-free/css/all.min.css">

    <!-- Custom styles for this template-->
    <link href="/assets/Admin/css/sb-admin-2.min.css" rel="stylesheet">
    <?= csrf_meta() ?>

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <?= $this->renderSection('content') ?>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/assets/Admin/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/Admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/assets/Admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/Admin/js/sb-admin-2.min.js"></script>
    <script src="/assets/vendor/validate.js/validate.min.js"></script>
    
    <?= $this->renderSection('script') ?>
</body>
</html>