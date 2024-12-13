<?php
include "config.php";
if(isset($_FILES['fileToUpload'])){
    $error=array();

   $file_name=$_FILES['fileToUpload']['name'];
   $file_size=$_FILES['fileToUpload']['size'];
   $file_tmp=$_FILES['fileToUpload']['tmp_name'];
   $file_type=$_FILES['fileToUpload']['type'];
   $file_ext=end(explode('.',$file_name));
   $file_extensions=array('JPG','jpg','png','jpeg');
   if(in_array($file_ext,$file_extensions)===false){
    $error[]="this file not allowed";
   }
   if($file_size > 3097152){
    $error[]="file size must be 2mb";
   }
   if(empty($error)==true){
    move_uploaded_file($file_tmp,"upload/".$file_name);
   }
   else{
    print_r($error);
    die();
   }
}
session_start();
$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$post_desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
$Category = mysqli_real_escape_string($conn, $_POST['category']);
$date=date("d M,Y");
$author=$_SESSION['user_id'];
$sql1 = "INSERT INTO post (`title`, `description`, `category`, `post_date`, `author`, `post_img`) 
         VALUES ('$title', '$post_desc', '$Category', '$date', '$author', '$file_name')";

// Update category post count query
$sql2 = "UPDATE category SET post = post + 1 WHERE category_id = '$Category'";

// Execute the queries separately
if (mysqli_query($conn, $sql1) && mysqli_query($conn, $sql2)) {
    header("Location: http://localhost/news/admin/post.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
?>