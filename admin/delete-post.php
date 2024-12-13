<?php
include "config.php";

$cat=$_GET['catid'];
$post=$_GET['id'];
$sql1="SELECT post_img from post WHERE  post_id=$post ";
$result1=mysqli_query($conn,$sql1);
$row=mysqli_fetch_assoc($result1);
unlink("upload/".$row['post_img']);

$sql="Delete FROM post WHERE post_id=$post;";
$sql.="UPDATE category SET post=post-1 WHERE category_id=$cat;";
$result=mysqli_multi_query($conn,$sql);
if($result){
    header("Location: http://localhost/news/admin/post.php");
}


?>