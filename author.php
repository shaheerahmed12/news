<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                        <?php
                        if(isset($_GET['aid'])){
                        $author_id=$_GET['aid'];};
                        $limit=3;
                        if(isset($_GET['page'])){
                            $page=$_GET['page'];
                        }else{
                            $page=1;
                        }
                        $offset=($page-1)*$limit;
                        $sql="Select * From post  JOIN category ON post.category=category.category_id
                         JOIN user ON post.author=user.user_id ORDER BY post.post_id DESC LIMIT $offset,$limit  ";
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
                        LEFT JOIN user ON post.author=user.user_id WHERE author=$author_id ";
                    $result1=mysqli_query($conn,$sql1);
                   
                    $total_row=mysqli_num_rows($result1);
                    $quantity=mysqli_fetch_assoc($result1);
                    $total_page=ceil($total_row/$limit);
                    if($total_row>3){
                    for($i=1;$i<=$total_page;$i++){
                          if($i==$page){
                        echo "<li class='active ' ><a href='author.php?page=$i&aid=$author_id'> $i</a></li>";
                    }
                    else{
                        echo "<li class='' ><a href='author.php?page=$i&aid=$author_id'> $i</a></li>";
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
