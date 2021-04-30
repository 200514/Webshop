<?php
include('../core/header.php');
include('../core/checklogin_admin.php');
?>

    <h1>Add Category</h1>

<?php
if (isset($_POST['cat_name']) && $_POST['cat_desc'] != "" && isset($_POST['cat_name']) && $_POST['cat_desc']) {
    $cat_name = $con->real_escape_string($_POST['cat_name']);
    $cat_desc = $con->real_escape_string($_POST['cat_desc']);
    $active = $con->real_escape_string($_POST['active']);

    $liqry1 = $con->prepare("INSERT INTO category (name, description, active) VALUES (?, ?, ?)");
    if($liqry1 === false) {
        echo mysqli_error($con);
    } else{
        $liqry1->bind_param('sss',$cat_name,$cat_desc, $active);
        if($liqry1->execute()){
            echo "Category user with name " . $cat_name . " and description " . $cat_desc . " Added! ";
            header('Refresh: 2; index.php');
        }
    }

}
?>

    <form action="" method="POST">
        Category Name: <input type="text" name="cat_name" value=""><br>
        Category Description: <input type="text" name="cat_desc" value=""><br>
        Category Active: <select name="active"><option value="1">Yes</option><option value="0">No</option></select><br>
        <input type="submit" name="submit" value="Add">
        <a href="index.php">Go Back</a>
    </form>



<?php
include('../core/footer.php');
?>