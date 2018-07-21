<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>長角</title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

 <!-- Framework CSS -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/blueprint/screen.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/blueprint/print.css" type="text/css" media="print" />
<!--[if IE]><link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/blueprint/ie.css" type="text/css" media="screen, projection" /><![endif]-->

<!-- Import fancy-type plugin for the sample page. -->
<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/blueprint/plugins/fancy-type/screen.css" type="text/css" media="screen, projection" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

<script type="text/javascript" src="http://mediaplayer.yahoo.com/js"></script>
</head>
<body>
	<div class="container"> 
    <?php include (TEMPLATEPATH . "/searchform.php"); ?>
		<div id="header">
         

       
        </div>
        
			<hr />
            
        <ul id="menu">
        <li class="<?php if (((is_home()) && !(is_paged())) or (is_archive()) or (is_single()) or (is_paged()) or (is_search())) { ?>current_page_item<?php } else { ?>page_item<?php } ?>"><a href="<?php echo get_settings('home'); ?>">Home<?php echo $langblog;?></a></li>
                  <?php wp_list_categories('show_count=0&title_li=&depth=1') ?>

       	</ul>
        
			<hr />