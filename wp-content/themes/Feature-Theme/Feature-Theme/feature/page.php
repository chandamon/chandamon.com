<?php get_header(); ?>
<?php get_sidebar(); ?>

 
		 		 

		 <div class="mbo-all">
							
						<div class="qnoyt">Page &#8212; <?php the_title(); ?></div>	
						
							
					<div class="portfolio-main">		
							
 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
 
							<div class="pajo1ent-conto"><?php the_content(); ?></div>
                          <div class="clear"></div></div>	
	
<?php endwhile; endif; ?>
  </div>

<?php get_footer(); ?>