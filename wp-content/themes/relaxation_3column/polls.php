<?php
/*
Template Name: Polls
*/
?>
<?php get_header(); ?>

	<div id="content" class="narrowcolumn">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><?php the_title(); ?></h2>
			<div class="entrytext">
				<?php the_content('Read the rest »'); ?>
				<?php link_pages('<p><b>Pages:</b> ', '</p>', 'number'); ?>
			</div>
			<div>
			<?php jal_democracy_archives($show_active = TRUE, $before_title = '<h3>',$after_title = '</h3>'); ?>
			</div>
		</div>
	  <?php endwhile; endif; ?>
		<?php edit_post_link('Edit this entry.'); ?>
	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>