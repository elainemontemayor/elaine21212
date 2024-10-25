<?php
session_start(); 
require('./read.php');

$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'User';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Georgia', serif;
            background: url('admin.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
        }

        .top-bar {
            display: flex;
            justify-content: flex-end;
            width: 100%;
            max-width: 900px;
            margin-bottom: 20px;
        }

        .logout-btn {
            padding: 10px 20px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #a52631;
        }

        h1 {
            margin-bottom: 20px;
            color: black;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.4);
            font-size: 2.5em;
            border-bottom: 2px solid #007bff; /* Underline with blue color */
            padding-bottom: 10px; /* Adds space between text and underline */
        }

        nav {
            width: 100%;
            margin-bottom: 20px;
        }

        nav ul {
            list-style-type: none;
            display: flex;
            justify-content: center;
            padding: 10px;
            background-color: rgba(139, 94, 60, 0.8);
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        nav li {
            margin: 0 15px;
        }

        nav a {
            color: #fff8e7;
            text-decoration: none;
            font-weight: 700;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #5c4033; 
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 100%;
            max-width: 900px;
            margin-bottom: 20px;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background-color: #007bff; /* Table header color - blue */
            color: white;
            padding: 15px;
            font-size: 1.2em;
            font-weight: bold;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s;
        }

        tr:nth-child(even) {
            background-color: #e7f1ff; /* Light blue for even rows */
        }

        tr:hover {
            background-color: #cce5ff; /* Slightly darker blue on hover */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        #printButton {
            padding: 10px 20px;
            background-color: #0d6efd; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        #printButton:hover {
            background-color: #0056b3;
            transform: scale(1.05); 
        }

        #printButton:active {
            transform: scale(1);
            background-color: #004080; 
        }

        @media print {
            #printButton {
                display: none;
            }
        }
    </style>
</head>
<body>

<!-- Logout Button -->
<div class="top-bar">
    <form action="login.php" method="post">
        <input type="submit" value="Logout" class="logout-btn">
    </form>
</div>

<h1>Welcome, <?php echo htmlspecialchars($userName); ?></h1>
<h1>Our Scholar In Sta Rita Pampanga</h1>

<div class="container">
    <table>
        <tr>
            <th>Id</th>
            <th>Full Name</th>
            <th>Address</th>
        </tr>
        <?php while ($result = mysqli_fetch_array($sqlAccounts)) { ?>
            <tr>
                <td><?php echo $result['id']; ?></td>
                <td><?php echo $result['fname']; ?></td>
                <td><?php echo $result['address1']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div> 

<button id="printButton" onclick="window.print()">Print</button>

</body>
</html>
