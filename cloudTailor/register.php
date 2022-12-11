<?php include_once('components/header.php')?>

<?php
require_once("dbConnection.php");

$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Username cannot be blank";
    } else {
        $sql = "SELECT user_id FROM users WHERE username=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            //Set the value of param username
            $param_username = trim($_POST['username']);

            //Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken";
                } else {
                    $username = trim($_POST['username']);
                }
            } else {
                echo "something went wrong";
            }
        }
    }
    mysqli_stmt_close($stmt);


    //check if email is empty
    if (empty(trim($_POST["email"]))) {
        $email_err = "Email cannot be blank";
    } else {
        $sql = "SELECT user_id FROM users WHERE email=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            //Set the value of param username
            $param_email = trim($_POST["email"]);

            //Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "This email is already taken";
                } else {
                    $email = trim($_POST['email']);
                }
            } else {
                echo "something went wrong";
            }
        }
    }
    mysqli_stmt_close($stmt);


    //check for password
    if (empty(trim($_POST['password']))) {
        $password_err = "Password cannot be blank";
    } elseif (strlen(trim($_POST['password'])) < 5) {
        $password_err = "Password cannot be less than 5 characters";
    } else {
        $password = trim($_POST['password']);
    }

    //Check for confirm password field
    if (trim($_POST['password']) != trim($_POST['confirm_password'])) {
        $password_err = "Password should match";

    }

    // If there were no errors, insert into the database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)) {
        $sql = "INSERT INTO users (username,email,password) VALUES(?,?,?)";
        $stmt = mysqli_prepare($conn,$sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username,$param_email,$param_password);

            //Set these parameters
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT);

            //Try to execute the query
            if (mysqli_stmt_execute($stmt)) {

                header("location: login.php");
            } else {
                echo "Something went wrong...";
            }
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}


?>

<div class="container mt-4">
    <h3>Create New Account:</h3>
    <br>
    <form action="" method="post">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Username</label>
    <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Username">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="inputPassword4" placeholder="Email">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="inputPassword4" placeholder="Password" >
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name="confirm_password" id="inputPassword4" placeholder="Confirm Password">
  </div>
  <div class="col-12 mt-4">
    <button type="submit" class="btn btn-primary">Sign in</button>
  </div>
</form>
</div>

<?php include_once('components/footer.php')?>