<div class="wrap">
  <div id="menu-left">
    <!-- <a href="<?php echo checkSelectedLeftMenuLink( "USERS", "admin_users.php" ); ?>">
        <div <?php echo checkSelectedLeftMenu( "USERS" ); ?>>
        <?php include $assetsPath."svg/users.svg"; ?>
        <p>Users</p></div>
    </a> -->

    <a href="<?php echo checkSelectedLeftMenuLink( "BOMBACKUP", "admin_bom_backup.php" ); ?>">
        <div <?php echo checkSelectedLeftMenu( "BOMBACKUP" ); ?>>
        <?php include $assetsPath."svg/save.svg"; ?>
        <p>BOM Backup</p></div>
    </a>

    <!-- <a href="<?php echo checkSelectedLeftMenuLink( "BOMCOMPARE", "admin_bom_compare.php" ); ?>">
      <div <?php echo checkSelectedLeftMenu( "BOMCOMPARE" ); ?>>
      <?php include $assetsPath."svg/compare.svg"; ?>
      <p>BOM Compare</p></div>
    </a> -->

    <a href="<?php echo checkSelectedLeftMenuLink( "IMPORTBOM", "admin_import_bom_2.php" ); ?>">
      <div <?php echo checkSelectedLeftMenu( "IMPORTBOM" ); ?>>
      <?php include $assetsPath."svg/upload.svg"; ?>
      <p> Import Bom </p></div>
    </a>
  </div>
</div>
