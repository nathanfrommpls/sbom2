
<!-- app styles -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
        echo '<link rel="stylesheet" href="'.$componentsPath.'_shared/styles/_variables.css">';
        echo '<link rel="stylesheet" href="'.$componentsPath.'app.css">';
        echo '<link rel="stylesheet" href="'.$componentsPath.'header/header.css">';
        echo '<link rel="stylesheet" href="'.$componentsPath.'_shared/styles/form.css">';
        echo '<link rel="stylesheet" href="'.$componentsPath.'_shared/styles/table.css">';
        echo '<link rel="stylesheet" href="'.$componentsPath.'_shared/styles/left_menu.css">';
        echo '<link rel="stylesheet" href="'.$componentsPath.'pages/pages.css">';
        echo '<link rel="stylesheet" href="'.$componentsPath.'pages/bom/tree.css">';
        echo '<link rel="stylesheet" href="'.$componentsPath.'pages/login/login.css">';
        echo '<link rel="stylesheet" href="'.$componentsPath.'pages/releases/releases.css">';
    ?>

    <link rel="icon" href="<?php echo $assetsPath; ?>images/BOM.png" />
    <title><?php echo $tabTitle; ?></title>
</head>
