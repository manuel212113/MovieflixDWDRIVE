<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1" />
	<title><?php
	global $pagetitle, $file;
	if (isset($pagetitle) && $pagetitle) {
		echo $pagetitle.' - '.siteinfo('title');
	}else if (page() == 'index') {
		echo siteinfo('title');
	} else if (page() == 'manage') {
		echo siteinfo('title')." - Manage";
	} else if (page() == 'settings') {
		echo siteinfo('title')." - Settings";
	} else {
		echo siteinfo('title');
	} ?></title>
	<link rel="stylesheet" href="https://cdn.azk1.net/player/plyr/style.css">
    <?php anti_adblock(); ?>
	<meta name="referrer" content="no-referrer">
	<link rel="shortcut icon" href="https://www.google.com/s2/favicons?sz=32&domain_url=drive.google.com"/>
	<meta name="robots" content="noindex" />
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,600&amp;display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<?php if (((page() == "embed" && siteinfo('video_embed')) || (page() == "dl" && siteinfo('video_preview'))) && $file['type'] == 'video') { ?>
		<link rel="stylesheet" href="https://cdn.azk1.net/player/plyr/plyr.css" />
	<?php } ?>
</head>
<body>
	<?php if (page() != 'embed') { ?>
		<div class="notification"></div>
		<div class="navbar">
			<div class="container">
				<div id="nav_toggle"><i class="material-icons">menu</i></div>
				<div class="brand"><a href="<?php echo siteinfo('url') ?>index.php"><?php echo siteinfo('title') ?></a></div>
				<nav id="navbar">
					<ul>
						<?php if (userActive()) { ?>

						<li><a href="<?php echo siteinfo('url') ?>manage.php" <?php if (page() == 'manage') echo 'class="active"'; ?>>Manage</a></li>
						<li><a href="<?php echo siteinfo('url') ?>settings.php" <?php if (page() == 'settings') echo 'class="active"'; ?>>Settings</a></li>

						<?php } ?>
					</ul>
				</nav>
				<div class="user">
					<?php if (userActive()) {
						echo '<a href="'.siteinfo('url').'login.php?logout" class="logout">Logout</a>';
					} ?>
				</div>
			</div>
		</div>
	<?php } ?>