<?php 

include "header.php"; 
include "config.php";
if($_SESSION["role"]=='0'){
    header("Location: http://localhost/news/admin/post.php");
}
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $u_id = intval($_GET['id']); // Ensure user ID is an integer

    if (isset($_POST['submit'])) {
        // Get form data with validation
        $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
        $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
        $user = mysqli_real_escape_string($conn, $_POST['username']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);
        
        // Update query
        $sql1 = "UPDATE user SET first_name='$fname', last_name='$lname', username='$user', role='$role' WHERE user_id='$u_id'";
        $result = mysqli_query($conn, $sql1);

        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        } else {
            header("Location: http://localhost/news/admin/users.php");
            // echo "<p>User details updated successfully.</p>"; // Feedback for successful update
        }
    }

    // Fetch user details
    $sql = "SELECT * FROM user WHERE user_id = $u_id";
    $result = mysqli_query($conn, $sql) or die("Query failed: " . mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        $rows = mysqli_fetch_assoc($result);
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id=' . $u_id); ?>" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="user_id" class="form-control" value="<?php echo $rows['user_id']; ?>" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="f_name" class="form-control" value="<?php echo $rows['first_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="l_name" class="form-control" value="<?php echo $rows['last_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $rows['username']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role" required>
                            <option value="0" <?php if($rows['role'] == 0) echo 'selected'; ?>>Normal User</option>
                            <option value="1" <?php if($rows['role'] == 1) echo 'selected'; ?>>Admin</option>
                        </select>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />
                </form>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>

<?php 
    } else {
        echo "<p>No user found with that ID.</p>";
    }
} else {
    echo "<p>Invalid user ID.</p>";
}

include "footer.php"; 
?>