	<div id="sidebar">
		<div id="noindent">
			<ul>
				<?php /* If this is the frontpage */ if ( !is_home() ) { ?>
				<li>
					<h2><a href="/home/">返屋企啦</a></h2>
				</li>
				<?php } ?>

				<li>
					<h2><img src="http://chandamon.com/site/damon.gif"></h2>
					<ul><li><img src="http://chandamon.com/site/damonlogo.gif"></ul>
				</li>
				<li>
			

					
				</li>
				<?php if (function_exists('wp_theme_switcher')) { ?>
				<li>
					<h2><?php _e('Themes'); ?></h2>
					<ul>
						<li><?php wp_theme_switcher(); ?></li>
					</ul>
				</li>
				<?php } ?>
				<li>
					<h2><img src="http://chandamon.com/site/cate.gif"></h2>
					<ul>
						<?php list_cats(0, '', 'name', 'asc', '', 1, 0, 1, 1, 1, 1, 0,'','','','','') ?>
					</ul>
				</li>

				<li>
					<h2><img src="http://chandamon.com/site/archive.gif"></h2>
					<ul>
					<?php get_calendar(); ?>
					</ul>
				</li>	<li>
					<h2><img src="http://chandamon.com/site/comment.gif"></h2>
			<?php sem_recent_comments('max_num=10'); ?>
					<h2><img src="http://chandamon.com/site/link.gif"></h2>
				<?php get_links_list(); ?>
				<li>
					<h2><img src="http://chandamon.com/site/sub.gif"></h2>
					<ul><a href="http://feeds.feedburner.com/chandamon" target="_blank" title="subscribe with feedburner"><img src="http://www.feedburner.com/fb/images/pub/fbapix.gif" alt="subscribe with feedburner" style="border:0"/></a>
						<li></li>
						<li></li>
						<li></li>
					</ul>
			</ul>
		</div> <!-- end of noindent -->
	</div>

	<!-- This is the second sidebar for the 3 column relaxe theme.
	I left the flickr badges in as a example. Feel free to alter 
	the content to your own needs. -->
	<div id="sidebar2">
		<div id="noindent2">
			<ul><li>
					<h2><img src="http://chandamon.com/site/play.gif"></h2>
					<ul><li><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="100" height="20"
    codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
    <param name="movie" value="http://chandamon.com/site/song/singlemp3player.swf?file=http://chandamon.com/site/song/music.mp3&autoStart=false&songVolume=75&backColor=FFCC33&amp&frontColor=ffffff&amp&showDownload=false&amp" />
    <param name="wmode" value="transparent" />
    <embed wmode="transparent" width="100" height="20" src="http://chandamon.com/site/song/singlemp3player.swf?file=http://chandamon.com/site/song/music.mp3&autoStart=false&songVolume=75&backColor=FFCC33&amp&frontColor=ffffff&amp&showDownload=false&amp" type="application/x-shockwave-flash" "
    type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object></ul>
				</li>
				<li>
					<h2><img src="http://chandamon.com/site/snap.gif"></h2>
					<ul>
						<li>
						<!-- Start of Flickr Badge -->
				<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=5&display=random&size=t&layout=x&source=user&user=87206651%40N00"></script>
						<!-- End of Flickr Badge -->
						
						</li>
					</ul><li>
					<h2><img src="http://chandamon.com/site/sponsor.gif"></h2>
					<ul><li>
      <li><?php if (function_exists('vote_poll') && !$in_pollsarchive): ?>
<li>
   <h2>Polls</h2>
   <ul>
      <li><?php get_poll();?></li>
   </ul>
   <?php display_polls_archive_link(); ?>
</li>
<?php endif; ?> 
<?php jal_democracy(); ?>
<a href="http://www.last.fm/user/chandamon/?chartstyle=Damon"><img src="http://imagegen.last.fm/Damon/artists/chandamon.gif" border="0" /></a>
	  </ul>
				</li>
				<li>
			
<li><h2>最受歡迎Post先生</h2>
   <ul>
   <?php akpc_most_popular(); ?>
   </ul>
</li> 
<br><br>
<?php if ( function_exists('wp_tag_cloud') ) : ?>
	<ul id ="tagcloud">
	<?php wp_tag_cloud('smallest=8&largest=22&number=o&orderby=count'); ?>
	</ul>
<?php endif; ?>
				<A HREF="http://www.icdsoft.com/?aff=chandamon.damonc"><IMG WIDTH="125" HEIGHT="125" BORDER="0" SRC="http://affiliate.icdsoft.com/b/chandamon.damonc/125x125-1.gif" ALT="Web hosting by ICDSoft"></A>	
				</li>
				</li>
				</li>
			</ul>
		</div> <!-- end of noindent -->
	</div>
	<!-- end of the 3rd column -->
	