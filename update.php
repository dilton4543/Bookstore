<?php 
    include('db_connect.php');

    // Check if the form is submitted
    if(isset($_POST['update'])){
        // Sanitize and escape form inputs
        $id_to_update = mysqli_real_escape_string($conn, $_POST['id_to_update']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $publisher = mysqli_real_escape_string($conn, $_POST['publisher']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);

        // Create SQL query for updating the record in the database
        $sql = "UPDATE books SET name='$name', author='$author', publisher='$publisher', year='$year' WHERE id=$id_to_update";

        // Update record in the database and check for errors
        if(mysqli_query($conn, $sql)){
            // Redirect back to index.php after successful update
            header('Location:index.php');
            exit();
        }else{
            // Display error message if update fails
            echo "Error updating record: " . mysqli_error($conn);
        }
    }

    // Fetch book details for the selected book ID from the URL parameter
    if(isset($_GET['id'])){
        $id_to_update = mysqli_real_escape_string($conn, $_GET['id']);

        // Create SQL query to select book details by ID
        $sql = "SELECT * FROM books WHERE id=$id_to_update";

        // Execute SQL query
        $result = mysqli_query($conn, $sql);

        // Fetch the book details as an associative array
        $book = mysqli_fetch_assoc($result);
    } else {
        // Redirect to index.php if no book ID is provided in the URL
        header('Location:index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
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
        #updatebook{
            text-decoration:none;
        }
        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"] {
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

        footer {
            text-align: center;
            color: #808080;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" id="updatebook"><h1>Update Book</h1></a>
        <form action="update.php" method="POST">
            <input type="hidden" name="id_to_update" value="<?php echo htmlspecialchars($book['id']); ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($book['name']); ?>" required>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
            <label for="publisher">Publisher:</label>
            <input type="text" id="publisher" name="publisher" value="<?php echo htmlspecialchars($book['publisher']); ?>" required>
            <label for="year">Year:</label>
            <input type="text" id="year" name="year" value="<?php echo htmlspecialchars($book['year']); ?>" required>

            <input type="submit" name="update" value="Update Book">
        </form>
    </div>
    <footer>
        <p>&copy; 2024 Bookstores</p>
    </footer>
</body>
</html>
