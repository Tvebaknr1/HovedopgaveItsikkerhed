<?php
session_start(); // Starting Session
$error = 'an error has occured'; // Variable To Store Error Message

  if (empty($_POST['username']) || empty($_POST['password'])) {
    $error = "Username or Password is invalid";
  }
  else{
    // Define $username and $password
    $username = $_POST['username'];
    $password = $_POST['password'];
    // mysqli_connect() function opens a new connection to the MySQL server.
    $conn = mysqli_connect("localhost", "admin", "3fa286d22a8a3de6bacda949815c5a6ef65f40023388e4cc", "website");
    // SQL query to fetch information of registerd users and finds user match.
    $query = "SELECT username, password from Users where username='".$username."' AND password='".$password."' limit 1";
    $result = mysqli_query($conn,$query);
    if(mysqli_num_rows($result) > 0){ //fetching the contents of the row {
      while($row = mysqli_fetch_assoc($result)) {
               $_SESSION['login_user'] = $username;
            }
          }
    else{
    $querylog ="INSERT INTO Logs (Log,Place,Severity,IP) VALUES ('login failed:".$username."', 'login.php','1','".$_SERVER['REMOTE_ADDR']."')";
    mysqli_query($conn, $querylog);

  }
  header("location: profile.php"); // Redirecting To Profile Page
}
mysqli_close($conn); // Closing Connection
?>
