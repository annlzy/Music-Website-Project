<?php
include('config.php');
session_start();

$user_check = $_SESSION['email_user'];

$ses_sql = mysqli_query($conn, "select IdUser from user where email = '$user_check' ");

$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$login_session = $row['IdUser'];

if (!isset($_SESSION['email_user'])) {
   header("location: login.php");
   die();
}
