<?php
require('./database.php');

if (isset($_POST['adreg'])) {  
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if ($sqlregistration = $connection->prepare("INSERT INTO adreg (email, username, password) VALUES (?, ?, ?)")) {
        $sqlregistration->bind_param("sss", $email, $username, $hashedPassword);
        if ($sqlregistration->execute()) {
            echo '<script>alert("Registration Successful!")</script>';
            echo '<script>window.location.href = "adlog.php"</script>'; 
        } else {
            echo '<script>alert("Failed to register: ' . $connection->error . '")</script>';
        }
        $sqlregistration->close();
    } else {
        echo '<script>alert("Database query preparation failed.")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Admin Registration</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
            position: relative;
            margin: 0;
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
            position: relative;
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
            border-color: #4e54c8;
            box-shadow: 0 0 8px rgba(78, 84, 200, 0.2);
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

        /* Mobile Responsiveness */
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
    <script>
        function capitalizeInput(event) {
            const input = event.target;
            const words = input.value.split(' ');
            for (let i = 0; i < words.length; i++) {
                words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
            }
            input.value = words.join(' ');
        }
    </script>
</head>
<body>


</div>

<div class="wrapper">
    <h2>Admin Registration</h2>
    <form action="" method="post">
        <div class="input-box">
            <input type="email" name="email" id="email" placeholder="Email" required oninput="capitalizeInput(event)">
        </div>
        <div class="input-box">
            <input type="text" name="username" id="username" placeholder="Username" required>
        </div>
        <div class="input-box">
            <input type="password" name="password" id="password" placeholder="Enter Password" required>
        </div>
        <div class="input-box button">
            <input type="submit" name="adreg" value="Register">
        </div>
        <div class="text">
            <h3>Already have an account? <a href="adlog.php">Login here</a></h3>
        </div>
    </form>
</div>

</body>
</html>
