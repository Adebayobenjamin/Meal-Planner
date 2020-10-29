<?php 
include 'config/db_config.php';
if(isset($_POST['delete'])){
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    $sql = "DELETE FROM food WHERE id = $id_to_delete";
    if(mysqli_query($conn, $sql)){
        header('Location: index.php');
    }
    else{
        echo "query error: ". mysqli_error($conn);
    }

}

if(isset($_GET['id'])){
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM food WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    $food = mysqli_fetch_assoc($result);
    
    mysqli_free_result($result);
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php' ?>
<div class="container center white-text">
<?php if($food):?>
<h4 class="red-text"><?php echo htmlspecialchars($food['menu']) ?></h4>
<p><span class="yellow-text">Ingredints:</span> <?php echo htmlspecialchars($food['ingredients']) ?></p>
<p><span class="yellow-text">Prepared by: </span><?php echo htmlspecialchars($food['email']) ?></p>
<p><span class="yellow-text">Created at: </span><?php echo htmlspecialchars($food['created_at']) ?></p>
<a href="index.php" class="btn yellow">Home</a>
    <br><br>
<form action="details.php" method="post">
    <input type="hidden" name="id_to_delete" value="<?php echo $food['id'] ?>">
    <input type="submit" value="Delete" class="btn red" name="delete">
</form>
<?php else: ?>
<h4><?php echo "NO such Menu Exists" ?></h4>
<?php endif;?>

</div>

<?php include 'templates/footer.php' ?>
</html>