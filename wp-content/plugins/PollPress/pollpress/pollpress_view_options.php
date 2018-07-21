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

$pp_controller_options = new pollpress_controller_options();
$pp_controller_options->dispatch();
$pp_bar_color = $pp_controller_options->get_bar_color();

$messages[1] = __('All polls deleted');
$messages[2] = __('PollPress options updated');

?>

<?php if (isset($_GET['message'])) : ?>
<?php $message_index = (int)$_GET['message']; ?>
<div id="message" class="updated fade"><p><?php echo $messages[ $message_index ]; ?></p></div>
<?php endif; ?>

<div class="wrap">
	<h2><?php _e('PollPress Options'); ?></h2>
	
	<form action="<?php echo POLLPRESS_OPTIONS; ?>" method="post">
		
		<?php wp_nonce_field('pollpress-update-options'); ?>
		
		<fieldset class="options">
			<legend><?php _e('Results'); ?></legend>
			<table class="optiontable">
				<tr>
					<th scope="row"><?php _e('Bar color:'); ?></th>
					<td>
						<input type="text" name="bar_color" size="7" value="<?php echo $pp_bar_color; ?>" />
						<span style="background-color:<?php echo $pp_bar_color; ?>;">&nbsp;&nbsp;&nbsp;&nbsp;</span>
					</td>
				</tr>
			</table>
		</fieldset>
		
		<?php if ( current_user_can('edit_posts') ) { ?>
			<fieldset class="options">
				<legend><?php _e('Uninstall'); ?></legend>
				<table class="optiontable">
					<tr>
						<th scope="row">&nbsp;</th>
						<td>
							<?php $delete_message = __("You are about to delete all polls\\n  \'Cancel\' to stop, \'OK\' to delete."); ?>
						
							<input type="button" name="delete_all" value="<?php _e('Delete all polls'); ?>" onclick="return confirm('<?php echo $delete_message; ?>');"/>
						</td>
					</tr>
				</table>
			</fieldset>
		<?php } ?>
		
		<p class="submit">
			<input type="submit" name="Submit" value="<?php _e('Update Options') ?> &raquo;" />
		</p>
	</form>
</div>