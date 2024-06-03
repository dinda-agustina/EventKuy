<?php
require_once("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, name, email, password) VALUES ('$username','$name','$email','$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
        header("Location: register.php?success=true");
        exit();
    }else{
        // registrasi gagal
        echo "Error: ".sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>