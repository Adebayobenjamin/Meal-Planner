<?php
    // connect to database

    $conn = mysqli_connect('localhost', 'benji', 'benjilocalhost', 'buka spot');
    
    // check connection error
    if(!$conn){
        echo 'Connection Error:'. mysqli_connect_error();
    }
?> 