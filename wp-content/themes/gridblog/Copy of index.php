<?php get_header(); ?>
		
 <?php include (TEMPLATEPATH . "/topcontent.php"); ?>

<div class="span-24">

<?php if (have_posts()) : ?>

<?php $count=0; while (have_posts()) : the_post(); if(!($firstpost == $post->ID)) : ?>
<?php if($count % 2 == 0) echo '<div class="left span-11 colborder">'; else echo '<div class="right span-11">'; ?>

    <div class="post" id="post-<?php the_ID(); ?>">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <div class="allinfos alt"><span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span> | Written by <?php the_author() ?> </div>
    
            <?php the_content_rss('', TRUE, '', 50) ; ?><br /><br />
            <div class="category alt">Posted in <?php the_category(', ') ?><br /><?php the_tags('Tags: ', ', ', ' '); ?><?php edit_post_link('Edit', '[ ', ' ]'); ?></div>
            <br clear="all" />
            

    </div><!--post-->
    
</div><!--left/right-->
<?php if($count % 2 != 0) echo '<br clear="all" />';?>

<?php $count++; endif; ?>

<?php  endwhile; ?>

    <div class="alignleft alt"><?php next_posts_link('&laquo; Previous Entries') ?></div>
    <div class="alignright alt"><?php previous_posts_link('Next Entries &raquo;') ?></div>

<?php else : ?>
<?php endif; ?>
    
</div><!--span-24-->
        
        
<?php include (TEMPLATEPATH . "/bottomcontent.php"); ?>
        
<?php get_footer(); ?>
        
	</div><!--container-->

</body>
</html>