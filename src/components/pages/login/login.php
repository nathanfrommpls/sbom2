<?php
    $nav_selected = "LOGIN";
    $tabTitle = "SBOM - Login";
    $error = '';
    
    include("../../../../index.php");
    if(!isset($_SESSION)){
    session_start();
    }
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['email']);
      $mypassword = mysqli_real_escape_string($db,$_POST['hash']); 

      if(password_verify($mypassword, '$2y$10$zFAG5GBNtf.5BpowMqZSputSLeG8OzfKACpjAMsePjZhu.TnvU/Bu') == true){
         $sql = "SELECT * FROM users WHERE email = '$myusername'";
         $result = mysqli_query($db,$sql);
         $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
         //$active = $row['active'];
         
         $count = mysqli_num_rows($result);
         
         // If result matched $myusername and $mypassword, table row must be 1 row
         
         if($count == 1) {
            $_SESSION['login_user'] = $myusername;
            $mytype = $row['role'];
            if (strpos($mytype, "admin") !== false){
               $_SESSION['admin'] = "It is working";
            }
            
            header("location: ../../../../index.php");
         }else {
            $error = "Your Login Name or Password is invalid";
         }
      }
   } 

?>

<div class="wrap table-container login center">
   <div id="LOGIN">
      <p><b>Login</b></p>
      
      <form action="" method="post">
         <fieldset>
            <label> Email: </label>
            <input type="text" name="email" class="box"/>
         </fieldset>

         <fieldset>
            <label> Password: </label>
            <input type="password" name="hash" class="box" />
         </fieldset>
         
         <button type="submit"> Submit </button>
      </form>
      
      <div style="color:#cc0000;">
         <?php echo $error; ?>
      </div>
   </div>
</div>
