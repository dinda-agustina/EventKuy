<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "pendaftaran_event";

$conn = new mysqli($host,$username,$password,$database);

setlocale(LC_TIME, 'id-ID'); 
$tanggal = date('d-m-Y'); // Contoh tanggal dalam format MySQL (YYYY-MM-DD)
$tanggal_format = strftime('%A, %d %B %Y', strtotime($tanggal)); // Memformat tanggal menggunakan strftime() dengan locale yang telah diatur
 // Menampilkan tanggal dengan format yang sesuai dengan locale


if ($conn->connect_error){
    die("database gagal terkoneksi: " . $conn->connect_error);
}



?>