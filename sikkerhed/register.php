<?php
  $conn = new mysqli("localhost", "user", "%ZzG*CAeg!lVxb8rR1ORLZDFkS#kUvpXy0m#nCck3KRQ", "website");
  $salt = openssl_random_pseudo_bytes(16);
  $prepare = "INSERT INTO Users (username, password,salt) VALUES (?, ?, ?)";
  $prepare->bind_param("1", $username);
  $prepare->bind_param("2", password_hash($password+$salt,PASSWORD_ARGON2I);
  $prepare->bind_param("3", $salt);
  $conn->execute($conn, $prepare);
  $perparelog =new mysqli("INSERT INTO Logs (Log, Place,Severity,IP) VALUES ('new user with username:?','Register.php','2','?')");
  $prepare->bind_param("1", $_POST['username']);
  $prepare->bind_param("2", $_SERVER['REMOTE_ADDR']);
  $conn->execute($conn, $perparelog);
  header("location: index.html");
