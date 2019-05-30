<?php
include('../session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: ../index.html"); // Redirecting To Home Page
}
if ($userprivilege=='user') {
    //add comment
    $conn = new mysqli("localhost", "comment", "2oI9Ga68CKk7k@Fc$H47&x3sgdpdx0&9ND6i82hirhFq", "website");
    session_start();// Starting Session
    $queryinscom = $conn->prepare("UPDATE  `Comments` set report = ? WHERE Id =?");
    $queryinscom->bind_param("1", $_POST['reason']);
    $queryinscom->bind_param("2", $_POST['id']);
    $conn->execute($conn, $queryinscom);
    mysqli_close();
    $conn = new mysqli("localhost", "logging", "ZOc*RD8IthP$JnolWw12kT^qOzw7eWa&Rty*D9ZguP@j", "website");
    $querylog =$conn->prepare("INSERT INTO logs (Log, Place,Severity,IP) VALUES ('comment reported by:?','reportcommentfinal.php','1',?)");
    $querylog->bind_param("1", $_SESSION['login_user']);
    $querylog->bind_param("2", $_SERVER['REMOTE_ADDR']);
    $conn->execute($conn, $querylog);
}
//reload page
header("location: comment.php");
