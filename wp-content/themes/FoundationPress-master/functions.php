<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */
/** Various clean up functions */
require_once( 'library/cleanup.php' );
/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );
/** Format comments */
require_once( 'library/class-foundationpress-comments.php' );
/** Register all navigation menus */
require_once( 'library/navigation.php' );
/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/class-foundationpress-top-bar-walker.php' );
require_once( 'library/class-foundationpress-mobile-walker.php' );
/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );
/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );
/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );
/** Add theme support */
require_once( 'library/theme-support.php' );
/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );
/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );
/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );
/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/class-foundationpress-protocol-relative-theme-assets.php' );


//filter for content

add_action( 'wp_ajax_my_action', 'load_cat_posts' );
add_action( 'wp_ajax_nopriv_my_action', 'load_cat_posts' );


add_filter("the_content", "break_text");
function break_text($textttt){
    $length = 300;
    $extractOut = "<div class='load-more'><a data-id='" . get_the_ID() . "' data-title='" . get_the_title() . "' data-slug='" .  get_post_field( 'post_name', get_post() ) . "' class='link-post'>—睇哂—</a></div>";

if ( is_home() ) {
    if(strlen($textttt)<$length+10) return $textttt;//don't cut if too short
    $break_pos = strpos($textttt, '，', $length);//find next space after desired length
    $visible = substr($textttt, 0, $break_pos);
    return balanceTags($visible) . $extractOut;
}

else {
return $textttt;
}

} 

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
  $first_img = $matches[1][0];


  $total = 14;

  $thumbnailno = array();


  for($x=0;$x<$total;$x++) {
      $thumbnailno[$x] = "http://www.chandamon.com/home/wp-content/uploads/nothumb" . $x . ".png";
  }
  
  if(empty($first_img)) {
    $first_img =   $thumbnailno[rand(0, 13)] ;
  } 
  return $first_img;
  
}



function load_cat_posts () {


   $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $temp = $DamonQuery;
            $DamonQuery= null;
$DamonQuery = new WP_Query();

    $cat_id = $_POST[ 'cat' ];
         $args = array (
        'cat' => $cat_id,
        'posts_per_page' => 10,
'orderby' => rand,
'post__not_in' =>  $do_not_duplicate,
                 'paged' => $paged,
        'order' => 'DESC'

    );






            $DamonQuery->query($args);

            $max_page = $DamonQuery->max_num_pages;


    ob_start ();

if ( $DamonQuery->have_posts() ) {
    while ( $DamonQuery->have_posts() ) {
        $DamonQuery->the_post();
        if ( get_the_post_thumbnail($post_id) != '' ) {
 $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
   echo '        <div class="post-contentC"><a href="';
   echo the_permalink() . '" id="' . get_the_ID() . '" title="' . the_title_attribute('echo=0') . '" >';
   echo get_the_post_thumbnail($post->ID);
   echo '</a></div>';
        }
else {
echo  '   <div class="post-contentC"><a href="' ;
echo   the_permalink() . '" id="' . get_the_ID() . '" title="' . the_title_attribute('echo=0') . '" >' . '<img class="nothumbclass"'; echo 'src="' ;
echo catch_that_image();
echo '" />';
echo  '</a></div>';

}

    }
		

wp_reset_postdata();
$DamonQuery= null;
$DamonQuery= $temp;
}

echo '</div>';






   $response = ob_get_contents();
   ob_end_clean();

   echo $response;
   die(1);
   }


if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 200, 0, true );
}


function my_get_posts_for_pagination() {
	$paged = $_GET['page']; // Page number
	$html = '';
	$pag = 0;
	if( filter_var( intval( $paged ), FILTER_VALIDATE_INT ) ) {
		$pag = $paged;
		$args = array(
	'post_status'      => 'publish',
			'paged' => $pag, // Uses the page number passed via AJAX
			'posts_per_page' => 7 // Change this as you wish
		);
		$loop = new WP_Query( $args );
			
		if( $loop->have_posts() ) {
			while( $loop->have_posts() ) {
				$loop->the_post();
				// Build the HTML string with your post's contents

echo ' <article id="post-'. get_the_ID() . '"';
echo  post_class() . '> ';
echo '	<header>';
echo	'	<h2><a href=" ';
echo the_permalink() . '" id="' ;
echo get_the_ID(). '">';
echo the_title() . ' </a></h2> ';
echo FoundationPress_entry_meta(); 
echo '	</header>';
echo	'<div class="entry-content">';

echo  the_content("--Read All--");
echo	'</div>';
echo	'<footer>';
	 $tag = get_the_tags(); 
	 
	 if (!$tag) { }
	 
	  else { 
echo '<p>';
echo the_tags("" , " － ", "<br />") ;
echo '</p>';
 }
echo	'</footer>';
echo '	<hr />';
echo '</article>';

			}
				
			wp_reset_query();
		}
	}
		
	echo $html;
	exit();

}

add_action( 'wp_ajax_my_pagination', 'my_get_posts_for_pagination' );
add_action( 'wp_ajax_nopriv_my_pagination', 'my_get_posts_for_pagination' );

function my_load_ajax_content () {

    $args = array(
        'p' => $_POST['post_id'],

        );

    $post_query = new WP_Query( $args );
    while( $post_query->have_posts() ) : $post_query->the_post(); ?>

    <div class="post-container">
        <div id="project-content">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

            <?php $imcthumb = "http://www.chandamon.com/home/wp-content/uploads/2016/07/27387923803_0d154f2991_k-2-785x589.jpg" ; ?>

<img src="<?php has_post_thumbnail() ? the_post_thumbnail_url('large') : print 'http://www.chandamon.com/home/wp-content/uploads/2016/07/27387923803_0d154f2991_k-2-785x589.jpg' ; ?>"/>
            <?php the_content(); ?>
<?php
  echo "<div class='meta-row tag-row'>";
              the_tags('',' ');
              echo "</div>"; ?>
			<?php 

global $withcomments; $withcomments = true;

comments_template(); ?>



        </div>
    </div><!-- .post-container -->

    <?php
    endwhile;
    wp_die();
}

add_action ( 'wp_ajax_nopriv_load-content', 'my_load_ajax_content' );
add_action ( 'wp_ajax_load-content', 'my_load_ajax_content' );



?>