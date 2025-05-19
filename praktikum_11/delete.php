<?php
include_once("config.php");

// Get and sanitize ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// First get the book data to delete the associated image
$stmt = $mysqli->prepare("SELECT picture FROM library WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $book = $result->fetch_assoc();
    $picture = $book['picture'];
    
    // Delete the book record
    $delete_stmt = $mysqli->prepare("DELETE FROM library WHERE id=?");
    $delete_stmt->bind_param("i", $id);
    
    if ($delete_stmt->execute()) {
        // Delete the associated image file if it's not default
        if ($picture != 'default.jpg') {
            $image_path = "picture/" . $picture;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
    } else {
        die("Error deleting record: " . $delete_stmt->error);
    }
}

// Redirect back to index
header("Location: index.php");
exit();
?>