<?php
include_once 'database.php';
$sql = sprintf("SELECT * FROM admin");
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
?>

<html>
    <head>
    <link rel='stylesheet' href='css/admin_login.css'>
    </head>

    <body class="img">
    <form name="form" method="post">
        <h1 style="text-align:center">Admin Login</h1>
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder = "Password">
        <input type="submit" name="submit">
        
    </form>
    <?php 
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
            if($_POST['email'] == $user['email'] && $_POST['password'] == $user['password'])
            {
                session_start();
                $_SESSION['email'] = $_POST['email'];
                $_SESSION["name"] = 'Admin';
                $_SESSION["key"] ='admin';
                header("location:dash.php");
            }
    }
        ?>
    </body>
</html>
