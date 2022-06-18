<?php
  $nav_selected = "BOM";
  $left_selected = "SBOMTREE2";
  $tabTitle = "SBOM - BOM (Tree V2)";

  include("../../../../index.php");
  include "get_scope.php";
  include("bom_left_menu.php");

  //Get DB Credentials
  $DB_SERVER = constant('DB_SERVER');
  $DB_NAME = constant('DB_NAME');
  $DB_USER = constant('DB_USER');
  $DB_PASS = constant('DB_PASS');
  //PDO connection
  $pdo = new PDO("mysql:host=$DB_SERVER;dbname=$DB_NAME", $DB_USER, $DB_PASS);
   $cookie_name = 'preference';
  $cookie_name = 'preference';

  $def = "false";
  $DEFAULT_SCOPE_FOR_RELEASES = getScope($db);
  $scopeArray = array();


  //initialize for use in logging
  $logpref = false;
  getLoggingPreference($db);
  $timestamp = date("h:i:sa\r\n");
  $logfile = "./logs/bom_error.log";

  if ($logpref) {
    error_log($timestamp, 3, $logfile);
  }

  //Grabs default app_ids that are to be shown in the default scope
  function getFilterArray($db) {
    global $scopeArray;
    global $pdo;
    global $DEFAULT_SCOPE_FOR_RELEASES;

    $sql = "SELECT * FROM releases WHERE app_id LIKE ?";
    foreach($DEFAULT_SCOPE_FOR_RELEASES as $currentTag){
      $sqlTag = $pdo->prepare($sql);
      $sqlTag->execute([$currentTag]);
      if ($sqlTag->rowCount() > 0) {
        while($row = $sqlTag->fetch(PDO::FETCH_ASSOC)){
          array_push($scopeArray, $row["app_id"]);
        }
      }
    }
  }


  function getLoggingPreference($db){
    global $pdo;
    global $logpref;

    $sql = "SELECT value FROM preferences WHERE preference_id = 1";
    $sqlLog = $pdo->prepare($sql);
    $sqlLog->execute();
    if ($sqlLog->rowCount() > 0) {
      $row = $sqlLog->fetch(PDO::FETCH_ASSOC);
      if($row["value"] == "true"){
        $logpref = true;
      }
    }
  }

  //Display error if user retrieves preferences w/o any cookies set
  global $pref_err;
  if(isset($_POST['getpref']) && !isset($_COOKIE[$cookie_name])) {
    $pref_err = "You don't have BOMS saved.";
  }
  echo '<p
  style="font-size: 2.5rem;
  text-align: center;
  background-color: red;
  color: white;">'.$pref_err.'</p>';
  
 ?>

<style>
 .hidden{
   display:none;
 }
 </style>

<?php
  /*----------------- FUNCTION TO GET BOMS -----------------*/
  function getBoms($db, $sql_parent) {
    global $def;
    global $scopeArray;
    global $logpref;
    global $logfile;
    $result_parent = $db->query($sql_parent);
    $p=1;
    $c=1;
    $gc=1;

    //If logging enabled and query failure, store query to log file
    if($logpref && $result_parent == FALSE){
      $querylog = $sql_parent."\r\n";
      error_log($querylog, 3, $logfile);
    }

    if ($result_parent->num_rows > 0) {
      while($row_parent = $result_parent->fetch_assoc()) {
        $app_name = $row_parent["name"];
        $app_version = $row_parent["version"];
        $class = $row_parent["class"];
        $app_status = $row_parent["status"];
        $div_class = $row_parent["div_class"];
        $p_id = $p;
        $app_id = "NONE";


        /*If log enabled, store parent info to file. This commented out code is for examining query return values
        if($logpref){
          $parentlog = $p_id." ".$app_name." ".$app_version." ".$div_class."\r\n";
          error_log($parentlog, 3, $logfile);
        }
        */

        //If the default scope is enabled then hide all table rows that are outside the system scope
        if ($def == "true"){
          $app_id = $row_parent["app_id"];
          if (in_array($app_id, $scopeArray) && $def == "true") {
            echo "<tbody class= '".$div_class."'>
            <tr data-tt-id = '".$p_id."' ><td class='text-capitalize'>
            <div class = 'btn ".$class."' ><span class = 'app_name' style = 'max-width: 160em; white-space: pre-wrap; word-wrap: break-word; word-break: break-all;'>".$app_name."</span>&nbsp; &nbsp;&nbsp; &nbsp;</div></td>
            <td >".$app_version."</td><td class='text-capitalize'>".$app_status."</td><td/><td/><td/><td/></tr>";
          } else {
            echo "<tbody class= 'hidden'>
            <tr data-tt-id = '".$p_id."' ><td class='text-capitalize'>
            <div class = 'btn ".$class."' ><span class = 'app_name' style = 'max-width: 160em; white-space: pre-wrap; word-wrap: break-word; word-break: break-all;'>".$app_name."</span>&nbsp; &nbsp;&nbsp; &nbsp;</div></td>
            <td >".$app_version."</td><td class='text-capitalize'>".$app_status."</td><td/><td/><td/><td/></tr>";
          }
       } else {
        echo "<tbody class= '".$div_class."'>
        <tr data-tt-id = '".$p_id."' ><td class='text-capitalize'>
        <div class = 'btn ".$class."' ><span class = 'app_name' style = 'max-width: 160em; white-space: pre-wrap; word-wrap: break-word; word-break: break-all;'>".$app_name."</span>&nbsp; &nbsp;&nbsp; &nbsp;</div></td>
        <td >".$app_version."</td><td class='text-capitalize'>".$app_status."</td><td/><td/><td/><td/></tr>";
       }
        $p++;

        // output data of child
        $sql_child = "SELECT DISTINCT cmp_name as cmpname, cmp_type, cmp_version as cmpver, request_step,cmp_status, request_status, notes,
        CASE WHEN cmp_name in (select distinct app_name
          from sbom where app_name = cmpname and app_version = cmpver) THEN 'child'
        ELSE 'grandchild'
        END AS class
          from sbom where app_name = '".$app_name."' and app_version = '".$app_version."' and app_status = '".$app_status."'";
        $result_child = $db->query($sql_child);

        //If logging enabled and query failure, store child query to log file
        if($logpref && $result_child == FALSE){
          $querylog = $sql_child."\r\n";
          error_log($querylog, 3, $logfile);
        }
        
        if ($result_child->num_rows > 0) {
          // output data of child
          while($row_child = $result_child->fetch_assoc()) {
            $cmp_name = $row_child["cmpname"];
            $cmp_version = $row_child["cmpver"];
            $cmp_status = $row_child["cmp_status"];
            $request_step = $row_child["request_step"];
            $request_status = $row_child["request_status"];
            $cmp_type = $row_child["cmp_type"];
            $notes = $row_child["notes"];
            $c_class = $row_child["class"];
            $c_id=$p_id."-".$c;

            //If log enabled, store child info to file. Commented out code is for examining child query return values
            /*if($logpref){
              $childlog = $c_id." ".$cmp_name." ".$cmp_version." ".$c_class."\r\n";
              error_log($childlog, 3, $logfile);
            }
            */

            echo "<tr data-tt-id = '".$c_id."' data-tt-parent-id='".$p_id."' class = 'component' >
            <td class='text-capitalize'> <div class = 'btn ".$c_class."'> <span class = 'cmp_name'>".$cmp_name."</span>&nbsp; &nbsp;&nbsp; &nbsp;</div></td>
            <td class = 'cmp_version'>".$cmp_version."</td>
            <td class='text-capitalize'>".$cmp_status."</td>
            <td class='text-capitalize'>".$cmp_type."</td>
            <td class='text-capitalize'>".$request_status."</td>
            <td class='text-capitalize'>".$request_step."</td>
            <td class='text-capitalize'>".$notes."</td></tr>";
            $c++;

            // output data of grandchild
            $sql_gchild = "SELECT DISTINCT  cmp_name, cmp_type, cmp_version, request_step, cmp_status, request_status, notes, 'grandchild' as class
            from sbom
            where app_name = '".$cmp_name."' and app_version = '".$cmp_version."' ;";

            $result_gchild = $db->query($sql_gchild);

            //if log enabled store query to file
            if($logpref && $result_gchild == FALSE){
              $querylog = $sql_gchild."\r\n";
              error_log($querylog, 3, $logfile);
            }

            if ($result_gchild->num_rows > 0 ) {
              // output data of grandchild
              while($row_gchild = $result_gchild->fetch_assoc()) {
                $gcmp_name = $row_gchild["cmp_name"];
                $gcmp_version = $row_gchild["cmp_version"];
                $gcmp_status = $row_gchild["cmp_status"];
                $grequest_step = $row_gchild["request_step"];
                $grequest_status = $row_gchild["request_status"];
                $gcmp_type = $row_gchild["cmp_type"];
                $gnotes = $row_gchild["notes"];
                $gc_class = $row_gchild["class"];
                $gc_id=$c_id."-".$gc;

                // if log enabled store grandchild info to log. Commented out code is for examining grandchild query return values.
                /*if($logpref){
                  $gchildlog = $gc_id." ".$gcmp_name." ".$gcmp_version." ".$gc_class."\r\n";
                  error_log($gchildlog, 3, $logfile);
                }
                */
                
                echo "<tr data-tt-id = '".$gc_id."' data-tt-parent-id='".$c_id."' >
                <td class='text-capitalize'> <div class = 'btn ".$gc_class."'> <span class = 'cmp_name'>".$gcmp_name."</span>&nbsp; &nbsp;&nbsp; &nbsp;</div></td>
                <td class = 'cmp_version'>".$gcmp_version."</td>
                <td class='text-capitalize'>".$gcmp_status."</td>
                <td class='text-capitalize'>".$gcmp_type."</td>
                <td class='text-capitalize'>".$grequest_status."</td>
                <td class='text-capitalize'>".$grequest_step."</td>
                <td class='text-capitalize'>".$gnotes."</td></tr>";
                $gc++;
              }
            $result_gchild -> close();
            }
          }
          $result_child -> close();
        } echo "</tbody>";
      }
      $result_parent->close();
    }//if there is no parent, then add a row to reflect no results.
    else {
      echo "<tr data-tt-id = 'No Results'> <td>No Results Found</td><td/><td/><td/><td/><td/><td/> </tr>";
    }
    //Default scope is turned off so it doesn't interfere with any further page activity
    $def = 'false';
  }

  //get all BOMS
  function getAllBoms($db) {
    $sql_parent = "SELECT DISTINCT app_name as name,
      app_version as version, app_status as status, color as div_class,
      CASE WHEN color = 'yellow' THEN 'child' 
      ELSE 'parent' 
      END AS class from sbom 
      GROUP BY name, version, status";

      $starttime = microtime(true);
      getBoms($db, $sql_parent);
      $endtime = microtime(true);
      $timediff = $endtime - $starttime;
      echo "Time (sec): $timediff";
  }
?>


<div class="right-content">
  <div class="container" id="container">
    <h3 id=scannerHeader style="color: #01B0F1;">BOM --> BOM Tree V2</h3>
    <!-- Form to retrieve user preference -->
    <form id='getpref-form' name='getpref-form' method='post' action='' style='display: inline;'>
        <button type='submit' name='getpref' value='submit'>Show My BOMS</button>
      </form>
      <form id='getdef-form' name='getdef-form' method='post' action='' style='display: inline;'>
        <button type='submit' name='getdef' value='submit'>Show System Boms</button>
      </form>
      <form id='getall-form' name='getall-form' method='post' action='' style='display: inline;'>
        <button type='submit' name='getall' value='submit'>Show All BOMS</button>
      </form>

    <nav class="navbar">
    <div class="container-fluid">
      <ul class="nav navbar-nav" style='font-size: 18px;'>
        <li><a href="#" onclick="expandAll();" id = 'expandAll'><span class="glyphicon glyphicon-chevron-down"></span>Expand All</a></li>
        <li class="active"><a href="#" onclick="collapseAll();"><span class="glyphicon glyphicon-chevron-up"></span>Collapse All</a></li>
        <li><a href="#" id='color_noColor'><span id = 'no_color'>No </span>Color</a></li>
        <li><a href="#" id ="showYellow" >Show <span class="glyphicon glyphicon-tint" style='color:#ffd966;'> </span>Yellow</a></li>
        <li><a href="#" id ="showRed" >Show <span class="glyphicon glyphicon-tint" style='color:#ff6666;'> </span>Red</a></li>
        <li><a href="#" id = "showRedYellow" > Show <span class="glyphicon glyphicon-tint" style='color:#ff6666;'></span>Red and <span class="glyphicon glyphicon-tint" style='color:#ffd966;'></span>Yellow</a></li>
        <li><div class="input-group">
          <input type="text" id="input" class="form-control" placeholder="Where Used" >
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit"> <!--Makes the user feel better, otherwise no use.-->
              <i class="glyphicon glyphicon-search"></i>
            </button>
          </div>
        </div>
        </li>
      </ul>
</div>
</nav>
  <div>
    <h4 id="loading-text">Loading...</h4>
    <div class="h4" id="responsive-wrapper" style="opacity: 0.0;">
      <table id = "bom_treetable" >
        <thead class = 'h4'>
          <th style="width:50%" >Name</th>
          <th>Version</th>
          <th>Status</th>
          <th>CMP Type</th>
          <th>Request Status</th>
          <th>Request Step</th>
          <th>Notes</th>
        </thead>
          <?php
            $getAppId = null;
            $findApp = false;

            if (isset($_GET['id'])){
              $getAppId = $_GET['id'];
              $findApp = true;
              $findAppName = false;
            }

            $getAppName = null;
            $getAppVer = null;
            $findAppName = false;
            if (isset($_GET['name']) && isset($_GET['version']) ){
              $getAppName= $_GET['name'];
              $getAppVer = $_GET['version'];
              $findApp = false;
              $findAppName = true;
            }
            //if user clicks "get all BOMS", retrieve all BOMS
            if(isset($_POST['getall'])) {
              ?>
              <script>document.getElementById("scannerHeader").innerHTML = "BOM --> BOM Tree V2 --> All BOMS";</script>
              <?php
              getAllBoms($db);

            }
            //If user clicks "get system BOMS", retrieve all default scope BOMS
            elseif(isset($_POST['getdef'])) {
              ?>
              <script>document.getElementById("scannerHeader").innerHTML = "BOM --> BOM Tree V2 --> System BOMS";</script>
              <?php
              $def = "true";
              $sql_parent = "SELECT DISTINCT app_name as name, app_id, app_version as version, app_status as status, color as div_class,
              CASE WHEN color = 'yellow' THEN 'child'
              ELSE 'parent'
              END AS class
              from sbom
              group by name, version, status;";
              getFilterArray($db);
              $starttime = microtime(true);
              getBoms($db, $sql_parent);
              $endtime = microtime(true);
              $timediff = $endtime - $starttime;
              echo "Time (sec): $timediff";

            } elseif ($findApp) {
              $sql_parent = "SELECT DISTINCT app_name as name,
                              app_version as version,
                              app_status as status,
                              '' as cmp_type,
                              '' as request_step,
                              '' as request_status,
                              '' as notes,
                              color as div_class,
                              CASE WHEN color = 'yellow' THEN 'child'
                              ELSE 'parent'
                              END AS class
                              from sbom
                              where app_id = '".$getAppId."'
                              group by name, version, status;";

              $starttime = microtime(true);
              getBoms($db, $sql_parent);
              $endtime = microtime(true);
              $timediff = $endtime - $starttime;
              echo "Time (sec): $timediff";
            } else if ($findAppName) {
              $sql_parent = "SELECT DISTINCT app_name as name,
                              app_version as version,
                              app_status as status,
                              '' as cmp_type,
                              '' as request_step,
                              '' as request_status,
                              '' as notes,
                              color as div_class,
                              CASE WHEN color = 'yellow' THEN 'child'
                              ELSE 'parent'
                              END AS class
                              from sbom
                              where app_name = '".$getAppName."'
                              and app_version = '".$getAppVer."'
                              group by name, version, status;";

              $starttime = microtime(true);
              getBoms($db, $sql_parent);
              $endtime = microtime(true);
              $timediff = $endtime - $starttime;
              echo "Time (sec): $timediff";

            }//default if preference cookie is set, display user BOM preferences
            elseif(isset($_COOKIE[$cookie_name]) || isset($_COOKIE[$cookie_name]) && isset($_POST['getpref'])) {
              ?>
              <script>document.getElementById("scannerHeader").innerHTML = "BOM --> BOM Tree V2 --> My BOMS";</script>
              <?php
              $prep = rtrim(str_repeat('?,', count(json_decode($_COOKIE[$cookie_name]))), ',');
              $sql = "SELECT DISTINCT app_name as name,
                app_version as version, app_status as status, color as div_class,
                CASE WHEN color = 'yellow' THEN 'child'
                ELSE 'parent'
                END AS class from sbom
                WHERE app_id IN (".$prep.")
                group by name, version, status;";

              $pref = $pdo->prepare($sql);
              $pref->execute(json_decode($_COOKIE[$cookie_name]));

              $p=1;
              $c=1;
              $gc=1;

              while($row = $pref->fetch(PDO::FETCH_ASSOC)) {
                $app_name = $row["name"];
                $app_version = $row["version"];
                $class = $row["class"];
                $app_status = $row["status"];
                $div_class = $row["div_class"];
                $p_id = $p;
                echo "<tbody class= '".$div_class."'>
                <tr data-tt-id = '".$p_id."' ><td class='text-capitalize'>
                <div class = 'btn ".$class."' ><span class = 'app_name' style = 'max-width: 160em; white-space: pre-wrap; word-wrap: break-word; word-break: break-all;'>".$app_name."</span>&nbsp; &nbsp;&nbsp; &nbsp;</div></td>
                <td >".$app_version."</td>
                <td class='text-capitalize'>".$app_status."</td><td/><td/><td/><td/></tr>";
                $p++;

                // output data of child
                $sql_child = "SELECT DISTINCT cmp_name as cmpname, cmp_type, cmp_version as cmpver, request_step,cmp_status, request_status, notes,
                CASE WHEN cmp_name in (select distinct app_name
                  from sbom where app_name = cmpname and app_version = cmpver) THEN 'child'
                ELSE 'grandchild'
                END AS class
                  from sbom where app_name = '".$app_name."' and app_version = '".$app_version."' and app_status = '".$app_status."'";
                $result_child = $db->query($sql_child);

                if ($result_child->num_rows > 0) {
                  // output data of child
                  while($row_child = $result_child->fetch_assoc()) {
                    $cmp_name = $row_child["cmpname"];
                    $cmp_version = $row_child["cmpver"];
                    $cmp_status = $row_child["cmp_status"];
                    $request_step = $row_child["request_step"];
                    $request_status = $row_child["request_status"];
                    $cmp_type = $row_child["cmp_type"];
                    $notes = $row_child["notes"];
                    $c_class = $row_child["class"];
                    $c_id=$p_id."-".$c;
                    echo "<tr data-tt-id = '".$c_id."' data-tt-parent-id='".$p_id."' class = 'component' >
                    <td class='text-capitalize'><div class = 'btn ".$c_class."'> <span class = 'cmp_name'>".$cmp_name."</span>&nbsp; &nbsp;&nbsp; &nbsp;</div></td>
                    <td class = 'cmp_version'>".$cmp_version."</td>
                    <td class='text-capitalize'>".$cmp_status."</td>
                    <td class='text-capitalize'>".$cmp_type."</td>
                    <td class='text-capitalize'>".$request_status."</td>
                    <td class='text-capitalize'>".$request_step."</td>
                    <td class='text-capitalize'>".$notes."</td></tr>";
                    $c++;

                    // output data of grandchild
                    $sql_gchild = "SELECT DISTINCT  cmp_name, cmp_type, cmp_version, request_step, cmp_status, request_status, notes, 'grandchild' as class
                    from sbom
                    where app_name = '".$cmp_name."' and app_version = '".$cmp_version."' ;";

                    $result_gchild = $db->query($sql_gchild);
                    if ($result_gchild->num_rows > 0 ) {
                      // output data of grandchild
                      while($row_gchild = $result_gchild->fetch_assoc()) {
                        $gcmp_name = $row_gchild["cmp_name"];
                        $gcmp_version = $row_gchild["cmp_version"];
                        $gcmp_status = $row_gchild["cmp_status"];
                        $grequest_step = $row_gchild["request_step"];
                        $grequest_status = $row_gchild["request_status"];
                        $gcmp_type = $row_gchild["cmp_type"];
                        $gnotes = $row_gchild["notes"];
                        $gc_class = $row_gchild["class"];
                        $gc_id=$c_id."-".$gc;
                        echo "<tr data-tt-id = '".$gc_id."' data-tt-parent-id='".$c_id."' >
                        <td class='text-capitalize'><div class = 'btn ".$gc_class."'> <span class = 'cmp_name'>".$gcmp_name."</span>&nbsp; &nbsp;&nbsp; &nbsp;</div></td>
                        <td class = 'cmp_version'>".$gcmp_version."</td>
                        <td class='text-capitalize'>".$gcmp_status."</td>
                        <td class='text-capitalize'>".$gcmp_type."</td>
                        <td class='text-capitalize'>".$grequest_status."</td>
                        <td class='text-capitalize'>".$grequest_step."</td>
                        <td class='text-capitalize'>".$gnotes."</td></tr>";
                        $gc++;
                      }
                    $result_gchild -> close();
                    }
                  }
                  $result_child -> close();
                } echo "</tbody>";
              }
            }//if no preference cookie is set but user clicks "show my BOMS"
            elseif(isset($_POST['getpref']) && !isset($_COOKIE[$cookie_name])) {
              ?>
              <script>document.getElementById("scannerHeader").innerHTML = "BOM --> BOM Tree V2 --> My BOMS";</script>
              <?php
              getAllBoms($db);
            }//if no preference cookie is set show BOMS in default scope
            else {
              ?>
              <script>document.getElementById("scannerHeader").innerHTML = "BOM --> BOM Tree V2 --> My BOMS";</script>
              <?php
              getAllBoms($db);
             }
          ?>
        </table>
        </div>
      </div>
    </div>

    <script>
      //Params for the treetable
      let sbom_params = {
        expandable: true,
        clickableNodeNames: true,
        indent: 40
      };
      $("#bom_treetable").treetable(sbom_params);
      //Function for Color/No Color Button
      $(document).ready(function(){
        $("#color_noColor").click(function(){
          $("#no_color").toggle();
          $("div .parent").toggleClass("bw_parent");
          $("div .child").toggleClass("bw_child");
          $("div .grandchild").toggleClass("bw_grandchild");
        });
      });
        $(document).ready(function(){
        //click getRed to hide the yellows and show the reds
        $("#showRed").click(function(){
          $("div .yellow").hide();
          $("div .red").show();
        });
      });
        $(document).ready(function(){
        //click getYellow to hide the reds and show the yellows
        $("#showYellow").click(function(){
          $("div .yellow").show();
          $("div .red").hide();
        });
      });
        $(document).ready(function(){
        //click getRedYellow to show everything
        $("#showRedYellow").click(function(){
          $("div .yellow").show();
          $("div .red").show();
        });
      });
      $(document).ready(function() {
        //input search for where used
        $('#input').on('keyup', function() {
          let input = $(this).val().toLowerCase();
          let cmp_nameInput = '', cmp_idInput = '';
          //Checks to see if the search terms are delineated, if yes, split input into cmp_nameInput and cmp_idInput
          //Feel free to add more delimiters to this array exxcept backslash ( \ ). I'm nearly 100% sure it'll break something, somewhere.
          let delimiterArray = [';', ':', ',', '|', '/'];
          let usingDelimiter = delimiterArray.some(function(delimiter){
            if(input.includes(delimiter)){
              [cmp_nameInput, cmp_idInput] = input.split(delimiter, 2);
              return true;
            }
          });
          //if we're not using a delimiter, assume input is only for component name
          if(!usingDelimiter){cmp_nameInput = input;}
          //Loops over each application
          $('#bom_treetable tbody').each(function() {
            let sucessfulMatch = false;
            //Check if any component name in the current application matches cmp_nameInput
            $(this).find(".component").each(function(){
              let nameMatch = false, idMatch = false;
              if($(this).find(".cmp_name").text().toLowerCase().includes(cmp_nameInput)){
                nameMatch = true;
              }
              if($(this).find(".cmp_version").text().toLowerCase().includes(cmp_idInput)){
                idMatch = true;
              }
              //Outer: if there was a sucessful match, don't bother searching more
              // 1: if (both search terms are used) and (both search terms aren't found)
              // 2: if (cmp_name is used) and (cmp_name isn't found)
              // 3: if (cmp_id is used) and (cmp_id isn't found)
              // 4: else, search successful, mark flag so we don't overwrite the show()
              if(!sucessfulMatch){
                if((cmp_nameInput != '' && cmp_idInput != '') && (!nameMatch || !idMatch)){
                  $(this).parent().hide();
                }else if((cmp_nameInput != '') && (!nameMatch)){
                  $(this).parent().hide();
                }else if((cmp_idInput != '') && (!idMatch)){
                  $(this).parent().hide();
                }else{
                  $(this).parent().show();
                  sucessfulMatch = true;
                }
              }
            });
          });
        });
      });
      document.onreadystatechange = function () {
        if (document.readyState === 'complete') {
          $('#loading-text').hide();
          $("#responsive-wrapper").css('opacity', '100.0');
        }
      }
      let expandAll = function(){
        $("#bom_treetable tbody tr.leaf").each((index, item) => {
          setTimeout(() => {
            $("#bom_treetable").treetable("reveal", $(item).attr("data-tt-id"))
          }, 0);
        });
      }
      let collapseAll = function(){
        let highestTimeoutId = setTimeout(";");
        for (let i = 0 ; i < highestTimeoutId ; i++) {
            clearTimeout(i);
        }
        $('#bom_treetable').treetable('collapseAll');
      }
      <?php
      if ($findApp || $findAppName) {
        echo "$( \"#expandAll\" ).trigger( \"click\" );";
      }

      ?>
      </script>