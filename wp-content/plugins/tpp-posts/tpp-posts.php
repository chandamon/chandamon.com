<?php

/*
 * Plugin Name: tpp-posts
 * Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
 * Description: A brief description of the Plugin.
 * Version: The Plugin's Version Number, e.g.: 1.0
 * Author: Name Of The Plugin Author
 * Author URI: http://URI_Of_The_Plugin_Author
 * License: A "Slug" license name e.g. GPL2
 */

function tpp_posts_comments_return()
{

$post_id = isset( $_POST['post_id'] ) ? $_POST['post_id'] : 0;

if ( $post_id > 0)
{

$post = get_post($post_id);

$my_query_Postnp = new WP_Query();

$my_query_Postnp->query(array( 'post__in' => array($post_id )));


?>


<div id="post"><?php  echo apply_filters('the_content', $post->post_content); ?></div>

<?php 


if ($my_query_Postnp->have_posts()) : while ($my_query_Postnp->have_posts()) : $my_query_Postnp->the_post();

$next_post_Popup = get_next_post();
$prev_post_Popup = get_previous_post();

?>

<div class="nav_ajax">

 <div class="nav-previous">
	  
	  <a href="<?php echo get_permalink( $prev_post_Popup->ID ); ?>" id="post-<?php echo $prev_post_Popup->ID ; ?>"><?php echo $prev_post_Popup->post_title; ?></a>
	  
	
 </div>
 
 <?php 
 if (isset($next_post_Popup->ID)) {


echo '<div class="nav-next">';
echo '<a href="';
echo get_permalink( $next_post_Popup->ID ); 
echo '" id="post-' .  $next_post_Popup->ID . '">';
echo $next_post_Popup->post_title;
echo '</a>';
 }
?>	
	
</div>
</div>


<?php

 endwhile;
endif;                  

wp_reset_query();

}

die();
}
add_action('wp_ajax_nopriv_tpp_comments','tpp_posts_comments_return');
add_action( 'wp_ajax_tpp_comments', 'tpp_posts_comments_return');

function tpp_posts_get_scripts()
{
wp_enqueue_script("tpp-posts", path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ )). "/top_post.js") , array("jquery"));

}

add_action('wp_print_scripts','tpp_posts_get_scripts');

?>