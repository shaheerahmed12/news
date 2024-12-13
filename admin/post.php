<?php include "header.php";
$limit=3;
if(isset($_GET['page'])){
    $page=$_GET['page'];
}else{
    $page=1;
}
$offset=($page-1)*$limit;
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                        include "config.php";
                        
                        if($_SESSION['role']==1){
                        $sql="Select * From post LEFT JOIN category ON post.category=category.category_id
                                LEFT JOIN user ON post.author=user.user_id ORDER BY post.post_id DESC LIMIT $offset,$limit ";
                       }else{
                            $sql="Select * From post LEFT JOIN category ON post.category=category.category_id
                                LEFT JOIN user ON post.author=user.user_id ORDER BY post.post_id DESC LIMIT $offset,$limit WHERE author={$_SESSION['user_id']}"  ;
                        }
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_assoc($result)){?>
                            <tr>
                              <td class='id'><?php echo $row['post_id']?></td>
                              <td class='id'><?php echo $row['title']?></td>
                              <td class='id'><?php echo $row['category_name']?></td>
                              <td class='id'><?php echo $row['post_date']?></td>
                              <td class='id'><?php echo $row['username']?></td>
                              <td class='edit'><a href='update-post.php?id=<?php echo $row['post_id']; ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?php echo $row['post_id']; ?>&catid=<?php echo $row['category']; ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
<?php
                            }
                        }
                        ?>
                          
                          
                      </tbody>
                  </table>
                  <ul class='pagination admin-pagination'>
                    <?php
                    $sql1="SELECT * FROM post";
                    $result1=mysqli_query($conn,$sql1);
                    $total_row=mysqli_num_rows($result1);
                    $total_page=ceil($total_row/$limit);
                    for($i=1;$i<=$total_page;$i++){
                          if($i==$page){
                        echo "<li class='active ' ><a href='post.php?page=$i'> $i</a></li>";
                    }
                    else{
                        echo "<li class='' ><a href='post.php?page=$i'> $i</a></li>";
                    }
                    }?>
                    </ul>
                 
                      
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
