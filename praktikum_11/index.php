<?php
include_once("config.php");

// Fetch all books from database using prepared statement
$stmt = $mysqli->prepare("SELECT * FROM library ORDER BY id DESC");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Management System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .container { max-width: 1200px; }
        .book-img { max-width: 100px; height: auto; object-fit: cover; }
        .action-links a { margin-right: 5px; }
        .table th { vertical-align: middle; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Book Management System</h2>
        
        <div class="d-flex justify-content-between mb-4">
            <a href="add.php" class="btn btn-success">Add New Book</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Cover</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Publisher</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        $no = 1;
                        while ($book = $result->fetch_assoc()) {
                            $imagePath = 'picture/' . $book['picture'];
                            $imageExists = file_exists($imagePath) && !empty($book['picture']);
                            
                            echo "<tr>";
                            echo "<td>" . $no++ . "</td>";
                            
                            // Display image with fallback
                            echo "<td>";
                            if ($imageExists) {
                                echo "<img src='" . $imagePath . "' class='book-img' alt='Book cover'>";
                            } else {
                                echo "<img src='picture/default.jpg' class='book-img' alt='No cover'>";
                            }
                            echo "</td>";
                            
                            echo "<td>" . htmlspecialchars($book['name']) . "</td>";
                            echo "<td>" . htmlspecialchars($book['category']) . "</td>";
                            echo "<td>" . htmlspecialchars($book['publisher']) . "</td>";
                            echo "<td>" . $book['count'] . "</td>";
                            
                            // Action links
                            echo "<td class='action-links'>";
                            echo "<a href='edit.php?id=" . $book['id'] . "' class='btn btn-sm btn-warning'>Edit</a>";
                            echo "<a href='delete.php?id=" . $book['id'] . "' class='btn btn-sm btn-danger' 
                                  onclick=\"return confirm('Are you sure you want to delete this book?')\">Delete</a>";
                            echo "</td>";
                            
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center'>No books found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>