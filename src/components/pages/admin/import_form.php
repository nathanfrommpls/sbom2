<form id="importform" action="admin_import_bom.php" method="post">
  <h4>Column Mapping for: <span style='color: red;'><?php echo $_FILES["file"]["name"]?></span></h4>
  
  <div class="group">
    <label for="app_id">App ID</label>
    <select id="app_id" name="app_id" required>
      <?php dropdown($cookie_map, 'appid', $row); ?>
    </select>

    <label for="app_name">App Name</label>
    <select id="app_name" name="app_name" required>
      <?php dropdown($cookie_map, 'appname', $row); ?>
    </select>

    <label for="app_version">App Version</label>
    <select id="app_version" name="app_version" required>
      <?php dropdown($cookie_map, 'appver', $row); ?>
    </select>

    <label for="cmp_id">Component ID:</label>
    <select id="cmp_id" name="cmp_id" required>
      <?php dropdown($cookie_map, 'cmpid', $row); ?>
    </select>

    <label for="cmp_name">Component Name:</label>
    <select id="cmp_name" name="cmp_name" required>
      <?php dropdown($cookie_map, 'cmpname', $row); ?>
    </select>
  </div>

  <div class="group">
    <label for="cmp_version">Component Version:</label>
    <select id="cmp_version" name="cmp_version" required>
      <?php dropdown($cookie_map, 'cmpver', $row); ?>
    </select>

    <label for="cmp_type">Component Type:</label>
    <select id="cmp_type" name="cmp_type" required>
      <?php dropdown($cookie_map, 'cmptype', $row); ?>
    </select>

    <label for="app_status">App Status:</label>
    <select id="app_status" name="app_status" required>
      <?php dropdown($cookie_map, 'appstatus', $row); ?>
    </select>

    <label for="cmp_status">Component Status:</label>
    <select id="cmp_status" name="cmp_status" required>
      <?php dropdown($cookie_map, 'cmpstatus', $row); ?>
    </select>

    <label for="request_id">Request ID:</label>
    <select id="request_id" name="request_id" required>
      <?php dropdown($cookie_map, 'requestid', $row); ?>
    </select>
  </div>

  <div class="group">
    <label for="request_date">Request Date:</label>
    <select id="request_date" name="request_date" required>
      <?php dropdown($cookie_map, 'requestdate', $row); ?>
    </select>

    <label for="request_status">Request Status:</label>
    <select id="request_status" name="request_status" required>
      <?php dropdown($cookie_map, 'requeststatus', $row); ?>
    </select>

    <label for="request_step">Request Step:</label>
    <select id="request_step" name="request_step" required>
      <?php dropdown($cookie_map, 'requeststep', $row); ?>
    </select>

    <label for="notes">Notes:</label>
    <select id="notes" name="notes" required>
      <?php dropdown($cookie_map, 'notes', $row); ?>
    </select>

    <label for="requestor">Requestor:</label>
    <select id="requestor" name="requestor" required>
      <?php dropdown($cookie_map, 'requestor', $row); ?>
    </select>
  </div>

  <button type="submit" name="submitform" value="submit">Import File</button>
</form>
