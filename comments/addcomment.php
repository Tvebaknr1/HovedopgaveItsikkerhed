<?php
include('../session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: ../index.html"); // Redirecting To Home Page
}
//add comment
$queryinscom = "INSERT INTO Comments (author, comment) VALUES ('".$_SESSION['login_user']."', '".$_POST['comment']."')";
mysqli_query($conn, $queryinscom);
$querylog ="INSERT INTO logs (Log, Place,Severity,IP) VALUES ('new comment:".$_POST['comment']."','addcomment.php','2','".$_SERVER['REMOTE_ADDR']."')";
mysqli_query($conn, $querylog);
mysqli_close();
//reload page
header("location: comment.php");
