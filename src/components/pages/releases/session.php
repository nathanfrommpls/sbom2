<?php
    $nav_selected = ""; 
    $left_selected = "";

   if(!isset($_SESSION) && !isset($_SESSION['login_user'])){
      session_start();

      $user_check = $_SESSION['login_user'];
      $ses_sql = mysqli_query($db,"select username from users where username = '$user_check'");
      $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
      $login_session = $row['username'];

      header("location: ../login/login.php");
      die();
   }
?>