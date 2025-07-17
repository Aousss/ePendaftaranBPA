<?php
// Connect to the 'epermohonan' database
$conn = new mysqli("localhost", "root", "", "epermohonan");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sign_up_date = date("Y-m-d");

    $sql = "INSERT INTO users (user_name, password, email, sign_up_date)
            VALUES ('$user_name', '$hashed_password', '$email', '$sign_up_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
