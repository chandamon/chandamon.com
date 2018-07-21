<?php
/**
 * The template for displaying all content.
 *
 * If there aren't any other templates present to
 * display content, it falls back to index.php
 *
 * @package required+ Foundation
 * @since required+ Foundation 0.1.0
 */

get_header(); ?>

    <!-- Row for main content area -->
    <div id="content" class="row">

        <div id="main" class="eight columns" role="main">

 

            <div class="post-box">

            <?php if ( have_posts() ) : ?>

                <?php while ( have_posts() ) : the_post();   $do_not_duplicate[] = $post->ID ?>

                    <?php get_template_part( 'content', get_post_format() ); ?>

                <?php endwhile; ?>

            <?php else : ?>
                <?php get_template_part( 'content', 'none' ); ?>
            <?php endif; ?>

            <?php if ( function_exists( 'required_pagination' ) ) {
                required_pagination();
            } ?>
            </div>


 <?php $music_args = array(

'category_name' => 'music',
    'no_found_rows' => true,
'posts_per_page' => 10,
'orderby' => rand,
	'post__not_in' => $do_not_duplicate,

);  ?>
 

 <?php  $music = new WP_Query( $music_args ); ?>
 

<?php if ( $music->have_posts() ) {
    while ( $music->have_posts() ) {
        $music->the_post();
        if ( has_post_thumbnail( $music->post->ID ) ) {
 $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
   echo '<a href="';
   echo the_permalink() . '" title="' . the_title_attribute('echo=0') . '" >';
   echo get_the_post_thumbnail($post->ID, 'thumbnail');
   echo '</a>';
        }
else {
echo  '<a href="' ;
echo   the_permalink() . '" >' . '<img src="http://www.chandamon.com/home/wp-content/uploads/2008/05/blankttt.png" />';
echo  '</a>';

}

    }
 
    // Reset the post data
    wp_reset_postdata();
}
?>




        </div><!-- /#main -->

        <aside id="sidebar" class="four columns" role="complementary">
            <div class="sidebar-box">

 <?php $drawing_args = array(

'category_name' => 'drawing',
    'no_found_rows' => true,

'posts_per_page' => 10,
	'post__not_in' => $do_not_duplicate,


);  ?>
 

 <?php  $drawing = new WP_Query( $drawing_args ); ?>
 

<?php if ( $drawing->have_posts() ) {
    while ( $drawing->have_posts() ) {
        $drawing->the_post();
        if ( has_post_thumbnail( $drawiing->post->ID ) ) {
 $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
echo '<a href="';
   echo the_permalink() . '" title="' . the_title_attribute('echo=0') . '" >';
   echo get_the_post_thumbnail($post->ID, 'thumbnail');
   echo '</a>';
        }

    }
 
    // Reset the post data
    wp_reset_postdata();
}
?>

                <?php get_sidebar(); ?>
            </div>
        </aside><!-- /#sidebar -->

    </div><!-- End Content row -->

<?php get_footer(); ?>