<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require __DIR__ . "/database.php";

$sql = "SELECT * FROM user
        WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("Link expired");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Link expired");
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
    <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
        <input type="password" id="password" placeholder="Enter new password" name="password">

        <input type="password" id="password_confirmation"
        placeholder="Conform password"
               name="password_confirmation">

               <input type="submit" value="Set Password"/>
    </form>

</body>
</html>