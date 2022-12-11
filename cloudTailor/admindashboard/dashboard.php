<?php
include_once("../dbConnection.php");


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
                        header("location: createnewproduct.php");
                    }
                 }
                }

            }
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
<h1 style="text-align:center">Admin Dashboard</h1>
<h1 style="text-align:center">Login</h1>

<div class="container mt-4">

<form action="" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" >
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>



</body>
</html>


