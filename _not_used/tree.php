-<?php
  
  $nav_selected = "SCANNER";
  $left_buttons = "YES";
  $left_selected = "SBOMTREE";
  include("./index.php");
 ?>

<div class="right-content">
    <div class="container" id="container">
        <h3 style="color: #01B0F1;">Scanner --> BOM Tree</h3>
        <nav class="navbar">
            <div class="container-fluid">
                <ul class="nav navbar-nav" style='font-size: 18px;'>
                    <li><a href="#" onclick="expandAll();" id = 'expandAll'><span
                                class="glyphicon glyphicon-chevron-down"></span>Expand All</a></li>
                    <li class="active"><a href="#"
                            onclick="collapseAll();"><span
                                class="glyphicon glyphicon-chevron-up"></span>Collapse All</a></li>
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
                        <div >
                          <h4 id="loading-text">Loading...</h4>
                          <div class="h4" id="responsive-wrapper" style="opacity: 0.0;">
                            <!--table id = "bom_treetable" class = "table">
                              <thead class = 'h4'>
                                <th >Name</th>
                                <th>Version</th>
                                <th>Status</th>
                                <th>CMP Type</th>
                                <th>Request Status</th>
                                <th>Request Step</th>
                                <th>Notes</th>
                              </thead-->
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

            if ($findApp) {
              $sql_parent = "SELECT DISTINCT app_name as name, 
                              app_version as version, 
                              app_status as status, 
                              '' as cmp_type, 
                              '' as request_step,
                              '' as request_status,
                              '' as notes, 
                              'parent' as class, 
                              'red' as div_class,
                              concat(app_name, concat('_', app_version)) as application
                              from sbom  
                              where app_id = '".$getAppId."';";
            } else if ($findAppName) {
              $sql_parent = "SELECT DISTINCT app_name as name, 
                              app_version as version, 
                              app_status as status, 
                              '' as cmp_type, 
                              '' as request_step,
                              '' as request_status,
                              '' as notes, 
                              'parent' as class, 
                              'red' as div_class, 
                              concat(app_name, concat('_', app_version)) as application
                              from sbom  
                              where app_name = '".$getAppName."' 
                              and app_version = '".$getAppVer."' ;";
            } else {
              $sql_parent = "SELECT DISTINCT app_name as name, 
              app_version as version, 
              app_status as status, 
              '' as cmp_type, 
              '' as request_step,
              '' as request_status,
              '' as notes, 
              CASE WHEN app_name in (select distinct cmp_name from sbom) THEN 'child'
              ELSE 'parent'
              END AS class,
              CASE WHEN app_name in (select distinct cmp_name from sbom) THEN 'yellow'
              ELSE 'red'
              END AS div_class,
              concat(app_name, concat('_', app_version)) as application
              from sbom";
             }
            $result_parent = $db->query($sql_parent);
            $p=1;
            $c=1;
            $gc=1;
            if ($result_parent->num_rows > 0) {
              while($row_parent = $result_parent->fetch_assoc()) {
                $app_name = $row_parent["name"];
                $app_version = $row_parent["version"];
                $class = $row_parent["class"];
                $app_status = $row_parent["status"];
                $cmp_type = $row_parent["cmp_type"];
                $request_step = $row_parent["request_step"];
                $request_status = $row_parent["request_status"];
                $notes = $row_parent["notes"];
                $application = $row_parent["application"];
                $div_class = $row_parent["div_class"];
                $p_id = $p;
                echo "PARENT: ".print_r(array_values($row_parent))." ".$p_id."<br>";

                $p++;
                      // output data of child
                      $sql_child = "SELECT DISTINCT cmp_name, 
                                                      cmp_type, 
                                                      cmp_version, 
                                                      request_step,
                                                      cmp_status, 
                                                      request_status,
                                                      notes, 
                                                      CASE WHEN cmp_name in (select distinct app_name from sbom) THEN 'child'
                                                      ELSE 'grandchild'
                                                      END AS class,
                                                      concat(cmp_name, concat('_', cmp_version)) as cmp
                                        from sbom
                                        where app_name = '".$app_name."'
                                        and app_version = '".$app_version."'
                                        and app_status = '".$app_status."'";
                          $result_child = $db->query($sql_child);
                          if ($result_child->num_rows > 0) {
                            // output data of child
                            while($row_child = $result_child->fetch_assoc()) {
                              $cmp_name = $row_child["cmp_name"];
                              $cmp = $row_child["cmp"];
                              $cmp_version = $row_child["cmp_version"];
                              $cmp_status = $row_child["cmp_status"];
                              $request_step = $row_child["request_step"];
                              $request_status = $row_child["request_status"];
                              $cmp_type = $row_child["cmp_type"];
                              $notes = $row_child["notes"];
                              $c_class = $row_child["class"];
                              $c_id=$p_id."_".$c;
                             
                              echo "CHILD: ".print_r(array_values($row_child))." ".$p_id." ".$c_id."<br>";
                              $c++;
                          // output data of grandchild
                          $sql_gchild = "SELECT DISTINCT  cmp_name,
                                          cmp_type, 
                                          cmp_version, 
                                          request_step,
                                          cmp_status, 
                                          request_status,
                                          notes, 
                                          'grandchild' as class, 
                                          concat(cmp_name, concat('_', cmp_version)) as gcmp
                                        from sbom
                                        where app_name = '".$cmp_name."'
                                        and app_version = '".$cmp_version."'
                                        and app_status = '".$cmp_status."'
                                        ;";
                                      $result_gchild = $db->query($sql_gchild);
                                      if ($result_gchild->num_rows > 0 ) {
                                        // output data of grandchild
                                        while($row_gchild = $result_gchild->fetch_assoc()) {
                                          $gcmp_name = $row_gchild["cmp_name"];
                                          $gcmp = $row_gchild["gcmp"];
                                          $gcmp_version = $row_gchild["cmp_version"];
                                          $gcmp_status = $row_gchild["cmp_status"];
                                          $grequest_step = $row_gchild["request_step"];
                                          $grequest_status = $row_gchild["request_status"];
                                          $gcmp_type = $row_gchild["cmp_type"];
                                          $gnotes = $row_gchild["notes"];
                                          $gc_class = $row_gchild["class"];
                                          $gc_id=$c_id."_".$gc;
                                          echo "GRANDCHILD: ".print_r(array_values($row_gchild))." ".$c_id." ".$gc_id."<br>";
                                          $gc++;
                                      }
                                    $result_gchild -> close();
                                  }
                                }
                                $result_child -> close();
                            } 
                            
                        }
                    $result_parent->close();
                  }
          //if there is no parent, then add a row to reflect no results.
          else {
            
          }
          
          ?>
        </table>
        </div>
      </div>
    </div>
    <?php include("./footer.php"); ?>
    <script>
      //Params for the treetable
      let sbom_params = {
        expandable: true,
        clickableNodeNames: true,
        indent: 25
      };
      $("#bom_treetable").treetable(sbom_params).DataTable(
        {
          searching: false,
          columnDefs: [
            { width: "35%", targets: 0 }
            ],
          ordering:  false,
          info: false,
          scrollY:        '50vh',
          scrollCollapse: true,
          paging:         false
        });
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