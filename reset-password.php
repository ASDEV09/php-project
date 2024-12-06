<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'config/db.php'; 

    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password != $confirm_password) {
        $message = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET password_hash = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $hashed_password, $email);
            if ($stmt->execute()) {
                $message = "Password updated successfully. You can now login with your new password.";
            } else {
                $message = "Failed to update password.";
            }
            $stmt->close();
        } else {
            $message = "Database error: " . $conn->error;
        }
    }

    // Prepare modal content
    $modal_content = '<div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Password Reset</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>' . $message . '</p>
                            </div>
                            <div class="modal-footer">
                                <a href="login.php" class="btn btn-primary">Login</a>
                            </div>
                        </div>
                    </div>';

    // Display the modal
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Password Reset</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <button type="button" id="modalButton" style="display:none;" data-toggle="modal" data-target="#exampleModal"></button>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                ' . $modal_content . '
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $("#modalButton").click();
            });
        </script>
    </body>
    </html>';
}
?>