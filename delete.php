<?php

require('./database.php');

if(isset($_POST['delete'])){
    $id = $_POST['id'];
    $squeryDelete = "DELETE FROM isko WHERE ID= $id";
    $sqlDelete = mysqli_query($connection, $squeryDelete); 
    
    echo '<script>alert("successfully Delete!")</script>';
    echo '<script>window.location.href = "/elaine/admin.php "</script>';
}
    
?>