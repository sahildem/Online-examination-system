<link rel="stylesheet" href="css/test.css">

<?php
include_once 'database.php';
$eid = $_GET['eid'];
$email = $_GET['email'];
$query1 = mysqli_query($mysqli, "SELECT * FROM user WHERE email='$email'");
$row1 = mysqli_fetch_assoc($query1);
$name = $row1['name'];
$email = $row1['email'];

$query = mysqli_query($mysqli, "SELECT * FROM quiz WHERE eid='$eid'");
$row = mysqli_fetch_assoc($query);
$examTime = $row['time'] * 60;
$Time = $row['time'];
$examName = $row['title'];
echo '<div style="border: 2px solid #333; padding: 20px; border-radius: 10px; background-color: #f8f8f8;">';
echo 'Exam Name: '.$examName.'<br>';
echo 'Candidate Name: '.$name.'<br>';
echo 'Email Address: '.$email.'<br>';
echo '<script>localStorage.setItem("timeleft", ' . $examTime . ');</script>';
$total = $_GET['total'];
echo 'Welcome to the Online Examination System!
<br>
Before you begin the exam, please read the following instructions carefully:
<br>
Time Limit: This exam has a time limit of <b>'.$Time.' Minutes</b>.
<br>Make sure to manage your time effectively and attempt all questions within the allocated time.
<br><br>
<b>Rules and Guidelines:</b>
<br>
You are required to answer all the questions.<br>
Do not use any external resources or aids during the exam.<br>
Any suspicious behavior or violation of exam rules may result in disqualification.<br>
<b>Keyboard and Tab Alerts:</b><br>
Please note that using the keyboard or switching to another tab during the exam is strictly prohibited.<br>
If you attempt to use the keyboard or switch tabs, alerts will be triggered, and after a specific alerts your exam session may be terminated.<br>
By proceeding with the exam, you agree to abide by the rules and guidelines stated above.<br>';
echo'<div style="text-align:center;">';
echo '<br><a href="update.php?q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32 "><b>Start</b></a>';
echo '</div>';
?>
