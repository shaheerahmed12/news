<?php
if($_SESSION["role"]=='0'){
    header("Location: http://localhost/news/admin/post.php");
}
include "config.php";
$u_id= $_GET['id'];
$sql="DELETE  FROM user WHERE user_id='$u_id'";
$result=mysqli_query($conn,$sql) or die("failed");
if(!$result){
    echo"record can't delete";
}else{
    header("Location: http://localhost/news/admin/users.php");
}
?>