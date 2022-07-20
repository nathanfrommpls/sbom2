<?php
  $nav_selected = "BOM";
  $left_selected = "SBOMLIST";
  $tabTitle = "SBOM - BOM (List)";
  //$bom_columns = array("app_id","app_name","app_version","app_status","is_eol");
  $bom_columns = array("app_id","app_name","app_version","cmpt_id","cmpt_name","cmpt_version","license","status","requester","description","monitoring_id","monitoring_digest","issue_count");

  include("bom_functions.php");
  include("../../../../index.php");
  include("bom_left_menu.php");

  $def = "false";
  $DEFAULT_SCOPE_FOR_RELEASES = getScope($db);
  $scopeArray = array();
?>


<?php
  global $pref_err;

  /*----------------- FUNCTION TO GET BOMS -----------------*/
  function getAppList($db) {
    global $bom_columns;
    //displayAllAppsList($db, $bom_columns);
    displayAllAppsAndComponentList($db, $bom_columns);
  }

  checkUserAppsetCookie();
?>

    <div class="wrap">
      <h3  id = scannerHeader style = "color: #01B0F1;">Scanner --> Software BOM </h3>

      <!-- Form to retrieve user preference -->
      <form id='getpref-form' name='getpref-form' method='post' action='' style='display: inline;'>
        <button type='submit' name='show_user_boms' value='submit'>Show My BOMS</button>
      </form>
      <form id='getdef-form' name='getdef-form' method='post' action='' style='display: inline;'>
        <button type='submit' name='show_system_boms' value='submit'>Show System Boms</button>
      </form>
      <form id='getall-form' name='getall-form' method='post' action='' style='display: inline;'>
        <button type='submit' name='show_all_boms' value='submit'>Show All BOMS</button>
      </form>

      <table id="info" cellpadding="0" cellspacing="0" border="0"
        class="datatable table table-striped table-bordered datatable-style table-hover"
        width="100%" style="width: 100px;">
      <thead>
        <tr id="table-first-row">
          <?php
            global $bom_columns;
            foreach($bom_columns as $column){
              echo '<th>'.$column.'</th>';
            }
           ?>
        </tr>
      </thead>
      <tbody>
      <?php
        $startTime = microtime(true);
        //if user clicks "get all BOMS", retrieve all BOMS
        if(isset($_POST['show_all_boms'])) {
          //$def = "false";
          ?>
          <script>document.getElementById("scannerHeader").innerHTML = "BOM --> Software BOM --> All BOMS";</script>
          <?php
          getAppList($db);
        } elseif (isset($_POST['show_system_boms'])) {
          //$def = "true";
          ?>
          <script>document.getElementById("scannerHeader").innerHTML = "BOM --> Software BOM --> System BOMS";</script>
          <?php
          $is_set_sql = $db->prepare('SELECT value FROM preferences WHERE name = "ACTIVE_APP_SET"');
          if(!$is_set_sql->execute()) {
            getAppList($db);
          } else {
            $is_set_results = $is_set_sql->get_result();
            $is_set_rows = $is_set_results->fetch_all(MYSQLI_ASSOC);
            if ( 0 < count($is_set_rows)) {
              //$system_dbom_sql = 'SELECT * FROM applications WHERE app_id in ( SELECT app_id FROM app_sets WHERE app_set_id in ( SELECT value FROM preferences WHERE name = "ACTIVE_APP_SET" ));';
              $system_dbom_sql = 'SELECT applications.app_id, applications.app_name, applications.app_version, apps_components.cmpt_id, apps_components.cmpt_name, apps_components.cmpt_version, apps_components.license,apps_components.status,apps_components.requester,apps_components.description,apps_components.monitoring_id,apps_components.monitoring_digest,apps_components.issue_count FROM applications INNER JOIN apps_components ON applications.app_id = apps_components.red_app_id WHERE applications.app_id IN ( SELECT app_id FROM app_sets WHERE app_set_id in ( SELECT value FROM preferences WHERE name = "ACTIVE_APP_SET" ));';
              displayAllAppsList($db, $bom_columns, $system_dbom_sql);
            } else {
              getAppList($db);
            }
          }
        } elseif(isset($_COOKIE[$bom_app_set_cookie_name]) && isset($_POST['show_user_boms'])) {
          //default if preference cookie is set, display user BOM preferences
          ?>
          <script>document.getElementById("scannerHeader").innerHTML = "BOM --> Software BOM --> My BOMS";</script>
          <?php
          global $bom_columns;
          /*$sql = '
            SELECT * FROM applications
            WHERE app_id IN ('.get_user_appset_cookie_string().')
          ';*/
          $sql = 'SELECT applications.app_id, applications.app_name, applications.app_version, apps_components.cmpt_id, apps_components.cmpt_name, apps_components.cmpt_version, apps_components.license,apps_components.status,apps_components.requester,apps_components.description,apps_components.monitoring_id,apps_components.monitoring_digest,apps_components.issue_count FROM applications INNER JOIN apps_components ON applications.app_id = apps_components.red_app_id WHERE applications.app_id IN ('.get_user_appset_cookie_string().')';
          displayAllAppsList($db, $bom_columns, $sql);
        } elseif(isset($_POST['show_user_boms']) && !isset($_COOKIE[$bom_app_set_cookie_name])) {
          //if no preference cookie is set but user clicks "show my BOMS"
          //$def = "false";
          ?>
          <script>document.getElementById("scannerHeader").innerHTML = "BOM --> Software BOM --> All BOMS";</script>
          <?php
          getAppList($db);
        }//if no preference cookie is set show all BOMS
        else {
          //$def = "false";
          ?>
          <script>document.getElementById("scannerHeader").innerHTML = "BOM --> Software BOM --> All BOMS";</script>
          <?php
          getAppList($db);
        }
        $endTime = microtime(true) - $startTime;
      ?>
      </tbody>
      <tfoot>
        <tr>
          <?php
            global $bom_columns;
            foreach($bom_columns as $column){
              echo '<th>'.$column.'</th>';
            }
           ?>
        </tr>
      </tfoot>
      </table>
      <span><?php echo round($endTime, 5); ?> seconds to generate</span>

    <script type="text/javascript" language="javascript">
    $(document).ready( function () {
    $('#info').DataTable( {
      dom: 'lfrtBip',
      buttons: ['copy', 'excel', 'csv', 'pdf']
    } );

    $('#info thead tr').clone(true).appendTo( '#info thead' );
    $('#info thead tr:eq(1) th').each( function (i) {
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

      $( 'input', this ).on( 'keyup change', function () {
        if ( table.column(i).search() !== this.value ) {
          table
          .column(i)
          .search( this.value )
          .draw();
        }
      } );
    } );

      var table = $('#info').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
        retrieve: true
      } );

      /*
      * If the default scope is to be used then this will iterate through
      * each row of the datatable and hide any rows whose app_id does not
      * match a release who's app is not in the default scope
      */

      var def = <?php echo json_encode($def); ?>;
      var app_id = <?php echo json_encode($scopeArray); ?>;

      if (def === "true") {
        var indexes = table.rows().indexes().filter(
          function (value, index) {
            var currentID = table.row(value).data()[1];
            var currentIDString = JSON.stringify(currentID);
            for (var i = 0; i < app_id.length; i++){
            if (currentIDString.includes(app_id[i])) {
              return false;
              break;
              }
            }
            return true;
          });
        table.rows(indexes).remove().draw();
     }

    const listTable = document.querySelector('#info');
    const infoFilter = document.querySelector('#info_filter');
    let z = document.createElement('div');
    z.classList.add('table-container');

    z.append(listTable);
    infoFilter.after(z);

    $('.table-container').doubleScroll(); // assign a double scroll to this class
    } );
  </script>
