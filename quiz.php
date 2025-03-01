<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Take Exam</title>
<style>
  /* CSS for styling the progress bar */
  #progress {
    width: 100%;
    background-color: #f0f0f0;
    margin-bottom: 10px;
  }
  #progress-bar {
    width: 0%;
    height: 20px;
    background-color: #4caf50;
  }
</style>
</head>
<body>
<h2>Exam Page</h2>

<?php
// Include database connection
include_once 'database.php';

// Fetch available exams from the quiz table
$sql_exams = "SELECT * FROM quiz";
$result_exams = $mysqli->query($sql_exams);
$row_exam = $result_exams->fetch_assoc()
?>

<!-- Form for selecting exams -->
<form id="examForm" method="post" action="">
    <?php
    if ($result_exams->num_rows > 0) {
        while ($row_exam = $result_exams->fetch_assoc()) {
            echo "<button class='exam-button' type='submit' name='exam_id' value='" . $row_exam["eid"] . "'>" . $row_exam["title"] . "</button>";
        }
    } else {
        echo "No exams found.";
    }
    ?>
</form>

<?php
// Handle form submission
if(isset($_POST['exam_id'])) {
    $selected_exam_id = $_POST['exam_id'];

    // Query to retrieve random questions for the selected exam
    $sql_questions = "SELECT * FROM questions WHERE eid = '$selected_exam_id' ORDER BY RAND() LIMIT 1";
    $result_questions = $mysqli->query($sql_questions);

    if ($result_questions->num_rows > 0) {
        echo "<div id='question-container'>";
        echo "<p id='question'></p>";
        echo "<form id='answer-form'>";
        while($row_question = $result_questions->fetch_assoc()) {
            // Display question container with unique IDs
            echo "<div class='question-container' id='question-" . $row_question["qid"] . "'>";
            echo "<p>" . $row_question["qns"] . "</p>";
            
            // Retrieve options for the current question from the options table
            $sql_options = "SELECT * FROM options WHERE qid = '" . $row_question["qid"] . "'";
            $result_options = $mysqli->query($sql_options);
            if ($result_options->num_rows > 0) {
                while($row_option = $result_options->fetch_assoc()) {
                    // Display options
                    echo "<input type='radio' name='answer[" . $row_question["qid"] . "]' value='" . $row_option["qid"] . "' id='option-" . $row_option["qid"] . "'>";
                    echo "<label for='option-" . $row_option["qid"] . "'>" . $row_option["option"] . "</label><br>";
                }
            } else {
                echo "No options found for this question.";
            }
            
            echo "</div>";
        }
        echo "</form>";
        echo "</div>";
    } else {
        echo "No questions found for the selected exam.";
    }
}
$mysqli->close();
?>

<!-- Progress bar to show attempted questions -->
<div id="progress">
  <div id="progress-bar"></div>
</div>

<!-- Buttons for navigation -->
<button onclick="prevQuestion()">Previous</button>
<button onclick="nextQuestion()">Next</button>

<script>
// Sample questions and answers data (replace with actual data)
const questions = [
  <?php
    // Re-fetch the questions to use in JavaScript
    if(isset($_POST['exam_id'])) {
        $selected_exam_id_js = $_POST['exam_id'];
        $sql_questions_js = "SELECT * FROM questions WHERE eid = '$selected_exam_id_js' ORDER BY RAND() LIMIT 1";
        $result_questions_js = $mysqli->query($sql_questions_js);
        while($row_question_js = $result_questions_js->fetch_assoc()) {
          echo "{ qid: " . $row_question_js["qid"] . ", question: '" . addslashes($row_question_js["qns"]) . "' },";
        }
    }
  ?>
];

let currentQuestionIndex = 0;

// Function to display current question
function displayQuestion() {
  const currentQuestion = questions[currentQuestionIndex];
  document.getElementById('question').textContent = currentQuestion.question;
  // Update progress bar
  const progress = (currentQuestionIndex + 1) / questions.length * 100;
  document.getElementById('progress-bar').style.width = progress + '%';
}

// Function to navigate to next question
function nextQuestion() {
  if (currentQuestionIndex < questions.length - 1) {
    currentQuestionIndex++;
    displayQuestion();
  }
}