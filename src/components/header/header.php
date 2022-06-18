
<ul id="HEADER">
    <?php
        // logo
        echo
            '<a href="'.checkSelectedLink( "", $indexPath.'index.php' ).'">
                <li class="logo '.checkSelectedTab( "" ).'">';
        include $assetsPath.'svg/structure.svg';
        echo '
                    <h1> SOFTWARE BOM </h1>
                </li>
            </a>';
    ?>

    <!-- nav links -->
    <span class="links">
        <?php
            echo
                '<li class="search '.checkSelectedTab( "SEARCH" ).'" tabindex="0">
                    <form action="'.$componentsPath.'pages/search/search.php" method="POST">
                        <input name="searchVal" />';
            include $assetsPath.'svg/search.svg';
            echo
                    '</form>
                </li>';

            echo
                '<a href="'.checkSelectedLink( "RELEASES", $componentsPath.'pages/releases/releases_releases_list.php' ).'">
                    <li class="'.checkSelectedTab( "RELEASES" ).'">';
            include $assetsPath.'svg/releases.svg';
            echo
                        '<h2> RELEASES </h2>
                    </li>
                </a>';
            
            echo
                '<a href="'.checkSelectedLink( "APPLICATIONS", $componentsPath.'pages/applications/applications_page.php' ).'">
                    <li class="'.checkSelectedTab( "APPLICATIONS" ).'">';
            include $assetsPath.'svg/applications.svg';
            echo
                        '<h2> APPLICATIONS </h2>
                    </li>
                </a>';

            echo 
                '<a href="'.checkSelectedLink( "BOM", $componentsPath.'pages/bom/bom_sbom_list.php' ).'">
                    <li class="'.checkSelectedTab( "BOM" ).'">';
            include $assetsPath.'svg/bom.svg';
            echo
                        '<h2> BOM </h2>
                    </li>
                </a>';

            echo
                '<a href="'.checkSelectedLink( "OWNERSHIP", $componentsPath.'pages/ownership/ownership.php' ).'">
                    <li class="'.checkSelectedTab( "OWNERSHIP" ).'">';
            include $assetsPath.'svg/copyright.svg';
            echo
                        '<h2> OWNERSHIP </h2>
                    </li>
                </a>';
            
            echo
                '<a href="'.checkSelectedLink( "SETUP", $componentsPath.'pages/setup/setup_system_preference.php' ).'">
                    <li class="'.checkSelectedTab( "SETUP" ).'">';
            include $assetsPath.'svg/tools.svg';
            echo
                        '<h2> SETUP </h2>
                    </li>
                </a>';

            echo
                '<a href="'.checkSelectedLink( "REPORTS", $componentsPath.'pages/reports/reports_location.php' ).'">
                    <li class="'.checkSelectedTab( "REPORTS" ).'">';
            include $assetsPath.'svg/chart.svg';
            echo
                        '<h2> REPORTS </h2>
                    </li>
                </a>';

            echo
                '<a href="'.checkSelectedLink( "HELP", $componentsPath.'pages/help/help_process.php' ).'">
                    <li class="'.checkSelectedTab( "HELP" ).'">';
            include $assetsPath.'svg/help.svg';
            echo
                        '<h2> HELP </h2>
                    </li>
                </a>';

            if( isset( $_SESSION['admin'] ) ) {
                echo
                    '<a href="'.checkSelectedLink( "ADMIN", $componentsPath.'pages/admin/admin_bom_backup.php' ).'">
                        <li class="'.checkSelectedTab( "ADMIN" ).'">';
                include $assetsPath.'svg/admin.svg';
                echo
                            '<h2> ADMIN </h2>
                        </li>
                    </a>';
            }

            if( isset( $_SESSION['login_user'] ) ) { // logout will never have a selected state.
                echo 
                    '<a href="'.$componentsPath.'pages/login/logout.php">
                        <li>';
                include $assetsPath.'svg/logout.svg';
                echo
                            '<h2> LOGOUT </h2>
                        </li>
                    </a>';
            } else {
                echo
                    '<a href="'.checkSelectedLink( "LOGIN", $componentsPath.'pages/login/login.php' ).'">
                        <li class="'.checkSelectedTab( "LOGIN" ).'">';
                include $assetsPath.'svg/login.svg';
                echo
                            '<h2> LOGIN </h2>
                        </li>
                    </a>';
            }
        ?>
    </span>
</ul>
