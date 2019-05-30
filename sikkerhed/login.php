<?php
session_start(); // Starting Session
$error = 'an error has occured'; // Variable To Store Error Message

  if (empty($_POST['username']) || empty($_POST['password'])) {
        header("location: index.html");
  } else {
      // Define $username and $password
      $username = $_POST['username'];
      $password = $_POST['password'];
      // mysqli_connect() function opens a new connection to the MySQL server.
      $conn = new mysqli("localhost", "login", "nisd%Em38$#P$AH@qasyV6YJBkA6$Np*Bo14Xud^M2&e", "website");
      // SQL query to fetch information of registerd users and finds user match.
      $prepare = $conn->prepare("SELECT username, password, salt from Users where username=? limit 1");
      $prepare->bind_param("1", $username);
      $conn->execute($conn, $prepare);
      $conn->bind_result($result);
      if (mysqli_num_rows($result) > 0) { //fetching the contents of the row {
          if(password_hash($password+$row['salt'],PASSWORD_ARGON2I) ==$row['password']){
             $_SESSION['login_user'] = $username;
          } else {
              $preparelog =$conn->prepare("INSERT INTO Logs (Log,Place,Severity,IP) VALUES ('loging failed: wrong passowrd:?', 'login.php','2','?')");
              $preparelog->bind_param("1", $username);
              $preparelog->bind_param("2", $_SERVER['REMOTE_ADDR']);
              $conn->execute($conn, $preparelog);
          }
          header("location: profile.php"); // Redirecting To Profile Page
      }
      } else {
          $preparelog =$conn->prepare("INSERT INTO Logs (Log,Place,Severity,IP) VALUES ('login attempt on nonexistend user:?', 'login.php','1','?')");
          $preparelog->bind_param("1", $username);
          $preparelog->bind_param("2", $_SERVER['REMOTE_ADDR']);
          $conn->execute($conn, $preparelog);
      }
      header("location: profile.php"); // Redirecting To Profile Page
  }
mysqli_close($conn); // Closing Connection
