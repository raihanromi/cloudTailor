<?php include_once('components/header.php')?>

 <?php
 session_start();
//check if the user is login
if(isset($_SESSION['username'])){
    header("location:customerpage.php");
    exit;
}

require_once "dbConnection.php";
$username = $password = "";
$err = "";

//if request method is post
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['username']))){
        $err = "Please enter username or password";
    }else{
         $username = trim($_POST["username"]);
         $password = trim($_POST["password"]);
    }

    if(empty($err)){
        $sql = "SELECT user_id,username,password FROM users WHERE username=?";
         $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;
        //Try to execute this statement
            if(mysqli_stmt_execute($stmt)){        
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)==1){
                 mysqli_stmt_bind_result($stmt,$user_id,$username,$hashed_password);
                 if(mysqli_stmt_fetch($stmt)){ 
                    if(password_verify($password,$hashed_password)){
                        //this mean password is correct
                        session_start();
                        $_SESSION["username"]=$username;
                        $_SESSION["user_id"]=$user_id;
                        $_SESSION["loggedin"]=true;
                        //redirect user
                        header("location: customerpage.php");
                    }
                 }
                }

            }
    }
}

?>


<div class="container mt-4">
    <h3>Please Login Here:</h3>
    <form action="" method="post">  
  <div class="col-md-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter username">
  </div>
  <div class="col-md-3 mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Enter password">
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<?php include_once('components/footer.php')?>