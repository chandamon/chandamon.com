<?php 
/* Don't remove this line. */
require('./wp-blog-header.php');
include(get_template_directory() . '/header.php');
?>

<ul class="topnavi">
  <?php if (function_exists('wp_theme_switcher')) { ?>
  <li>
    <?php wp_theme_switcher('dropdown'); ?>
  </li>
  <?php } ?>
  <li><a href="/" title="Home" rel="me">Home</a></li>
  <li><a href="feed:<?php bloginfo('rss2_url'); ?>" title="Posts Feed">RSS</a></li>
  <li><a href="http://vidar.xmgfree.com" title="Vidar, Theme Author">Vidar</a></li>
  <li><a href="#" title="link!">Page</a></li>
</ul>
<div class="description">
  <?php bloginfo('description'); ?>
</div>
<h1>
  <?php bloginfo('name'); ?>
</h1>
</div>
<div id="content">
<div class="post_nav">
<div class="alignleft">
  <?php posts_nav_link('','','Past') ?>
</div>
<div class="alignright">
  <?php posts_nav_link('','Future','') ?>
</div>
</div>
<br>
<br>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="post"> <span class="tiny">On
  <?php the_time('Y-m-d') ?>
  ,
  <?php the_author() ?>
  said...</span>
  <h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
    "<?php the_title(); ?>"
</a> </h2>
  <span class="tiny">On the subject of
  <?php the_category(', ') ?>
  </span>
  <div class="entry">
    <?php the_content('Ramble On'); ?>
    <div class="comment_link">
      <?php comments_popup_link(__('What?'), __('1... That\'s all?'), __('%! Whee!')); ?>
    </div>
  </div>
  <br>
  <!--
	<?php trackback_rdf(); ?>
	-->
</div>
<?php comments_template(); // Get wp-comments.php template ?>
<?php endwhile; else: ?>
<p>
  <?php _e('Sorry, no posts matched your criteria.'); ?>
</p>
<?php endif; ?>
<?php include(get_template_directory() . '/footer.php'); ?>
