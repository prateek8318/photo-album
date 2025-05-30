<?php
$imagesPerPage = 6;
$imageDir = "images/";
$allImages = array_values(array_filter(scandir($imageDir), function ($file) use ($imageDir) {
    return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png']);
}));

$totalImages = count($allImages);
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$start = ($page - 1) * $imagesPerPage;
$currentImages = array_slice($allImages, $start, $imagesPerPage);
$totalPages = ceil($totalImages / $imagesPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Photo Album</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>📸 My Photo Album</h1>

    <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept=".jpg,.jpeg,.png" required>
        <button type="submit">Upload Image</button>
    </form>

    <div class="gallery">
        <div class="left-column">
            <?php for ($i = 0; $i < 3; $i++): ?>
                <?php if (isset($currentImages[$i])): ?>
                    <img src="images/<?= htmlspecialchars($currentImages[$i]) ?>" />
                <?php endif; ?>
            <?php endfor; ?>
        </div>
        <div class="right-column">
            <?php for ($i = 3; $i < 6; $i++): ?>
                <?php if (isset($currentImages[$i])): ?>
                    <img src="images/<?= htmlspecialchars($currentImages[$i]) ?>" />
                <?php endif; ?>
            <?php endfor; ?>
        </div>
    </div>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>">← Previous</a>
        <?php endif; ?>
        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>">Next →</a>
        <?php endif; ?>
    </div>

    <script src="script.js"></script>
</body>
</html>
