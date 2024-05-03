<?php 
    include ('db_connect.php');

    // Initialize variable to store the search query
    $search = '';

    // Check if search form is submitted
    if(isset($_POST['search'])) {
        // Get the search query
        $search = mysqli_real_escape_string($conn, $_POST['search']);
    }

    // Create SQL query with search functionality
    $sql = "SELECT * FROM books WHERE name LIKE '%$search%' OR author LIKE '%$search%' OR publisher LIKE '%$search%' ORDER BY id";

    // Fetch the result from the database
    $result = mysqli_query($conn, $sql);

    // Fetch all the data from the result and convert to an associative array
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC); 
    
    if(isset($_POST['delete'])){
        // Retrieve the ID of the book to delete from the form submission
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
    
        // Create the SQL query to delete the book from the database
        $sql = "DELETE FROM books WHERE id = $id_to_delete";
    
        // Execute the SQL query
        if(mysqli_query($conn, $sql)){
            // Book successfully deleted
            echo "Book removed!";
        }else{
            // Error occurred during deletion
            echo "Error in your query: " . mysqli_error($conn);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book list</title>
    <style>
        /* Common styles for all screen sizes */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            /* background-image: url('images/backgroundimg.jpeg');
            /* Set background image size to cover the entire viewport */
            background-size: cover;
            /* Set background image to fixed so it doesn't scroll with the content */
            background-attachment: fixed;
            /* Center the background image horizontally and vertically */
            background-position: center center; */
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
        }

        .book {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Add gap between book items */
            
        }

        .book-item {
            width: calc(32% - 20px); /* Three columns in desktop view */
            margin-bottom: 20px;
            padding: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .book-image {
            text-align: center;
        }

        .book-details {
            margin-top: 10px;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #add {
            text-decoration: none;
            color: white;
            border: 1px solid;
            background-color: #007bff;
            padding: 10px;
            border-radius: 5px;
        }

        #add:hover {
            background-color: #0056b3;
        }

        #search {
            padding: 8px;
            border-radius: 5px;
        }

        #delete {
            background-color: red;
            color: white;
            border: 1px solid red;
            border-radius: 5px;
            padding: 8px;
        }

        #delete:hover {
            background-color: #8b0000;
            border: 1px solid #8b0000;
        }

        #update {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
            border-radius: 5px;
            padding: 8px;
            text-decoration: none;
        }

        #update:hover {
            background-color: #0056b3;
            color: white;
            border: 1px solid #0056b3;
            border-radius: 5px;
            padding: 8px;
        }

        .updatedelete {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        footer {
            text-align: center;
            color: #808080;
        }

        /* Media query for smaller screens */
        @media only screen and (max-width: 768px) {
            .book-item {
                width: calc(50% - 20px); /* Two columns in smaller screens */
            }
        }

        /* Media query for even smaller screens */
        @media only screen and (max-width: 480px) {
            .book-item {
                width: calc(100% - 20px); /* One column in even smaller screens */
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Search form -->
        <div class="nav">
            <h1>Book List</h1>
            <form method="POST">
                <input type="search" name="search" id="search" placeholder="Search by name, author, or publisher" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
            </form>
            <a href="addbook.php" id="add">Add a Book</a>
        </div>

       <!-- Display search results or no books found message -->
<div class="book">
    <?php if(empty($books)): ?>
        <p>No such book in the bookstore.</p>
    <?php else: ?>
        <!-- Display search results -->
        <?php foreach($books as $book): ?>
            <div class="book-item">
                <div class="book-image">
                    <img src="images/blackbook.png" alt="Book Image" style="width: 100px; height: 150px;">
                </div>
                <div class="book-details">
                    <p><strong>ID:</strong> <?php echo htmlspecialchars($book['id']); ?></p>
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($book['name']); ?></p>
                    <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                    <p><strong>Publisher:</strong> <?php echo htmlspecialchars($book['publisher']); ?></p>
                    <p><strong>Year:</strong> <?php echo htmlspecialchars($book['year']); ?></p>
                </div>
                <div class="updatedelete">
                    <form action="index.php" method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo $book['id'] ?>">
                        <input type="submit" name="delete" value="delete" id="delete">
                    </form>
                    <a href="update.php?id=<?php echo $book['id']; ?>" id="update">update</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
    <footer>
        <p>Copyright 2024 @Bookstores</p>
    </footer>
</body>
</html>
