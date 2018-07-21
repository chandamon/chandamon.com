<?php get_header(); ?>
		


<div class="archive-span-24">

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

		
<?php $count=1; while (have_posts()) : the_post(); if(!($firstpost == $post->ID)) : ?>
<?php if($count % 3 == 0) echo '<div class="right span-11 ">'; elseif($count % 2 == 0) echo '<div class="middll left span-11 colborder">'; else echo '<div class="left span-11 colborder">'; ?>

    <div class="post" id="post-<?php the_ID(); ?>">
            <h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
            <div class="allinfos alt"><span class="date"><?php the_time('F jS, Y') ?></span> | <span class="comments"><?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?> </span>  </div>
    
             <?php
$id =$post->ID;
$the_content =$wpdb->get_var("SELECT post_content FROM $wpdb->posts WHERE ID = $id");
$pattern = '!<img.*?src="(.*?)"!';
preg_match_all($pattern, $the_content, $matches);
$image_src = $matches['1'][0];
?>

<?php if($image_src != '') {
echo "<div class='tumbr' style='border:0px; width:300px;height: 200px;background: url(";

 echo $image_src ;
echo ") 0 0 no-repeat;'> </div>" ; 
echo strip_tags(get_the_excerpt(), '<a><strong>'); }
else {?> <?php  the_content(); ?> <?php }
?>

<br /><br />
            <div class="category alt">Posted in <?php the_category(', ') ?>
            <br />
      <?php the_tags('Tags: ', ', ', ' '); ?><?php edit_post_link('Edit', '[ ', ' ]'); ?></div>
            <br clear="all" />
            

    </div><!--post-->
    
</div><!--left/right-->
<?php if($count % 3 == 0) echo '<br clear="all" />';?>
<?php if($count % 3 == 0) {
$count = 0;
}
?>

<?php $count++; endif; ?>

<?php  endwhile; ?>

    <div class="alignleft alt"><?php next_posts_link('&laquo;   &#20043;&#21069;&#30340;&#25991;') ?></div>
    <div class="alignright alt"><?php previous_posts_link('&#20043;&#24460;&#30340;&#25991; &raquo;') ?></div>
<?php else : ?>
<?php endif; ?>
    
</div><!--span-24-->
        
<?php include (TEMPLATEPATH . "/bottomcontent.php"); ?>
        
<?php get_footer(); ?>
        
	</div><!--container-->

</body>
</html>