<?php
session_start();

require_once("../config.php");

// Check if there are any admin users in the database
$checkAdminSql = "SELECT COUNT(*) as admin_count FROM users WHERE role = ?";
$stmt = $conn->prepare($checkAdminSql);
$stmt->bind_param("s", $role);
$role = 'admin';
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row['admin_count'] == 0) {
    // If no admin exists, redirect to register_admin.php
    header("Location: register_admin.php");
    exit();
}

// If there is already an admin, continue to the regular register page
?>

<!DOCTYPE html>
<html lang="en"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Register &mdash; EventKuy</title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico"/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0.500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <!-- icons. uncomment required icon fonts -->
    <link rel = "stylesheet" href="../assets/vendor/fonts/boxicons.css"/>
    <!-- core css -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="../assets/css/styles.css" />
    <!-- vendors css -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <!-- page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!-- !template customizer & theme config files must be included after core stylesheets and helpers.js in the <head> section -->
    <!-- ?config: mandatory theme config file contain global vars & default theme options, set your preferred theme option in this file. -->
    <script src="../assets/js/config.js"></script>
</head>
<body>
    <!-- bootstrap toast -->
    <div id="toast" class="bs-toast toast fade bg-primary position-absolute m-3 end-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Registrasi Berhasil</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-lable="Close"></button>
        </div>
        <div class="toast-body">Registrasi akun berhasil!</div>
    </div>
    <!-- content -->
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- register card -->
                <div class="card">
                    <div class="card-body">
                        <!-- logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo"></span>
                                <span class="app-brand-text demo text-uppercase fw-bolder">EventKuy</span>
                            </a>
                        </div>
                        <!-- /logo -->
                        <h4 class="mb-2" align="center" >Silahkan Daftar! 😊</h4>
                        <form action="register_process.php" class="mb-3" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Masukkan Username" autofocus />
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" placeholder="Masukkan Nama" />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Masukkan Email" />
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">Daftar</button>
                        </form>
                        <p class="text-center">
                            <span>Sudah memiliki akun?</span><a href="login.php"><span> Masuk</span></a>
                        </p>
                    </div>
                </div>
                <!-- register card -->
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
    <!-- page js -->
    <!--  -->
    <?php
    if (isset($_GET["success"]) && $_GET["success"] == "true") {
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