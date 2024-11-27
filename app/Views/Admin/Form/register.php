<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image">
                        <img
                         src="/assets/img/presentation-cap-1.jpg" 
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

                                <p>
                                    Invité par <b>"Jean Cyrille"</b>
                                </p>
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
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

</body>

</html>