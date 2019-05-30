<?php
include('../session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: ../index.html"); // Redirecting To Home Page
}
?>
<!DOCTYPE html>
<html>
<head>
 <title>comment page</title>
 <link href="style.css" rel="stylesheet" type="text/css">
 <style media="screen">
   th,
   td {
     border-bottom: 1px solid #ddd;
   }
   tr:hover {background-color: #f5f5f5;}
 </style>
</head>
<body>
  <form action='reportcommentfinal.php' method="post">
    <?php
    echo "<input name='id' type='hidden' value=".$_POST['id'].">";
    ?>

  Why did you report this comment<br>
  <input type='text' name="reason"><br>
  <input type='submit' value='Report'>
</form>
</body>
</html>
