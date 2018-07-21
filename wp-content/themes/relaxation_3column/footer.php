	<div id="footer">
		<p>
			<a href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a>
			and <a href="<?php bloginfo('comments_rss2_url'); ?>">Comments (RSS)</a>.
			<small><?php echo $wpdb->num_queries; ?> queries. <?php timer_stop(1); ?> seconds.</small>
		</p>
	</div>
</div>

	<?php do_action('wp_footer'); ?>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-240539-1";
urchinTracker();
</script>
</body>
</html>