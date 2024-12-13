<?php include "admin/config.php";
$page=basename($_SERVER['PHP_SELF']);
switch($page){
  case "single.php":
    
  if(isset($_GET['id'])){
    $sql_title="Select * FROM post WHERE post_id={$_GET['id']}";
    $result_title=mysqli_query($conn,$sql_title);
    $row_title=mysqli_fetch_assoc($result_title);
    if($row_title>0){
    $page_title=$row_title['title']." News";
}
else{
    $page_title="not found";
    header("Location: http://localhost/news/not-found.php");
    break;
}
  }
  else{
    $page_title="page not found";
  }
  break;
  case "category.php":
    if(isset($_GET['category'])){
        $sql_title="Select * FROM category WHERE category_id={$_GET['category']}";
        $result_title=mysqli_query($conn,$sql_title);
        $row_title=mysqli_fetch_assoc($result_title);
        if($row_title>0){
        $page_title=$row_title['category_name']." News";
    }
    else{
        $page_title="not found";
        header("Location: http://localhost/news/not-found.php");
        break;
    }
      }
      else{
        $page_title="page not found";
      }
      break;
      case "author.php":
        if(isset($_GET['aid'])){
            $sql_title="Select * FROM user WHERE user_id={$_GET['aid']}";
            $result_title=mysqli_query($conn,$sql_title);
            $row_title=mysqli_fetch_assoc($result_title);
            if($row_title>0){
            $page_title=$row_title['username']." News";
        }
        else{
            $page_title="not found";
            header("Location: http://localhost/news/not-found.php");
            break;
        }
          }
          else{
            $page_title="page not found";
          }
          break;
          case "search.php":
            if(isset($_GET['search'])){
                $page_title=$_GET['search']." News";
            }
            else{
                $page_title="not found";
                header("Location: http://localhost/news/not-found.php");
                break;
            }
              
              
              break;
 
          default :
          $page_title="News";
          break;
            }




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                $sql="SELECT * FROM category where post >0";
                $result=mysqli_query($conn,$sql);?>
                        
                      
                <ul class='menu'>
                <?php if(mysqli_num_rows($result)>0){
                    while($row=mysqli_fetch_assoc($result)){
                        if(isset($_GET['category'])){
                            $category=$_GET['category'];
                        if($row['category_id']==$category){
                            $active="active";
                        }else{
                            $active="";
                        }


                        
                    }
                        ?>
                    
                    <li><a class='<?php echo $active?>' href='category.php?category=<?php echo $row['category_id'] ?>'><?php echo $row['category_name'] ?></a></li>
                   
                    <?php
                    }}    
                ?>

                </ul>
               
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
