<?php get_header(); ?>
		
 <?php include (TEMPLATEPATH . "/topcontent.php"); ?>

<div class="span-24">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

    <div class="post" id="post-<?php the_ID(); ?>">
            <h2><?php the_title(); ?></h2>
            
    
            <?php the_content() ; ?>
            <br clear="all" />

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