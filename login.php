<?php
session_start();
$passmass = '';
$usermass = '';
$sinmassage1 = '';
$sinmassage2 = '';
$sinmassage3 = '';
$sinmassage4 = '';
$success_message = '';
if (isset($_SESSION['success_message'])) {
    $success_message = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
include 'config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'Administrator') {
                    header("Location: mydashboard/index.php");
                } else {
                    header("Location: index.php");
                }
                exit();
            } else {
                $passmass = "Invalid password.";
            }
        } else {
            $usermass = "No user found with that email.";
        }
    } elseif (isset($_POST['usernamesign']) && isset($_POST['passwordsign']) && isset($_POST['email'])) {
        $usernamesign = $_POST['usernamesign'];
        $email = $_POST['email'];
        $passwordsign = password_hash($_POST['passwordsign'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $usernamesign, $email, $passwordsign);
            try {
                if ($stmt->execute()) {
                    $_SESSION['success_message'] = 'Account created successfully!';
                    header("Location: login.php");
                    exit();
                } else {
                    $sinmassage1 = "Error: " . $stmt->error;
                }
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() === 23000) {
                    $sinmassage2 = 'Email already exists. Please use a different email.';
                } else {
                    $sinmassage3 = 'Error: ' . $e->getMessage();
                }
            }
            $stmt->close();
        } else {
            $sinmassage4 = "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Log In / Sign Up</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'>
    <link rel="stylesheet" href="form.css">
</head>

<body>
    <div style="background-color: #000;" class="section">
        <div class="container">
            <h4 style="text-align: center;margin-top:20px;">
                <?php echo $usermass . $passmass . $success_message . $sinmassage1 . $sinmassage2 . $sinmassage3 . $sinmassage4; ?>
            </h4>

            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div style="background-color: #FEA506;" class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Log In</h4>
                                            <form id="login-form" class="validate-form" action="login.php" method="POST">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off" required>
                                                    <i class="input-icon uil uil-envelope"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off" required>
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <button type="submit" class="btn mt-4">Submit</button>
                                                <p class="mb-0 mt-4 text-center black"><a href="forgot-password.php" class="link">Forgot your password?</a></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div style="background-color: #FEA506;" class="card-back">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Sign Up</h4>
                                            <form id="signup-form" class="validate-form" action="login.php" method="POST">
                                                <div class="form-group">
                                                    <input type="text" name="usernamesign" class="form-style" placeholder="Your Full Name" id="logname" autocomplete="off" required>
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" name="email" class="form-style" placeholder="Your Email" id="email" autocomplete="off" required>
                                                    <i class="input-icon uil uil-envelope"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="passwordsign" class="form-style" placeholder="Your Password" id="signuppass" autocomplete="off" required>
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <button type="submit" class="btn mt-4">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>