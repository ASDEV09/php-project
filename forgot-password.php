<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700,800,900');

    body {
        font-family: 'Poppins', sans-serif;
        font-weight: 300;
        font-size: 15px;
        line-height: 1.9;
        color: #c4c3ca;
        background-color: #1f2029;
        overflow-x: hidden;
    }

    .toggle-password {
        position: relative;
        cursor: pointer;
    }

    .toggle-password .fa-eye {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        cursor: pointer;
    }

    .form-container {
        width: 100%;
        max-width: 450px;
        margin: 0 auto;
        padding: 30px;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background: orange;
    }

    .form-group {
        margin-bottom: 15px;
        position: relative;
    }

    .form-control {
        font-size: 16px;
        padding: 15px 10px 15px 40px;
        background-color: #1f2029;
        border: 1px solid #ccc;
        font-weight: 500;
    }

    .form-control::placeholder {
        color: #c4c3ca;
    }

    .form-control:focus,
    .form-control:hover {
        background-color: #1f2029;
        color: #fff;
    }

    .input-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #888;
        font-size: 18px;
    }

    .container {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .text-center {
        color: #333;
        font-weight: 700;
        margin-bottom: 20px;
        font-family: 'Poppins', sans-serif;

    }

    .btn {
        border-radius: 4px;
        height: 44px;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        -webkit-transition: all 200ms linear;
        transition: all 200ms linear;
        padding: 0 30px;
        letter-spacing: 1px;
        display: -webkit-inline-flex;
        display: -ms-inline-flexbox;
        display: inline-flex;
        -webkit-align-items: center;
        -moz-align-items: center;
        -ms-align-items: center;
        align-items: center;
        -webkit-justify-content: center;
        -moz-justify-content: center;
        -ms-justify-content: center;
        justify-content: center;
        -ms-flex-pack: center;
        text-align: center;
        border: none;
        background-color: #ffeba7;
        color: #102770;
        box-shadow: 0 8px 24px 0 rgba(255, 235, 167, .2);
    }

    .btn:active,
    .btn:focus {
        background-color: #102770;
        color: #ffeba7;
        box-shadow: 0 8px 24px 0 rgba(16, 39, 112, .2);
    }

    .btn:hover {
        background-color: #102770;
        color: #ffeba7;
        box-shadow: 0 8px 24px 0 rgba(16, 39, 112, .2);
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center">Forgot Password</h2>
            <form action="reset-password.php" method="POST">
                <div class="form-group">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email Address"
                        required>
                </div>
                <div class="form-group">
                    <div class="toggle-password">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="new_password" id="new_password" class="form-control"
                            placeholder="New Password" required>
                        <i class="fa fa-eye" onclick="togglePassword('new_password')"></i>
                    </div>
                </div>
                <div class="form-group">
                    <div class="toggle-password">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                            placeholder="Confirm Password" required>
                        <i class="fa fa-eye" onclick="togglePassword('confirm_password')"></i>
                    </div>
                </div>
                <button type="submit" class="btn  btn-block">Reset Password</button>
            </form>
        </div>
    </div>

    <script>
    function togglePassword(id) {
        const element = document.getElementById(id);
        if (element.type === "password") {
            element.type = "text";
        } else {
            element.type = "password";
        }
    }
    </script>
</body>

</html>