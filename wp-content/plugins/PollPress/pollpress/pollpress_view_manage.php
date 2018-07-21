<?php
/*  Copyright 2006  Andy Finnell  (email : andy@losingfight.com)

	Modified BSD license, compatible with GNU GPL.
	
	Redistribution and use in source and binary forms, with or without 
	modification, are permitted provided that the following conditions are met:

	1. Redistributions of source code must retain the above copyright notice, 
	this list of conditions and the following disclaimer.

	2. Redistributions in binary form must reproduce the above copyright notice, 
	this list of conditions and the following disclaimer in the documentation 
	and/or other materials provided with the distribution.

	3. The name of the author may not be used to endorse or promote products
	derived from this software without specific prior written permission.

	THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED 
	WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF 
	MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO 
	EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, 
	SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED 
	TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR 
	PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF 
	LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING 
	NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, 
	EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/

require_once("pollpress_helpers_category.php");
require_once("pollpress_helpers_comment.php");

$pp_controller_manage = new pollpress_controller_manage();
$pp_controller_manage->dispatch();
$pp_polls = $pp_controller_manage->get_polls();
$drafts = $pp_controller_manage->get_users_poll_drafts( $user_ID );
$other_drafts = $pp_controller_manage->get_others_poll_drafts( $user_ID);

?>

<script type="text/javascript" src="../wp-includes/js/tw-sack.js"></script>
<script type="text/javascript" src="list-manipulation.js"></script>
<script type="text/javascript" src="<?php echo POLLPRESS_URL; ?>/pollpress_list_manipulation.js"></script>

<?php if ($drafts || $other_drafts) { ?> 
<div class="wrap">
<?php if ($drafts) { ?>
    <p><strong><?php _e('Your Drafts:') ?></strong> 
    <?php $pp_controller_manage->drafts($drafts); ?> 
    .</p> 
<?php } ?>

<?php if ($other_drafts) { ?> 
    <p><strong><?php _e('Other&#8217;s Drafts:') ?></strong> 
	<?php $pp_controller_manage->drafts($other_drafts); ?> 	
    .</p> 
<?php } ?>

</div>
<?php } ?>

<div class="wrap">
	<h2><?php $pp_controller_manage->page_title(); ?></h2>
	<p><?php _e('Polls are like posts except they contain custom content, i.e. a poll.'); ?> <a href="<?php echo POLLPRESS_WRITE; ?>"><?php _e('Create a new poll'); ?> &raquo;</a></p>
	
	
	<form name="searchform" action="" method="get" style="float: left; width: 16em; margin-right: 3em;"> 
		<fieldset> 
			<legend><?php _e('Search Polls&hellip;') ?></legend> 
			<input type="hidden" name="page" value="<?php echo POLLPRESS_MANAGE_PAGE; ?>" />
			<input type="text" name="s" value="<?php if (isset($_GET['s'])) echo wp_specialchars($_GET['s'], 1); ?>" size="17" /> 
			<input type="submit" name="submit" value="<?php _e('Search') ?>"  /> 
		</fieldset>
	</form>

	<?php $arc_result = $pp_controller_manage->get_months_for_polls(); ?>

	<?php if ( count($arc_result) ) { ?>

		<form name="viewarc" action="" method="get" style="float: left; width: 20em; margin-bottom: 1em;">
			<fieldset>
			<legend><?php _e('Browse Month&hellip;') ?></legend>
			<input type="hidden" name="page" value="<?php echo POLLPRESS_MANAGE_PAGE; ?>" />
		    <select name='m'>
			<?php
				foreach ($arc_result as $arc_row) {			
					$arc_year  = $arc_row->yyear;
					$arc_month = $arc_row->mmonth;

					if( isset($_GET['m']) && $arc_year . zeroise($arc_month, 2) == (int) $_GET['m'] )
						$default = 'selected="selected"';
					else
						$default = null;

					echo "<option $default value=\"" . $arc_year.zeroise($arc_month, 2) . '">';
					echo $month[zeroise($arc_month, 2)] . " $arc_year";
					echo "</option>\n";
				}
			?>
			</select>
				<input type="submit" name="submit" value="<?php _e('Show Month') ?>"  /> 
			</fieldset>
		</form>

	<?php } ?>
	
	<br style="clear:both;" />

	<?php if ( count($pp_polls) ) { ?>
		<table id="the-list-x" width="100%" cellpadding="3" cellspacing="3"> 
			<tr>
				<th scope="col"><?php _e('ID'); ?></th>
				<th scope="col"><?php _e('When'); ?></th>
				<th scope="col"><?php _e('Title'); ?></th>
				<th scope="col"><?php _e('Categories'); ?></th>
				<th scope="col"><?php _e('Comments'); ?></th>
				<th scope="col"><?php _e('Author'); ?></th>
				<th scope="col"><!-- View --></th>
				<th scope="col"><!-- Edit --></th>
				<th scope="col"><!-- Delete --></th>
			</tr>
			
			<?php foreach ( $pp_polls as $pp_poll ) : ?>
				<?php $class = ('alternate' != $class) ? 'alternate' : ''; ?>
				<?php $post = $pp_poll->get_post(); ?>
				<tr id="poll-<?php echo $pp_poll->get_id(); ?>" class="<?php echo $class; ?>">
					<th scope="row"><?php echo $pp_poll->get_id(); ?></th>
					<td><?php echo mysql2date('Y-m-d \<\b\r \/\> g:i:s a', $post->post_date); ?></td>
					<td><?php echo $pp_poll->get_title(); ?></td>
					<td><?php echo get_poll_category_list($pp_poll, ','); ?></td>
					<td><a href="<?php echo POLLPRESS_MANAGE; ?>&id=<?php echo $pp_poll->get_id(); ?>&c=1"><?php echo get_poll_comments_number($pp_poll); ?></a></td>
					<td><?php echo get_author_name($post->post_author); ?></td>
					<td><a href="<?php echo get_permalink($pp_poll->get_post_id()); ?>" rel="permalink" class="edit"><?php _e('View'); ?></a></td>
					<td>
						<?php if ( current_user_can('edit_post',$post->ID) ) { ?>
							<a href="<?php echo POLLPRESS_WRITE; ?>&id=<?php echo $pp_poll->get_id(); ?>" class="edit"><?php _e('Edit'); ?></a>
						<?php } ?>
					</td>
					<td>
						<?php if ( current_user_can('edit_post',$post->ID) ) { ?>
							<a href="<?php echo wp_nonce_url(POLLPRESS_MANAGE . '&op=delete&id=' . $pp_poll->get_id(), 'delete-poll_' . $pp_poll->get_id()); ?>" class="delete" onclick="return pp_deleteSomething( 'poll', <?php echo $pp_poll->get_id(); ?>, -1, '<?php echo sprintf(__("You are about to delete the &quot;%s&quot; poll.\\n&quot;OK&quot; to delete, &quot;Cancel&quot; to stop."), js_escape( $pp_poll->get_title() ) ); ?>');"><?php _e('Delete'); ?></a>
						<?php } ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
	<?php } else { ?>
		<?php if ( isset( $_GET['s'] ) ) {?>
			<p><?php _e("No polls found."); ?></p>
		<?php } else { ?>
			<p><?php _e("No polls yet."); ?></p>			
		<?php } ?>
	<?php } ?>
	
	<div id="ajax-response"></div>

	<h3><a href="<?php echo POLLPRESS_WRITE; ?>"><?php _e('Create New Poll'); ?> &raquo;</a></h3>

	<div class="navigation">
		<div class="alignleft"><?php $pp_controller_manage->next_polls_link(__('&laquo; Previous Entries')); ?></div>
		<div class="alignright"><?php $pp_controller_manage->previous_polls_link(__('Next Entries &raquo;')); ?></div>
	</div>

<?php
	if ( 1 == count($pp_polls) ) {
		$poll = $pp_polls[0];
		$comments = get_poll_comments($poll);
		if ($comments) {
		?> 
	<h3><?php _e('Comments') ?></h3> 
	<ol id="comments"> 
	<?php
	foreach ($comments as $comment) {
	$comment_status = wp_get_comment_status($comment->comment_ID);
	?> 

	<li <?php if ("unapproved" == $comment_status) echo "class='unapproved'"; ?> >
	  <?php comment_date('Y-n-j') ?> 
	  @
	  <?php comment_time('g:m:s a') ?> 
	  <?php 
				if ( current_user_can('edit_post', $poll->get_post_id()) ) {
					echo "[ <a href=\"post.php?action=editcomment&amp;comment=".$comment->comment_ID."\">" .  __('Edit') . "</a>";
					echo ' - <a href="' . wp_nonce_url('post.php?action=deletecomment&amp;p=' . $poll->get_post_id() . '&amp;comment=' . $comment->comment_ID, 'delete-comment_' . $comment->comment_ID) . '" onclick="return confirm(\'' . __("You are about to delete this comment.\\n&quot;Cancel&quot; to stop, &quot;OK&quot; to delete.") . "');\">" . __('Delete') . '</a> ';

					if ( ('none' != $comment_status) && ( current_user_can('moderate_comments') ) ) {
						if ('approved' == wp_get_comment_status($comment->comment_ID)) {
							echo ' - <a href="' . wp_nonce_url('post.php?action=unapprovecomment&amp;p=' . $poll->get_post_id() . '&amp;comment=' . $comment->comment_ID, 'unapprove-comment_' . $comment->comment_ID) . '">' . __('Unapprove') . '</a> ';
						} else {
							echo ' - <a href="' . wp_nonce_url('post.php?action=approvecomment&amp;p=' . $poll->get_post_id() . '&amp;comment=' . $comment->comment_ID, 'approve-comment_' . $comment->comment_ID) . '">' . __('Approve') . '</a> ';
						}
					}
					echo "]";
				} // end if any comments to show
				?> 
	  <br /> 
	  <strong> 
	  <?php comment_author() ?> 
	  (
	  <?php comment_author_email_link() ?> 
	  /
	  <?php comment_author_url_link() ?> 
	  )</strong> (IP:
	  <?php comment_author_IP() ?> 
	  )
	  <?php comment_text() ?> 

	</li> 
	<!-- /comment --> 
	<?php //end of the loop, don't delete
			} // end foreach
		echo '</ol>';
		}//end if comments
		?>
	<?php } ?> 

</div>