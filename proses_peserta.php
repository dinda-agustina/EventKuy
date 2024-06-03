<?php
include 'config.php';

// Start or resume the session
session_start();

//Get user_id from session (you need to set this when logging in)
if(isset($_SESSION["user_id"])){
    $userId = $_SESSION["user_id"];
} else {
    echo "Error: user_id not set in the session.";
    exit();
}



// UPDATE
if (isset($_POST['update'])) {
    if (isset($_POST['id_peserta'])) {
        $pesertaId = $_POST['id_peserta'];
        $namaPeserta = $_POST["nama_lengkap"];
        $email = $_POST["email"];
        $jk = $_POST["jk"];
        $age = $_POST["usia"];
        $addres = $_POST["alamat"];
        $eventId = $_POST["id_event"];

        // Update post in the database
        $query = "UPDATE peserta SET nama_lengkap='$namaPeserta', email='$email', jk='$jk', usia='$age', alamat='$addres', id_event=$eventId WHERE id_peserta=$pesertaId";
        if ($conn->query($query) === TRUE) {
            // Redirect to the post list
            header('Location: peserta.php?status=updated');
            exit();
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Error: id_peserta not provided.";
    }
}

// DELETE
if (isset($_GET['id_peserta'])) {
    $pesertaId = $_GET['id_peserta'];

    // Get the event ID associated with this peserta
    $queryGetEvent = "SELECT id_event FROM peserta WHERE id_peserta = $pesertaId";
    $result = $conn->query($queryGetEvent);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $eventId = $row['id_event'];

        // Delete participant from database
        $queryDelete = "DELETE FROM peserta WHERE id_peserta = $pesertaId";
        if ($conn->query($queryDelete) === TRUE) {
            // Update jumlah_peserta in event table
            $updateQuery = "UPDATE event SET jumlah_peserta = jumlah_peserta - 1 WHERE id_event = $eventId";
            $conn->query($updateQuery);

            // Redirect to the appropriate page (e.g., peserta.php)
            header('Location: peserta.php?status=deleted');
            exit();
        } else {
            echo "Error: " . $queryDelete . "<br>" . $conn->error;
        }
    } else {
        echo "Error: Event ID not found for this peserta.";
    }
} else {
    echo "Error: Post ID not provided.";
}
?>
