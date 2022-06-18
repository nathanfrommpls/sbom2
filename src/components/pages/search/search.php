
<?php
  $nav_selected = "SEARCH";
  $tabTitle = "SBOM - Search";

  include("../../../../index.php");

  // search component name first, then app name.
  // default to "where" searches when nothing is provided (where/who)
  $searchVal = $_POST["searchVal"];
  function searchAppComponents( $search ) {
    $sql =
      'SELECT * from apps_components
      WHERE cmpt_name LIKE "'.$search.'%"
      OR app_name LIKE "'.$search.'%"';

    return $data = $GLOBALS['db'] -> query( $sql );
  }

  function grabList( $result ) {
    $list = [];

    foreach( $result as $key => $val ) {
      array_push( $list, $val );
    }

    return $list;
  }

  function buildTable( $object ) {
    echo 
      '<div class="table-container">
        <table class="table table-striped table-bordered">';

    $x = 0; // used to find first object, not increment
    foreach( $object as $key => $val ) {
      if( $x === 0 ) { // build headers from first object
        echo '<tr>';
        foreach( $val as $col => $cell ) {
          echo '<th>'.$col.'</th>';
        }
        echo '</tr>';

        echo '<tr>';
        foreach( $val as $col => $cell ) { // apply first row values from object
          echo '<td>'.$cell.'</td>';
        }
        echo '</tr>';
      } else { // build any other rows that come after
        echo '<tr>';
        foreach( $val as $col => $cell ) {
          echo '<td>'.$cell.'</td>';
        }
        echo '</tr>';
      }

      $x++;
    }

    echo
        '</table>
      </div>';
  }
?>

<!-- HTML -->
<div class="wrap">
  <h3>
    <span>Query: <i>"app_components"</i></span>

    <div>
      WHERE <span> (cmpt_name</span> OR <span>app_name) = </span>
      <span><i><u><?php echo $searchVal; ?></u></i></span>
    </div>
  </h3>

  <?php
    // can possibly build toggle to search other tables.
    $resultsObject = searchAppComponents( $searchVal );

    buildTable( $resultsObject ); // table output to HTML
  ?>
</div>

<!-- added functionality -->
<script>
  $('.table-container').doubleScroll(); // assign a double scroll to this class
</script>

<?php
  // console output
  $resultsArray = grabList( $resultsObject );
  $json = json_encode( $resultsArray, JSON_PRETTY_PRINT );
  
  echo '<script> console.warn("Data:"); </script>';
  echo '<script> console.warn('.$json.'); </script>';
?>
