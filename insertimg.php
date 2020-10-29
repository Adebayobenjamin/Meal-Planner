
<!DOCTYPE html>
<html lang="en">
<?php
include 'templates/header.php';
// include 'config/db_config.php'; 
?>
<?php
$conn2 = mysqli_connect('localhost', 'root', '', 'images');
if(!$conn2){
    echo "connection Error:". mysqli_connect_error();
}
if(isset($_POST['submit1'])){
    // if(!empty($_POST['image'])){
        $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));

 $sql = "INSERT INTO `table1` (`img1`) VALUES('$image')";
    if(!mysqli_query($conn2, $sql)){
        echo mysqli_error($conn2);
    }
//     }
//     else{
//         echo "Error";
// }
};




 ?>


<form action="" method="post" enctype='multipart/form-data'class="black" >
<input type="file" name="image" id="image" class="yellow-text"><br>
<input type="submit" value="Upload" name="submit1" id="insert"class="btn yellow">
<input type="submit" value="Display" name="submit2" id="insert"class="btn yellow">
</form>
<div class="container">
<?php

if(isset($_POST['submit2'])){
    $sql = 'SELECT * FROM table1';
    $result = mysqli_query($conn2, $sql);
    $table1 = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn2);
  

 foreach($table1 as $table){ 
    echo '<img src="data:image/jpeg;base64, '.base64_encode($table['img1']).'" height="100px" width="100px"/>';
 }}?>
</div>


<?php include 'templates/footer.php';
 ?>
 <script src="script.js"></script>
</html>
