<?php
require('./database.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($stmt = $connection->prepare("SELECT id, username, password FROM ureg WHERE email = ?")) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $username, $hashedPassword);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                session_start();
                $_SESSION['userid'] = $id;
                $_SESSION['username'] = $username;
                echo '<script>alert("Login Successful!")</script>';
                echo '<script>window.location.href = "user.php"</script>'; // Redirect to user dashboard
            } else {
                echo '<script>alert("Incorrect password.")</script>';
            }
        } else {
            echo '<script>alert("No user found with that email.")</script>';
        }
        $stmt->close();
    } else {
        echo '<script>alert("Database query failed.")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
            position: relative;
            margin: 0; /* Remove default margin */
        }

        .admin-link {
            position: absolute; 
            top: 20px; 
            right: 20px; 
            font-size: 14px;
        }

        .admin-link a {
            color: #ffdf2b;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .admin-link a:hover {
            color: #ffc107;
        }

        .wrapper {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 20px 50px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .wrapper h2 {
            margin-bottom: 20px;
            font-size: 26px;
            color: #4e54c8;
            font-weight: 700;
        }

        .input-box {
            margin-bottom: 20px;
        }

        .input-box input {
            width: 100%;
            padding: 12px 16px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .input-box input:focus {
            border-color: #4e54c8; /* Highlight border color on focus */
        }

        .input-box.button input {
            background-color: #4e54c8;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
            border-radius: 8px;
        }

        .input-box.button input:hover {
            background-color: #3a44a6;
        }

        .text h3 {
            font-size: 15px;
            color: #666;
        }

        .text h3 a {
            color: #4e54c8;
            text-decoration: none;
            font-weight: bold;
        }

        .text h3 a:hover {
            color: #3a44a6;
        }

        @media (max-width: 600px) {
            .wrapper {
                padding: 30px; 
                max-width: 90%; 
            }

            .wrapper h2 {
                font-size: 24px; 
            }

            .input-box input {
                font-size: 16px; 
            }

            .text h3 {
                font-size: 14px; 
            }
        }
    </style>
</head>
<body>

<div class="admin-link">
    <a href="adlog.php">Admin</a>
</div>

<div class="wrapper">
    <h2>Login to Your Scholar Account</h2>
    <form action="" method="post">
        <div class="input-box">
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" id="password" placeholder="Password" required>
        </div>
        <div class="input-box button">
            <input type="submit" name="login" value="Login">
        </div>
        <div class="text">
            <h3>Don't have an account? <a href="registration.php">Register here</a></h3>
        </div>
    </form>
</div>

</body>
</html>
