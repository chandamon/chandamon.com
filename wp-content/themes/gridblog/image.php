<?php get_header(); ?>
		
 <?php include (TEMPLATEPATH . "/topcontent.php"); ?>

<div class="span-24">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

    <div class="post" id="post-<?php the_ID(); ?>">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            
            <!-- gallerycode -->
            <div class="attachment"><a href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo wp_get_attachment_image( $post->ID, 'medium' ); ?></a></div>
            <div class="caption"><?php if ( !empty($post->post_excerpt) ) the_excerpt(); // this is the "caption" ?></div>
            <!-- gallerycode -->
            <?php the_content() ; ?>
            <!-- gallerynavigation -->
            <div class="imgnav">
            <div class="imgleft"><?php previous_image_link() ?></div>
            <div class="imgright"><?php next_image_link() ?></div>
            </div>
            <br clear="all" />
            <!-- gallerynavigation -->
            
            <br clear="all" />
            <?php comments_template(); ?>
 </div><!--post-->
<?php  endwhile; ?>
<?php else : ?>
<?php endif; ?>
    
</div><!--span-24-->
        
        
<?php include (TEMPLATEPATH . "/bottomcontent.php"); ?>
        
<?php get_footer(); ?>
        
	</div><!--container-->

</body>
</html>