<?php
  $nav_selected = "RELEASES";
  $left_selected = "RELEASESLIST";
  $tabTitle = 'SBOM - Releases (List)';

  include('../../../../index.php');
  include('releases_left_menu.php');

  global $db;
  global $count_err;

  function updateScope($db, $newScope)
  {
      $sql = "UPDATE preferences
              SET value = '$newScope'
              WHERE name = 'SYSTEM_BOMS';";
      $result = $db->query($sql);
  }

  /*----------------- SET PREFERENCE COOKIE -----------------*/
  $cookie_name = 'preference';
  $expire = strtotime('+1 year');

  //If user wants to use admin functions of release table then they must be logged in
  if (isset($_POST['saveScope'])) {
    include("session.php");
  }

  //Get selected apps & put into cookie or system scope if the user is logged in as an admin
  if(isset($_POST['save']) && isset($_POST['app'])) {
    $apps = $_POST['app'];

      echo '<p>BOM preferences successfully saved.</p>';
        header("Refresh:1.75");
      $preference = $apps;
      $set_pref = setcookie($cookie_name, json_encode($preference), $expire);

  }elseif(isset($_POST['save']) && !isset($_POST['app'])) {
    if(!isset($apps)) {
      $count_err = "Please select at least one BOM.";
    }
  }elseif(isset($_POST['saveScope']) && isset($_POST['app']) && isset($_SESSION['login_user']) && isset($_SESSION['admin'])) {
    $apps = $_POST['app'];

      echo '<p>Default BOM scope successfully set.</p>';
      $newScope = implode(",",$apps);
      updateScope($db, $newScope);
  } elseif (isset($_POST['saveScope']) && !isset($_POST['app']) && isset($_SESSION['login_user']) && isset($_SESSION['admin'])){
    if(!isset($apps)){
      $count_err = "You have set the system scope to be empty";
      $newScope = '';
      updateScope($db, $newScope);
    }
  } elseif (isset($_POST['saveScope']) && !isset($_SESSION['admin'])){
    echo '<p>You must be login in as an administrator to use this function.</p>';
  }
  //if cookie is set, decode cookie into array
  if(isset($_COOKIE[$cookie_name])) {
    $cookie_arr = json_decode($_COOKIE[$cookie_name]);
  }

?>

<script type="text/javascript" language="javascript">
  $(document).ready( function () {
    
    //Create search bars at the footer of every column
    $('#info tfoot th').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

  var table = $('#info').DataTable({
    dom: 'lfrtBip',
    orderCellsTop: true,
    fixedHeader: true,
    retrieve: true,
    "paging": false
  });

  $('a.toggle-vis').on('click', function(e) {
    e.preventDefault();

    // Get the column API object
  var column = table.column($(this).attr('data-column'));

  //Change link color
  if (column.visible()){
    $(this).css('color','red');
  } else {
    $(this).css('color','#0000EE');
  }

  // Toggle the visibility
  column.visible(!column.visible());
  });

  // Apply the search
  table.columns().every( function () {
    var that = this;

    $( 'input', this.footer() ).on( 'keyup change clear', function () {
    if ( that.search() !== this.value ) {
        that
            .search( this.value )
            .draw();
        }
    } );

  } );

    const listTable = document.querySelector('#info');
    const infoFilter = document.querySelector('#info_filter');
    let z = document.createElement('div');
    z.classList.add('table-container');

    z.append(listTable);
    infoFilter.after(z);

    $('.table-container').doubleScroll(); // assign a double scroll to this class
  });
</script>

<div id="releases" class="wrap">
  <h3>Releases -> System Releases List</h3>

  <p>
    <b> Toggle column: </b>
    <a class="toggle-vis" data-column="0">Select App</a> - 
    <a class="toggle-vis" data-column="1">Application ID</a> - 
    <a class="toggle-vis" data-column="2">Release ID</a> - 
    <a class="toggle-vis" data-column="3">Name</a> - 
    <a class="toggle-vis" data-column="4">Type</a> - 
    <a class="toggle-vis" data-column="5">Status</a> - 
    <a class="toggle-vis" data-column="6">Open Date</a> - 
    <br />
    <a class="toggle-vis" data-column="7">Dependency Date</a> - 
    <a class="toggle-vis" data-column="8">Content Date</a> - 
    <a class="toggle-vis" data-column="9">RTM Date(s)</a> - 
    <a class="toggle-vis" data-column="10">Manager</a> - 
    <a class="toggle-vis" data-column="11">Author</a> - 
    <a class="toggle-vis" data-column="12">Tag</a>
  </p>

  <!-- Form to set user preference -->
  <form id='app-form' name='app-form' method='post' action=''>
    <table id="info" class="table table-striped table-bordered">
      <thead>
        <tr id="table-first-row">
          <th>Select App</th>
          <th>Application ID</th>
          <th>Release ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Status</th>
          <th>Open Date</th>
          <th>Dependency Date</th>
          <th>Content Date</th>
          <th>RTM Date(s)</th>
          <th>Manager</th>
          <th>Author</th>
          <th>Tag</th>
        </tr>
      </thead>

      <tbody>
        <?php
          $sql = "SELECT * from releases ORDER BY rtm_date ASC;";
          $result = $db->query($sql);

          if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              echo '<tr>';
              $appName = str_replace(' ', '', $row["name"]);
              $sql2 = "SELECT DISTINCT app_id as appID FROM (select distinct concat(TRIM(app_name),
                TRIM(app_version)) as name, app_id from sbom ) as subquery where name ='".$appName."' Limit 1;";
              $result2 = $db->query($sql2);

              //if a cookie is set keep the selected apps checkbox checked
              if(isset($_COOKIE[$cookie_name])) {
                if (in_array($row['app_id'], $cookie_arr, true)) {
                  echo "<td><input type='checkbox' name='app[]' value='".$row['app_id']."' checked></td>";
                }else {
                  echo "<td><input type='checkbox' name='app[]' value='".$row['app_id']."'></td>";
                }
              }//if no cookie is set, all checkboxes are unchecked by default
              else {
                echo "<td><input type='checkbox' name='app[]' value='".$row['app_id']."'></td>";
              }

              echo '<td><a class="btn" href="../bom/bom_sbom_tree_v2.php?id='.$row["app_id"].'">'.$row["app_id"].' </a> </td>';
              echo '<td><a class="btn" href="../bom/bom_sbom_tree_v2.php?id='.$row["app_id"].'">'.$row["id"].' </a> </td>';

              if ($result2->num_rows > 0) {
                while($row2 = $result2->fetch_assoc()) {
                  $id = $row2["appID"];
                }
                echo '<td><a href="../bom/bom_sbom_tree_v2.php?id='.$id.'">'.$row["name"].' </a> </span> </td>';

              }//end if
              else {
                echo '<td>'.$row["name"].' </span> </td>';
              }//end else
              echo '<td>'.$row["type"].'</td>
                <td>'.$row["status"].'</td>
                <td>'.$row["open_date"].' </span> </td>
                <td>'.$row["dependency_date"].'</td>
                <td>'.$row["freeze_date"].'</td>
                <td>'.$row["rtm_date"].' </span> </td>
                <td>'.$row["manager"].' </span> </td>
                <td>'.$row["author"].' </span> </td>
                <td>'.$row["tag"].' </span> </td>';
              echo '</tr>';
                $result2->close();
            }
          }
        ?>
      </tbody>

      <thead>
        <tr>
          <th>Select App</th>
          <th>Application ID</th>
          <th>Release ID</th>
          <th>Name</th>
          <th>Type</th>
          <th>Status</th>
          <th>Open Date</th>
          <th>Dependency Date</th>
          <th>Content Date</th>
          <th>RTM Date(s)</th>
          <th>Manager</th>
          <th>Author</th>
          <th>Tag</th>
        </tr>
      </thead>
    </table>

    <button type='submit' name='save' value='submit'>Set My BOMS</button>
    <button type='submit' name='saveScope' value='submit'>Set System BOMS</button>
  </form>
</div>
