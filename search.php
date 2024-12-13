<?php include 'header.php'; 
include "admin/config.php";
if(isset($_GET['search'])){
    $search_term=$_GET['search'];};
    $limit=3;
    if(isset($_GET['page'])){
        $page=$_GET['page'];
    }else{
        $page=1;
    }
    $offset=($page-1)*$limit;
?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                <h2 class="page-heading">Search : <?php echo $search_term?></h2>
                  <?php
                        
                        $sql="Select * From post LEFT JOIN category ON post.category=category.category_id
                        LEFT JOIN user ON post.author=user.user_id  WHERE post.title LIKE '%{$search_term}%' OR 
                         username LIKE '%{$search_term}%'OR 
                         category_name LIKE '%{$search_term}%'
                       
                        ORDER BY post.post_id DESC LIMIT $offset,$limit    ";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0){
                            while($row=mysqli_fetch_assoc($result)){?>
                       
                        <div class="post-content">
                           
                            <div class="row">
                            
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $row['post_id']?>"><img src="admin/upload/<?php echo $row['post_img'];?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?php echo $row['post_id']?>'><?php echo $row['title']?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php'><?php echo $row['category_name']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $row['author'] ?>'><?php echo $row['username']?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $row['post_date']?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?php echo $row['description']?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                            }}
                            else{
                                echo "<h1>No records</h1>";
                            }
                        ?>
                     
                     <ul class='pagination admin-pagination'>
                    <?php
                    
                    // $sql1="SELECT * FROM category WHERE category_id=$category";
                    $sql1="Select * From post LEFT JOIN category ON post.category=category.category_id
                        LEFT JOIN user ON post.author=user.user_id  WHERE post.title LIKE '%{$search_term}%' OR  post.description LIKE '%{$search_term}%'";
                    $result1=mysqli_query($conn,$sql1);
                   
                    $total_row=mysqli_num_rows($result1);
                    $quantity=mysqli_fetch_assoc($result1);
                    $total_page=ceil($total_row/$limit);
                    if($total_row>3){
                    for($i=1;$i<=$total_page;$i++){
                          if($i==$page){
                        echo "<li class='active ' ><a href='search.php?page=$i&search=$search_term'> $i</a></li>";
                    }
                    else{
                        echo "<li class='' ><a href='search.php?page=$i&search=$search_term'> $i</a></li>";
                    }
                }
                    }?>
                    </ul>
                    
                                     
                    
                    
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
