<?php
session_start();
?>

<?php
include_once "dbConnection.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];
    $number = $_POST['phnumber'];
    $address = $_POST['address'];
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO user_info(user_id,name,phone_number,address) VALUES(?,?,?,?)";
    $stmt = mysqli_prepare($conn,$sql);
    mysqli_stmt_bind_param($stmt, "isss", $param_user_id,$param_name, $param_phone,$param_address);

    $param_user_id = $user_id;
    $param_name=$name;
    $param_phone=$number;
    $param_address=$address;

    mysqli_stmt_execute($stmt);
  header("location:clearcheckout.php");




}


?>



<?php include_once("components/header.php")?>

<h1 style="text-align: center;">Enter your information</h1>

<div class="container mt-4">
<form action="" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label" >Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Phone Number</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="phnumber">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Address</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="address">
  </div>
  <button type="submit" class="btn btn-primary">Confirm information</button>
</form>

</div>



<?php include_once("components/footer.php")?>