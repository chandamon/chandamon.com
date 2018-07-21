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

require_once('pollpress_controller.php');
require_once('pollpress_poll_factory.php');

class pollpress_controller_write extends pollpress_controller {
	var $factory = null;
	var $poll = null;
	var $post = null;
	
	function pollpress_controller_write() {
		$this->pollpress_controller('post.php', 'Write Poll', 'pollpress_view_write.php');
		$this->factory = new pollpress_poll_factory();
	}
	
	function get_poll() {
		return $this->poll;
	}
	
	function get_post() {
		return $this->post;
	}
	
	function dispatch() {
		// First, determine the poll, if it exists
		$poll_id = -1;
		if ( isset($_GET['id']) ) {
			$poll_id = (int)$_GET['id'];
		}
		if ( $poll_id != -1 ) {
			$this->poll = $this->factory->get_poll($poll_id);
		}
		
		// Check to see if they have permission to edit the posts
		if ( ($this->poll != null) && !current_user_can('edit_post', $this->poll->get_post_id()) )
			die ( __('You are not allowed to edit this poll.') );
		else if ( ($this->poll == null) && !current_user_can('edit_posts') )
			die ( __('You are not allowed to create new polls.') );
			
		// Second, get the corresponding post, if it exists
		if ( current_user_can('edit_posts') ) {
			if ( $this->poll == null ) {
				$this->post = get_default_post_to_edit();
			} else {
				$this->post = get_post_to_edit($this->poll->get_post_id());
			}
		}

		// Figure out if this was a form submission
		if ( isset($_POST['add_option']) ) {	
			// They're trying to add an option
			$this->verify_save_nonce($poll_id);
			$this->handle_add_option($poll_id);
		} else if ( isset($_POST['save']) ) {
			// Save & Continue
			$this->verify_save_nonce($poll_id);
			$this->handle_save_continue($poll_id);
		} else if ( isset($_POST['submit']) ) {
			// Save
			$this->verify_save_nonce($poll_id);
			$this->handle_save($poll_id);
		} else if ( isset($_POST['publish']) ) {
			// Publish
			$this->verify_save_nonce($poll_id);
			$this->handle_publish($poll_id);
		} else if ( isset($_POST['deletepost']) ) {
			// Delete
			check_admin_referer('delete-poll_' . $poll_id);	
			$this->handle_delete($poll_id);
		} else if ( isset($_POST['updatemeta']) ) {
			$this->verify_save_nonce($poll_id);
			$this->handle_update_meta($poll_id);
		} else if ( isset($_POST['deletemeta']) ) {
			$this->verify_save_nonce($poll_id);
			$this->handle_delete_meta($poll_id);
		} else if ( isset($_GET['op']) ) {
			// Some sort of non-form interaction
			$option_id = (int)$_GET['oid'];
			switch ( $_GET['op'] ) {
				case 'edit':
					check_admin_referer('update-poll-option_' . $option_id);
					$this->handle_option_edit( $option_id );
					break;
				case 'up':
					check_admin_referer('update-poll-option_' . $option_id);
					$this->handle_option_up( $option_id );
					break;
				case 'down':
					check_admin_referer('update-poll-option_' . $option_id);
					$this->handle_option_down( $option_id );
					break;
				case 'delete':
					check_admin_referer('delete-poll-option_' . $option_id);
					$this->handle_option_delete( $option_id );
					break;
			}
		}

		// If by now we don't have a poll, create one
		if ( $this->poll == null )
			$this->poll = $this->factory->create_poll();
	}
	
	function verify_save_nonce($poll_id) {
		if ( $poll_id == -1 )
			check_admin_referer('add-poll');
		else
			check_admin_referer('update-poll_' . $poll_id);		
	}
	
	function handle_add_option($poll_id) {
		//	First, ensure the poll has actually been saved.
		$_POST['save'] = 'save'; // needed so they think "Save & Continue" was hit
		$this->handle_primitive_save($poll_id);
		
		// Even if we didn't add an option, we did do a primitive_save, which
		//	saves the title at least, so we did update.
		$_GET['message'] = '1'; // display "Poll updated"
	}
	
	function handle_save_continue($poll_id) {
		$this->handle_primitive_save($poll_id);
		
		$_GET['message'] = '1'; // display "Poll updated"
	}

	function handle_save($poll_id) {
		$this->handle_primitive_save($poll_id);
		
		if ( $this->post->post_status == 'draft' ) {
			// If this was a draft, then create a new poll
			//	for them to work on
			$this->poll = null; // forces a new poll to be created
			$this->post = get_default_post_to_edit();
			
			$_GET['message'] = '1'; // display "Poll updated"
		} else {
			// If this was a published poll, take them back to poll management
			//wp_redirect(POLLPRESS_MANAGE);
			
			$this->poll = null; // forces a new poll to be created
			$this->post = get_default_post_to_edit();
		}
	}

	function handle_publish($poll_id) {
		$this->handle_primitive_save($poll_id);
		
		// Publish always creates a new poll for them to work on
		$this->poll = null; // forces a new poll to be created
		$this->post = get_default_post_to_edit();	
		
		$_GET['message'] = '4'; // display "Poll saved. View Site"
	}
	
	function handle_primitive_save($poll_id) {
		// Make sure people lower than editors can actually get the poll tags through
		//	so the poll results show up
		global $allowedposttags;

		$allowedposttags['poll'] = array ('id' => array ());

		// Create a new poll if necessary
		if ( $this->poll == null ) {		
			$this->poll = $this->factory->create_poll();
		}
		
		// Set the title for the poll and the post results
		$this->poll->set_title( stripslashes($_POST['post_title']) );
		$_POST['post_title'] = __('Poll Results: ') . $_POST['post_title'];
		
		// Actually save off the poll and post data
		if ( $poll_id == -1 ) {	
			// Ugh. Catch-22 here. Save the poll, so we can get a poll id,
			//	so we can save the corresponding post, so we can get
			//	the post id, so we can save it in the poll record.
			$this->poll = $this->poll->save(); 
			$poll_id = $this->poll->get_id();
			
			$_POST['content'] = '<poll id="' . $poll_id . '" />';

			$this->post = get_post_to_edit( write_post() );
			$this->poll->set_post_id( $this->post->ID );
		} else {
			$_POST['content'] = '<poll id="' . $poll_id . '" />';			
			
			$this->post = get_post_to_edit( edit_post() );
		}
		$this->poll = $this->poll->save(); // Have to save to get an id
		
		// If they're trying to save anything, check for something
		//	in the add options field and add that too.
		// Actually create and save the option
		if ( isset( $_POST['option_text']) ) {
			$option_text = trim( $_POST['option_text'] );
			if ( strlen($option_text) > 0 ) {
				$pp_option = $this->poll->create_option( $_POST['option_text'] );
				$pp_option = $pp_option->save();		
			}
		}
	}
	
	function handle_delete($poll_id) {
		$this->poll->destroy();
		$this->poll = null;
		$this->post = get_default_post_to_edit();
	}
	
	function handle_update_meta($poll_id) {
		$this->handle_primitive_save($poll_id);
		
		$_GET['message'] = '2'; // display "Custom updated"
	}
	
	function handle_delete_meta($poll_id) {
		$this->handle_primitive_save($poll_id);
		
		$_GET['message'] = '3'; // display "Custom Delete"
	}

	function handle_option_edit($option_id) {
		// Check for the save button, 'cause they also have a cancel button		
		if( isset( $_POST['save_option'] ) ) {
			$this_option = $this->poll->get_option($option_id);
			
			// Only change the text if its not blank
			$option_text = trim( $_POST['option_text'] );
			if ( strlen($option_text) > 0 )
				$this_option->set_text( $_POST['option_text'] );
				
			// Only change the number of votes if its a number,
			//	and a positive integer at that.
			if ( is_numeric($_POST['option_votes']) ) {
				$option_votes = (int)$_POST['option_votes'];
				if ( $option_votes >= 0 )
					$this_option->set_votes( $option_votes );
			}
			$this_option->save();
		}
	}
	
	function handle_option_up($option_id) {
		$this_option = $this->poll->get_option($option_id);
		
		// Check to see if we're at the top of the list
		if ( $this_option->get_order() == 0 )
			return; // nothing to do
			
		// Go grab the previous option
		$previous_order = $this_option->get_order() - 1;
		$options = $this->poll->get_options();
		$previous_option = $options[$previous_order];
		
		// Up just swaps with the previous option
		$previous_option->set_order( $this_option->get_order() );
		$this_option->set_order( $previous_order );
		
		// Save off the changes
		$previous_option->save();
		$this_option->save();
	}

	function handle_option_down($option_id) {
		$this_option = $this->poll->get_option($option_id);
		$options = $this->poll->get_options();

		// Check to see if we're at the bottom of the list
		if ( $this_option->get_order() == (count($options) - 1) )
			return; // nothing to do
			
		// Go grab the next option
		$next_order = $this_option->get_order() + 1;
		$next_option = $options[$next_order];
		
		// Down just swaps with the next option
		$next_option->set_order( $this_option->get_order() );
		$this_option->set_order( $next_order );
		
		// Save off the changes
		$next_option->save();
		$this_option->save();
	}

	function handle_option_delete($option_id) {
		$this_option = $this->poll->get_option($option_id);
		$this_option->destroy();
	}
	
	function get_users_poll_drafts($user_id) {
		$user_id = (int) $user_id;
		return $this->factory->get_draft_polls($user_id);		
	}
}

?>
