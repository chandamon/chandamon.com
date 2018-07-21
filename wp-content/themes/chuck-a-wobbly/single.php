<?php 
/* Don't remove this line. */
require('./wp-blog-header.php');
include(get_template_directory() . '/header.php');
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<ul class="topnavi">
  <li><a href="/" title="Home" rel="me">Home</a></li>
  <?php if ( comments_open() ) : ?>
  <li><a href="#comments" title="<?php _e("Go comment"); ?>">Comments</a></li>
  <li><a href="feed:<?php bloginfo('comments_rss2_url'); ?>" title="Comments Feed">RSS</a></li>
  <?php endif; ?>
  <?php if ( pings_open() ) : ?>
  <li><a href="<?php trackback_url() ?>" rel="trackback">
    <?php _e('TrackBack <abbr title="Uniform Resource Identifier">URI</abbr>'); ?>
    </a></li>
  <?php endif; ?>
</ul>
<br>
<br>
<h1 id="post-<?php the_ID(); ?>"> <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
  <?php the_title(); ?>
  </a> </h1>
<div class="single_tiny">Thus spake
  <?php the_author() ?>
  on
  <?php the_time('Y-m-d') ?>
  about
  <?php the_category(', ') ?>
</div>
</div>
<div id="content">
<div class="post">
  <div class="alignleft">
    <?php previous_post('%', 'Before', 'no'); ?>
  </div>
  <div class="alignright">
    <?php next_post('%', 'After', 'no'); ?>
  </div>
  <br>
  <br>
  <div class="entry">
    <?php the_content('Ramble On'); ?>
    <div class="comment_link">
      <?php comments_popup_link(__('What?'), __('1... That\'s all?'), __('%! Whee!')); ?>
    </div>
  </div>
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
