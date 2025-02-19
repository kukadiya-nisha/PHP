<?php 
    include('header.php');
?>
<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file" required>
    <input type="submit" name="upload" value="Upload">
</form>
<?php
$uploadDir = 'uploads/';
if (isset($_POST['upload'])) {
    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $targetPath = $uploadDir . $fileName;
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        echo "<script>alert('File uploaded successfully!');</script>";
    } else {
        echo "<script>alert('Error uploading file.');</script>";
    }
}
if (isset($_POST['delete'])) {
    $filename = $_POST['filename'];
    unlink($uploadDir . $filename);
    echo "<script>alert('File deleted successfully!');</script>";
}
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}
$files = scandir($uploadDir);
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        echo $file;
        echo "<a href='{$uploadDir}{$file}' download><button>Download</button></a> ";
        ?>
        <form method="POST">
            <input type="hidden" name="filename" value="<?php echo $file; ?>">
            <a><input type="submit" name="delete" value="Delete"></a>
        </form>
        <?php
    }
}
?>