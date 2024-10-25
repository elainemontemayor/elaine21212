<?php

require('./database.php');

if(isset($_POST['create'])){
    $fname = $_POST['fname'];
    $address1 = $_POST['address1'];
    $contactnum = $_POST['contactnum'];
    $querryCreate = "INSERT INTO isko VALUES (null, '$fname', '$address1' , '$contactnum')";
    $sqlCreate = mysqli_query($connection, $querryCreate); 
    
    echo '<script>alert("successfully Created!")</script>';
    echo '<script>window.location.href = "/elaine/admin.php "</script>';
}
    
?>