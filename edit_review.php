<?php
include('dbb.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['review_id'])) {
    $review_id = $_POST['review_id'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    $sql_review = "SELECT * FROM reviews WHERE review_id = ? AND user_id = ?";
    $stmt_review = $pdo->prepare($sql_review);
    $stmt_review->bindParam(1, $review_id, PDO::PARAM_INT);
    $stmt_review->bindParam(2, $user_id, PDO::PARAM_INT);
    $stmt_review->execute();
    $review = $stmt_review->fetch(PDO::FETCH_ASSOC);

    if ($review) {
        echo '<div class="form-container">';
        echo '<form method="POST" action="update_review.php" onsubmit="return validateForm()">';
        echo '<input type="hidden" name="review_id" value="' . htmlspecialchars($review_id) . '">';
        echo '<label for="rating">Rating:</label>';
        echo '<input type="number" name="rating" min"1" max="5" id="rating" value="' . htmlspecialchars($review['rating']) . '" min="1" max="99999" required><br>';
        echo '<label for="review_text">Review:</label>';
        echo '<textarea name="review_text" id="review_text" required>' . htmlspecialchars($review['review_text']) . '</textarea><br>';
        echo '<button type="submit">Update Review</button>';
        echo '</form>';
        echo '</div>';
    } else {
        echo '<p>Review not found or you do not have permission to edit this review.</p>';
    }
} else {
    echo '<p>Invalid request.</p>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.jpg" type="image/png">
    <title>Edit Review</title>
    <link rel="icon" href="logo.jpg" type="image/png">
    <style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #000;
        color: #fff;
        font-family: Arial, sans-serif;
    }

    .form-container {
        background-color: #333;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        max-width: 400px;
        width: 100%;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-top: 10px;
    }

    input,
    textarea,
    button {
        margin-top: 5px;
        padding: 10px;
        border: none;
        border-radius: 4px;
    }

    input,
    textarea {
        background-color: #555;
        color: #fff;
    }

    button {
        background-color: #FEA506;
        color: #fff;
        cursor: pointer;
    }

    button:hover {
        background-color: #e69500;
    }
    </style>
</head>

<body>
    <script>
    function validateForm() {
        const rating = document.getElementById('rating').value;
        if (rating.length > 5) {
            alert('Rating must be 5 digits or less.');
            return false;
        }
        return true;
    }
    </script>
</body>

</html>