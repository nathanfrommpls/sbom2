
<div class="wrap">
	<div id="menu-left">
		<a href="<?php echo checkSelectedLeftMenuLink( "SYSPREFERENCES", "setup_system_preference.php" ); ?>">
			<div <?php echo checkSelectedLeftMenu( "SYSPREFERENCES" ); ?>>
                <?php include $assetsPath."svg/systemGear.svg"; ?>
				<p> System Preferences </p>
			</div>
		</a>

		<a href="<?php echo checkSelectedLeftMenuLink( "USERPREFERENCES", "setup_user_preference.php" ); ?>">
			<div <?php echo checkSelectedLeftMenu( "USERPREFERENCES" ); ?>>
                <?php include $assetsPath."svg/user.svg"; ?>
				<p> User Preferences </p>
			</div>
		</a>
	</div>
</div>
