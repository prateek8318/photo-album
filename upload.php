<?php
$targetDir = "images/";
$allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
$maxSize = 5 * 1024 * 1024; // 5MB

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $image = $_FILES['image'];

    if (!in_array($image['type'], $allowedTypes)) {
        die("Invalid file type.");
    }

    if ($image['size'] > $maxSize) {
        die("File too large.");
    }

    $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
    $newName = uniqid() . "." . $ext;

    if (move_uploaded_file($image['tmp_name'], $targetDir . $newName)) {
        header("Location: index.php");
    } else {
        echo "Upload failed.";
    }
}
?>
