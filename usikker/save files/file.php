 <?php
include('../session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: ../index.html"); // Redirecting To Home Page
}?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>

  <meta charset="utf-8">
  <title>add a file to webserver</title>
</head>

<body>
  <form action="addfile.php" method="post" enctype="multipart/form-data">
    Select file to upload, max 2MB:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<!-- list of files -->
<?php
$files = glob("files/*");
foreach ($files as $key => $value) {
    echo "<a href='".$value."'>".$value."</a><br>";
}
?>
</body>

</html>
