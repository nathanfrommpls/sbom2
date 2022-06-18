
<?php
  // pages are separate from the index, so this is needed for pathing..
  if( !isset( $nav_selected ) ) { // from "index.php"
    $nav_selected = $indexPath = '';
    $tabTitle = 'Software BOM (SBOM)';
    $assetsPath = 'src/assets/';
    $componentsPath = 'src/components/';
  } else { // from "components"
    $indexPath = '../../../../';
    $assetsPath = '../../../assets/';
    $componentsPath = '../../';
  }
?>
