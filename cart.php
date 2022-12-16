<?php
session_start();

include_once "dbConnection.php";

$user_id = $_SESSION['user_id'];

$sql = "SELECT p_type,p_desc,p_price,p_imgurl,p_title FROM c_products WHERE user_id=?";

         $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = $user_id;

        mysqli_stmt_bind_result($stmt,$type,$desc,$price,$img_url,$title);

        mysqli_stmt_execute($stmt);

         $totalprice=0;
?>

<?php include_once("components/header.php")?>

<h1 style="text-align: center;">Your Cart: </h1>

<?php while( mysqli_stmt_fetch($stmt)):?>
<div class="container mt-4">
<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img src="admindashboard/uploads/<?php echo $img_url;?>" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?php echo $title; ?></h5>
        <p class="card-text"><?php echo $desc?></p>
        <h5 class="card-title"><?php echo $price; ?> TK</h5>
      </div>
    </div>
  </div>
</div>
<hr>
</div>

<?php $int_price = (int) $price;
        $totalprice+=$int_price;
?>
<?php endwhile; ?>


<h1 style="text-align: center;">Your Total Price: <?php echo $totalprice;?></h1>

<?php if($totalprice>0): ?>
<div class="text-center mt-4 mb-3">
<a href="customerinfo.php" class="btn btn-success">Confirm Checkout</a>
</div>
<?php endif;?>


<?php include_once("components/footer.php")?>