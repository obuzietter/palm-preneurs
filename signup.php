<?php
if (isset($_POST['submit'])) {

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'tuk_preneurs_db';

    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
        echo "Password confirmation does not match.";
        exit;
    }

    // Check if the email already exists in the database
    $checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($checkEmailQuery);

    if ($result->num_rows > 0) {
        echo "<script>alert('Email address already exists. Please choose a different one.')</script>";
        echo "<script>window.location.href='signup.html'</script>";
        $conn->close();
        exit;
    }

    // Insert the email and password into the database
    $sql = "INSERT INTO users (email, password) VALUES ('$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('You have successfully signed up!')</script>";
        echo "<script>window.location.href='index.html'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
