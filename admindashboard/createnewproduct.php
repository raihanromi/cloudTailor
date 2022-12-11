<?php 

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "../dbConnection.php";

	echo "<pre>";
	print_r($_FILES['my_image']);
	echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];
    $product_type = $_POST['p_type'];
    $product_desc = $_POST['p_desc'];
    $product_price = $_POST['p_price'];
    $product_title = $_POST['p_title'];

	if ($error === 0) {
		if ($img_size > 12500000) {
			$em = "Sorry, your file is too large.";
		    header("Location: createnewproduct.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "INSERT INTO products(product_img,product_type,product_desc,product_price,product_title) 
				        VALUES('$new_img_name','$product_type','$product_desc','$product_price','$product_title')";
				mysqli_query($conn, $sql);
				header("Location: createnewproduct.php");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: createnewproduct.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: createnewproduct.php?error=$em");
	}

}else {
	// header("Location: createnewproduct.php");
}


?>


<?php  include_once("dashboardheader.php")?>

<h1 style="text-align:center;">Create New Product: </h1>

<div class="container mt-4">
<form action="" method="post" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Put image:</label>
    <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="my_image">
  </div>
    <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Title:</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="p_title">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Description:</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="p_desc">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Price:</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="p_price">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Dress Type:</label>
    <input type="text" class="form-control" id="exampleInputPassword1" name="p_type">
  </div>
  <!-- <button type="submit" class="btn btn-primary" name="submit" value="Upload">Submit</button> -->
    <div class="mb-3">
    <input type="submit" class="btn btn-primary" id="exampleInputPassword1" name="submit" value="Upload">
  </div>
  
</form>

</div>

<?php  include_once("dashboardfooter.php")?>