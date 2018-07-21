<?php get_header(); ?>
		


<div class="span-24">

<?php if (have_posts()) : ?>

 	  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	  <?php /* If this is a category archive */ if (is_category()) { ?>
		<h3 class="alt">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category:</h2>
 	  <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h3 class="alt">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>
 	  <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h3 class="alt">Archive for <?php the_time('F jS, Y'); ?>:</h2>
 	  <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h3 class="alt">Archive for <?php the_time('F, Y'); ?>:</h2>
 	  <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h3 class="alt">Archive for <?php the_time('Y'); ?>:</h2>
	  <?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h3 class="alt">Author Archive</h2>
 	  <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h3 class="alt">Blog Archives</h2>
 	  <?php } ?>

		
<?php $count=0; while (have_posts()) : the_post(); if(!($firstpost == $post->ID)) : ?>
<?php if($count % 2 == 0) echo '<div class="left span-11 colborder">'; else echo '<div class="right span-11">'; ?>

    <div class="post" id="post-<?php the_ID(); ?>">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <div class="allinfos alt"><span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span> | Written by <?php the_author() ?> </div>
    
            <?php the_content_rss('', TRUE, '', 50) ; ?><br /><br />
            <div class="category alt">Posted in <?php the_category(', ') ?><br /><?php the_tags('Tags: ', ', ', ' '); ?><?php edit_post_link('Edit', '[ ', ' ]'); ?></div>
            <br clear="all" />
            <?php comments_template(); ?>
 </div><!--post-->
<?php  endwhile; ?>
<?php else : ?>
<?php endif; ?>
    
</div><!--span-24-->
        
         <?php include (TEMPLATEPATH . "/topcontent.php"); ?>
<?php include (TEMPLATEPATH . "/bottomcontent.php"); ?>
        
<?php get_footer(); ?>
        
	</div><!--container-->

</body>
</html>