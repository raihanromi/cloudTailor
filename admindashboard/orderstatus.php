<?php 
include_once "../dbConnection.php";

$sql = "SELECT user_id,order_id FROM c_products";

//prapared statement
$result=mysqli_prepare($conn, $sql);

//Bind Result set in Variables
mysqli_stmt_bind_result($result, $user_id, $product_id); 

//Execute prepared Statement
mysqli_stmt_execute($result);

?>


<?php  include_once("dashboardheader.php")?>

<h1 style="text-align: center;">Customer oder status:</h1>

<div class="container mt-4">
<table class="table table hover">
  <thead class="table-dark">
    <tr>
      <th scope="col">User ID</th>
      <th scope="col">Product ID</th>
    </tr>
  </thead>
<?php while(mysqli_stmt_fetch($result)): ?>
  <tbody>
    <tr>
      <td><?php echo $user_id  ?></td>
      <td><?php echo $product_id ?></td>
    </tr>
  </tbody>
<?php endwhile; ?>
</table>

</div>

<?php  include_once("dashboardfooter.php")?>