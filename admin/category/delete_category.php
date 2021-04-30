<?php
include('../core/header.php');
include('../core/checklogin_admin.php');
?>

    <h1>Delete Category</h1>

<?php
if (isset($_POST['submit']) && $_POST['submit'] != '') {
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
    $id = $con->real_escape_string($_POST['id']);
    $query = $con->prepare("DELETE FROM category WHERE category_id = ? LIMIT 1;");
    if ($query === false) {
        echo mysqli_error($con);
    }

    $query->bind_param('i',$id);
    if ($query->execute() === false) {
        echo mysqli_error($con);
    } else {
        echo '<div style="border: 2px solid dodgerblue; width: fit-content;">Category with category_id '.$id.' deleted!</div>';
        header('Refresh: 2; index.php');
    }
    $query->close();

}
?>


<?php
if (isset($_GET['id']) && $_GET['id'] != '') {

    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

        <h2 style="color: red">Are you sure you want to delete this category?</h2><?php

        $id = $con->real_escape_string($_GET['id']);

        $liqry = $con->prepare("SELECT category_id, name FROM category WHERE category_id = ? LIMIT 1;");
        if($liqry === false) {
            echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$id);
            $liqry->bind_result($id,$name);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    echo '$productId: ' . $id . '<br>';
                    echo '<input type="hidden" name="id" value="' . $id . '" />';
                    echo '$name: ' . $name . '<br>';
                }
            }
        }
        $liqry->close();

        ?>
        <br>
        <input type="submit" name="submit" value="Yes, delete!">
        <a href="index.php">Go back</a>
    </form>
    <?php

}
?>

<?php
include('../core/footer.php');
?>