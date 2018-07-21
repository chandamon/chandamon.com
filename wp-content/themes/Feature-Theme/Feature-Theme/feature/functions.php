<?php

$cp_options;
$theme_name;

function WP_Control_Panel($options, $name, $short_name) {
	
	global $cp_options;
	global $theme_name;
	
	if (! is_array($options)) {
		die("Expects an array");
	}
	
	if (empty($short_name)) {
		die("Short name must be provided");
	}
	
	if (empty($options)) {
		die("Array cannot be empty");
	}
	
	if (! is_string($name)) {
		die("Name needs to be of type string");
	}
	elseif (empty($name)) {
		die("Name cannot be empty");
	}
	else {
		$theme_name = $name;
	}
		
	
	for ($i = 0; $i < count($options); $i++) {
		if(array_key_exists('id', $options[$i])) {
			$options[$i]['id'] = $short_name . $options[$i]['id'];
		}
	}
	
	$cp_options = $options;
	
	foreach($cp_options as $option) {
		if ((array_key_exists('id', $option) === true) && (get_option($option['id']) === false)) {
			add_option($option['id'], $option['std']);
		}
	}
}

function add_menu() {
	global $cp_options;
	global $theme_name;
	
	
	if ($_GET['page'] == basename(__FILE__)) {
		
		if ($_REQUEST['action'] == 'save') {
		
			foreach ($cp_options as $option) {
				update_option($option['id'], stripslashes($_REQUEST[$option['id']]));
			}
			
			header("Location: themes.php?page=functions.php&saved=true");
			die;
		}			
	}
	
	add_menu_page($theme_name . ' Theme Control Panel', $theme_name . ' Theme Control Panel', 10, basename(__FILE__), 'show_cp_page');
}

function admin_head() {
	
	global $cp_options;
	global $theme_name;
	
	print '<style type="text/css">';
?>

<?php
		print '</style>';
	}
	
function add_page() {
		add_action('admin_menu', 'add_menu');
		add_action('admin_head', 'admin_head');
}
	
function show_cp_page() {
	
	global $cp_options;
	global $theme_name;
		
		if ($_REQUEST['saved'] == true) {
			echo '<div class="updated fade" id="message" style="background:#ffe8e8; margin-bottom:25px;width:727px; border: 1px dotted #ca0000; padding:11px 0 11px 11px; margin-left: 5px; margin-top: 17px;"><p><strong> Feature Theme Settings Saved.</strong></p></div>';
		}
?>
		<div class="theme-settings">
		<h2 style="font-family: Georgia; font-size:22px; font-weight:normal; margin-left:5px;  font-style:italic; letter-spacing:1px; width:97.6%; height:29px; margin-bottom:0px; padding-bottom:7px; color:#555555; padding-bottom:10px;"><?php print $theme_name; ?> Settings<div style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color: #6F5D57;  padding-left:543px; padding-top:20px;">Theme by <a href="http://www.moonthemes.com">MoonThemes.com</a></div></h2>
		<div style="font-family:verdana; color#333; font-size:12px; margin-left:5px;">To easily customize the feature theme, you can use the menu below.</div>
		
		<form action="" method="post">
		<fieldset>
		<?php 
		foreach ($cp_options as $option) {
		
			switch ($option['type']) {
				
				case "title":
		?>		
				<h3 style="background:#d2eaff; width: 727px; border: 1px solid #c1ddf5; height:27px; padding-top:16px; padding-left:11px; padding-bottom:11px;font-family: Verdana; font-size:13px; color:#333; font-weight:normal; margin-top:18px;margin-left:5px; margin-bottom:0px; text-transform:uppercase; font-weight:bold; "><?php echo $option['name']; ?> <div style=" float:right; margin-top:-27px; padding-right:11px;"><div class="submit">
			<input style="width:86px; height:13px; padding-bottom:5px;" name="save" type="submit" value="Save changes" />
			<input type="hidden" name="action" id="action" value="save" />
			</div></div></h3>
			
		<?php
				break;
				
				case "text":
		?>		
		        <div style="background:#ecf6ff; border: 1px solid #cae2f7; width:721px; height:31px; padding-top:29px; margin-bottom:0px; margin-left:5px; border-top:1px solid #fff; padding-left:17px; padding-bottom:36px;border-bottom:1px solid#cae2f7;">
				<label style="font-family:verdana; font-size:12px; color:#333;padding-right:67px; display:inline; float:left; width:111px;" for="<?php echo $option['id']; ?>"><strong><?php echo $option['name']; ?></strong></label>
				<input style="display:inline; float:left; width:147px; height:22px; border: 1px solid #dfdfdf; background:#fff;padding-top:3px;" name="<?php echo $option['id']; ?>" id="<?php echo $option['id']; ?>" type="<?php echo $option['type']; ?>" value="<?php if (get_option($option['id']) != "") { echo get_option($option['id']); } else { echo $option['std']; }?>" />
				<small style="display:inline; float:left; width:320px;font-family:verdana; font-size:10px; color:#333;padding-left:33px;"><?php echo $option['desc']; ?></small><br /></div>
				
		<?php
				break;
				
				case "textarea":
		?><div style="background:#ecf6ff; border: 1px solid #cae2f7; width:721px; height:149px; padding-top:29px; margin-bottom:0px; margin-left:5px; border-top:1px solid #fff; padding-left:17px; padding-bottom:36px;border-bottom:1px solid#cae2f7; ">
				<label style="font-family:verdana; font-size:12px; color:#333;padding-right:67px; display:inline; float:left; width:111px;" for="<?php echo $option['id']; ?>"><strong><?php echo $option['name']; ?></strong></label>
				<textarea style="display:inline; float:left; width:147px; height:140px; border: 1px solid #dfdfdf; background:#fff;padding-top:3px;" name="<?php echo $option['id']; ?>" type="<?php echo $option['type']; ?>" cols="30" rows=""><?php if (get_option($option['id']) != "") { echo get_option($option['id']); } else { echo $option['std']; } ?></textarea>
				<small style="display:inline; float:left; width:200px;font-family:verdana; font-size:10px; color:#333;padding-left:33px;"><?php echo $option['desc']; ?></small><br /></div>
		<?php 	
				break;
				
				case "select":
		?>
		        <div style="background:#ecf6ff; border: 1px solid #cae2f7; width:721px; height:31px; padding-top:29px; margin-bottom:0px; margin-left:5px; border-top:1px solid #fff; padding-left:17px; padding-bottom:36px;border-bottom:1px solid #cae2f7;">
				<label style="font-family:verdana; font-size:12px; color:#333;padding-right:67px; display:inline; float:left; width:111px;" for="<?php echo $option['id']; ?>" class="<?php echo $option['id']; ?>"><strong><?php echo $option['name']; ?></strong></label>
				<select style="display:inline; float:left; width:147px; height:22px; border: 1px solid #dfdfdf; background:#fff;padding-top:3px;" name="<?php echo $option['id']; ?>" id="<?php echo $option['id']; ?>">
					<?php foreach ($option['options'] as $op) { ?>
						<option <?php if (get_option($option['id']) == $op) { echo 'selected="selected"'; } elseif ($op == $option['std']) { echo 'selected="selected"'; } ?>><?php echo $op; ?></option>
		<?php
					}
		?>
				</select>
				<small style="display:inline; float:left; width:320px;font-family:verdana; font-size:10px; color:#333;padding-left:33px;"><?php echo $option['desc']; ?></small><br /><br/></div>
		<?php
				break;
				
				case "selectcat":
		?>
		<div style="background:#ecf6ff; border: 1px solid #cae2f7; width:721px; height:31px; padding-top:29px; margin-bottom:0px; margin-left:5px; border-top:1px solid #fff; padding-left:17px; padding-bottom:36px;border-bottom:1px solid#cae2f7;">
				<label style="font-family:verdana; font-size:12px; color:#333;padding-right:67px; display:inline; float:left; width:111px;" for="<?php echo $option['id']; ?>" class="<?php echo $option['id']; ?>"><strong><?php echo $option['name']; ?></strong></label>
		<div style="float:left; display:inline; width:149px;"><?php
				$old = get_option($option['id']) === false ? '-1' : get_option($option['id']);
				$args = array(	'depth' => 0,
								'hierarchical' => 1,
								'hide_empty' => 0,
								'name' => $option['id'],
								'class' => $option['id'],
								'selected' => $old,
								'show_option_none' => 'No category selected');
				wp_dropdown_categories($args);
		?></div>
				<small style="display:inline; float:left; width:320px;font-family:verdana; font-size:10px; color:#333;padding-left:33px;"><?php echo $option['desc']; ?></small><br /></div>
		<?php
				break;				
				
				case "checkbox":
		?>
		<div style="background:#ecf6ff; border: 1px solid #cae2f7; width:721px; height:31px; padding-top:29px; margin-bottom:0px; margin-left:5px; border-top:1px solid #fff; padding-left:17px; padding-bottom:36px;border-bottom:1px solid#cae2f7;">
				<label style="font-family:verdana; font-size:12px; color:#333;padding-right:67px; display:inline; float:left; width:111px;" for="<?php echo $option['id']; ?>"><strong><?php echo $option['name']; ?></strong></label>
				<?php if (get_option($option['id']) == 'true') { $checked = 'checked="checked"'; } elseif (get_option($option['id']) === false && $option['std'] == 'true') { $checked = 'checked="checked"'; } else { $checked = ""; } ?>
				<input style="display:inline; float:left; width:147px; height:22px; border: 1px solid #dfdfdf; background:#fff;padding-top:3px;" type="checkbox" name="<?php echo $option['id']; ?>" id="<?php echo $option['id']; ?>" value="true" <?php echo $checked; ?> />
				
				<small style="display:inline; float:left; width:320px;font-family:verdana; font-size:10px; color:#333;padding-left:33px;"><?php echo $option['desc']; ?></small><br /></div>
		<?php
				break;
			}
		}
		?>
		
			<div style=" font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; color: #6F5D57; padding-bottom:35px; padding-left:5px; padding-top:20px;">Theme by <a href="http://www.moonthemes.com">MoonThemes.com</a></div>
		</form>
		</fieldset>
		</div>
<?php
	}

/**********************************************************************/
/*
/*	class WP_Control_Panel
/*	ends here
/*
/**********************************************************************/

$options = array(
					array(	"name" => "Theme Layout",
							"type" => "title"),
					array(	"name" => "Color Scheme",
							"desc" => "Select a color scheme for your blog here.",
							"id" => "theme_scheme",
							"type" => "select",
							"options" => array("Default", "Black"),
							"std" => "default"),
					array(	"name" => "Theme Layout",
							"desc" => "Select the theme layout for your blog here.",
							"id" => "theme_layout",
							"type" => "select",
							"options" => array("Layout - 1", "Layout - 2", "Layout - 3", "Layout - 4", "Layout - 5", "Layout - 6", "Layout - 7", "Layout - 8", "Layout - 9"),
							"std" => "Layout - 1"),
					array(	"name" => "Logo Image",
							"desc" => "Enter the full URL of your custom logo image here. Note: Logo size should not be greater than 108px width and 78px height, will be resized if it is greater than that. ",
							"id" => "logo_image",
							"type" => "text",
							"std" => ""),
					array(	"name" => "Top Teaser, Heading Title",
							"type" => "title"),		
					array(	"name" => "Teaser Title Text on Very Top Right",
							"desc" => "Write a teaser title",
					        "id"   => "ablgt",
							"type" => "textarea",
							"std" =>  "A beautifully teaser like the nice feature theme, get it today"),		
				    array(	"name" => "Description Text",
							"desc" => "Write a description text here.",
					        "id"   => "fth",
							"type" => "textarea",
							"std" =>  "WordPress is web software you can use to create a beautiful website or blog. We like to say that WordPress is both free and priceless at the same time. WordPress is web software you can use to create a beautiful website or blog."),
				    array(	"name" => "Blog Posts Settings",
							"type" => "title"),	
				    array(	"name" => "Set Number of Posts",
							"desc" => "Enter any number of posts you wish to have in any layout you have chosen.",
					        "id"   => "blog_post_count",
							"type" => "text",
							"std" =>  "0"),	
					 array(	"name" => "Featured Posts Settings on Single Post Page",
							"type" => "title"),	
                    array(	"name" => "Heading Text for Posts",
							"desc" => "Enter a heading text for featured posts.",
					        "id"   => "frti",
							"type" => "textarea",
							"std" =>  "Featured"),							
					array(	"name" => "Featured Posts Category",
							"desc" => "Select a category for featured posts.",
							"id" => "category_20",
							"type" => "selectcat",
							"std" => "-1"),		
                    array(	"name" => "Number of posts",
							"desc" => "Enter any number of posts you wish to have in featured posts.",
							"id" => "featured_posts_count",
							"type" => "text",
							"std" => ""),
                    array(	"name" => "Disable Featured Posts",
							"desc" => "Check this box if you want to disable featured posts, will be apply to all sidebars.",
							"id" => "frpstd",
							"type" => "checkbox",
							"std" => ""),			
					array(	"name" => "Contact Page Settings",
							"type" => "title"),	
				    array(	"name" => "Heading Text",
							"desc" => "Enter contact page heading text",
					        "id"   => "ctpgh",
							"type" => "textarea",
							"std" =>  "Send us mail"),	
					array(	"name" => "Description Text",
							"desc" => "Enter contact page description text",
					        "id"   => "ctpdscrip",
							"type" => "textarea",
							"std" =>  "Contact page description text goes here"),
                   	array(	"name" => "Footer Settings",
							"type" => "title"),	
				    array(	"name" => "Footer Text",
							"desc" => "Enter footer copyright text or links",
					        "id"   => "ftrcrt",
							"type" => "textarea",
							"std" =>  "Copyright 2011 Feature Theme by Moonthemes.com - Allrights Reserved.")						
				
				);

define("SHORT_NAME", "eye_gaze_");

WP_Control_Panel($options, "Feature", SHORT_NAME);

add_page();






if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'Sidebar-Widgets',
'before_widget' => '<div class="side-cats2"><div class="sider-22">',
'after_widget' => '</div></div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));





/**********************Meta Box Starts Here*******************************/

	$new_meta_boxes = array("image" => array("name" => "Image", "std" => "", "title" => "Thumbnail",
											"description" => "To add a thumbnail to the post, paste the complete URL of the image above.")
							);


function new_meta_boxes() {
	global $post, $new_meta_boxes;
	
	foreach($new_meta_boxes as $meta_box) {
		$meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
		
		if ($meta_box_value == "")
			$meta_box_value = $meta_box['std'];
		
		echo '<input type="hidden" name="' . $meta_box['name'] . '_noncename" id="' . $meta_box['name'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
		echo '<h2>' . $meta_box['title'] . '</h2>';
		echo '<input type="text" name="' . $meta_box['name'] . '" value="' . $meta_box_value . '" size="55" /><br />';
		echo '<p><label for="' . $meta_box['name'] . '">' . $meta_box['description'] . '</label></p>';
		}
}

function create_meta_box() {
	if (function_exists('add_meta_box'))  {
		add_meta_box('new-meta-boxes', 'Feature Theme Post Thumbnail Settings', 'new_meta_boxes', 'post', 'normal', 'high');
	}
}

function print_emp_feat($cat_id) {
	
	if ($cat_id < 0) {
?>
	<div class="ftbox">
		<div class="title"></div>
		<div class="fpostbox">
			<div class="fpost-content">
				<div class="fpost-title"><a href="" rel="bookmark" title="No category selected">No category selected</a></div>
			</div>
		</div>
	</div>
<?php
	}
	else {
?>
	<div class="ftbox">
		<div class="title"></div>
		<div class="fpostbox">
			<div class="fpost-content">
				<div class="fpost-title"><a href="<?php echo get_category_link($cat_id); ?>" rel="bookmark" title="Permanent Link to ">No posts in <?php echo get_cat_name($cat_id); ?> category</a></div>
			</div>
		</div>
	</div>
<?php
	}
}

register_nav_menus( array(
        'primary' => __( 'Primary Navigation'),
               
    ) );
// remove menu container div
function my_wp_nav_menu_args( $args = '' )
{
    $args['container'] = false;
    return $args;
} // function
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );




function the_subscribe_heading() {
	$heading = get_option(SHORT_NAME . 'subscribe_heading');
	echo $heading;
}

function the_subscribe_text() {
	$text = get_option(SHORT_NAME . 'subscribe_text');
	echo $text;
}

function print_emp_cat($cat_num, $cat_id) {
	
	if ($cat_id < 0) {
?>
		<div class="cat<?php echo $cat_num; ?>-box">
			<div class="cat<?php echo $cat_num; ?>-head">
				<div class="cat<?php echo $cat_num; ?>-head-title"><a href="" title="No category seleced" rel="category">No category selected</a></div>
			</div>
			
			<div class="cat<?php echo $cat_num; ?>-content">
			</div>
		</div>
<?php
	}
	else {
?>
		<div class="cat<?php echo $cat_num; ?>-box">
			<div class="cat<?php echo $cat_num; ?>-head">
				<div class="cat<?php echo $cat_num; ?>-head-title"><a href="<?php echo get_category_link($cat_id); ?>" title="View all posts in " rel="category">No posts in <?php echo get_cat_name($cat_id); ?> category</a></div>
			</div>
			
			<div class="cat<?php echo $cat_num; ?>-content">
			</div>
		</div>
<?php
	}
}

function the_logo() {
	$logo_image = get_option(SHORT_NAME . 'logo_image');
	$logo_image = trim($logo_image);	
	
	$logo_height = get_option(SHORT_NAME . 'logo_height');
	$logo_width = get_option(SHORT_NAME . 'logo_width');
	
	$height_max = false;
	$width_max = false;
	
	define('MAX_WIDTH', 108);
	define('MAX_HEIGHT', 78);
	
	if ($logo_image != "") {
		$user_resize_height = false;
		$user_resize_width = false;
		
		if (! empty($logo_height)) {
			$user_resize_height = true;
		}
		
		if (! empty($logo_width)) {
			$user_resize_width = true;
		}
		
		if ($user_resize_width == true || $user_resize_height == true) {
			
			if ($logo_height > MAX_HEIGHT) {
				$logo_height = MAX_HEIGHT;
			}
			
			if ($logo_width > MAX_WIDTH) {
				$logo_width = MAX_WIDTH;
			}
		}
		
		$size = getimagesize($logo_image);
		
		if ($user_resize_width != true) {
			if ($size[0] > MAX_WIDTH) {
				$logo_width = MAX_WIDTH;
			}
			else {
				$logo_width = $size[0];
			}
		}
		
		if ($user_resize_height != true) {
			if ($size[1] > MAX_HEIGHT) {
				$logo_height = MAX_HEIGHT;
			}
			else {
				$logo_height = $size[1];
			}
		}
		
		echo '<div class="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_bloginfo('template_directory') . '/phpThumb/phpThumb.php?src=' . $logo_image . '&h=' . $logo_height . '&w=' . $logo_width . '&zc=1&q=100" border="0" /></a></div>';
	}
	else {		
		$theme_scheme = get_option(SHORT_NAME . 'theme_scheme');
			
		if ($theme_scheme == 'Black') {
			echo '<div class="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_bloginfo('stylesheet_directory') . '/css/black/images/logo2.jpg"' . ' border="0" alt="logo" /></a></div>';
		}
		else if ($theme_scheme == 'Red') {
			echo '<div class="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_bloginfo('stylesheet_directory') . '/css/red/images/logo2.jpg"' . ' border="0" alt="logo" /></a></div>';		
		}
		else if ($theme_scheme == 'Green') {
			echo '<div class="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_bloginfo('stylesheet_directory') . '/css/green/images/logo2.jpg"' . ' border="0" alt="logo" /></a></div>';		
		}
		else if ($theme_scheme == 'Baby Blue') {
			echo '<div class="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_bloginfo('stylesheet_directory') . '/css/baby blue/images/logo2.jpg"' . ' border="0" alt="logo" /></a></div>';	
		}
		else if ($theme_scheme == 'Forest') {
			echo '<div class="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_bloginfo('stylesheet_directory') . '/css/forest/images/logo2.jpg"' . ' border="0" alt="logo" /></a></div>';		
		}
		else if ($theme_scheme == 'Orange') {
			echo '<div class="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_bloginfo('stylesheet_directory') . '/css/orange/images/logo2.jpg"' . ' border="0" alt="logo" /></a></div>';		
		}
		else if ($theme_scheme == 'Purple') {
			echo '<div class="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_bloginfo('stylesheet_directory') . '/css/purple/images/logo2.jpg"' . ' border="0" alt="logo" /></a></div>';	
		}
		else if ($theme_scheme == 'Grey') {
			echo '<div class="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_bloginfo('stylesheet_directory') . '/css/grey/images/logo2.jpg"' . ' border="0" alt="logo" /></a></div>';		
		}
		else if ($theme_scheme == 'Pink') {
			echo '<div class="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_bloginfo('stylesheet_directory') . '/css/pink/images/logo2.jpg"' . ' border="0" alt="logo" /></a></div>';	
		}
		else if ($theme_scheme == 'Sea Green') {
			echo '<div class="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_bloginfo('stylesheet_directory') . '/css/sea green/images/logo2.jpg"' . ' border="0" alt="logo" /></a></div>';	
		}
		else {
			echo '<div class="logo"><a href="' . get_bloginfo('url') . '"><img src="' . get_bloginfo('stylesheet_directory') . '/images/logo2.jpg"' . ' border="0" alt="logo" /></a></div>';	
		}
	}
}

function save_postdata($post_id) {
	global $post, $new_meta_boxes;
	
	foreach($new_meta_boxes as $meta_box) {
		// Verify input
		if (! wp_verify_nonce($_POST[$meta_box['name'] . '_noncename'], plugin_basename(__FILE__))) {
			return $post_id;
		}
		
		if ('page' == $_POST['post_type']) {
			if (! current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		}
		else {
			if (! current_user_can('edit_post', $post_id)) {
				return $post_id;
			}
		}
		$data = $_POST[$meta_box['name']];
		
		if (get_post_meta($post_id, $meta_box['name']) == "") {
			add_post_meta($post_id, $meta_box['name'], $data, true);
		}
		elseif ($data != get_post_meta($post_id, $meta_box['name'], true)) {
			update_post_meta($post_id, $meta_box['name'], $data);
		}
		elseif ($data == "") {
			delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
		}
	}
}
	add_action('admin_menu', 'create_meta_box');
	add_action('save_post', 'save_postdata');
	
/**********************Meta Box Ends Here*******************************/





function dimox_breadcrumbs() {
 
  $delimiter = '&raquo;';
  $home = 'Home'; // text for the 'Home' link
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb
 
  if ( !is_home() && !is_front_page() || is_paged() ) {
 
    echo '<div id="crumbs">';
 
    global $post;
    $homeLink = get_bloginfo('url');
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';
 
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
      echo $before . 'Archive by category "' . single_cat_title('', false) . '"' . $after;
 
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
        echo $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;
 
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $before . get_the_title() . $after;
 
    } elseif ( is_search() ) {
      echo $before . 'Search results for "' . get_search_query() . '"' . $after;
 
    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;
 
    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
} // end dimox_breadcrumbs()
?>