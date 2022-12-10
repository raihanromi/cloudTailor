<?php
session_start();
include_once "dbConnection.php";
$id = $_GET['pid'];

$sql = "SELECT product_type,product_desc,product_price,product_img,product_title FROM products WHERE product_id=?";

         $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $param_id);

        $param_id = $id;

        mysqli_stmt_bind_result($stmt,$type,$desc,$price,$img_url,$title);

        mysqli_stmt_execute($stmt);
        
        mysqli_stmt_fetch($stmt);

      
        $customer_product_type= $type;
        $customer_product_desc= $desc;
        $customer_product_price= $price;
        $customer_product_title= $title;
        $customer_product_imgurl= $img_url;

        mysqli_stmt_close($stmt);

        $user_id = $_SESSION['user_id'];

        $sql = "INSERT INTO c_products(user_id,p_type,p_desc,p_title,p_price,p_imgurl) VALUES(?,?,?,?,?,?)";

         $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "isssss", $param_id,$param_type, $param_desc,$param_title,$param_price,$param_img);


        $param_id = $user_id;
        $param_type = $customer_product_type;
        $param_desc =  $customer_product_desc;
        $param_title= $customer_product_title;
        $param_price = $customer_product_price;
        $param_img = $customer_product_imgurl;

        mysqli_stmt_execute($stmt);
        header("location: cart.php");


                


?>