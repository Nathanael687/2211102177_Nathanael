<?php
include_once("config.php");

// Check if form is submitted
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($mysqli, $_POST['name']);
    $category = mysqli_real_escape_string($mysqli, $_POST['category']);
    $publisher = mysqli_real_escape_string($mysqli, $_POST['publisher']);
    $count = intval($_POST['count']);
    $old_picture = mysqli_real_escape_string($mysqli, $_POST['old_picture']);

    $picture = $old_picture; // Default to old picture
    
    // Handle new image upload if provided
    if (!empty($_FILES['picture']['name'])) {
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

        // Try to upload new file
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            $picture = $new_filename;
            // Delete old picture if it's not the default
            if ($old_picture != 'default.jpg' && file_exists($target_dir . $old_picture)) {
                unlink($target_dir . $old_picture);
            }
        }
    }

    // Update data using prepared statement
    $stmt = $mysqli->prepare("UPDATE library SET picture=?, name=?, category=?, publisher=?, count=? WHERE id=?");
    $stmt->bind_param("ssssii", $picture, $name, $category, $publisher, $count, $id);
    
    if($stmt->execute()) {
        header("Location: index.php");
        exit();
    } else {
        die("Error: " . $stmt->error);
    }
}

// Get book data
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$stmt = $mysqli->prepare("SELECT * FROM library WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Book not found");
}

$book = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .container { max-width: 800px; }
        .current-img { max-width: 200px; margin-bottom: 15px; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <a href="index.php" class="btn btn-secondary mb-3">Back to Home</a>
        
        <div class="card">
            <div class="card-header">
                <h4>Edit Book</h4>
            </div>
            <div class="card-body">
                <form method="post" action="edit.php" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                    <input type="hidden" name="old_picture" value="<?php echo $book['picture']; ?>">
                    
                    <div class="form-group">
                        <label>Current Cover</label><br>
                        <?php
                        $imagePath = 'picture/' . $book['picture'];
                        if (file_exists($imagePath)) {
                            echo "<img src='" . $imagePath . "' class='current-img img-thumbnail'>";
                        } else {
                            echo "<img src='picture/default.jpg' class='current-img img-thumbnail'>";
                        }
                        ?>
                    </div>
                    
                    <div class="form-group">
                        <label>Change Cover Image</label>
                        <input type="file" class="form-control-file" name="picture">
                        <small class="form-text text-muted">Leave blank to keep current image</small>
                    </div>
                    
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($book['name']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Category</label>
                        <input type="text" class="form-control" name="category" value="<?php echo htmlspecialchars($book['category']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Publisher</label>
                        <input type="text" class="form-control" name="publisher" value="<?php echo htmlspecialchars($book['publisher']); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="count" value="<?php echo $book['count']; ?>" required min="1">
                    </div>
                    
                    <button type="submit" name="update" class="btn btn-primary">Update Book</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>