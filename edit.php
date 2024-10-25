<?php
require('./database.php');

$editid = '';
$editF = '';
$editA = '';
$editC = '';

if (isset($_POST['edit'])) {
    $editid = $_POST['editid'];
    $editF = $_POST['editF'];
    $editA = $_POST['editA'];
    $editC = $_POST['editC'];
}

if (isset($_POST['update'])) {
    $updateid = $_POST['updateid'];
    $updateF = mysqli_real_escape_string($connection, $_POST['updateF']);
    $updateA = mysqli_real_escape_string($connection, $_POST['updateA']);
    $updateC = mysqli_real_escape_string($connection, $_POST['updateC']);

    $queryupdate = "UPDATE isko SET fname = '$updateF', address1 = '$updateA', contactnum = '$updateC' WHERE id = $updateid";
    $sqlupdate = mysqli_query($connection, $queryupdate);

    if ($sqlupdate) {
        echo '<script>alert("Successfully Updated!")</script>';
        echo '<script>window.location.href = "/elaine/admin.php"</script>';
    } else {
        echo '<script>alert("Failed to Update: ' . $connection->error . '")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Scholar Info</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Georgia', serif;
            background: url('bgweb.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            min-height: 100vh;
        }

        .container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 100%;
            text-align: center;
            transition: transform 0.6s ease-in-out;
        }

        .container:hover {
            transform: scale(1.02);
        }

        h1 {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }

        form h3 {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 10px;
        }

        .input-field {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease;
        }

        .input-field:focus {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            outline: none;
            border-color: #56ab2f;
        }

        .btn-submit {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(45deg, #56ab2f, #a8e063);
            color: white;
            font-weight: bold;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: linear-gradient(45deg, #4facfe, #00f2fe);
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        .btn-submit:active {
            transform: scale(1);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 600px) {
            .container {
                width: 90%;
                padding: 30px;
            }

            h1 {
                font-size: 1.5em;
            }

            form h3 {
                font-size: 1em;
            }

            .input-field {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Scholar Information</h1>
        <form action="" method="post">
            <h3>Update Information</h3> 
            <input type="text" class="input-field" name="updateF" placeholder="Full Name" value="<?php echo $editF ?>" required />
            <input type="text" class="input-field" name="updateA" placeholder="Address" value="<?php echo $editA ?>" required />
            <input type="text" class="input-field" name="updateC" placeholder="Contact Number" value="<?php echo $editC ?>" required />
            <input type="hidden" name="updateid" value="<?php echo $editid ?>"/>
            <input type="submit" class="btn-submit" name="update" value="Update">
        </form>
    </div>
</body>
</html>
