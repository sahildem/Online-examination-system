<?php
$conn = mysqli_connect("localhost","root","","test") or die("Connection Failed");
$sql = "SELECT * FROM students WHERE email = '$email'";
$qry = mysqli_query($conn,$sql);
$res = mysqli_fetch_assoc($qry);
$d_pass = $res['password'];
if (isset($_GET['email'])) {
	$email = $_GET['email'];
	$to = $email;
	$from = "sahilkargutkar68@gmail.com";
	$fromName = "Online Examination System";
	$subject = "Password";
	$message = "Your Password is ".$d_pass;
	$header = 'from '.$fromName.'<'.$from.'>';
	$mail = mail($to,$subject,$message,$header);
}

?>
<!DOCTYPE html>
<html>
  <head>
   <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <div class="background"></div>  
    <section class="wrapper">
      <div class="form signup">
        <header>Forgot Password?</header>
        <h2 style="text-align: center;color: grey">Dont Worry!</h2>
        <form action="fpassword.php" method="GET">
          <input type="email" placeholder="Enter Registered Email Address" name="email" required >
          <input type="submit" value="Get Password"/>
        </form>
      </div>
    </section>
  </body>
</html>