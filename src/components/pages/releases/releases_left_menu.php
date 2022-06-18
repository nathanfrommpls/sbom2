
<div class="wrap">
    <div id="menu-left">
        <a href="<?php echo checkSelectedLeftMenuLink( "RELEASESLIST", "releases_releases_list.php" ); ?>">
            <div <?php echo checkSelectedLeftMenu( "RELEASESLIST" ); ?>>
                <?php include $assetsPath.'svg/tableChart.svg'; ?>
                <p> Releases List </p>
            </div>
        </a>

        <a href="<?php echo checkSelectedLeftMenuLink( "RELEASESGANTT", "releases_releases_gantt.php" ); ?>">
            <div <?php echo checkSelectedLeftMenu( "RELEASESGANTT" ); ?>>
                <?php include $assetsPath.'svg/backupTable.svg'; ?>
                <p> Releases Gantt </p>
            </div>
        </a>
    </div>
</div>
