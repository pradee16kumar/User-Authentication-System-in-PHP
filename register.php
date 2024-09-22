<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_auth');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = ($_POST['username']);
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    
    if ($password !== $repassword) {
        echo "Passwords do not match!";
    } else {
        $Password = password_hash($password, PASSWORD_DEFAULT);

        $checkUser = $conn->query("SELECT * FROM users WHERE username='$username'");
        if ($checkUser->num_rows > 0) {
            echo "Username already exists!";
        } else {
            $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$Password')");
            echo "Registration successful!";
        }
    }
}
?>

<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Re-enter Password: <input type="password" name="repassword" required><br>
    <button type="submit">Register</button>
</form>
