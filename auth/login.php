
<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Login &mdash; EventKuy</title>
    <meta name="description" content="" />
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico"/>
    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0.500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <!-- icons. uncomment required icon fonts -->
    <link rel = "stylesheet" href="../assets/vendor/fonts/boxicons.css"/>
    <!-- core css -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="../assets/css/styles.css" />
    <!-- vendor css -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <!-- page css -->
    <!-- page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!-- !template customizer & theme config files must be included after core stylesheets and helpers.js in the <head> section -->
    <!-- ?config: mandatory theme config file contain global vars & default theme options, set your preferred theme option in this file. -->
    <script src="../assets/js/config.js"></script>
</head>
<body>
    <!-- content -->
    <!-- bootstrap toast -->
    <div id="toast" class="bs-toast toast fade bg-primary position-absolute m-3 end-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Login Gagal</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            Username atau Password salah
        </div>
    </div>
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- register -->
                <div class="card">
                    <div class="card-body">
                        <!-- logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-text demo text-uppercase fw-bolder">EventKuy</span>
                            </a>
                        </div>
                        <!-- /logo -->
                        <h4 class="mb-2" align="center">Selamat datang di EventKuy! 👋</h4>
                        <form class="mb-3" action="login_auth.php" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter your username" autofocus required />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                            </div>
                        </form>
                        <p class="text-center">
                            <span>Belum punya akun?</span><a href="register.php"><span>Daftar</span></a>
                        </p>
                    </div>
                </div>
                <!-- /register -->
            </div>
        </div>
    </div>
    <!-- /content -->
    <!-- core js -->
    <!-- build: js ../assets/vendor/js.core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <!-- end build -->
    <!-- main js -->
    <script src="../assets/js/main.js"></script>
    <!--jika terdapat parameter status di url: login.php dan param bernilai false, maka akan memunculkan toast message  -->
    <?php
    if (isset($_GET["status"]) && $_GET["status"] == "false") {
        echo
        '<script>
        $(document).ready(function(){
            $(".toast").toast("show");
        });
        </script>';
    }
    ?>
</body>
</html>