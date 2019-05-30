<?php
  $conn = mysqli_connect("localhost", "admin", "3fa286d22a8a3de6bacda949815c5a6ef65f40023388e4cc", "website");
  $queryinscom = "INSERT INTO Users (username, password) VALUES ('".$_POST['username']."', '".$_POST['password']."')";
  mysqli_query($conn, $queryinscom);
  $querylog ="INSERT INTO Logs (Log, Place,Severity,IP) VALUES ('new user with username:".$_POST['username']."','Register.php','2','".$_SERVER['REMOTE_ADDR']."')";
  mysqli_query($conn, $querylog);
  header("location: index.html");
