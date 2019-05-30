<?php
include('../session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: ../index.html"); // Redirecting To Home Page
}
if ($userprivilege=='user') {
    //add comment
    $queryinscom = $conn->prepare("INSERT INTO filereport (report,file,user) VALUES(?,?,?)");
    $queryinscom->bind_param("1", $_POST['report']);
    $queryinscom->bind_param("2", $_POST['file']);
    $queryinscom->bind_param("3", $login_session);
    $conn->execute($conn, $queryinscom);
    $conn = new mysqli("localhost", "logging", "ZOc*RD8IthP$JnolWw12kT^qOzw7eWa&Rty*D9ZguP@j", "website");
    $querylog =$conn->prepare("INSERT INTO logs (Log, Place,Severity,IP) VALUES ('file reported by:?','reportfile.php','1',?)");
    $querylog->bind_param("1", $_SESSION['login_user']);
    $querylog->bind_param("2", $_SERVER['REMOTE_ADDR']);
    $conn->execute($conn, $querylog);
}
header("location: file.php");
