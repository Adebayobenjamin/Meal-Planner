<?php

    include 'config/db_config.php';


    $email = $menu = $ingredients = '';
    // errors
    $errors = ['email'=>'', 'menu'=> '','ingredients'=> '' ];
    if(isset($_POST['submit'])){

        // check email
        if(empty($_POST['email'])){
            $errors['email'] = 'an email is required';
        }
        else{
            $email = htmlspecialchars($_POST['email']);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Please enter a valid email address';
            }
        }

        // check menu
        if(empty($_POST['menu'])){
            $errors['menu'] = 'a menu is required';
        }
        else{
            $menu = htmlspecialchars($_POST['menu']) ;
            if(!preg_match('/^[a-zA-Z\s]+$/', $menu)){
                $errors['menu'] = 'Menu should contains letters and spaces only';
            }
        }
        
        // check ingredients

        if(empty($_POST['ingredients'])){
            $errors['ingredients'] = 'an ingredient is required';
        }
        else{
            $ingredients = htmlspecialchars($_POST['ingredients']) ;
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                $errors['ingredients'] = "Ingredients must be comma seperated list";
            }
        }

        if (array_filter($errors)){

        }
        else{
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $menu = mysqli_real_escape_string($conn, $_POST['menu']);
            $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

            // create sql

            $sql = "INSERT INTO food(menu,ingredients,email) VALUES('$menu', '$ingredients', '$email')";
            
            // save to db and check connection

            if(mysqli_query($conn, $sql)){
                header('Location: index.php');
            }
            else{
                echo 'Query Error:'. mysqli_error($conn);
            }
        }
    }
 ?>




<!DOCTYPE html>
<html lang="en">
<?php include 'templates/header.php' ?>


<section class="container white-text">
<h2 class="center"><?php echo 'Add to Menu' ?></h2>
<form action="" method="post" class="black form">
<label for="email">Email:</label>
<input type="text" name="email" id="" class="yellow-text" value='<?php echo htmlspecialchars($email) ?>'>
<div class="red-text"><?php echo $errors['email'] ?></div>
<label for="menu">Menu:</label>
<input type="text" name="menu" id="" class="yellow-text" value="<?php echo htmlspecialchars($menu);?>">
<div class="red-text"><?php echo $errors['menu'] ?></div>
<label for="ingredients">Ingredients(comma seperated):</label>
<input type="text" name="ingredients" id="" class="yellow-text"value='<?php echo htmlspecialchars($ingredients) ?>'>
<div class="red-text"><?php echo $errors['ingredients'] ?></div>
<div class="center">
<input type="submit" value="Submit" class="yellow btn brand" name="submit">
</div>
</form>
<?php// echo $email; echo $menu; echo $ingredients;?>
</section>




<?php include 'templates/footer.php'?> 
</body>
</html>