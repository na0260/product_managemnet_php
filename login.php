<?php
// login.php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
        } else {
            echo "Invalid credentials";
        }
    } else {
        echo "Invalid credentials";
    }

    $stmt->close();
    $conn->close();
}
