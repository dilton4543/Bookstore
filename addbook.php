<?php
include('db_connect.php');

    if(isset($_POST['submit'])){
        //first store the data from the user into variables that we can use
        $name=mysqli_real_escape_string($conn, $_POST['name']); //the mysqli_real_escape_string enables us prevent users from injecting harmful code into our databse.
        $author=mysqli_real_escape_string($conn, $_POST['author']);
        $publisher=mysqli_real_escape_string($conn, $_POST['publisher']);
        $year=mysqli_real_escape_string($conn, $_POST['year']); 

        //now create sql query for storing in db
        $sql="INSERT INTO books(name,author,publisher,year) VALUES('$name','$author','$publisher','$year')";

        //save to db and check
        if(mysqli_query($conn,$sql)){
            echo "Book Added!";
            header('Location:index.php'); //if the query for inserting works redirect to homepage
        }else{
            echo 'Error in yoour sql query:'. mysqli_error($conn); //if not error, theres error in the query and it doesnt save.
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        #h11{
            color:black;
            text-decoration:none;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 6px 12px;
            cursor: pointer;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }
        footer{
            text-align:center;
            color:#808080;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><a href="index.php" id="h11">Bookstore</a></h1>

        <!-- Form for adding a book -->
        <form id="addForm" action="addbook.php" method="POST">
            <h2>Add a Book</h2>
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>
            <label for="genre">Publisher:</label>
            <input type="text" id="publisher" name="publisher" required>
            <label for="year">Year</label>
            <input type="number" id="year" name="year" min="0" step="1" required>
            <input type="submit" name="submit" value="Add Book">
        </form>
    </div>
    
    <footer>
        <p>Copyright 2024 @Bookstores</p>
    </footer>

    <!-- JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        // JavaScript code for handling AJAX requests and updating UI goes here
    </script>
</body>
</html>
