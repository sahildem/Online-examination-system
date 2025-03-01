<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["email"] = $user["email"];
            $_SESSION["name1"] = $name;
            
            header("location:project_test.php?q=1");
            exit;
        }
        else {
        	echo "<script>alert('Invalid Email or Password')</script>";
        }
    }
    else {
      echo "<script>alert('User not found')</script>";
    }
    
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
  <head>
   <title>Login & Signup</title>
    <link rel="stylesheet" href="style.css" />
    <script src="/js/validation.js" defer></script>
  </head>
  <body>
    <div class="background"></div>  
    <section class="wrapper">
      <div class="form signup">
        <header>Signup</header>

        <form action="process-signup.php" method="post">
          <input type="text" placeholder="Name" name="name1" required />
          <input type="Email" placeholder="Email address" name="email1" required />
          <input type="password" placeholder="Password" name="password1" required />
          
          <input type="submit" value="Signup"/>
        </form>
      </div>
      <div class="form login">
        <header>Login</header>
        <form method="post">
          <input type="Email" placeholder="Email address" name="email" required />
          <input type="password" placeholder="Password" name="password" required />
          <a href="forgot-password.php">Forgot password?</a>
          <input type="submit" value="Login"/>
          <p><a href="admin_login.php">Admin Login</a>    |   <a href="teacher_login.php">Teachers Login</a></p>

        </form>
      </div>
      <script>
        const wrapper = document.querySelector(".wrapper"),
          signupHeader = document.querySelector(".signup header"),
          loginHeader = document.querySelector(".login header");
        loginHeader.addEventListener("click", () => {
          wrapper.classList.add("active");
        });
        signupHeader.addEventListener("click", () => {
          wrapper.classList.remove("active");
        });
      </script>
    </section>
  </body>
</html>