<?php
include('../session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: ../index.html"); // Redirecting To Home Page
}
$comment = $_POST['comment'];
$comment =str_replace("<","&lt;",$comment);
$conn = new mysqli("localhost", "comment", "2oI9Ga68CKk7k@Fc$H47&x3sgdpdx0&9ND6i82hirhFq", "website");
session_start();// Starting Session
//add comment
$queryinscom = $conn->prepare("INSERT INTO Comments (author, comment) VALUES (?, ?)");
$queryinscom->bind_param("1", $_SESSION['login_user']);
$queryinscom->bind_param("2", $_POST['comment']);
$conn->execute($conn, $queryinscom);
mysqli_close();
$conn = new mysqli("localhost", "logging", "ZOc*RD8IthP$JnolWw12kT^qOzw7eWa&Rty*D9ZguP@j", "website");
$querylog =$conn->prepare("INSERT INTO logs (Log, Place,Severity,IP) VALUES ('new comment:?','addcomment.php','2',?)");
$querylog->bind_param("1", $_POST['comment']);
$querylog->bind_param("2", $_SERVER['REMOTE_ADDR']);
$conn->execute($conn, $querylog);
mysqli_close();
//reload page
header("location: comment.php");
