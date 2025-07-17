<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "epermohonan");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form inputs
$user_name = $_POST['user_name'];
$password = $_POST['password'];

// Lookup user
$sql = "SELECT * FROM users WHERE user_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Check password
    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_name'] = $user['user_name'];
        header("Location: home.php");
        exit();
    } else {
        echo "❌ Invalid password.";
    }
} else {
    echo "❌ User not found.";
}

$stmt->close();
$conn->close();
?>
