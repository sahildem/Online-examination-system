<?php

$mysqli = require __DIR__ . "/database.php";

if (empty($_POST["name1"])) {
    echo '<script>alert("Name already take")</script>';
}

if ( ! filter_var($_POST["email1"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["password1"]) < 8) {
    echo '<script>alert("Password must be of 8 characters")
    window.location = "login.php";
    </script>';
}

if ( ! preg_match("/[a-z]/i", $_POST["password1"])) {
    echo '<script>alert("Password must contain atleast 1 letter")
    window.location = "login.php";
    </script>';
}

if ( ! preg_match("/[0-9]/", $_POST["password1"])) {
    echo '<script>alert("Password must contain atleast 1 number")
    window.location = "login.php";
    </script>';
}

$sql = sprintf("SELECT * FROM user");
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();

if($_POST["email1"] == $user['email']){
    echo '<script>alert("Email already take")
    window.location = "login.php";
    </script>';
    
}else{

$password_hash = password_hash($_POST["password1"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                  $_POST["name1"],
                  $_POST["email1"],
                  $password_hash);
                  
if ($stmt->execute()) {

    header("Location: signup-success.html");
    exit;
    
} else {
    
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}
}