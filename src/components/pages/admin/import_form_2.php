<form id="importform" action="admin_import_bom_2.php" method="post">
<h4>Column Mapping for: <span style='color: red;'><?php echo $_FILES["file"]["name"]?></span></h4>
<div class="group">
  <label for="cmpt_id">Component ID:</label>
  <select id="cmpt_id" name="cmpt_id" required>
    <?php dropdown($cookie_map, 'cmpt_id', $row); ?>
  </select>

  <label for="cmpt_name">Component Name:</label>
  <select id="cmpt_name" name="cmpt_name" required>
    <?php dropdown($cookie_map, 'cmpt_name', $row); ?>
  </select>

  <label for="cmpt_version">Component Version:</label>
  <select id="cmpt_version" name="cmpt_version" required>
    <?php dropdown($cookie_map, 'cmpt_version', $row); ?>
  </select>

  <label for="app_id">Application ID:</label>
  <select id="app_id" name="app_id" required>
    <?php dropdown($cookie_map, 'app_id', $row); ?>
  </select>
</div>

<div class="group">
  <label for="app_name">Application Name:</label>
  <select id="app_name" name="app_name" required>
    <?php dropdown($cookie_map, 'app_name', $row); ?>
  </select>

  <label for="app_version">Application Version:</label>
  <select id="app_version" name="app_version" required>
    <?php dropdown($cookie_map, 'app_version', $row); ?>
  </select>

  <label for="license">License:</label>
  <select id="license" name="license" required>
    <?php dropdown($cookie_map, 'license', $row); ?>
  </select>

  <label for="status">Status:</label>
  <select id="status" name="status" required>
    <?php dropdown($cookie_map, 'status', $row); ?>
  </select>

  <label for="requester">Requester:</label>
  <select id="requester" name="requester" required>
    <?php dropdown($cookie_map, 'requester', $row); ?>
  </select>
</div>

<div class="group">
  <label for="description">Description:</label>
  <select id="description" name="description" required>
    <?php dropdown($cookie_map, 'description', $row); ?>
  </select>

  <label for="monitoring_id">Monitoring ID:</label>
  <select id="monitoring_id" name="monitoring_id" required>
    <?php dropdown($cookie_map, 'monitoring_id', $row); ?>
  </select>

  <label for="monitoring_digest">Monitoring Digest:</label>
  <select id="monitoring_digest" name="monitoring_digest" required>
    <?php dropdown($cookie_map, 'monitoring_digest', $row); ?>
  </select>

  <label for="issue_count">Issue Count:</label>
  <select id="issue_count" name="issue_count" required>
    <?php dropdown($cookie_map, 'issue_count', $row); ?>
  </select>

</div>

<?php
  // Simply passing the Red App ID from admin_import_bom_2.php back to the same
  echo '<input type="hidden" id="red_app_id_field" name="red_app_id_field" value="'.$_POST['red_app_id_form'].'">';
?>

<button type="submit" name="submitform" value="submit">Import File</button>
</form>
