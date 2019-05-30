<?php
// mysqli_connect() function opens a new connection to the MySQL server.
$conn = mysqli_connect("localhost", "admin", "3fa286d22a8a3de6bacda949815c5a6ef65f40023388e4cc", "website");
session_start();// Starting Session
// Storing Session
$user_check = $_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$query = "SELECT username,userprivilege from Users where username = '".$user_check."'";
$ses_sql = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['username'];
$userprivilege = $row['userprivilege'];
