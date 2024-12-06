<?php
include('dbb.php'); 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['review_id'])) {
    $review_id = $_POST['review_id'];
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

    $sql_delete = "DELETE FROM reviews WHERE review_id = ? AND user_id = ?";
    $stmt_delete = $pdo->prepare($sql_delete);
    $stmt_delete->bindParam(1, $review_id, PDO::PARAM_INT);
    $stmt_delete->bindParam(2, $user_id, PDO::PARAM_INT);
    
    if ($stmt_delete->execute()) {
        $massage = '<p>Review deleted successfully.</p>';
    } else {
        $massage = '<p>Failed to delete review.</p>';
    }
} else {
    $massage = '<p>Invalid request.</p>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo.jpg" type="image/png">
    <title>Music Player - Delete Review</title>
    <link rel="stylesheet" href="css/style.css" />
    <link
        href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/slicknav.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    body {
        font-family: Arial, sans-serif;
        line-height: 1.6;
        margin: 0;
        background-color: #000;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .center-content {
        text-align: center;
        margin-top: 50vh;
    }

    p {
        font-size: large;
        font-weight: bold;
    }

    button {
        background-color: #FEA506;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <div class="center-content">
        <h1 class="text-white"><?php echo $massage; ?></h1>

        <script>
        setTimeout(function() {
            window.location.href = "index.php";
        }, 1000);
        </script>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.slicknav.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/main.js"></script>
    <?php include('webassets/script.php') ?>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</body>

</html>