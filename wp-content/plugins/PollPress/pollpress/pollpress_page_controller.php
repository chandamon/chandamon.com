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

require_once('pollpress_controller_options.php');

class pollpress_page_controller {
	var $page_name = '';
	var $page_content = '';
	
	function pollpress_page_controller($page_name, $page_content) {
		$this->page_name = $page_name;
		$this->page_content = $page_content;
		
		if( function_exists('add_action') ) {
			add_action ('activate_' . POLLPRESS_NAME, array(&$this, 'install_page'));
			add_action ('deactivate_' . POLLPRESS_NAME, array(&$this, 'uninstall_page'));
		}
	}
	
	function install_page() {
		global $user_ID;
		
		// Create the page in the DB
		$page = array();
		$page['post_title'] = $this->page_name;
		$page['post_content'] = $this->page_content;
		$page['post_excerpt'] = '';
		$page['post_category'] = array();
		$page['post_status'] = 'static';
		$page['post_name'] = $this->page_name;
		$page['comment_status'] = 'closed';
		$page['ping_status'] = 'closed';
		$page['post_author'] = $user_ID;
		$page['post_date'] = current_time('mysql');
		$page['post_date_gmt'] = get_gmt_from_date($page['post_date']);
		$page['post_parent'] = 0;
		$page['to_ping'] = '';
		$page['user_ID'] = $user_ID;

		$page_ID = wp_insert_post($page);
		
		// We need to remember our page so we can delete it later
		$options_controller = new pollpress_controller_options();
		$options_controller->set_page($this->page_name, $page_ID);
	}
	
	function uninstall_page() {
		// Get the page_id of the page we inserted
		$options_controller = new pollpress_controller_options();
		$page_ID = $options_controller->get_page($this->page_name);

		// Actually delete the page
		wp_delete_post($page_ID);
		
		// Finally, forget the page
		$options_controller->remove_page($this->page_name);
	}
}

?>
