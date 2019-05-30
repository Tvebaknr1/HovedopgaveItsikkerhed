<?php
// mysqli_connect() function opens a new connection to the MySQL server.
$conn = new mysqli("localhost", "login", "nisd%Em38$#P$AH@qasyV6YJBkA6$Np*Bo14Xud^M2&e", "website");
session_start();// Starting Session
// Storing Session
$user_check = $_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$prepare = $conn->prepare("SELECT username,userprivilege from Users where username = ?");
$prepare->bind_param("1", $username);
$conn->execute($conn, $prepare);
$conn->bind_result($ses_sql);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['username'];
$userprivilege = $row['userprivilege'];
mysqli_close();
