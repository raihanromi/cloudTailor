
<?php
session_start();
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true ){
    header("location:login.php");
}
?>

<?php include_once("components/header.php")?>

<h1>Customer : <?php echo $_SESSION['username']; ?></h1>

<?php include_once("components/footer.php")?>
