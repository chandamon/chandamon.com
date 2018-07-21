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


$pp_controller_write = new pollpress_controller_write();
$pp_controller_write->dispatch();
$pp_poll = $pp_controller_write->get_poll();
$post = $pp_controller_write->get_post();
$post_ID = $post->ID;

if ('' != $post->pinged) {
	$pings = '<p>'. __('Already pinged:') . '</p><ul>';
	$already_pinged = explode("\n", trim($post->pinged));
	foreach ($already_pinged as $pinged_url) {
		$pings .= "\n\t<li>$pinged_url</li>";
	}
	$pings .= '</ul>';
}


$messages[1] = __('Poll updated');
$messages[2] = __('Custom field updated');
$messages[3] = __('Custom field deleted.');
$messages[4] = __('Poll saved.') . ' <a href="' . get_bloginfo('url') . '">' . __('View site') . ' &raquo;</a>';
?>

<script type="text/javascript" src="../wp-includes/js/tw-sack.js"></script>
<script type="text/javascript" src="list-manipulation.js"></script>
<script type="text/javascript" src="<?php echo POLLPRESS_URL; ?>/pollpress_list_manipulation.js"></script>
<script type="text/javascript" src="../wp-includes/js/dbx.js"></script>
<script type="text/javascript">
//<![CDATA[
addLoadEvent( function() {
var manager = new dbxManager('pagemeta');
});
//]]>
</script>
<script type="text/javascript" src="../wp-includes/js/dbx-key.js"></script>
<script type="text/javascript" src="cat-js.php"></script>


<?php if (isset($_GET['message'])) : ?>
<?php $message_index = (int)$_GET['message']; ?>
<div id="message" class="updated fade"><p><?php echo $messages[ $message_index ]; ?></p></div>
<?php endif; ?>

<?php
	if ( current_user_can('edit_posts') ) {
		get_currentuserinfo();
		if ( $drafts = $pp_controller_write->get_users_poll_drafts( $user_ID ) ) {
			?>
			<div class="wrap">
			<p><strong><?php _e('Your Drafts:') ?></strong>
			<?php
			$num_drafts = count($drafts);
			if ( $num_drafts > 15 ) $num_drafts = 15;
			for ( $i = 0; $i < $num_drafts; $i++ ) {
				$draft = $drafts[$i];
				if ( 0 != $i )
					echo ', ';
				$draft_title = stripslashes($draft->get_title());
				if ( empty($draft_title) )
					$draft_title = sprintf(__('Poll # %s'), $draft->get_id());
				echo "<a href='" . POLLPRESS_WRITE . "&id=" . $draft->get_id() . "' title='" . __('Edit this draft') . "'>" . $draft_title . "</a>";
			}
			?>
			<?php if ( 15 < count($drafts) ) { ?>
			, <a href="<?php echo POLLPRESS_MANAGE; ?>"><?php echo sprintf(__('and %s more'), (count($drafts) - 15) ); ?> &raquo;</a>
			<?php } ?>
			.</p>
			</div>
			<?php
		}
	}
?>

<div class="wrap">		

<form name="post" action="<?php echo POLLPRESS_WRITE; ?>&id=<?php echo $pp_poll->get_id(); ?>" method="post" id="post">

<?php
	if (0 == $post_ID) {
		$form_action = 'post';
		$temp_ID = -1 * time();
		$form_extra = "<input type='hidden' name='temp_ID' value='$temp_ID' />";
		wp_nonce_field('add-poll');
	} else {
		$form_action = 'editpost';
		$form_extra = "<input type='hidden' name='post_ID' value='$post_ID' />";
		wp_nonce_field('update-poll_' .  $pp_poll->get_id());
	}
?>

	<input type="hidden" name="user_ID" value="<?php echo $user_ID ?>" />
	<input type="hidden" name="action" value="<?php echo $form_action ?>" />
	<input type="hidden" name="post_author" value="<?php echo $post->post_author ?>" />
	<?php echo $form_extra ?>

		<h2 id="write-post">
			<?php _e('Write Poll'); ?>
			<?php if ( 0 != $post_ID ) : ?>
				<small class="quickjump">
					<a href="#preview-post"><?php _e('preview &darr;'); ?></a>
				</small>
			<?php endif; ?>
		</h2>
	
		<script type="text/javascript">
		<!--
		function focusit() { // focus on first input field
			<?php if ( $pp_poll->get_id() == -1 ) { ?>
				document.getElementById('title').focus();
			<?php } else { ?>
				document.getElementById('option_text').focus();
			<?php } ?>
		}
		addLoadEvent(focusit);
		//-->
		</script>


		<div id="moremeta">
			<div id="grabit" class="dbx-group">

				<fieldset id="commentstatusdiv" class="dbx-box">
					<h3 class="dbx-handle"><?php _e('Discussion') ?></h3>
					<div class="dbx-content">
						<input name="advanced_view" type="hidden" value="1" />
						<label for="comment_status" class="selectit">
						<input name="comment_status" type="checkbox" id="comment_status" value="open" <?php checked($post->comment_status, 'open'); ?> />
						<?php _e('Allow Comments') ?></label> 
						<label for="ping_status" class="selectit"><input name="ping_status" type="checkbox" id="ping_status" value="open" <?php checked($post->ping_status, 'open'); ?> /> <?php _e('Allow Pings') ?></label>
					</div>
				</fieldset>

				<fieldset id="passworddiv" class="dbx-box">
					<h3 class="dbx-handle"><?php _e('Password-Protect Post') ?></h3> 
					<div class="dbx-content"><input name="post_password" type="text" size="13" id="post_password" value="<?php echo $post->post_password ?>" /></div>
				</fieldset>

				<fieldset id="slugdiv" class="dbx-box">
					<h3 class="dbx-handle"><?php _e('Post slug') ?></h3> 
					<div class="dbx-content"><input name="post_name" type="text" size="13" id="post_name" value="<?php echo $post->post_name ?>" /></div>
				</fieldset>

				<fieldset id="categorydiv" class="dbx-box">
					<h3 class="dbx-handle"><?php _e('Categories') ?></h3>
					<div class="dbx-content">
						<p id="jaxcat"></p>
						<div id="categorychecklist"><?php dropdown_categories(get_settings('default_category')); ?></div>
					</div>
				</fieldset>

				<fieldset class="dbx-box">
					<h3 class="dbx-handle"><?php _e('Post Status') ?></h3> 
					<div class="dbx-content">
						<?php if ( current_user_can('publish_posts') ) : ?>
							<label for="post_status_publish" class="selectit">
								<input id="post_status_publish" name="post_status" type="radio" value="publish" <?php checked($post->post_status, 'publish'); ?> /> <?php _e('Published') ?>
							</label>
						<?php endif; ?>
						<label for="post_status_draft" class="selectit"><input id="post_status_draft" name="post_status" type="radio" value="draft" <?php checked($post->post_status, 'draft'); ?> /> <?php _e('Draft') ?></label>
						<label for="post_status_private" class="selectit"><input id="post_status_private" name="post_status" type="radio" value="private" <?php checked($post->post_status, 'private'); ?> /> <?php _e('Private') ?></label>
					</div>
				</fieldset>

				<?php if ( current_user_can('edit_posts') ) : ?>
					<fieldset class="dbx-box">
						<h3 class="dbx-handle"><?php _e('Post Timestamp'); ?>:</h3>
						<div class="dbx-content"><?php touch_time(($action == 'edit')); ?></div>
					</fieldset>
				<?php endif; ?>

				<?php if ( $authors = get_editable_authors( $current_user->id ) ) : // TODO: ROLE SYSTEM ?>
					<fieldset id="authordiv" class="dbx-box">
						<h3 class="dbx-handle"><?php _e('Post author'); ?>:</h3>
						<div class="dbx-content">
							<select name="post_author_override" id="post_author_override">
							<?php 
							foreach ($authors as $o) :
								$o = get_userdata( $o->ID );
								if ( $post->post_author == $o->ID || ( empty($post_ID) && $user_ID == $o->ID ) ) $selected = 'selected="selected"';
								else $selected = '';
								echo "<option value='$o->ID' $selected>$o->display_name</option>";
							endforeach;
							?>
							</select>
						</div>
					</fieldset>
				<?php endif; ?>

				<?php do_action('dbx_post_sidebar'); ?>

			</div>
		</div>

		<div id="maincontent" style="width:78%;">
		<fieldset id="titlediv">
			<legend><?php _e('Poll Title'); ?></legend>
			<div>
				<input type="text" name="post_title" size="30" tabindex="1" value="<?php echo $pp_poll->get_title(); ?>" id="title" />
			</div>
		</fieldset>
	
		
		<fieldset id="postdiv">
			<legend><?php _e('Poll Options'); ?></legend>
			
<?php 

			$pp_poll_options = $pp_poll->get_options();

			if ( count($pp_poll_options) > 0 ) { ?>

			<table id="the-list-x" width="100%" cellpadding="3" cellspacing="3">
				<tr>
					<th scope="col"><?php _e('ID') ?></th>
					<th scope="col"><?php _e('Title') ?></th>
					<th scope="col"><?php _e('Votes') ?></th>
					<th scope="col"><!-- Edit --></th> 
					<th scope="col"><!-- Up --></th> 
					<th scope="col"><!-- Down --></th>
					<th scope="col"><!-- Delete --></th> 
				</tr>
				<?php foreach ( $pp_poll_options as $option ) : ?>
					<?php $class = ('alternate' != $class) ? 'alternate' : ''; ?>
						
					<tr id='option-<?php echo $option->get_id(); ?>' class='<?php echo $class; ?>'>
						<th scope="row"><?php echo $option->get_id(); ?></th>
						<td><?php echo $option->get_text(); ?></td>
						<td><?php echo $option->get_votes(); ?></td>
						<td><a href="<?php echo POLLPRESS_EDIT_OPTION; ?>&id=<?php echo $pp_poll->get_id(); ?>&oid=<?php echo $option->get_id(); ?>" class="edit"><?php _e('Edit'); ?></a></td>
						<td><a href="<?php echo wp_nonce_url(POLLPRESS_WRITE . '&id=' . $pp_poll->get_id() . '&op=up&oid=' . $option->get_id(), 'update-poll-option_' . $option->get_id()); ?>" class="edit"><?php _e('Up'); ?></a></td>
						<td><a href="<?php echo wp_nonce_url(POLLPRESS_WRITE . '&id=' . $pp_poll->get_id() . '&op=down&oid=' . $option->get_id(), 'update-poll-option_' . $option->get_id()); ?>" class="edit"><?php _e('Down'); ?></a></td>
						<td><a href="<?php echo wp_nonce_url(POLLPRESS_WRITE . '&id=' . $pp_poll->get_id() . '&op=delete&oid=' . $option->get_id(), 'delete-poll-option_' . $option->get_id()); ?>" class="delete" onclick="return pp_deleteSomething( 'option', <?php echo $pp_poll->get_id(); ?>, <?php echo $option->get_id(); ?>, '<?php echo sprintf(__("You are about to delete the &quot;%s&quot; option.\\n&quot;OK&quot; to delete, &quot;Cancel&quot; to stop."), js_escape( $option->get_text() ) ); ?>');"><?php _e('Delete'); ?></a></td>
					</tr>
				<?php endforeach; ?>
			</table>
		<?php } else { ?>
			<p><?php _e("No options yet."); ?></p>
		<?php } ?>
		
			<legend><?php _e('Add Option'); ?></legend>
			<div>
				<input type="text" name="option_text" size="30" tabindex="2" value="" id="option_text" />
				<input type="submit" name="add_option" id="add_option" tabindex="3" value="<?php _e('Add'); ?>" />
			</div>
		
		</fieldset>
	
		<div id="ajax-response"></div>
		
		<input type="hidden" name="post_pingback" value="<?php echo get_option('default_pingback_flag'); ?>" id="post_pingback" />
		<input type="hidden" name="prev_status" value="<?php echo $post->post_status; ?>" />

		<p class="submit">
			<input name="save" id="save" type="submit" tabindex="4" value="<?php _e('Save and Continue Editing'); ?>" />
			<input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Save'); ?>" />
			<?php if ( ($post->post_status == 'draft') && current_user_can('publish_posts') ) { ?>
				<input name="publish" type="submit" id="publish" tabindex="6" accesskey="p" value="<?php _e('Publish'); ?>" />
			<?php } ?>
			
			<input name="referredby" type="hidden" id="referredby" value="<?php 
			if ( !empty($_REQUEST['popupurl']) )
				echo wp_specialchars($_REQUEST['popupurl']);
			else if ( url_to_postid(wp_get_referer()) == $post_ID )
				echo 'redo';
			else
				echo wp_specialchars(wp_get_referer());
			?>" />
		</p>
		

		<div id="advancedstuff" class="dbx-group" >


			<div class="dbx-box-wrapper">
				<fieldset class="dbx-box">
					<div class="dbx-handle-wrapper">
						<h3 class="dbx-handle"><?php _e('Trackbacks') ?></h3>
					</div>
					<div class="dbx-content-wrapper">
						<div class="dbx-content"><?php _e('Send trackbacks to'); ?>: 
							<input type="text" name="trackback_url" style="width: 415px" id="trackback" tabindex="7" value="<?php echo str_replace("\n", ' ', $post->to_ping); ?>" /> 
							(<?php _e('Separate multiple URIs with spaces'); ?>)
							<?php 
							if ( ! empty($pings) )
								echo $pings;
							?>
						</div>
					</div>
				</fieldset>
			</div>

			<div class="dbx-box-wrapper">
				<fieldset id="postcustom" class="dbx-box">
					<div class="dbx-handle-wrapper">
						<h3 class="dbx-handle"><?php _e('Custom Fields') ?></h3>
					</div>
					<div class="dbx-content-wrapper">
						<div id="postcustomstuff" class="dbx-content">
							<?php 
							if($metadata = has_meta($post_ID)) {
							?>
							<?php
								list_meta($metadata); 
							?>
							<?php
							}
								meta_form();
							?>
						</div>
					</div>
				</fieldset>
			</div>

			<?php do_action('dbx_post_advanced'); ?>

		</div>
		
		<?php if ('editpost' == $form_action) { ?>
			<?php $delete_message = sprintf(__("You are about to delete this poll \'%s\'\\n  \'Cancel\' to stop, \'OK\' to delete."), js_escape($pp_poll->get_title()) ); ?>
			<?php $delete_nonce = wp_create_nonce( 'delete-poll_' . $pp_poll->get_id() ); ?>
			<input name="deletepost" class="button" type="submit" id="deletepost" tabindex="10" value="<?php _e('Delete this poll') ?>" onclick="if ( confirm('<?php echo $delete_message; ?>') ) { document.forms.post._wpnonce.value = '<?php echo $delete_nonce; ?>'; return true;} return false;" />
		<?php } ?>
		
		</div>
	
	
</form>

<?php if ('editpost' == $form_action) { ?>
	<div id='preview' class='wrap'>
		<h2 id="preview-post"><?php _e('Poll Preview (updated when poll is saved)'); ?> 
			<small class="quickjump"><a href="#write-post"><?php _e('edit &uarr;'); ?></a></small>
		</h2>
		<iframe id="pollpreview" name="pollpreview" src="<?php echo add_query_arg('preview', 'true', get_permalink($post->ID)); ?>" width="100%" height="600" ></iframe>
	</div>
<?php } ?>

</div>
