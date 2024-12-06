<?php
session_start();
include('config/db.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $media_id = $_POST['media_id'];

    $sql = "DELETE FROM playlists WHERE user_id = ? AND media_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $media_id);

    if ($stmt->execute()) {
        echo "Song deleted successfully from playlist.";
    } else {
        echo "Error deleting song from playlist.";
    }
    $stmt->close();
} else {
    echo "Unauthorized access or missing parameters.";
}
?>