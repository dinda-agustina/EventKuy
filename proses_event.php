<?php
include 'config.php';

// Start or resume the session
session_start();

// Get user_id from session
if (isset($_SESSION["user_id"])) {
    $userId = $_SESSION["user_id"];
} else {
    echo "Error: user_id not set in the session.";
    exit();
}

if (isset($_POST['simpan'])) {
    // Handle form submission
    $eventTitle = $_POST["nama_event"];
    $penyelenggara = $_POST["penyelenggara"];
    $beginDate = $_POST["tgl_mulai"];
    $endDate = $_POST["tgl_selesai"];
    $location = $_POST["lokasi"];
    $description = $_POST["keterangan"];
    $kuota = $_POST["kuota"];
    $kategoriId = $_POST["id_kategori"];

    // Prepare the statement to call the stored procedure
    $query = "CALL insertEvent(?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ssssssiii", $eventTitle, $penyelenggara, $beginDate, $endDate, $location, $description, $kuota, $kategoriId, $userId);

    // Execute the statement
    $exec = mysqli_stmt_execute($stmt);

    // Check if the execution was successful
    if ($exec) {
        // Redirect to the post list
        header('Location: dashboard.php?status=added');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// UPDATE
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_event'])) {
    $eventId = $_POST['id_event'];
    $eventTitle = $_POST["nama_event"];
    $penyelenggara = $_POST["penyelenggara"];
    $beginDate = $_POST["tgl_mulai"];
    $endDate = $_POST["tgl_selesai"];
    $location = $_POST["lokasi"];
    $description = $_POST["keterangan"];
    $kuota = $_POST["kuota"];
    $kategoriId = $_POST["id_kategori"];

    // Prepare the statement to call the stored procedure
    $query = "CALL updateEvent(?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "issssssii", $eventId, $eventTitle, $penyelenggara, $beginDate, $endDate, $location, $description, $kuota, $kategoriId);

    // Execute the statement
    $exec = mysqli_stmt_execute($stmt);

    // Check if the execution was successful
    if ($exec) {
        // Redirect to the post list
        header('Location: dashboard.php?status=updated');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

// DELETE
if (isset($_GET['id_event'])) {
    $eventId = $_GET['id_event'];

    // Prepare the statement to call the stored procedure
    $query = "CALL deleteEvent(?)";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind the parameter
    mysqli_stmt_bind_param($stmt, "i", $eventId);

    // Execute the statement
    $exec = mysqli_stmt_execute($stmt);

    // Check if the execution was successful
    if ($exec) {
        // Redirect to the appropriate page (e.g., dashboard.php)
        header('Location: dashboard.php?status=deleted');
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Post ID not provided.";
}
?>
