<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Merriweather', sans-serif;
            background-color: #70a1ff;
            background-image: url('bgimage.jpg');
            background-size: cover;
        }
        .timer {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            color: black; /* Change color as needed */
        }
        /* Reset and base styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Merriweather', serif;
    background: linear-gradient(135deg, #70a1ff, #1e90ff);
    color: #333;
    line-height: 1.6;
}

.container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h3 {
    color: #2c3e50;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

ol {
    padding-left: 1.5rem;
    margin-bottom: 2rem;
}

li {
    margin-bottom: 0.5rem;
}

/* Timer styles */
.timer {
    font-size: 2rem;
    font-weight: bold;
    text-align: center;
    margin: 1.5rem 0;
    color: #e74c3c;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    animation: pulse 1s infinite alternate;
}

@keyframes pulse {
    from { transform: scale(1); }
    to { transform: scale(1.05); }
}

/* Question styles */
.question {
    background-color: #a29bfe;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    transition: all 0.3s ease;
}

.question:hover {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.question strong {
    display: block;
    margin-bottom: 1rem;
    color: #2c3e50;
}

/* Answer styles */
.answer {
    margin: 0.5rem 0;
}

input[type="radio"] {
    margin-right: 0.5rem;
}

/* Button styles */
.btn {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: bold;
    color: #fff;
    background-color: #3498db;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.btn:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Responsive design */
@media (max-width: 768px) {
    .container {
        padding: 1rem;
    }

    h3 {
        font-size: 1.5rem;
    }

    .timer {
        font-size: 1.5rem;
    }

    .question {
        padding: 1rem;
    }

    .btn {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }
}
    </style>
</head>
<body>
    
    <div class="container">
        <div class="row my-3">
            <h3 class="text-center">Rules And Regulations</h3>
            <ol>
                <li><p>Every Question contains 1 point</p></li>
                <li><p>There is no negative mark for Wrong Answer</p></li>
                <li><p>Complete Your exams in 30 minutes</p></li>
            </ol>

            <h3 class="text-center">Exam Questions</h3>
            <div class="timer" id="timer">30:00</div> <!-- Timer Display -->
            <form method="post" action="submit.php">
            <?php
            session_start();
            include("./connect.php");

            // Fetch questions
            $query = $conn->prepare("SELECT * FROM questions");
            $query->execute();
            $questions = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($questions as $question) {
                echo "<div class='question'>";
                echo "<strong>* " . htmlspecialchars($question['question_text']) . "</strong><br>";

                $answerQuery = $conn->prepare("SELECT * FROM answers WHERE question_id = :question_id");
                $answerQuery->bindParam(':question_id', $question['id']);
                $answerQuery->execute();
                $answers = $answerQuery->fetchAll(PDO::FETCH_ASSOC);

                foreach ($answers as $answer) {
                    echo "<div class='answer'>";
                    echo "<input type='radio' name='question_" . $question['id'] . "' value='" .($answer['id']) . "'> ";
                    echo ($answer['answer_text']);
                    echo "</div>";
                }

                echo "</div><br><br>";
            }
            ?>
            <br><br>
            <button class="col-lg-2 offset-4 btn btn-lg btn-dark my-3" type="submit" name="exam_submit">Submit Exam</button>
            </form>
        </div>
    </div>

    <script>
        // Set timer for 30 minutes
        let timeRemaining = 30 * 60; // 30 minutes in seconds
        const timerElement = document.getElementById('timer');

        const countdown = setInterval(() => {
            const minutes = Math.floor(timeRemaining / 60);
            const seconds = timeRemaining % 60;

            // Format time to MM:SS
            timerElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

            // Decrement time
            timeRemaining--;

            // Check if time has run out
            if (timeRemaining < 0) {
                clearInterval(countdown);
                alert("Time is up! Submitting your exam.");
                document.forms[0].submit(); // Automatically submit the form
            }
        }, 1000);
    </script>
</body>
</html>
