<?php get_header(); ?>
		
<div class="span-24">

<?php if (have_posts()) : ?>

		<?php while (have_posts()) : the_post(); ?>

    <div class="post" id="post-<?php the_ID(); ?>">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            
    
           <?php the_content() ; ?><br /><br />
            <div class="category alt">Posted in <?php the_category(', ') ?><br /><?php the_tags('Tags: ', ', ', ' '); ?><?php edit_post_link('Edit', '[ ', ' ]'); ?></div>
            <br clear="all" />
            <?php comments_template(); ?>
 </div><!--post-->
<?php  endwhile; ?>
    <div class="alignleft alt"><?php next_posts_link('&laquo;   &#20043;&#21069;&#30340;&#25991;') ?></div>
    <div class="alignright alt"><?php previous_posts_link('&#20043;&#24460;&#30340;&#25991; &raquo;') ?></div>
<?php else : ?>

		<h2 style="color:#FF0000;">No results found for "<? echo $_GET['s']; ?>". Try a different search?</h2>

<?php endif; ?>
    
</div><!--span-24-->
        
        
<?php include (TEMPLATEPATH . "/bottomcontent.php"); ?>
        
<?php get_footer(); ?>
        
	</div><!--container-->

</body>
</html>