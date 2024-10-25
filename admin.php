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
    <title>admin Homepage</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-size: cover;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
        }

        /* Style for the top bar with the logout button */
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
            margin-bottom: 30px;
            color: #2e4e74;
            text-align: center;
            font-size: 2.8em;
            font-weight: bold;
            text-transform: uppercase;
            border-bottom: 4px solid #2e4e74;
            padding-bottom: 10px;
        }

        nav {
            width: 100%;
            margin-bottom: 30px;
        }

        nav ul {
            list-style-type: none;
            display: flex;
            justify-content: center;
            padding: 10px;
            background-color: rgba(46, 78, 116, 0.9);
            border-radius: 8px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
        }

        nav li {
            margin: 0 20px;
        }

        nav a {
            color: #f4f6f9;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.1em;
            padding: 12px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #1d2e45; 
        }

        .container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            padding: 25px;
            width: 100%;
            max-width: 900px;
            margin-bottom: 30px;
            font-size: 18px;
        }

        input[type="text"], input[type="email"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            padding: 12px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            font-weight: bold;
            width: 100%;
            margin-top: 10px;
            font-size: 1em;
        }

        input[name="create"] {
            background: linear-gradient(90deg, #28a745 0%, #75e084 100%);
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #ccc;
        }

        th, td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #2e4e74;
            color: white;
            font-size: 1.2em;
        }

        td {
            font-size: 1em;
            color: #555;
            transition: background-color 0.3s;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e8f0fa;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        input[name="edit"] {
            background: linear-gradient(90deg, #007bff 0%, #66a9ff 100%);
            color: white;
        }

        input[name="delete"] {
            background: linear-gradient(90deg, #dc3545 0%, #ff6a75 100%);
            color: white;
        }

        input[type="submit"]:hover {
            transform: scale(1.05);
        }

        input[type="submit"]:active {
            transform: scale(1);
        }

        #printButton {
            padding: 10px 20px;
            background-color: #007bff; 
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
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

        .classic-form {
            padding: 40px;
            max-width: 600px;
            margin: auto;
            background: rgba(250, 250, 250, 0.95);
            border-radius: 10px;
            border: 1px solid #d4c2a0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            font-family: 'Times New Roman', Times, serif;
        }

        .classic-table {
            /* Add your table styling here */
        }

        .btn {
            padding: 8px 12px;
            font-size: 0.9em;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid #097db3;
            transition: background-color 0.3s, color 0.3s, transform 0.3s;
        }

        .btn-edit {
            background-color: #8b5e3c;
            color: white;
            border: 1px solid #5e4b32;
        }

        .btn-delete {
            background-color: #b35e5e;
            color: white;
            border: 1px solid #8e3c3c;
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
<h1>You are one of the admins in this Scholar List</h1>

<div class="container classic-form">
    <form action="create.php" method="post">
        <h3>Add Scholar</h3>
        <div class="form-group">
            <label for="fname">Full Name</label>
            <input type="text" id="fname" name="fname" placeholder="Enter full name" required />
        </div>
        <div class="form-group">
            <label for="address1">Address</label>
            <input type="text" id="address1" name="address1" placeholder="Enter address" required />
        </div>
        <div class="form-group">
            <label for="contactnum">Contact Number</label>
            <input type="num" id="contactnum" name="contactnum" placeholder="Enter contact number" required />
        </div>
        <input type="submit" name="create" value="Add Scholar">
    </form>
</div>

<div class="container classic-table">
    <table>
        <tr>
            <th>Id</th>
            <th>Full Name</th>
            <th>Address</th>
            <th>Contact No.</th>
            <th>Action</th>
        </tr>
        <?php while ($result = mysqli_fetch_array($sqlAccounts)) { ?>
            <tr>
                <td><?php echo $result['id']; ?></td>
                <td><?php echo $result['fname']; ?></td>
                <td><?php echo $result['address1']; ?></td>
                <td><?php echo $result['contactnum']; ?></td>
                <td>
                <form action="edit.php" method="post" style="display:inline;">
                        <input type="submit" name="edit" value="EDIT">
                        <input type="hidden" name="editid" value="<?php echo $result['id']; ?>">
                        <input type="hidden" name="editF" value="<?php echo $result['fname']; ?>">
                        <input type="hidden" name="editA" value="<?php echo $result['address1']; ?>">
                        <input type="hidden" name="editC" value="<?php echo $result['contactnum']; ?>">
                    </form>
                    <form action="delete.php" method="post" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
                        <input type="submit" name="delete" value="Delete" class="btn btn-delete">
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<button id="printButton" onclick="window.print()">Print</button>

</body>
</html>
