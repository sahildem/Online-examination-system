<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>ONLINE EXAMINATION SYSTEM </title>
 <link  rel="stylesheet" href="css/project_test.css">
 <link  rel="stylesheet" href="css/font.css">
 <script src="js/jquery.js" type="text/javascript"></script>

 
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
 <!--alert message-->
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->

</head>
<?php
include_once 'database.php';
?>
<body>
<div class="header">
<div class="row">
<div class="col-lg-6">
<span class="logo">Online Examination System</span></div>
<div class="col-md-4 col-md-offset-2">
 <?php
 include_once 'database.php';
session_start();
  if(!(isset($_SESSION['email']))){
header("location:index.php");

}
else
{
//$name = $_SESSION['name'];
$email = $_SESSION['email'];

include_once 'database.php';
echo '<span class="pull-right top title1" ><span class="log1">&nbsp;&nbsp;&nbsp;&nbsp;</a>&nbsp;|&nbsp;<a href="logout.php?q=project_test.php" class="log">&nbsp;Signout</button></a></span>';
}?>
</div>
</div></div>
<div class="bg">

<!--navigation menu-->
<nav class="navbar navbar-default title1">
  <div class="container-fluid">
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" >
        <ul class="nav navbar-nav">
        <li <?php if(@$_GET['q']==1) echo'class="active"'; ?> ><a href="project_test.php?q=1">&nbsp;Home</a></li>
        <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="project_test.php?q=2">&nbsp;History</a></li>
		<li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="project_test.php?q=3">&nbsp;Ranking</a></li>
        <li <?php if(@$_GET['q']==4) echo'class="active"'; ?>><a href="project_test.php?q=4">&nbsp;About Us</a></li>
        <li <?php if(@$_GET['q']==5) echo'class="active"'; ?>><a href="project_test.php?q=5">&nbsp;Feedback</a></li>
        <li <?php if(@$_GET['q']==6) echo'class="active"'; ?>><a href="project_test.php?q=6">&nbsp;Courses</a></li>
        </ul>
            
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav><!--navigation menu closed-->
<div class="container"><!--container start-->
<div class="row">
<div class="col-md-12">

<!--home start-->
<?php if(@$_GET['q']==1) {
echo '<script>localStorage.setItem("timeleft", 0);</script>';
$result = mysqli_query($mysqli,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
echo  '<div class="panel"><table class="table table-striped title1">
<tr><td><b>S.N.</b></td><td><b>Topic</b></td><td><b>Total question</b></td><td><b>Marks</b></td><td><b>Time limit</b></td><td></td></tr>';
$c=1;
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$total = $row['total'];
	$sahi = $row['sahi'];
    $time = $row['time'];
	$eid = $row['eid'];
$q12=mysqli_query($mysqli,"SELECT score FROM history WHERE eid='$eid' AND email='$email'" )or die('Error98');
$rowcount=mysqli_num_rows($q12);	
if($rowcount == 0){
	echo '<tr><td>'.$c++.'</td><td>'.$title.'</td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
	<td><b><a href="test.php?eid='.$eid.'&total='.$total.'&email='.$email.'" class="pull-right btn sub1" style="margin:0px;">&nbsp;<span class="title1"><b>Start</b></span></a></b></td></tr>';
}
else
{
echo '<tr style="color:black"><td>'.$c++.'</td><td>'.$title.'&nbsp;<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span></td><td>'.$total.'</td><td>'.$sahi*$total.'</td><td>'.$time.'&nbsp;min</td>
	<td><b><a href="test1.php?eid='.$eid.'&total='.$total.'&email='.$email.'" class="pull-right btn sub1" style="margin:0px;>&nbsp;<span class="title1"><b>Restart</b></span></a></b></td></tr>';
}
}
$c=0;
echo '</table></div>';

}?>


<!--home closed-->

<!--quiz start-->
<script>
var timeLeft = <?php echo $remainingTime; ?>;
</script>
<?php
if (@$_GET['q'] == 'quiz' && @$_GET['step'] == 2) {
    
    $eid = @$_GET['eid'];
    $sn = @$_GET['n'];
    $total = @$_GET['t'];
    $qid = @$_GET['qid'];
    
    $query = mysqli_query($mysqli, "SELECT * FROM quiz WHERE eid='$eid'");
    $row = mysqli_fetch_assoc($query);
    $examTime = $row['time'] * 60; // Time for the exam in seconds
    

    // Check if the remaining time is stored in session storage
    $remainingTime = isset($_SESSION['remaining_time']) ? $_SESSION['remaining_time'] : $examTime;

    // Hide the navbar when the exam starts
    echo '<script>document.getElementsByClassName("navbar")[0].style.display = "none";</script>';

    // JavaScript to trigger full-screen mode
    ?>
        <script>
            /* Get the element you want displayed in fullscreen mode (a video in this example): */
            //localStorage.setItem("timeleft", <?php $examTime ?>);
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            }   

            // Function to open fullscreen mode when user clicks OK on the alert
            
        </script>
    <?php

    // Calculate progress percentage
    $progress = ($sn / $total) * 100;

    $q = mysqli_query($mysqli, "SELECT * FROM questions WHERE eid='$eid' AND sn='$sn'");
    echo '<div class="panel" style="margin:5%">';
    while ($row = mysqli_fetch_array($q)) {
        $qns = $row['qns'];
        $qid = $row['qid'];
        echo '<b>Question &nbsp;' . $sn . '&nbsp;::<br />' . $qns . '</b><br /><br />';
    }

    $q = mysqli_query($mysqli, "SELECT * FROM options WHERE qid='$qid'");
    echo '<form action="update.php?q=quiz&step=2&eid=' . $eid . '&n=' . $sn . '&t=' . $total . '&qid=' . $qid . '" method="POST" class="form-horizontal"><br />';

    while ($row = mysqli_fetch_array($q)) {
        $option = $row['option'];
        $optionid = $row['optionid'];
        echo '<input type="radio" name="ans" value="' . $optionid . '">' . $option . '<br /><br />';
    }
    // Output progress bar
    echo '</div>';

    echo '<br /><button type="submit" class="btn btn-primary" name="submit"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button>';

    // Add Previous and Next question buttons
    $prev_sn = $sn - 1;
    $next_sn = $sn + 1;

    if ($prev_sn > 0) {
        echo '<a href="project_test.php?q=quiz&step=2&eid=' . $eid . '&n=' . $prev_sn . '&t=' . $total . '&qid=' . $qid . '" class="btn btn-default">Previous </a>';
    }

    if ($next_sn <= $total) {
        echo '<a href="project_test.php?q=quiz&step=2&eid=' . $eid . '&n=' . $next_sn . '&t=' . $total . '&qid=' . $qid . '" class="btn btn-default">Next</a>';
    }
    
    echo '<div id="countdown"></div>';
    echo '</form></div>';

    // Check if form is submitted and option is selected
    if (isset($_POST['submit']) && isset($_POST['ans'])) {
        // Update progress bar after form submission
        $sn++;
        $progress = ($sn / $total) * 100;
        echo '<script>document.getElementsByClassName("progress-bar")[0].style.width = "' . $progress . '%"';

        // Store the remaining time in session storage
        $_SESSION['remaining_time'] = $remainingTime;
    }
    
    ?>
    <script>
    var keyboardAlertCount = 0;
    var tabAlertCount = 0;

    window.addEventListener("keydown", function (e) {
        e.preventDefault();
        keyboardAlertCount++;
        alert("Using keyboard is not allowed in the exam you will only get 5 chances warnings left = " + (5 - keyboardAlertCount));

        if (keyboardAlertCount >= 5) {
            location.href = 'project_test.php?q=1';
        }
    });

    document.addEventListener("visibilitychange", function() {
        if (document.visibilityState === "hidden") {
            tabAlertCount++;
            alert("Warning: You have switched to another tab you will only get 3 chances warnings left = " + (3 - tabAlertCount));
            if (tabAlertCount >= 3) {
                location.href = 'project_test.php?q=1';
            }
        }
    });

    // Retrieve timeLeft from localStorage
    var timeLeft = localStorage.getItem("timeleft");
    if (timeLeft === null) {
        timeLeft = <?php echo $examTime; ?>;
    } else {
        timeLeft = parseInt(timeLeft); // Convert string to integer
    }

    function startTimer() {
        var timerInterval = setInterval(function() {
            var hours = Math.floor(timeLeft / 3600);
            var minutes = Math.floor((timeLeft % 3600) / 60);
            var seconds = timeLeft % 60;
            document.getElementById("countdown").innerHTML = hours + "h " + minutes + "m " + seconds + "s";
            localStorage.setItem("timeleft", timeLeft);
            if (--timeLeft < 0) {
                clearInterval(timerInterval);
                alert("Time's up!");
                location.href = 'project_test.php?q=1';
            }
        }, 1000);
    }

    startTimer(); // Start the timer when the page loads
</script>
<?php
}

?>

<?php

//result display
if(@$_GET['q']== 'result' && @$_GET['eid']) 
{
    
echo '<script>localStorage.setItem("timeleft", 0);</script>';
$eid=@$_GET['eid'];
$q=mysqli_query($mysqli,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
echo  '<div class="panel">
<center><h1 class="title" style="color:#660033">Result</h1><center><br /><table class="table table-striped title1" style="font-size:20px;font-weight:1000;">';

while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
echo '<tr style="color:#66CCFF"><td>Total Questions</td><td>'.$qa.'</td></tr>
      <tr style="color:#white"><td>right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td>'.$r.'</td></tr> 
	  <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td>'.$w.'</td></tr>
	  <tr style="color:#66CCFF"><td>Score&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
$q=mysqli_query($mysqli,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');
while($row=mysqli_fetch_array($q) )
{
$s=$row['score'];
echo '<tr style="color:#990000"><td>Overall Score&nbsp;<span class="glyphicon glyphicon-stats" aria-hidden="true"></span></td><td>'.$s.'</td></tr>';
}
echo '</table></div>';

}
?>
<!--quiz end-->
<?php
//history start
if(@$_GET['q']== 2) 
{
$q=mysqli_query($mysqli,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:black"><td><b>S.N.</b></td><td><b>Quiz</b></td><td><b>Question Solved</b></td><td><b>Right</b></td><td><b>Wrong<b></td><td><b>Score</b></td>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$eid=$row['eid'];
$s=$row['score'];
$w=$row['wrong'];
$r=$row['sahi'];
$qa=$row['level'];
$q23=mysqli_query($mysqli,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
while($row=mysqli_fetch_array($q23) )
{
$title=$row['title'];
}
$c++;
echo '<tr><td>'.$c.'</td><td>'.$title.'</td><td>'.$qa.'</td><td>'.$r.'</td><td>'.$w.'</td><td>'.$s.'</td></tr>';
}
echo'</table></div>';
}

//ranking start
if(@$_GET['q']== 3) 
{
$q=mysqli_query($mysqli,"SELECT * FROM rank  ORDER BY score DESC " )or die('Error223');
echo  '<div class="panel title">
<table class="table table-striped title1" >
<tr style="color:black"><td><b>Rank</b></td><td><b>Name</b></td><td><b>Score</b></td></tr>';
$c=0;
while($row=mysqli_fetch_array($q) )
{
$e=$row['email'];
$s=$row['score'];
$q12=mysqli_query($mysqli,"SELECT * FROM user WHERE email='$e' " )or die('Error231');
while($row=mysqli_fetch_array($q12) )
{
$name=$row['name'];
//$gender=$row['gender'];
//$college=$row['college'];
}
$c++;
echo '<tr><td style="color:black"><b>'.$c.'</b></td><td>'.$name.'</td><td>'.$s.'</td><td>';
}
echo '</table></div>';}
?>

<?php
//about us
if(@$_GET['q']== 4) 
{
  echo "<!DOCTYPE html>
  <html lang='en'>
  <head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      
      <style>
          body {
            width:99%;
              background-color: light-grey;
          }
  
          header {
              text-align: center;
              margin-bottom: 20px;
          }
  
          section {
              max-width: 800px;
              margin: 0 auto;
              padding: 20px;
              background-color: #fff;
              border-radius: 8px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
              animation: fadeInUp 1s ease-in-out;
          }
  
          h1, h2 {
              color: #333;
          }
  
          p {
              line-height: 1.6;
              color: #666;
          }
  
          ul {
              list-style-type: disc;
          }
  
          a {
              color: blue;
              text-decoration: none;
              transition: color 0.3s ease-in-out;
          }
  
  
          button {
              background-color: blue;
              color: #fff;
              padding: 8px 16px;
              border: none;
              border-radius: 4px;
              cursor: pointer;
              transition: background-color 0.3s ease-in-out;
          }
  
          button:hover {
              background-color: darkblue;
          }
  
          img {
              width: 100%;
              max-width: 100%;
              height: auto;
              border-radius: 8px;
              margin-bottom: 20px;
          }
  
          .account-holders {
              display: flex;
              justify-content: center;
              align-items: center;
              flex-wrap: wrap;
              gap: 20px;
          }
  
          .account-holder-img {
              max-width:200px;
              max-height: 200px;
              border-radius: 50%;
              margin-bottom: 10px;
          }
  
          .account-holder-info {
              text-align: center;
          }
  
          /* Responsive Styling */
          @media only screen and (max-width: 600px) {
              section {
                  padding: 10px;
              }
          }
          }
      </style>
  </head>
  <body>
  
      <header>
          <h1>About Us</h1>
      </header>
  
      <section>
          <!-- Image at the top -->
          <img src='img/about_us.jpg' alt='Banner Image'>
  
          <h2>Our Mission</h2>
          <p>We are committed to revolutionizing the field of education by providing a state-of-the-art Online Examination System. Our mission is to empower students, educators, and institutions with innovative technology that enhances the learning and assessment experience.</p>
  
          <h2>Features</h2>
  
          <ul>
              <li>Secure and reliable online exam platform</li>
              <li>Customizable exams with various question types</li>
              <li>Instant result generation</li>
              <li>User-friendly interface for both students and administrators</li>
              <li>Efficient real-time monitoring and proctoring (optional)</li>
          </ul>
  
          <h2>Contact Us</h2>
          <p>For any inquiries or support, please contact us at:</p>
         
  
          <!-- Centered Account Holder's Images and Mail Options -->
          <div class='account-holders'>
              <div>
                  <img class='account-holder-img' src='menus/male.png' alt='Account Holder 1'>
                  <div class='account-holder-info'>
                     
                      <a href='mailto:swapnilvichare22@gmail.com'>Swapnil Vichare</a>
                  </div>
              </div>
  
              <div>
                  <img class='account-holder-img' src='menus/male (2).png' alt='Account Holder 2'>
                  <div class='account-holder-info'>
                      
                      <a href='mailto:skargutkar2003@gmail.com'>Sahil Kargutkar</a>
                  </div>
              </div>
          </div>
  
          <h2>Visit Us</h2>
          <p>
              Feel free to visit our office at Dixit Road, Vileparle. Our team is always ready to assist you with any questions or concerns.
          </p>
  
          <!-- Interactive Button -->
          <button onclick='redirectToContactPage()'>Click to Connect</button>
      </section>
      <script>
          function redirectToContactPage() {
              // Redirect to your contact page URL
              
              window.location.href = 'project_test.php?q=5';
              
          }
      </script>
  
  </body>
  </html>";
}
?>

<?php
//Feedback
if(@$_GET['q']== 5) 
{
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Contact Us</title>
    <style>
    body {
        margin: 10;
        padding: 10;
        background-image: url("I:/PI/images/background2.png");
        height:100%; 
        width:99%; 
        background-size:cover; 
        background-position:center; 
    }
    
    
    header {
        
        border-radius: 10px;
        color: black;
        padding: 30px;
        text-align: center;
        margin-bottom: 20px;
    
    }
    
    section {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    }
    
    form {
        display: flex;
        flex-direction: column;
    }
    
    label {
        margin-bottom: 8px;
    }
    
    input, textarea {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    
    input[type="submit"] {
        background-color: grey;
        color: #fff;
        cursor: pointer;
    }
    
    input[type="submit"]:hover {
        background-color: green;
    }
    </style>
</head>
<body>

    <header>
        <h1 id="con">Feedback</h1>
    </header>
    

    <section>
        <form action="feedback1.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>

            <input type="submit" value="Submit">
        </form>
    </section>

</body>
</html>
';
}
//courses
if(@$_GET['q']== 6) 
{
  echo '<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!--<link rel="stylesheet" href="I:\PI\style.css">-->
      <title>Courses - Online Examination System</title>
      <style>
         <!--  body {
            
            background-color: light-grey;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

    
            section {
                max-width: 800px;
                margin: 0 auto;
                padding: 20px;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                animation: fadeInUp 1s ease-in-out;
            }
    
            h1, h2 {
                color: #333;
            }
    

              
              margin: 20px;
              background-color: ;
         }
         
       
  
          ul{
              list-style-type: none;
              border-radius: 10px;
              padding: 15px;
              border: 1px solid #80800;
              background-color: lightgray;         
          }
  
          li {
              margin-bottom: 10px;
              
              
          }
          .rounded-box {
              border-radius: 10px;
              padding: 15px;
              border: 1px solid #000;
              background-color: #gray; 
          }
      </style>
  
  </head>
  <body>
  
      <header>
          <h1>Courses</h1>
      </header>
  
      <section>
          <h2>Available Courses</h2>
          <ul >
              <li class="rounded-box"><a  target="_blank" href="menus\courses_data\1.pdf">Course 1: Introduction to Programming</a></li>
              <li class="rounded-box"><a  target="_blank" href="menus\courses_data\Web Devlopment Basics.pdf">Course 2: Web Development Basics</a></li>
              <li class="rounded-box"><a  target="_blank" href="menus\courses_data\Data Science Fundamentals.pdf">Course 3: Data Science Fundamentals</a></li>
              <li class="rounded-box"><a  target="_blank" href="menus\courses_data\digital-marketing-essentials.pdf">Course 4: Digital Marketing Essentials</a></li>
              <li class="rounded-box"><a  target="_blank" href="menus\courses_data\graphic design basics.pdf">Course 5: Graphic Design for Beginners</a></li>
              <li class="rounded-box"><a  target="_blank" href="menus\courses_data\Mobile App Development.pdf">Course 6: Mobile App Development</a></li>
              <li class="rounded-box"><a  target="_blank" href="menus\courses_data\cybersecuirty_sb_factsheets_all.pdf">Course 7: Cybersecurity Fundamentals</a></li>
              <li class="rounded-box"><a target="_blank" href="menus\courses_data\PRINCIPLESOFBUSINESSMANAGEMENT.pdf">Course 8: Business Management Principles</a></li>
              <li class="rounded-box"><a target="_blank" href="menus\courses_data\digital-marketing-essentials.pdf">Course 9: Machine Learning Basics</a></li>
              <li class="rounded-box"><a target="_blank" href="menus\courses_data\Web Devlopment Basics.pdf">Course 10: Advanced JavaScript Programming</a></li>
          </ul>
      </section>
  
  </body>
  </html>';
}

?>


</div></div></div></div>


<!--Modal for admin login
	 <div class="modal fade" id="login">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span style="color:orange;font-family:'typo' ">LOGIN</span></h4>
      </div>
      <div class="modal-body title1">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<form role="form" method="post" action="admin.php?q=index.php">
<div class="form-group">
<input type="text" name="uname" maxlength="20"  placeholder="Admin user id" class="form-control"/> 
</div>
<div class="form-group">
<input type="password" name="password" maxlength="15" placeholder="Password" class="form-control"/>
</div>
<div class="form-group" align="center">
<input type="submit" name="login" value="Login" class="btn btn-primary" />
</div>
</form>
</div><div class="col-md-3"></div></div>
      </div>-->
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--footer end-->


</body>
</html>
