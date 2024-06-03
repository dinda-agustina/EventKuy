<?php
include("config.php");

if(isset($_POST['simpan'])){
    $namaKategori = $_POST['nama_kategori'];
    $query = "CALL insertKategori(?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "s", $namaKategori);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header('Location: kategori.php?status=added');
            exit(); // Pastikan untuk keluar setelah redirect
        } else {
            // Handle error if execution failed
            echo "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


if(isset($_GET['id_kategori'])){
    $kategoriId = $_GET['id_kategori'];
    $query = "CALL deleteKategori(?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "i", $kategoriId);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header('Location: kategori.php?status=added');
            exit(); // Pastikan untuk keluar setelah redirect
        } else {
            // Handle error if execution failed
            echo "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


if(isset($_POST['update'])){
    $kategoriId = $_POST['id_kategori'];
    $namaKategori = $_POST['nama_kategori'];
    $query = "CALL updateKategori(?, ?)";

    if ($stmt = mysqli_prepare($conn, $query)) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "is", $kategoriId, $namaKategori);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            header('Location: kategori.php?status=added');
            exit(); // Pastikan untuk keluar setelah redirect
        } else {
            // Handle error if execution failed
            echo "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}


?>