<?php get_header(); ?>
		


<div class="single-span-24">
<div class="single-span-8 colborder">
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

    <div class="post" id="post-<?php the_ID(); ?>">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            
    
            <?php the_content() ; ?>
			  <div class="category alt"><?php the_tags('&#22823;&#23383; ', ', ', ' '); ?><?php edit_post_link('Edit', '[ ', ' ]'); ?></div>
            <br clear="all" />
            <?php comments_template(); ?></div>
 </div><!--post-->
 <div class="span-9 colborder">
 <span class="meta"><?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></span>

   <?php if(function_exists('echo_ald_crp')) echo_ald_crp(); ?></div>
<?php  endwhile; ?>
<?php else : ?>
<?php endif; ?>
    
</div><!--span-24-->
        
	    
<?php include (TEMPLATEPATH . "/bottomcontent.php"); ?>
        
<?php get_footer(); ?>
        
	</div><!--container-->

</body>
</html>