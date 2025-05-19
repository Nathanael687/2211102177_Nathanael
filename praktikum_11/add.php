<?php
include_once("config.php");

if (isset($_POST['submit'])) {
    // Sanitize inputs
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $category = mysqli_real_escape_string($mysqli, $_POST['category']);
    $publisher = mysqli_real_escape_string($mysqli, $_POST['publisher']);
    $count = intval($_POST['count']);

    // Handle file upload
    $target_dir = "picture/";
    $original_filename = basename($_FILES["picture"]["name"]);
    $imageFileType = strtolower(pathinfo($original_filename, PATHINFO_EXTENSION));
    
    // Generate unique filename
    $new_filename = uniqid() . '.' . $imageFileType;
    $target_file = $target_dir . $new_filename;

    // Validate image
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if($check === false) {
        die("File is not an image.");
    }

    // Check file size (2MB max)
    if ($_FILES["picture"]["size"] > 2000000) {
        die("Sorry, your file is too large (max 2MB).");
    }

    // Allow certain file formats
    $allowed_types = ["jpg", "jpeg", "png", "gif"];
    if(!in_array($imageFileType, $allowed_types)) {
        die("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }

    // Try to upload file
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
        // Insert data using prepared statement
        $stmt = $mysqli->prepare("INSERT INTO library(picture, name, category, publisher, count) VALUES(?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $new_filename, $name, $category, $publisher, $count);
        
        if($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            // Delete the uploaded file if DB insert fails
            unlink($target_file);
            die("Error: " . $stmt->error);
        }
    } else {
        die("Sorry, there was an error uploading your file.");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add New Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .container { max-width: 800px; }
        .form-group { margin-bottom: 1rem; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <a href="index.php" class="btn btn-secondary mb-3">Back to Home</a>
        
        <div class="card">
            <div class="card-header">
                <h4>Add New Book</h4>
            </div>
            <div class="card-body">
                <form action="add.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="picture">Book Cover Image</label>
                        <input type="file" class="form-control-file" id="picture" name="picture" required accept="image/*">
                        <small class="form-text text-muted">Max size: 2MB (JPG, PNG, GIF)</small>
                    </div>
                    <div class="form-group">
                        <label for="name">Book Title</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <input type="text" class="form-control" id="category" name="category" required>
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" class="form-control" id="publisher" name="publisher" required>
                    </div>
                    <div class="form-group">
                        <label for="count">Quantity</label>
                        <input type="number" class="form-control" id="count" name="count" required min="1">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add Book</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>