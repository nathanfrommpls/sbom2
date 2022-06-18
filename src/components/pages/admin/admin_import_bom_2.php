<?php
  // set the current page to one of the main buttons
  $nav_selected = "ADMIN";
  // make the left menu buttons visible; options: YES, NO
  //$left_buttons = "YES"; // Commented in effort to work with upstream
  // set the left menu button selected; options will change based on the main selection
  //$left_selected = "ADMIN";
  $left_selected = "IMPORTBOM";
  $tabTitle =  "SBOM - Admin (Import BOM)";

  //include("./nav.php");
  include("../../../../index.php");
  include("admin_left_menu.php");

  if(!isset($_SESSION)){
    session_start();
  }

  $cookie_name = 'mapping';
  $expire = strtotime('+1 year');

  //if cookie is set, decode cookie into array
  if(isset($_COOKIE[$cookie_name])) {
    $cookie_map = json_decode($_COOKIE[$cookie_name]);
  }
?>

<?php
  // Shared functions between import_form_2.php and admin_import_bom_2.php

  // Moved dropdown function out of the middle of code to improve readability.
  function dropdown($cookie_map, $col, $row) {
    //if mapping cookie is set, set headers from mapping cookie array as the default option
    //with headers pulled from uploaded file
    if(isset($cookie_map)) {
      $cmpt_id = $cookie_map[0];
      $cmpt_name = $cookie_map[1];
      $cmpt_version = $cookie_map[2];
      $app_id = $cookie_map[3];
      $app_name = $cookie_map[4];
      $app_version = $cookie_map[5];
      $license = $cookie_map[6];
      $status = $cookie_map[7];
      $requester = $cookie_map[8];
      $description = $cookie_map[9];
      $monitoring_id = $cookie_map[10];
      $monitoring_digest = $cookie_map[11];
      $issue_count = $cookie_map[12];

      switch($col) {
        case 'cmpt_id':
          echo '<option value="'.$cmpt_id.'">'.$cmpt_id.'</option>';
          file_options($row);
          break;
        case 'cmpt_name':
          echo '<option value="'.$cmpt_name.'">'.$cmpt_name.'</option>';
          file_options($row);
        case 'cmpt_version':
          echo '<option value="'.$cmpt_version.'">'.$cmpt_version.'</option>';
          file_options($row);
          break;
        case 'app_id':
          echo '<option value="'.$app_id.'">'.$app_id.'</option>';
          file_options($row);
          break;
        case 'app_name':
          echo '<option value="'.$app_name.'">'.$app_name.'</option>';
          file_options($row);
        case 'app_version':
          echo '<option value="'.$app_version.'">'.$app_version.'</option>';
          file_options($row);
          break;
        case 'license':
          echo '<option value="'.$license.'">'.$license.'</option>';
          file_options($row);
          break;
        case 'status':
          echo '<option value="'.$status.'">'.$status.'</option>';
          file_options($row);
        case 'requester':
          echo '<option value="'.$requester.'">'.$requester.'</option>';
          file_options($row);
          break;
        case 'description':
          echo '<option value="'.$description.'">'.$description.'</option>';
          file_options($row);
          break;
        case 'monitoring_id':
          echo '<option value="'.$monitoring_id.'">'.$monitoring_id.'</option>';
          file_options($row);
        case 'monitoring_digest':
          echo '<option value="'.$monitoring_digest.'">'.$monitoring_digest.'</option>';
          file_options($row);
          break;
        case 'issue_count':
          echo '<option value="'.$issue_count.'">'.$issue_count.'</option>';
          file_options($row);
          break;
      }

    }
    //if mapping cookie is not set, populate with the uploaded file headers
    else {
      echo '<option value="">--Select Choice--</option>';
      file_options($row);
    }
  }
?>

<html>
  <head>
  </head>
  <body>
    <div class="wrap">
      <h3>Admin --> Import BOM</h3>
      <div id='list'>
        <p>Before importing a file, please make sure the file is a <span style="font-weight: bold;">CSV</span>
        file with these <span style="font-weight: bold;">13 </span>columns:<br></p>
        <ul>
                <li>Component ID</li>
                <li>Component Name</li>
                <li>Component Version</li>
                <li>Application ID</li>
                <li>Application Name</li>
                <li>Application Version</li>
                <li>License</li>
                <li>Status</li>
                <li>Requester</li>
                <li>Monitoring ID</li>
                <li>Monitoring Digest</li>
                <li>Issue Count</li>
                <li>Description</li>
        </ul>
      </div>
      <form enctype="multipart/form-data" method="POST" role="form">
        <input type="file" name="file" id="file" size="150" style="color:black; display: inline-block;">
        Red Application ID: <input type="test" name="red_app_id_form" id="file" style="color:black; display: inline-block;">
        <button style="background: #01B0F1; color: white;" type="submit"
        class="btn btn-default" name="submit" value="submit">Submit</button>
      </form>
    </div>
  </body>
</html>

<?php
  /*if(!isset($_SESSION)){
    session_start();
  }*/
  
  $c = 0;
  
  $labels = array('cmpt_id', 'cmpt_name', 'cmpt_version',
	'app_id', 'app_name', 'app_version', 'license', 'status', 'requester',
	'description', 'monitoring_id', 'monitoring_digest', 'issue_count');
  $data = array();
  $map = array();
  
  if (isset($_POST['submit'])) {
    $chkfile = $_FILES['file']['name'];
    $file = $_FILES['file']['tmp_name'];
  
    //if user clicks button with no file uploaded
    if(!file_exists($file)) {
      echo $_POST['red_app_id_form'];
      echo "<p style='color: white; background-color: red; font-weight: bold; width: 500px;
      text-align: center; border-radius: 2px;'>NO FILE WAS SELCTED</p>";
  
    }else {
      $extension = 'csv';
      $file_ext = pathinfo($chkfile);
  
      //if the uploaded file is not a csv file
      if($file_ext['extension'] !== $extension) {
        echo "<p style='color: white; background-color: red; font-weight: bold; width: 500px;
        text-align: center; border-radius: 2px;'>PLEASE SELECT AN CSV FILE</p>";
  
      }else {
        $target_dir = "../../../../csv_files/";
        $target_file = $target_dir.basename($_FILES["file"]["name"]);
        move_uploaded_file($file,$target_file);
        $_SESSION["the_file"] = $target_file;
        $handle = fopen($target_file, "r");
  
        if(FALSE !== $handle) {
            $row = fgetcsv($handle, 1000, ',');
            if(count($row) < 13) {
              echo "<p style='color: white; background-color: red; font-weight: bold; width: 500px;
              text-align: center; border-radius: 2px;'>FILE CAN'T HAVE LESS THAN 13 COLUMNS</p>";
            }else {
              //function to populate options with headers from uploaded file
              function file_options($row) {
                foreach($row as $val) {
                  echo '<option value="'.$val.'">'.$val.'</option>';
                }
              }
 
              include('import_form_2.php');
            }
        }
      }
    }
  }
?>

<?php
 if (isset($_POST['submitform'])) {
   $red_app_id_field = $_POST['red_app_id_field'];
   $cmpt_id_col = $_POST['cmpt_id'];
   $cmpt_name_col = $_POST['cmpt_name'];
   $cmpt_version_col = $_POST['cmpt_version'];
   $app_id_col = $_POST['app_id'];
   $app_name_col = $_POST['app_name'];
   $app_version_col = $_POST['app_version'];
   $license_col = $_POST['license'];
   $status_col = $_POST['status'];
   $requester_col = $_POST['requester'];
   $description_col = $_POST['description'];
   $monitoring_id_col = $_POST['monitoring_id'];
   $monitoring_digest_col = $_POST['monitoring_digest'];
   $issue_count_col = $_POST['issue_count'];
   $target_file = $_SESSION["the_file"];

   //if mapping cookie is not set insert header selections into array and set cookie
   if(!isset($_COOKIE[$cookie_name])) {
     $mapping = array( $cmpt_id_col, $cmpt_name_col,
       $cmpt_version_col, $app_id_col, $app_name_col, $app_version_col,
       $license_col, $status_col, $requester_col, $description_col,
       $monitoring_id_col, $monitoring_digest_col, $issue_count_col);

     $set_map = setcookie($cookie_name, json_encode($mapping), $expire);
   }

   $headers = array( $cmpt_id_col, $cmpt_name_col,
     $cmpt_version_col, $app_id_col, $app_name_col, $app_version_col,
     $license_col, $status_col, $requester_col, $description_col,
     $monitoring_id_col, $monitoring_digest_col, $issue_count_col);

   $data = array();
   $map = array();

   //get data
   $handle = fopen($target_file, "r");
   if(FALSE !== $handle) {
       $row = fgetcsv($handle, 1000, ',');

       //get column labels
       foreach($headers AS $header) {
         $index = array_search(strtolower($header), array_map('strtolower', $row));
         if(FALSE !== $index) {
           $map[$index] = $header;
         }
       }

       }

   while($data1 = fgetcsv($handle, 1000, ',')) {
     $row = array();
     foreach($map as $index => $field) {
       $row[$field] = $data1[$index];
     }
       $data[] = $row;
     }

     if(empty($data)) {
       echo "EMPTY";

     }else {
       //delete existing data in table
       $sqldelete = $db->prepare('DELETE FROM apps_components WHERE red_app_id = ?');
       $sqldelete->bind_param('s',$red_app_id_field);
       //mysqli_query($db, $sqlDelete);
       if(!$sqldelete->execute()) {
         echo '<p style="background: red; color: white; font-size: 2rem;">ERROR: '.$db->error.'</p>';
       }else {
         echo "<p style='color: white; background-color: green; font-weight: bold; width: 500px;
         text-align: center; border-radius: 2px;'>DELETE SUCCESSFUL";
         echo "<br>".count($data)." rows have been successfully deleted from the apps_components table.</p>";
       }

       //insert data into database
       $sqlinsert = $db->prepare('INSERT INTO apps_components ( red_app_id, cmpt_id, cmpt_name, cmpt_version, app_id, app_name, app_version, license, status, requester, description, monitoring_id, monitoring_digest, issue_count ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)');

       $sqlinsert->bind_param('ssssssssssssss', $red_app_id_field, $cmpt_id,
         $cmpt_name, $cmpt_version, $app_id, $app_name, $app_version,
         $license, $status, $requester, $description, $monitoring_id,
         $monitoring_digest, $issue_count);

       foreach ($data as $row) {
            $red_app_id = $red_app_id_field;
            $cmpt_id = $row[$cmpt_id_col];
            $cmpt_name = $row[$cmpt_name_col];
            $cmpt_version = $row[$cmpt_version_col];
            $app_id = $row[$app_id_col];
            $app_name = $row[$app_name_col];
            $app_version = $row[$app_version_col];
            $license = $row[$license_col];
            $status = $row[$status_col];
            $requester = $row[$requester_col];
            $description = $row[$description_col];
            $monitoring_id = $row[$monitoring_id_col];
            $monitoring_digest = $row[$monitoring_digest_col];
            $issue_count = $row[$issue_count_col];
       }
         if(!$sqlinsert->execute()) {
           echo '<p style="background: red; color: white; font-size: 2rem;">ERROR: '.$db->error.'</p>';
         }else {
           echo "<p style='color: white; background-color: green; font-weight: bold; width: 500px;
           text-align: center; border-radius: 2px;'>IMPORT SUCCESSFUL";
           echo "<br>".count($data)." rows have been successfully imported into the apps_components table.</p>";
         }
     }

   }
  ?>
