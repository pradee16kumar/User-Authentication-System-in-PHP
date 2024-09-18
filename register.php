<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'user_auth');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = ($_POST['username']);
    $password = ($_POST['password']);

    $checkUser = $conn->query("SELECT * FROM users WHERE username='$username'");
    if ($checkUser->num_rows > 0) {
        echo "Username already exists!";
    } else {
        $conn->query("INSERT INTO users (username, password) VALUES ('$username', '$password')");
        echo "Registration successful!";
    }
}
?>

<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Register</button>
</form>
