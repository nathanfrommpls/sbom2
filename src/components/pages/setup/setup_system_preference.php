<?php
  $nav_selected = "SETUP";
  $left_selected = "SYSPREFERENCES";
  $tabTitle = "SBOM - Setup (System Preferences)";

  include "../../../../index.php";
  include "setup_left_menu.php";
?>

<head>
  <style>
    table.center {
        margin-left:auto;
        margin-right:auto;
      }

    #apps {
      border-collapse: collapse;
    }

    #apps td , #apps th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
      padding-right: 100px;
    }

    #apps tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
</head>

<div class="wrap">
  <h3>Setup --> System Preferences</h3>

  <table id = "apps">
    <caption>System Scope Applications<caption>
      
    <tr>
      <th>App ID</th>
      <th>Application Name</th>
    </tr>

    <?php
    $sqlScope = "SELECT * FROM preferences WHERE name = 'SYSTEM_BOMS';";
    $scopeList = $db->query($sqlScope);
    $output = array('NULL');

    if ($scopeList->num_rows > 0) {
      // output data of each row
      $row = $scopeList->fetch_assoc();
      $prefString = $row["value"];
      if(!empty(trim($prefString))){
      $output = explode(",", $prefString);
      }
    }

    foreach ($output as $appID){
        $sqlApp = "SELECT * FROM releases WHERE app_id = '$appID'";
        $appList = $db->query($sqlApp);
        if ($appList->num_rows > 0){
          while($row = $appList->fetch_assoc()){
            echo '<tr>
                <td>'.$row["app_id"].'</td>
                <td>'.$row["name"].'</td>
              </tr>';
          }
        }
      }
    ?>
  </table>

  <?php
  $sqlLog = "SELECT * FROM preferences WHERE name = 'ENABLE_LOGGING'";
  $logList = $db->query($sqlLog);
  $logRow = $logList->fetch_assoc();

  if($logRow["value"] == "true"){
    echo "<script> console.warn('Logging is enabled'); </script>";
    echo "<br/>";
    echo "<form id='disable-form' name='disable-form' method='post' action=''>
    <button type='submit' name='disable' value='submit'>Disable Logging</button>
    </form>";
  } else {
    echo "<script> console.warn('Logging is disabled'); </script>";
    echo "<br/>";
    echo "<form id='enable-form' name='enable-form' method='post' action=''>
    <button type='submit' name='enable' value='submit'>Enable Logging</button>
    </form>";
  }

  echo "<p> To change system scope you must be logged in as an administrator and select BOMs from the releases list. </p>";

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
  ?>

</div>
