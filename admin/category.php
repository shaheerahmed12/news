<?php include "header.php"; 
include "config.php";
if($_SESSION["role"]=='0'){
    header("Location: http://localhost/news/admin/post.php");
}
if(isset($_GET['page'])){
    $pages=$_GET['page'];
}else{
    $pages=1;
}

$limit=3;

?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        
                        
                        $offset=($pages-1)* $limit;
                        $sql="SELECT * FROM category ORDER BY category_id DESC LIMIT $offset,$limit";
                        $result=mysqli_query($conn,$sql);
                        if(mysqli_num_rows($result)>0){
                            while ($rows = mysqli_fetch_assoc($result)) { ?>   
                                <tr>
                                    <td class='id'><?php echo $rows['category_id']; ?></td>
                                    <td><?php echo $rows['category_name']; ?></td>
                                    <td><?php echo $rows['post']; // Fixed possible space issue ?></td>
                                    <td class='edit'><a href='update-category.php'><i class='fa fa-edit'></i></a></td>
                            <td class='delete'><a href='delete-category.php'><i class='fa fa-trash-o'></i></a></td>
                            <tr>
                       <?php }}?>
                        
                        
               
                    </tbody>
                </table>
                <?php
                
                $sql1="SELECT * FROM category";
                $result1=mysqli_query($conn,$sql1);
                if(mysqli_num_rows($result1)>0){
                $total_row=mysqli_num_rows($result1);
                $total_pages=ceil($total_row/$limit);
                echo"<ul class='pagination admin-pagination'> ";
                for($i=1; $i<=$total_pages;$i++){
                    if($pages==$i){
                        echo "<li class='active'><a href='category.php?page=$i'>$i</a></li>";
                    }
                    else{
                    echo "<li class=''><a href='category.php?page=$i'>$i</a></li>";
                }
                }
            }

                ?>
                </ul>
                    <!-- <li class="active"><a>1</a></li> -->
                    
                
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
