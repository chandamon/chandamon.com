<?php get_header(); ?>
<?php get_sidebar(); ?>



		
		 		 
 
		 <div class="mbo-all">

	<div class="qnoyt">Filed Under &#8212; <?php the_category(', ') ?></div>
		
		 
		
			  <div class="ghjtiu">
					 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	  <?php $image = get_post_meta($post->ID, "Image", $single = true); ?>
						    <div class="plioyt">
							<div class="shada1">
							<div class="port-thumb">	<?php if ($image !== '') { ?> <a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title(); ?>"><img src="<?php bloginfo('template_directory'); ?>/phpThumb/phpThumb.php?src=<?php echo $image; ?>&amp;h=365&amp;w=554&amp;zc=1&amp;q=100" alt="<?php the_title(); ?>" style="border:none;" /></a>
						<?php }
						else {
							echo '';
						} ?></div></div>
							<div class="hgjui"><h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2></div>
							<div class="simbt"><p> <?php the_content(); ?> </p></div>
                            <?php comments_template(); ?>
                            </div><!-- end: portfolio-content --> 					  
									
				   
	
	  
	  <?php endwhile; else: ?>
     <p><?php _e('No posts by this author.'); ?></p>

	<?php endif; ?>
		  </div> 
		  
		  
		  <?php
	$frpstd = get_option(SHORT_NAME . 'frpstd');
	if (! $frpstd) {
?>
		  <div class="ghghhp">
		  <div class="spss3"><?php $frti= get_option(SHORT_NAME . 'frti'); echo $frti; ?></div>
		  <?php 
	
		$cat2 = get_option(SHORT_NAME . 'category_20');
		$featured_posts_count = get_option(SHORT_NAME . 'featured_posts_count');
		
		
		
		$args = array(	
		
		            'cat' => $cat2,
					'showposts' => $featured_posts_count,
					'post__not_in' => $do_not_duplicate,
					
					
					);
					
						
		
		query_posts($args);
		if (have_posts() && (! ($cat2 < 0))) {
			while (have_posts()) : the_post();
				$image = get_post_meta($post->ID, "Image", $single = true); ?>
						    <div class="flllota">
							<div class="fgtio">
							<?php if ($image !== '') { ?>
							<a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title(); ?>">
<img src="<?php bloginfo('template_directory'); ?>/phpThumb/phpThumb.php?src=<?php echo $image; ?>&amp;h=50&amp;w=50&amp;zc=1&amp;q=100"  alt="<?php the_title(); ?>" style="border:none;" /></a>
						<?php }
						else {
							echo '';
						} ?>
							
							
                     </div>
                            </div><!-- end: portfolio-content -->    <div class="sblg-tin"> <div class="sd-blg-t2">
		  <a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?>
		  </a></div><div class="cm-sd-bgo"><?php the_time('F j, Y, g:i a') ?></div></div><div class="clear"></div>	<?php endwhile; 		}
		else {
			print_emp_cat('2', $cat2);
		}
	?> </div>
	
		<?php
	}
?>
	 <div class="clear"></div>


 
</div>



				

	

	

   

	  
	  
	  
	  


<?php get_footer(); ?>







