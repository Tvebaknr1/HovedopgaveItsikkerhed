<?php
include('../session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: ../index.html"); // Redirecting To Home Page
}
if($userprivilege=='admin')
{

}
//add comment
$queryinscom = "DELETE FROM `Comments` WHERE Id ='".$_POST['id']."'";
mysqli_query($conn, $queryinscom);
$querylog ="INSERT INTO logs (Log, Place,Severity,IP) VALUES ('comment deleted:".$_POST['id']."','deletecomment.php','2','".$_SERVER['REMOTE_ADDR']."')";
mysqli_query($conn, $querylog);
//reload page
header("location: comment.php");
