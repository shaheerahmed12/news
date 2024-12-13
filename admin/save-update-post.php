<?php
include "config.php";
if(empty($_FILES['new-image']['name'])){
    $file_name=$_POST['old-image'];
}else{

    $error=array();

   $file_name=$_FILES['new-image']['name'];
   $file_size=$_FILES['new-image']['size'];
   $file_tmp=$_FILES['new-image']['tmp_name'];
   $file_type=$_FILES['new-image']['type'];
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
$post_id=mysqli_real_escape_string($conn, $_POST['post_id']);
$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$post_desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
$Category = mysqli_real_escape_string($conn, $_POST['category']);
$sql="UPDATE post SET title='$title',description='$post_desc',category='$Category',post_img=' $file_name ' Where post_id=$post_id";

$result=mysqli_query($conn,$sql);
if($result){
    header("Location: http://localhost/news/admin/post.php");
}

?>