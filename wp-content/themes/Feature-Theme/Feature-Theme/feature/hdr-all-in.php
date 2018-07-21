<?php
	
	$theme_scheme = get_option(SHORT_NAME . 'theme_scheme');
	$theme_dir = get_bloginfo("stylesheet_directory");
	
	if ($theme_scheme == 'Black') {
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/black/black.css" type="text/css" media="screen" />';
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/black/jqueryslidemenu-b.css" type="text/css" media="screen" />';
		
	}
	
    else if ($theme_scheme == 'Green') {
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/green/green.css" type="text/css" media="screen" />';
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/green/jqueryslidemenu-grn.css" type="text/css" media="screen" />';
		
	}
	
	else if ($theme_scheme == 'Baby Blue') {
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/baby blue/bbyblue.css" type="text/css" media="screen" />';
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/baby blue/jqueryslidemenu-byb.css" type="text/css" media="screen" />';
		
	}
	
	else if ($theme_scheme == 'Forest') {
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/forest/forest.css" type="text/css" media="screen" />';
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/forest/jqueryslidemenu-frst.css" type="text/css" media="screen" />';
		
	}
	
	else if ($theme_scheme == 'Orange') {
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/orange/orange.css" type="text/css" media="screen" />';
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/orange/jqueryslidemenu-orng.css" type="text/css" media="screen" />';
		
	}
	
	else if ($theme_scheme == 'Purple') {
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/purple/purple.css" type="text/css" media="screen" />';
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/purple/jqueryslidemenu-prpl.css" type="text/css" media="screen" />';
		
	}
	
	else if ($theme_scheme == 'Pink') {
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/pink/pink.css" type="text/css" media="screen" />';
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/pink/jqueryslidemenu-pink.css" type="text/css" media="screen" />';
		
	}
	
	else if ($theme_scheme == 'Sea Green') {
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/sea green/sea.css" type="text/css" media="screen" />';
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/sea green/jqueryslidemenu-sea.css" type="text/css" media="screen" />';
		
	}

	else {
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/default/style.css" type="text/css" media="screen" />';
		echo '<link rel="stylesheet" href="' . $theme_dir . '/css/default/jqueryslidemenu.css" type="text/css" media="screen" />';
		
	}
?>