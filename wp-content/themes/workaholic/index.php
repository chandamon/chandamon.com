<?php get_header(); ?>
<div id="introduction" class="grid_8">
	<h2><?php if ( function_exists( 'get_option_tree') && get_option_tree( 'workaholic_quote_one') <>'') { echo get_option_tree( 'workaholic_quote_one'); } else { ?> Hi! We design beautiful websites. <?php } ?></h2>
	<h3><?php if ( function_exists( 'get_option_tree') && get_option_tree( 'workaholic_quote_two') <>'') { echo get_option_tree( 'workaholic_quote_two'); } else { ?>Not just beautiful but usable websites. Be sure to check out what we have done and <a href="#">contact us</a> if you want to improve yours as well.<?php } ?></h3>	
</div>
<div id="twitter" class="grid_4">
	<div id="twitter-top">		
        <ul id="twitter_update_list"><li></li></ul>		
	</div>
</div>
<hr class="grid_12" />
	<div id="content" class="grid_12">
	    
	    <?php 
	    // Grab Option Tree theme options 
        if (function_exists( 'get_option_tree') ) { $options = get_option_tree( 'option_tree'); }
        
        // Start Slider
        if (function_exists( 'get_option_tree') && get_option_tree( 'workaholic_homepage',$options) == 'Upload images') { 
            $i=0;
            $home_images = get_option_tree('workaholic_home_images',$options,false,true); ?> 
            <h2>Latest Work</h2> 
            
            <?php foreach( $home_images as $image ) { 
                
                $i++; ?> 
                
                <div class="portfolio grid_4<?php if ($i == 1) { ?> alpha<?php } else if($i==3) {?> omega<?php $i = 0;} ?>">
                    <h4><a href="<?php if( $image['link'] <> '') { echo $image['link']; } else { echo "#"; } ?>" class="thumb">
        				    <img src="<?php echo $image['image']; ?>" alt="<?php echo $image['title']; ?>" width="284" height="150"  />
                                <span class="title"><?php echo $image['title']; ?></span></a><span class="category"><?php echo $image['description']; ?></span></h4>
                                </div>
           <?php } ?>
            
               
        <?php } else { ?> 
            
            
	<?php if (have_posts()) : ?>	
	<?php $i=0; ?>	
	<h2>Latest Work</h2>
			
		<?php
		global $blog_ID;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		query_posts('cat=-' . $blog_ID. '&paged='.$paged);
		while (have_posts()) : the_post();$i++;?>	
						
			<div class="portfolio grid_4<?php if ($i == 1) { ?> alpha<?php } else if($i==3) {?> omega<?php $i = 0;} ?>">
				<h4><a href="<?php the_permalink(); ?>" class="thumb">						
					<?php get_the_image( array( 'custom_key' => array( 'thumbnail' ), 'default_size' => 'thumbnail', 'width' => '284', 'height' => '150', 'link_to_post' => false ) ); ?>						
						<span class="title"><?php the_title(); ?></span></a><span class="category"><?php the_category(' + '); ?></span></h4>
			</div>		

		<?php endwhile; wp_reset_query();?>
		
	   
	
		<div class="navigation">
			<div class="next"><?php next_posts_link('Next &rarr;') ?></div>
			<div class="prev"><?php previous_posts_link('&larr; Previous') ?></div>
		</div>		

	<?php else : ?>

		<h2 class="center">Not Found</h2>
		<p class="center">Sorry, but you are looking for something that isn't here.</p>
		<?php get_search_form(); ?>

	<?php endif; ?>
	
	<?php } ?> 

	</div>

<?php get_footer(); ?>
