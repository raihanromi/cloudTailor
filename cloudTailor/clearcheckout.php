<?php 
session_start();
$user_id=$_SESSION['user_id'];
include_once "dbConnection.php";


$sql="DELETE FROM c_products WHERE user_id=?";

$stmt=mysqli_prepare($conn,$sql);
mysqli_stmt_bind_param($stmt,"s",$param_id);
$param_id=$user_id;
mysqli_stmt_execute($stmt);

header("location:cart.php");


?>