<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Exam</title>
    <style>
        #submit-btn {
       background-color: red;
       color: white;
       padding: 10px 15px;
       border: none;
       border-radius: 5px;
       cursor: pointer;
       font-size: 16px;
       transition: background-color 0.3s ease;
   }

   #submit-btn:hover {
       background-color: darkred;
   }
       body {
           font-family: 'Arial', sans-serif;
           margin: 20px;
           background-color: #f5f5f5;
       }

       #exam-container {

           max-width: 800px;
           margin: auto;
           background-color: #fff;
           padding: 20px;
           border-radius: 8px;
           box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
           transition: transform 0.3s ease;
           position: relative;
       }
        #timer {
            position: absolute;
            top: 20px;
            right: 20px;            
            font-size: 18px;
            color: white;
            padding: 10px;
            border-radius: 5px;
            background-color:darkslategray ;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
       #exam-container:hover {
           transform: translateY(-5px);
       }

       .question {
           background-color: #f9f9f9;
           padding: 15px;
           border-radius: 8px;
           margin-bottom: 20px;
           transition: transform 0.3s ease;
       }

       .question:hover {
           transform: translateY(-5px);
           box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
       }

       .options {
           list-style-type: none;
           padding: 0;
       }

       .options li {
           margin-bottom: 10px;
           transition: background-color 0.3s ease;
           cursor: pointer;
       }

       .options li:hover {
           background-color: #f0f0f0;
       }

       .options li input[type="radio"] {
           display: none;
       }

       .options li label {
           display: block;
           padding: 10px 15px;
           border-radius: 5px;
           border: 1px solid #ddd;
           transition: background-color 0.3s ease;
       }

       .options li input[type="radio"]:checked + label {
           background-color: #4CAF50;
           color: white;
       }

       #review-btn {
           background-color: #4CAF50;
           color: white;
           padding: 10px 15px;
           border: none;
           border-radius: 5px;
           cursor: pointer;
           transition: background-color 0.3s ease;
       }

       #review-btn:hover {
           background-color: #45a049;
       }

       .page-navigation {
           margin-top: 20px;
           text-align: center;
       }

       .page-navigation button {
           background-color: #008CBA;
           color: white;
           border: none;
           padding: 10px 15px;
           margin-right: 10px;
           cursor: pointer;
           border-radius: 5px;
           transition: background-color 0.3s ease;
       }

       .page-navigation button:hover {
           background-color: #0077A3;
       }

       #progress {
           margin-top: 10px;
           text-align: center;
           font-size: 16px;
       }

       .progress-bar {
           height: 20px;
           margin-top: 10px;
           border-radius: 5px;
           overflow: hidden;
           background-color: #ddd;
       }

       .progress-bar span {
           display: block;
           height: 100%;
           width: 0;
           transition: width 0.5s ease;
       }

       .attempted {
           background-color: #4CAF50;
       }

       .unattempted {
           background-color: #ddd;
       }

       .legend {
           margin-top: 10px;
           text-align: center;
           font-size: 14px;
       }

       .legend span {
           display: inline-block;
           margin-right: 10px;
       }

       .legend .attempted {
           background-color: #4CAF50;
           width: 20px;
           height: 20px;
           border-radius: 50%;
           margin-right: 5px;
       }

       .legend .unattempted {
           background-color: #ddd;
           width: 20px;
           height: 20px;
           border-radius: 50%;
           margin-right: 5px;
       }

       .question-nav {
           display: flex;
           justify-content: center;
           margin-top: 20px;
       }

       .question-nav button {
           background-color: #008CBA;
           color: white;
           border: none;
           padding: 10px 15px;
           margin-right: 10px;
           cursor: pointer;
           border-radius: 5px;
           transition: background-color 0.3s ease;
       }

       .question-nav button.attempted {
           background-color: #4CAF50;
       }

       .question-nav button.current {
           background-color: #45a049;
       }

       .question-nav button:hover {
           background-color: #0077A3;
       }
   </style>    
</head>

<body>
<div id="exam-container">
    <!--Questions-->
    <div class="question" id="page1">
        <p>1. What does HTML stand for?</p>
        <ul class="options">
            <li><input type="radio" name="q1" value="a" id="q1a"><label for="q1a">Hyper Text Markup Language</label></li>
            <li><input type="radio" name="q1" value="b" id="q1b"><label for="q1b">Hyperlink and Text Markup Language</label></li>
            <li><input type="radio" name="q1" value="c" id="q1c"><label for="q1c">Home Tool Markup Language</label></li>
        </ul>
    </div>

    <div class="question" id="page2">
        <p>2. What is CSS used for?</p>
        <ul class="options">
            <li><input type="radio" name="q2" value="a" id="q2a"><label for="q2a">Styling HTML elements</label></li>
            <li><input type="radio" name="q2" value="b" id="q2b"><label for="q2b">Creating databases</label></li>
            <li><input type="radio" name="q2" value="c" id="q2c"><label for="q2c">Programming server-side logic</label></li>
        </ul>
    </div>

    <div class="question" id="page3">
        <p>3. What does JavaScript primarily provide in web development?</p>
        <ul class="options">
            <li><input type="radio" name="q3" value="a" id="q3a"><label for="q3a">Database management</label></li>
            <li><input type="radio" name="q3" value="b" id="q3b"><label for="q3b">Styling and layout</label></li>
            <li><input type="radio" name="q3" value="c" id="q3c"><label for="q3c">Client-side interactivity</label></li>
        </ul>
    </div>

    <div class="question" id="page4">
        <p>4. Which programming language is often used for server-side scripting?</p>
        <ul class="options">
            <li><input type="radio" name="q4" value="a" id="q4a"><label for="q4a">Java</label></li>
            <li><input type="radio" name="q4" value="b" id="q4b"><label for="q4b">Python</label></li>
            <li><input type="radio" name="q4" value="c" id="q4c"><label for="q4c">PHP</label></li>
        </ul>
    </div>

    <div class="question" id="page5">
        <p>5. What does the CSS property "display: none;" do?</p>
        <ul class="options">
            <li><input type="radio" name="q5" value="a" id="q5a"><label for="q5a">Hides an element</label></li>
            <li><input type="radio" name="q5" value="b" id="q5b"><label for="q5b">Makes an element visible</label></li>
            <li><input type="radio" name="q5" value="c" id="q5c"><label for="q5c">Adds a border to an element</label></li>
        </ul>
    </div>

    <div class="question" id="page6">
        <p>6. What is the purpose of the HTML <head> element?</p>
        <ul class="options">
            <li><input type="radio" name="q6" value="a" id="q6a"><label for="q6a">Defines the main content of the HTML document</label></li>
            <li><input type="radio" name="q6" value="b" id="q6b"><label for="q6b">Contains meta-information about the HTML document</label></li>
            <li><input type="radio" name="q6" value="c" id="q6c"><label for="q6c">Represents a section of a document that links to other documents</label></li>
        </ul>
    </div>

    <div class="question" id="page7">
        <p>7. What is the purpose of the CSS property "margin"?</p>
        <ul class="options">
            <li><input type="radio" name="q7" value="a" id="q7a"><label for="q7a">Adds space outside the border of an element</label></li>
            <li><input type="radio" name="q7" value="b" id="q7b"><label for="q7b">Adds space inside the border of an element</label></li>
            <li><input type="radio" name="q7" value="c" id="q7c"><label for="q7c">Changes the background color of an element</label></li>
        </ul>
    </div>

    <div class="question" id="page8">
        <p>8. What is the purpose of the JavaScript function "parseInt()"?</p>
        <ul class="options">
            <li><input type="radio" name="q8" value="a" id="q8a"><label for="q8a">Converts a string to a floating-point number</label></li>
            <li><input type="radio" name="q8" value="b" id="q8b"><label for="q8b">Converts a string to an integer</label></li>
            <li><input type="radio" name="q8" value="c" id="q8c"><label for="q8c">Concatenates two strings</label></li>
        </ul>
    </div>

    <div class="question" id="page9">
        <p>9. In CSS, what does the property "position: absolute;" do?</p>
        <ul class="options">
            <li><input type="radio" name="q9" value="a" id="q9a"><label for="q9a">Positions an element relative to its normal position</label></li>
            <li><input type="radio" name="q9" value="b" id="q9b"><label for="q9b">Removes an element from the normal document flow</label></li>
            <li><input type="radio" name="q9" value="c" id="q9c"><label for="q9c">Centers an element on the page</label></li>
        </ul>
    </div>

    <div class="question" id="page10">
        <p>10. Which HTML tag is used for creating hyperlinks?</p>
        <ul class="options">
            <li><input type="radio" name="q10" value="a" id="q10a"><label for="q10a">&lt;a&gt;</label></li>
            <li><input type="radio" name="q10" value="b" id="q10b"><label for="q10b">&lt;p&gt;</label></li>
            <li><input type="radio" name="q10" value="c" id="q10c"><label for="q10c">&lt;h1&gt;</label></li>
        </ul>
    </div>

    <div class="legend">
        <span class="attempted"></span> Attempted
        <span class="unattempted"></span> Not Attempted
    </div>

    <div class="question-nav" id="question-nav">
        <!-- Add buttons dynamically based on the number of questions -->
    </div>

    <div class="page-navigation">
        <button type="button" onclick="navigate('prev')">Previous</button>
        <button type="button" onclick="navigate('next')">Next</button>
        <button type="button" id="review-btn" onclick="reviewAnswers()">Review</button>
    </div>

    <div id="progress"></div>
    <div class="progress-bar">
        <span id="attempted-progress" class="attempted"></span>
        <span id="unattempted-progress" class="unattempted"></span>
    </div>

    <div id="timer">Time Left: <span id="countdown">30:00</span></div>

    <button type="button" id="submit-btn" onclick="submitExam()">Submit Exam</button>
</div>

<script>
    let currentPage = 1;
    let timer;
    let answers = {};
    let totalQuestions = 10;

    // Function to start the timer automatically
    function startTimer(durationInSeconds) {
        let timerDisplay = document.getElementById('countdown');
        let timerSeconds = durationInSeconds;

        timer = setInterval(function () {
            let minutes = Math.floor(timerSeconds / 60);
            let seconds = timerSeconds % 60;

            timerDisplay.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            if (--timerSeconds < 0) {
                clearInterval(timer);
                alert("Time's up! Submit your exam.");
                submitExam();
            }
        }, 1000);
    }

    // Function to automatically start the exam when the page loads
    function startExamAutomatically() {
        showPage(`page${currentPage}`);
        createQuestionNav();
        startTimer(1800); // 30 minutes timer
        updateProgress();
    }

    // Function to navigate to the specified page
    function showPage(pageId) {
        document.querySelectorAll('.question').forEach(question => {
            question.style.display = 'none';
        });
        document.getElementById(pageId).style.display = 'block';
        updateQuestionNavButtons();
    }

    // Function to navigate to the previous or next page
    function navigate(direction) {
        if (direction === 'prev' && currentPage > 1) {
            currentPage--;
        } else if (direction === 'next' && currentPage < totalQuestions) {
            currentPage++;
        }

        showPage(`page${currentPage}`);
        updateProgress();
    }

    // Function to update the progress display
    function updateProgress() {
        let attempted = Object.keys(answers).length;
        let notAttempted = totalQuestions - attempted;

        document.getElementById('progress').innerHTML = `Question ${currentPage} | Attempted: ${attempted} | Not Attempted: ${notAttempted}`;

        // Update progress bar
        let percentageAttempted = (attempted / totalQuestions) * 100;
        let percentageUnattempted = 100 - percentageAttempted;

        document.getElementById('attempted-progress').style.width = `${percentageAttempted}%`;
        document.getElementById('unattempted-progress').style.width = `${percentageUnattempted}%`;

        updateQuestionNavButtons();
    }

    // Function to create question navigation buttons dynamically
    function createQuestionNav() {
        let questionNav = document.getElementById('question-nav');
        for (let i = 1; i <= totalQuestions; i++) {
            let button = document.createElement('button');
            button.textContent = i;
            button.addEventListener('click', function () {
                currentPage = i;
                showPage(`page${currentPage}`);
                updateProgress();
            });
            questionNav.appendChild(button);
        }
    }

    // Function to update question navigation buttons
    function updateQuestionNavButtons() {
        let questionNavButtons = document.querySelectorAll('.question-nav button');

        questionNavButtons.forEach((button, index) => {
            let questionNumber = index + 1;
            if (answers.hasOwnProperty(`q${questionNumber}`)) {
                button.classList.add('attempted');
                button.classList.remove('current');
            } else {
                button.classList.remove('attempted');
                button.classList.remove('current');
            }

            if (questionNumber === currentPage) {
                button.classList.add('current');
            }
        });
    }

    // Function to review saved answers
    function reviewAnswers() {     
        let reviewMessage = "Reviewing Saved Answers:\n\n";
        for (let questionNumber = 1; questionNumber <= totalQuestions; questionNumber++) {
            if (answers.hasOwnProperty(`q${questionNumber}`)) {
                reviewMessage += `Question ${questionNumber}: ${answers[`q${questionNumber}`]}\n`;
            } else {
                reviewMessage += `Question ${questionNumber}: Not Attempted\n`;
            }
        }
        alert(reviewMessage);
    }

    // Function to submit the exam
    function submitExam() {
        clearInterval(timer);     
        alert("Exam submitted successfully!");
    }

    // Function to get the selected option for the current question
    function getSelectedOption() {
        let selectedOption = document.querySelector(`input[name="q${currentPage}"]:checked`);
        return selectedOption ? selectedOption.value : null;
    }

    // Listen for changes in radio button selections and record answers
    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.addEventListener('change', function () {
            recordAnswer(currentPage, getSelectedOption());
        });
    });

    // Function to record the selected answer for a question
    function recordAnswer(questionNumber, answer) {
        answers[`q${questionNumber}`] = answer;
        updateProgress();
    }

    // Automatically start the exam when the page loads
    startExamAutomatically();

    // JavaScript function to show a confirmation alert on page load
    window.onload = function() {
        var confirmation = window.confirm("Are you sure you want to start the exam?");
        // Check if the user clicked OK (true) or Cancel (false)
        if (confirmation) {     
            alert("Exam has started!");
            // Add your exam start logic here
        } else {
            // User clicked Cancel, you can optionally provide feedback or take other actions
            alert("Exam start canceled.");
            // Add your cancellation logic here if needed
        }
    };
</script>
</body>
</html>
