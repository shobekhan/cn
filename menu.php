<!DOCTYPE html>
<html>
<body>

<form action="menu.php" method="post" enctype="multipart/form-data">
    Select pdf to upload:
    <input type="file" name="file1" id="file1">
    <input type="submit" value="Upload Menu" name="submit">
</form>

<?php
$targetDir = "speiseplaene/";
if (isset($_FILES["file1"])) {
    $fileName = 'speiseplan.pdf';
    $targetFile = __DIR__ . '/' . $targetDir . $fileName;
    $fileUploadStatus = move_uploaded_file($_FILES["file1"]["tmp_name"], $targetFile);
    //chmod($targetFile, 0777);
}
?>

</body>
</html>