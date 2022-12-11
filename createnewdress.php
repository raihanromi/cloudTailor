<?php session_start();?>


<?php
include_once "dbConnection.php";

//SELECT data
$sql = "SELECT * FROM products WHERE product_type !=?";


//prapared statement
$result=mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param($result,"s",$param_type);

$param_type='readymadedress';




//Bind Result set in Variables
mysqli_stmt_bind_result($result, $id, $type, $description, $price, $img_url, $title); 

//Execute prepared Statement
mysqli_stmt_execute($result);

//Fetch  all data 
?>





<?php include_once("components/header.php")?>


<h1 style="text-align:center">Create New Dress</h1>


<?php while(mysqli_stmt_fetch($result)):?>
    <div class="container mt-4">
<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="admindashboard/uploads/<?php echo $img_url;?>" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $title; ?></h5>
        <p class="card-text"><?php echo $description?></p>
        <h5 class="card-title"><?php echo $price; ?> TK</h5>
        <a href="addcart.php?pid=<?php echo $id?>" class='btn btn-primary'>Add</a>
      </div>
    </div>
  </div>
</div>
<hr>
</div>
<?php endwhile;?>


<?php include_once("components/footer.php")?>