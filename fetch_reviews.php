<?php
include('dbb.php');
session_start(); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['media_id'])) {
    $media_id = $_POST['media_id'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
    $sql_reviews = "SELECT u.username, r.rating, r.review_text, r.review_date, a.artist_name, r.review_id, r.user_id 
                    FROM reviews r 
                    INNER JOIN users u ON r.user_id = u.user_id
                    INNER JOIN Media m ON r.media_id = m.media_id
                    INNER JOIN Artists a ON m.artist_id = a.artist_id
                    WHERE r.media_id = ?";
    $stmt_reviews = $pdo->prepare($sql_reviews);
    $stmt_reviews->bindParam(1, $media_id, PDO::PARAM_INT);
    $stmt_reviews->execute();
    $result_reviews = $stmt_reviews->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($result_reviews)) {
        foreach ($result_reviews as $review) {
            echo '<div class="review-item">';
            echo '<strong>Review By : ' . htmlspecialchars($review['username']) . '</strong><br>';
            echo '<strong>Artist: ' . htmlspecialchars($review['artist_name']) . '</strong><br>';
            echo '<strong>Rating: ' . htmlspecialchars($review['rating']) . '</strong><br>';
            echo '<em>Review: ' . htmlspecialchars($review['review_text']) . '</em><br>';
            echo '<small>Date: ' . htmlspecialchars($review['review_date']) . '</small>';
            if ($user_id && $user_id == $review['user_id']) {
                echo '<form method="POST" action="edit_review.php" style="display:inline;">';
                echo '<input type="hidden" name="review_id" value="' . htmlspecialchars($review['review_id']) . '">';
                echo '<input type="hidden" name="media_id" value="' . htmlspecialchars($media_id) . '">';
                echo "<br>";
                echo '<button style="border:none; background-color:#000;color: #fff;" type="submit">Edit Review</button>';
                echo "|";
                echo '</form>';
                echo '<form method="POST" action="delete_review.php" style="display:inline;" onsubmit="return confirm(\'Are you sure you want to delete this review?\');">';
                echo '<input  type="hidden" name="review_id" value="' . htmlspecialchars($review['review_id']) . '">';
                echo '<button style="border:none; background-color:#000;color: #fff;" type="submit">Delete Review</button>';
                echo '</form>';
            }
            echo '<hr>';
            echo '</div>';
        }
    } else {
        echo '<div class="no-reviews">';
        echo '<p>No reviews found for this song.</p>';
        echo '<p>Be the first to add a review!</p>';
        ?>

<?php
        echo '</div>';
    }
} else {
    echo '<p>Invalid request.</p>';
}
?>