<?php include "header.php"; 
if($_SESSION["role"]=='0'){
    header("Location: http://localhost/news/admin/post.php");
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">Add User</a>
            </div>
            <div class="col-md-12">
                <?php
                include "config.php";
                if(isset($_GET['page'])){
                    $pages=$_GET['page'];
                }else{
                    $pages=1;
                }
                
                $limit=4;
                
                $offset=($pages-1)* $limit;
                $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT $offset,$limit ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                ?>
                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Full Name</th>
                                <th>User Name</th>
                                <th>Role</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            while ($rows = mysqli_fetch_assoc($result)) { ?>   
                                <tr>
                                    <td class='id'><?php echo $rows['user_id']; ?></td>
                                    <td><?php echo $rows['first_name'] . ' ' . $rows['last_name']; ?></td>
                                    <td><?php echo $rows['username']; // Fixed possible space issue ?></td>
                                    <td><?php if($rows['role']==1) {
                                        echo "admin";
                                    } 
                                    
                                    else{ 
                                        echo "normal people";
                                    }
                                     ?></td>
                                    <td class='edit'><a href='update-user.php?id=<?php echo $rows['user_id'];  ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-user.php?id=<?php echo $rows['user_id']; ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <p>No users found.</p>
                <?php } 
                $query="SELECT * FROM user";
                $results =mysqli_query($conn,$query);
                if(mysqli_num_rows($results)>0){
                    $total_records=mysqli_num_rows($results);
                    
                    $total_page=ceil($total_records/$limit);
                     echo"<ul class='pagination admin-pagination'> ";
                    //  if($pages>1){
                    //     echo '<li class=$active><a href="users.php?page='.($pages-1).'">prev</a></li>';
                    //  };
                    for($i=1; $i<=$total_page;$i++){
                        // if($i==$pages){
                        //     $active="active";
                        // }else{
                        //     $active="";
                        // }
                        echo "<li class=''><a href='users.php?page=$i'>$i</a></li>";
                    }
                         
                        //  if($total_page>$pages){
                        //     echo '<li class=$active><a href="users.php?page='.($pages+1).'">next</a></li>';
                        //  }
                    
                
                  
                }
                
                ?>
               
                    <!-- <li class="active"><a>1</a></li>
                    <li><a>2</a></li> -->
                    
                </ul>
            </div>
        </div>
    </div>
</div>