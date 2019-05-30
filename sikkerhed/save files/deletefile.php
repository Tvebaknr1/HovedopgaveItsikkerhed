<?php
include('../session.php');
if (!isset($_SESSION['login_user'])) {
    header("location: ../index.html"); // Redirecting To Home Page
}

if($userprivilege=='admin' && unlink($_POST['file'])){
  echo "The file ".explode("/",$_POST['file'])[1]." has been deleted";
  $conn = new mysqli("localhost", "logging", "ZOc*RD8IthP$JnolWw12kT^qOzw7eWa&Rty*D9ZguP@j", "website");
  $querylog =$conn->prepare("INSERT INTO Logs (Log, Place,Severity,IP) VALUES ('a file has been deleted:?','deletefile.php','4',?)");
  $querylog->bind_param("1", $_POST['file']);
  $querylog->bind_param("2", $_SERVER['REMOTE_ADDR']);
  $conn->execute($conn, $querylog);
}else{
  echo "The file ".explode("/",$_POST['file'])[1]." failed to be deleted";
  $conn = new mysqli("localhost", "logging", "ZOc*RD8IthP$JnolWw12kT^qOzw7eWa&Rty*D9ZguP@j", "website");
  $querylog =$conn->prepare("INSERT INTO Logs (Log, Place,Severity,IP) VALUES ('a file failed to be deleted:? by user','deletefile.php','3',?)");
  $querylog->bind_param("1", $_POST['file']);
  $querylog->bind_param("2", $login_session);
  $querylog->bind_param("3", $_SERVER['REMOTE_ADDR']);
  $conn->execute($conn, $querylog);
}
