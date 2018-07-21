<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?></title>



<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/prettyPhoto.css" type="text/css" media="screen" />





<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/comment-reply.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jqueryslidemenu.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/shlomb.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/shorwa.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.prettyPhoto.js"></script>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.orbit-1.2.3.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/easySlider1.7.js"></script>


<?php include (TEMPLATEPATH . '/hdr-all-in.php'); ?>



<!--[if lte IE 7]>
<style type="text/css">
html .jqueryslidemenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->







 

<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$("a[rel^='prettyPhoto']").prettyPhoto({theme:'light_rounded'});
		});
	</script>

<?php wp_get_archives('type=monthly&format=link'); ?>

<script type="text/javascript">
		$(document).ready(function(){	
			$("#slider").easySlider({
				auto: true, 
				continuous: true
			});
		});	
	</script>



<script type="text/javascript">
     $(window).load(function() {
         $('#featured').orbit({
              bullets: true
         });
     });
</script>

	

<?php wp_head(); ?>

</head>

<body>

	   
		 <div class="op-hd-8">
		 
		
		 
		 </div>
	        
	            <div class="header">
				
		 <div id="main">
		 
		
				
				
			
					
					
					

	   

					
	   </div><!-- end: main -->
	   
	   </div><!-- end: header -->
		