<?php
     include 'config/db_config.php';

    // write query for all foods
    $sql = "SELECT menu, ingredients, id, created_at FROM food ORDER BY created_at ";
    // make query and get result
    $result = mysqli_query($conn, $sql);
    
    // fetch the resulting row as an array
    $foods = mysqli_fetch_all($result, MYSQLI_ASSOC);
    //free result from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php'; ?>
<?php include 'config/db_config.php' ?>
<div class="container">
    <h3 class="white-text center">Menu!</h3>
    <div class="row">
    <?php foreach($foods as $food){ ?>
        <div class="col s6 md3">
        <div class="card black">
        <div class="card-content center">
        <h6 class="red-text"><?php echo htmlspecialchars($food['menu']); ?></h6>
        <div class="white-text" id="ingredients"><?php echo htmlspecialchars($food['ingredients']) ;?></div>
        </div>
        <div class="card-action right-align">
        <a href="details.php?id=<?php echo $food['id'] ?>"class="yellow-text">More Info</a>
        </div>
        </div>
        </div>

    <?php } ?>
    </div>
</div>

   <?php include 'templates/footer.php'; ?>
</html>