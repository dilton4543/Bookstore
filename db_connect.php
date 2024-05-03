<?php 
    //connect to database
    $conn = mysqli_connect('localhost','root','','bookstore'); //takes in hostname, username, password and database name.
    if(!$conn){
        echo 'Connection error: '. mysqli_connect_error();
    }
?>