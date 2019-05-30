<?php
include('../session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: ../index.html"); // Redirecting To Home Page
}
if($userprivilege=='admin')
{
  //add comment
  $conn = new mysqli("localhost", "deletecomment", "7taOq8%k$ynW5CY7QpG8gInKC577*#@I#VG7Gc31uaDd", "website");
  session_start();// Starting Session
  $queryinscom = $conn->prepare("DELETE FROM `Comments` WHERE Id =?");
  $queryinscom->bind_param("1", $_POST['id']);
  $conn->execute($conn, $queryinscom);
  mysqli_close();
  $conn = new mysqli("localhost", "logging", "ZOc*RD8IthP$JnolWw12kT^qOzw7eWa&Rty*D9ZguP@j", "website");
  $querylog =$conn->prepare("INSERT INTO logs (Log, Place,Severity,IP) VALUES ('comment deleted:?','deletecomment.php','2',?)");
  $querylog->bind_param("1", $_POST['id']);
  $querylog->bind_param("2", $_SERVER['REMOTE_ADDR']);
  $conn->execute($conn, $querylog);
}
//reload page
header("location: comment.php");
