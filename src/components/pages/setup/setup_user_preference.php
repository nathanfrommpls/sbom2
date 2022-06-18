<?php
  $nav_selected = "SETUP";
  $left_selected = "USERPREFERENCES";
  $tabTitle = "SBOM - Setup (User Preferences)";

  include "../../../../index.php";
  include "setup_left_menu.php";

  $cookie_name = 'preference';
?>

<div class="wrap">
  <h3> Setup --> User Preferences </h3>
  
  <?php
    if(isset($_COOKIE[$cookie_name])) {
      $prep = rtrim(str_repeat('?,', count(json_decode($_COOKIE[$cookie_name]))), ',');
      $sql = 'SELECT * FROM releases WHERE app_id IN ('.$prep.')';
      $pref = $pdo->prepare($sql);
      $pref->execute(json_decode($_COOKIE[$cookie_name]));

      echo 
      "<table id = 'apps'>
      <caption>User Saved Applications<caption>
      <tr>
        <th>App ID</th>
        <th>Application Name</th>
      </tr>";

      while($row = $pref->fetch(PDO::FETCH_ASSOC)) {
        echo '<tr>
          <td>'.$row["app_id"].'</td>
          <td>'.$row["name"].'</td>
        </tr>';
      }

      echo '</table>';
    } else {
        echo "<script> console.warn('No preference cookie found.'); </script>";
    }
  ?>

  <?php
    $sqlLog = "SELECT * FROM preferences WHERE name = 'ENABLE_LOGGING'";
    $logList = $db->query($sqlLog);
    $logRow = $logList->fetch_assoc();

    if($logRow["value"] == "true"){
      echo "<script> console.warn('Logging is enabled'); </script>";
      echo
        "<form id='disable-form' name='disable-form' method='post'>
          <button type='submit' name='disable' value='submit'> Disable Logging </button>
        </form>";
    } else {
      echo "<script> console.warn('Logging is disabled'); </script>";
      echo
        "<form id='enable-form' name='enable-form' method='post'>
          <button type='submit' name='enable' value='submit'> Enable Logging </button>
        </form>";
    }

    if(isset($_POST['disable'])){
      $sql = "UPDATE preferences
      SET value = 'false'
      WHERE name = 'ENABLE_LOGGING';";
      $result = $db->query($sql);
      header("Refresh:0");
    }

    if(isset($_POST['enable'])){
      $sql = "UPDATE preferences
      SET value = 'true'
      WHERE name = 'ENABLE_LOGGING';";
      $result = $db->query($sql);
      header("Refresh:0");
    }

    echo "<p> To change user BOMs you must select BOMs from the releases list to save into a browser cookie. </p>";
    ?>
</div>
