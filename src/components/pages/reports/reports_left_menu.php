
<!-- checkSelectedLeftMenuLink() is in the header, so all left-menu's have access to the function -->
<div class="wrap">
    <div id="menu-left">
        <a href="<?php echo checkSelectedLeftMenuLink( "REPORTSLOCATION", "reports_location.php" ); ?>">
            <div <?php echo checkSelectedLeftMenu( "REPORTSLOCATION" ); ?>>
                <?php include $assetsPath."svg/location.svg"; ?>
                <p> Reports (Location) </p>
            </div>
        </a>

        <a href="<?php echo checkSelectedLeftMenuLink( "REPORTSFOSSCOUNT", "reports_foss_count.php" ); ?>">
            <div <?php echo checkSelectedLeftMenu( "REPORTSFOSSCOUNT" ); ?>>
                <?php include $assetsPath."svg/numberedList.svg"; ?>
                <p> FOSS Count </p>
            </div>
        </a>

        <a href="<?php echo checkSelectedLeftMenuLink( "REPORTSUNIQUEFOSSLIST", "reports_unique_foss_list.php" ); ?>">
            <div <?php echo checkSelectedLeftMenu( "REPORTSUNIQUEFOSSLIST" ); ?>>
                <?php include $assetsPath."svg/starCircled.svg"; ?>
                <p> Unique FOSS List </p>
            </div>
        </a>

        <a href="<?php echo checkSelectedLeftMenuLink( "REPORTSDUPLICATEVERSIONS", "reports_duplicate_versions.php" ); ?>">
            <div <?php echo checkSelectedLeftMenu( "REPORTSDUPLICATEVERSIONS" ); ?>>
                <?php include $assetsPath."svg/duplicate.svg"; ?>
                <p> Duplicate Versions </p>
            </div>
        </a>

        <a href="<?php echo checkSelectedLeftMenuLink( "REPORTSMULTIPLEVERSIONS", "reports_multiple_versions.php" ); ?>">
            <div <?php echo checkSelectedLeftMenu( "REPORTSMULTIPLEVERSIONS" ); ?>>
                <?php include $assetsPath."svg/multiple.svg"; ?>
                <p> Multiple Versions </p>
            </div>
        </a>

        <a href="<?php echo checkSelectedLeftMenuLink( "REPORTSOWNERSHIP", "reports_ownership.php" ); ?>">
            <div <?php echo checkSelectedLeftMenu( "REPORTSOWNERSHIP" ); ?>>
                <?php include $assetsPath."svg/copyright.svg"; ?>
                <p> Reports (Ownership) </p>
            </div>
        </a>
    </div>
</div>
