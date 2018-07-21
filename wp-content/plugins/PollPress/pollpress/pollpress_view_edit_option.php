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

require_once('pollpress_controller_edit_option.php');

$pp_controller_edit_option = new pollpress_controller_edit_option();
$pp_controller_edit_option->dispatch();
$pp_poll = $pp_controller_edit_option->get_poll();
$pp_option = $pp_controller_edit_option->get_option();

?>


<div class="wrap">

	<h2 id="write-post">
		<?php _e('Edit Poll Option'); ?>
	</h2>

	<form name="post" action="<?php echo POLLPRESS_WRITE; ?>&id=<?php echo $pp_poll->get_id(); ?>&op=edit&oid=<?php echo $pp_option->get_id(); ?>" method="post" id="post">
		<script type="text/javascript">
		<!--
		function focusit() { // focus on first input field
			document.getElementById('option_text').focus();
		}
		addLoadEvent(focusit);
		//-->
		</script>
		
		<?php wp_nonce_field('update-poll-option_' .  $pp_option->get_id()); ?>
		
		<div class="poststuff">
			<fieldset>
				<legend><?php _e('Text'); ?></legend>
				<div>
					<input type="text" name="option_text" size="30" tabindex="1" value="<?php echo $pp_option->get_text(); ?>" id="post_title" />
				</div>
			</fieldset>
			
			<fieldset>
				<legend><?php _e('Votes'); ?></legend>
				<div>
					<input type="text" name="option_votes" size="30" tabindex="2" value="<?php echo $pp_option->get_votes(); ?>" id="post_title" />
				</div>
			</fieldset>
			
			<p class="submit">
				<input name="save_option" id="save_option" type="submit" tabindex="3" value="<?php _e('Save'); ?>" />
				<input name="cancel" id="cancel" type="submit" tabindex="4" value="<?php _e('Cancel'); ?>" />
			</p>
		</div>
	</form>
</div>