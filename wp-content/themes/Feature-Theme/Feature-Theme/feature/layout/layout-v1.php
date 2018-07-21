<?php get_header(); ?>
<?php get_sidebar(); ?>



		
		 		 
 
		 <div class="mbo-all">

	<div class="text-hdin"><?php $ablgt= get_option(SHORT_NAME . 'ablgt'); echo $ablgt; ?></div>
		 <div class="smi-dci"><?php $fth= get_option(SHORT_NAME . 'fth'); echo $fth; ?></div>
		 
		
			  <div class="portfolio-main">
					<?php 
	$post_count = get_option(SHORT_NAME . 'blog_post_count');
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	
	$args = array(	'posts_per_page' => $post_count,
					'paged' => $paged);
	query_posts($args);
		
	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php $image = get_post_meta($post->ID, "Image", $single = true); ?>
						    <div class="portfolio-content">
							<div class="shada1">
							<div class="port-thumb">	<?php if ($image !== '') { ?>
							<a href="<?php echo $image; ?>" title="<?php the_title(); ?>" rel="prettyPhoto[group]">
<img src="<?php bloginfo('template_directory'); ?>/phpThumb/phpThumb.php?src=<?php echo $image; ?>&amp;h=167&amp;w=224&amp;zc=1&amp;q=100"  style="border:none;" /></a>
						<?php }
						else {
							echo '';
						} ?></div></div>
							<div class="portfolio-title"><h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2></div>
							<div class="portfolio-description"><p> <?php the_content_limit(111); ?>  </p></div>
                            
                            </div><!-- end: portfolio-content --> 			<?php endwhile; ?> 
	<div class="clear"></div></div>					
	
	<div class="pagi-po">
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>  
			</div><div class="clear"></div>
				<?php else : ?>
		
			<div class="bg-oo">
		<div class="cate-oops">Oops! No Posts Found </div>
		<div class="cate-aeros">Sorry, but you are looking for something that isn't here. </div></div>

		<?php endif; ?>	
		  </div>
	


 




				

	

	

   

	  
	  
	  
	  


<?php get_footer(); ?>







