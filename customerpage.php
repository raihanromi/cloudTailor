
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true ){
    header("location:login.php");
}
?>

<?php include_once("components/header.php")?>

<div class="col d-flex justify-content-center mt-5">
<div class="card text-center">
  <div class="card-header">
  </div>
  <div class="card-body">
    <h5 class="card-title">Create New Dress</h5>
    <p class="card-text">You can create new dress with your own materials and design</p>
    <a href="createnewdress.php" class="btn btn-outline-dark">Go to the page</a>
  </div>
</div>
</div>

<div class="col d-flex justify-content-center mt-5">
<div class="card text-center">
  <div class="card-header">
  </div>
  <div class="card-body">
    <h5 class="card-title">Check Readymade Dress</h5>
    <p class="card-text">Check what other customer already created their dress</p>
    <a href="readymadedress.php" class="btn btn-outline-dark">check readymade dress</a>
  </div>
</div>
</div>

<?php include_once("components/footer.php")?>
