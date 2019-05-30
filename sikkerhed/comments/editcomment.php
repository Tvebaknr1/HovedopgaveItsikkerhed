<?php
include('../session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: ../index.html"); // Redirecting To Home Page
}
if ($login_session == $_POST['author'] || $userprivilege =='admin') {
    //add comment
    $comment =str_replace("<","&lt;",$_POST['newcomment']);
    $queryinscom = $conn->prepare("UPDATE  `Comments` set comment = ? WHERE Id =?");
    $queryinscom->bind_param("1", $comment);
    $queryinscom->bind_param("2", $_POST['id']);
    $conn->execute($conn, $queryinscom);
    $querylog =$conn->prepare("INSERT INTO logs (Log, Place,Severity,IP) VALUES ('comment changed form: ? to ?','editcomment.php','1',?)");
    $querylog->bind_param("1", $_SESSION['oldcomment']);
    $querylog->bind_param("2", $comment);
    $querylog->bind_param("3", $_SERVER['REMOTE_ADDR']);
    $conn->execute($conn, $querylog);
}
//reload page
header("location: comment.php");
