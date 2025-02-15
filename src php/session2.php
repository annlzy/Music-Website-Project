<?php
include('config.php');
session_start();
$login_session = "";
$permission_sess = "";
if (isset($_SESSION['email_user'])) {
   $user_check = $_SESSION['email_user'];

   $ses_sql = mysqli_query($conn, "select IdUser, level from user where email = '$user_check' ");

   if ($row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC)) {
      $login_session = $row['IdUser'];
      $permission_sess = $row['level'];
   } else {
      $login_session = "";
      $permission_sess = "";
   }
} 
?>