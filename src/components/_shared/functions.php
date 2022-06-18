
<!-- functions -->
<?php
    // header nav
    function checkSelectedTab( $tab ) {
        if( $tab === $GLOBALS['nav_selected'] ) {
            return 'current-page';
        }

        return '';
    }

    // header nav link path
    function checkSelectedLink( $tab, $path ) {
        if( $GLOBALS['nav_selected'] !== $tab ) {
            return $path;
        }

        return '#';
    }

    // left-menu nav
    function checkSelectedLeftMenu( $tab ) {
        if( isset($GLOBALS['left_selected']) && $GLOBALS['left_selected'] === $tab ) {
            return 'class="menu-left-current-page"';
        }

        return '';
    }

    // left-menu nav path
    function checkSelectedLeftMenuLink( $tab, $path ) {
        if( $GLOBALS['left_selected'] !== $tab ) {
            return $path;
        } else {
            return "#";
        }
    }
?>
