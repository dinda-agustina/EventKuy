<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['backup_file'])) {
    $file_tmp = $_FILES['backup_file']['tmp_name'];
    $file_name = $_FILES['backup_file']['name'];

    // Konfigurasi database
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'pendaftaran_event';

    // Path penuh ke mysql (sesuaikan dengan path di server XAMPP Anda)
    $mysql_path = 'C:/xampp/mysql/bin/mysql.exe';

    // Membuat koneksi ke MySQL
    $conn = new mysqli($host, $username, $password);

    // Memeriksa koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Memeriksa apakah database sudah ada
    $db_exists = $conn->query("SHOW DATABASES LIKE '$database'");

    if ($db_exists->num_rows == 0) {
        // Membuat database jika belum ada
        $create_db_query = "CREATE DATABASE $database";
        if ($conn->query($create_db_query) === TRUE) {
            echo "Database {$database} berhasil dibuat. ";
        } else {
            die("Gagal membuat database: " . $conn->error);
        }
    } else {
        echo "Database {$database} sudah ada. ";
    }

    $conn->close();

    // Perintah untuk restore database
    $command = "\"{$mysql_path}\" --user=\"{$username}\" --password=\"{$password}\" --host=\"{$host}\" \"{$database}\" < \"{$file_tmp}\"";

    // Menangkap output dan error
    exec($command . ' 2>&1', $output, $return_var);

    if ($return_var === 0) {
        header('Location: index.php?status=restore_success');
    } else {
        echo "Restore gagal! Pesan error: " . implode("\n", $output);
    }
} else {
    echo "Tidak ada file yang diupload!";
}
?>
