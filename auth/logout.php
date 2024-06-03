<?php
// Mulai atau lanjutkan sesi
session_start();

// Hapus semua data sesi
session_unset();

// Hancurkan sesi
session_destroy();

// Redirect pengguna ke halaman login atau halaman lain setelah logout
header("Location: login.php");
exit;
?>