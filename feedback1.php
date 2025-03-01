<?php
$mysqli = require __DIR__ . "/database.php";
//$name_ = $_POST['name'];
//$email_ = $_POST['email'];
//$subject_ = $_POST['subject'];
//$message_ = $_POST['message'];


$sql = "INSERT INTO feedback1 (name, email, subject, message, date)
        VALUES (?, ?, ?, ?, NOW())";
        
$stmt = $mysqli->stmt_init();
$stmt->prepare($sql);

$stmt->bind_param("ssss",
                  $_POST["name"],
                  $_POST["email"],
                  $_POST['subject'],
                  $_POST['message'],
                  );

if ($stmt->execute()) {
    echo "<script>if(confirm('Feedback recorded successfully')){document.location.href='project_test.php?q=5'};</script>";
    //header("Location: project_test.php?q=5");
    exit;                
}

?>