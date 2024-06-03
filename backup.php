<?php
// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'pendaftaran_event';

// Path penuh ke mysqldump (sesuaikan dengan path di server XAMPP Anda)
$mysqldump_path = 'C:/xampp/mysql/bin/mysqldump.exe';

// Get the backup file name from the form
$backup_file_name = isset($_POST['backup_file_name']) ? $_POST['backup_file_name'] : 'backup_' . date("Y-m-d-H-i-s");

// Directory where you want to save the backup files
$backup_dir = 'C:/xampp/htdocs/PendaftaranEvent/uploads/';  // Set to your desired directory path
$backup_file = "{$backup_dir}{$backup_file_name}.sql";

// Ensure the backup directory exists
if (!is_dir($backup_dir)) {
    mkdir($backup_dir, 0777, true);
}

$command = "{$mysqldump_path} --user={$username} --password={$password} --host={$host} --routines {$database} > {$backup_file}";

// Menangkap output dan error
exec($command . ' 2>&1', $output, $return_var);

if ($return_var === 0) {
    header('Location: index.php?status=backup_success');
} else {
    echo "Backup gagal! Pesan error: " . implode("\n", $output);
}
?>
