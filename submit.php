<?php
session_start();
include("./connect.php");

// Fetch all questions
$query = $conn->prepare("SELECT * FROM questions");
$query->execute();
$questions = $query->fetchAll(PDO::FETCH_ASSOC);
$totalQuestions = count($questions);

// Initialize score
$score = 0;

// Check each question
foreach ($questions as $question) {
    if (isset($_POST['question_' . $question['id']])) {
        $selectedAnswerId = $_POST['question_' . $question['id']];

        // Check if the selected answer is correct
        $correctAnswerQuery = $conn->prepare("SELECT * FROM answers WHERE id = :id AND is_correct = 1");
        $correctAnswerQuery->bindParam(':id', $selectedAnswerId);
        $correctAnswerQuery->execute();
        if ($correctAnswerQuery->rowCount() > 0) {
            $score++;
        }
    }
}

// Output the result
echo "You scored " . $score . " out of " . $totalQuestions;
?>
