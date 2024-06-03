<?php
require_once("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if there are any admin users in the database
    $checkAdminSql = "SELECT COUNT(*) as admin_count FROM users WHERE role = ?";
    $stmt = $conn->prepare($checkAdminSql);
    $stmt->bind_param("s", $role);
    $role = 'admin';
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['admin_count'] == 0) {
        // No admin exists, make this user an admin
        $role = 'admin';
    } else {
        // Redirect to an error page or show a message indicating that admin already exists
        header("Location: login.php?success=true");
        exit();
    }

    $sql = "INSERT INTO users (username, name, email, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $name, $email, $hashedPassword, $role);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: login.php?success=true");
        exit();
    } else {
        // Registrasi gagal
        echo "Error: " . $stmt->error;
    }
}
$conn->close();
?>
