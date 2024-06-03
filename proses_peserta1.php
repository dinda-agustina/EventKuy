<?php
include 'config.php';

// Start or resume the session
session_start();

// Get user_id and user_role from session
if(isset($_SESSION["user_id"]) ) {
    $userId = $_SESSION["user_id"];
   
} else {
    echo "Error: user_id or role not set in the session.";
    exit();
}

// SIMPAN
if (isset($_POST['simpan'])) {
    $namaPeserta = $_POST["nama_lengkap"];
    $email = $_POST["email"];
    $jk = $_POST["jk"];
    $age = $_POST["usia"];
    $addres = $_POST["alamat"];
    $eventId = $_POST["id_event"];

    // Check if event is full
    $query = "SELECT kuota, jumlah_peserta FROM event WHERE id_event = $eventId";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['jumlah_peserta'] >= $row['kuota']) {
            header('Location: sorry.php');
            exit();
        }
    } else {
        echo "Error: Event tidak ditemukan.";
        exit(); 
    }

    // Check for duplicate entry before inserting for regular users
    $query = "SELECT * FROM peserta WHERE id_event = $eventId AND user_id = $userId";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        header('Location: denied.php');
        exit();
    }

    // Insert new participant into the database
    $query = "INSERT INTO peserta (nama_lengkap, email, jk, usia, alamat, id_event, user_id) VALUES ('$namaPeserta','$email', '$jk', '$age', '$addres', $eventId, $userId)";
    if ($conn->query($query) === TRUE) {
        // Update jumlah_peserta in event table
        $updateQuery = "UPDATE event SET jumlah_peserta = jumlah_peserta + 1 WHERE id_event = $eventId";
        $conn->query($updateQuery);

        // Redirect to the post list
        header('Location: peserta1.php?status=added');
        exit();
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>
