
<!-- checkSelectedLeftMenuLink() is in the header, so all left-menu's have access to the function -->
<div class="wrap">
    <div id="menu-left">
        <a href="<?php echo checkSelectedLeftMenuLink( "HELPPROCESS", "help_process.php" ); ?>">
            <div <?php echo checkSelectedLeftMenu( "HELPPROCESS" ); ?>>
                <?php include $assetsPath."svg/path.svg"; ?>
                <p> Process </p>
            </div>
        </a>

        <a href="<?php echo checkSelectedLeftMenuLink( "HELPCHAT", "help_chat.php" ); ?>">
            <div <?php echo checkSelectedLeftMenu( "HELPCHAT" ); ?>>
                <?php include $assetsPath."svg/chat.svg"; ?>
                <p> Chat </p>
            </div>
        </a>

        <a href="<?php echo checkSelectedLeftMenuLink( "HELPAPIS", "help_apis.php" ); ?>">
            <div <?php echo checkSelectedLeftMenu( "HELPAPIS" ); ?>>
                <?php include $assetsPath."svg/api.svg"; ?>
                <p> APIs </p>
            </div>
        </a>

        <a href="<?php echo checkSelectedLeftMenuLink( "HELPFAQS", "help_faqs.php" ); ?>">
            <div <?php echo checkSelectedLeftMenu( "HELPFAQS" ); ?>>
                <?php include $assetsPath."svg/faq.svg"; ?>
                <p> FAQs </p>
            </div>
        </a>
    </div>
</div>
