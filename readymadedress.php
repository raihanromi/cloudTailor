<?php
session_start()
?>

<?php
include_once "dbConnection.php";

//SELECT data
$sql = "SELECT * FROM products";

//prapared statement
$result=mysqli_prepare($conn, $sql);

//Bind Result set in Variables
mysqli_stmt_bind_result($result, $id, $type, $description, $price, $img_url, $title); 

//Execute prepared Statement
mysqli_stmt_execute($result);

//Fetch  all data 
?>


<?php include_once("components/header.php") ?>

<h1 style="text-align: center;">Ready Made Dress</h1>

<div class="card-group mt-4">
<?php while(mysqli_stmt_fetch($result)){
echo ("<div class='card' style='width: 18rem'>
      <img src='admindashboard/uploads/$img_url' class='card-img-top' alt='...'>
      <div class='card-body'>
        <h5 class='card-title'>$title</h5>
        <h5 class='card-title'>$price tk</h5>
        <p class='card-text'>$description</p>
        <a href='addcart.php?pid=$id' class='btn btn-primary'>Add Cart</a>
      </div>
    </div>");
}
?>
</div>

<?php include_once("components/footer.php")?>