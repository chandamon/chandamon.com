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

class pollpress_controller_options extends pollpress_controller {
	var $option_key = 'pollpress_options';
	var $bar_color_key = 'bar_color';
	var $pages_key = 'pages';
	
	function pollpress_controller_options() {
		$this->pollpress_controller('options-general.php', 'PollPress', 'pollpress_view_options.php');
		
		add_option($this->option_key, $this->get_default_options());
	}
	
	function dispatch() {
		if ( isset($_POST['Submit']) ) {
			check_admin_referer('pollpress-update-options');
			
			$options = get_option($this->option_key);
			
			$options[$this->bar_color_key] = $_POST['bar_color'];
			
			update_option($this->option_key, $options);
			
			$_GET['message'] = 2;
		} else if ( isset($_POST['delete_all']) && current_user_can('edit_posts') ) {
			check_admin_referer('pollpress-update-options');

			// Delete them all
			$factory = new pollpress_poll_factory();
			$polls = $factory->get_all_polls();
			if ( $polls ) {
				foreach ( $polls as $poll )
					$poll->destroy();
			}
			
			$_GET['message'] = 1;
		}
	}
	
	function get_bar_color() {
		$options = get_option($this->option_key);
				
		return $options[$this->bar_color_key];
	}
	
	function get_default_options() {
		$defaults = array();
		
		$defaults[$this->bar_color_key] = '#0000FF';
		$defaults[$this->pages_key] = array();

		return $defaults;
	}
	
	function set_page($page_name, $page_id) {
		$options = get_option($this->option_key);
		$pages = $options[$this->pages_key];
		
		$pages[$page_name] = $page_id;
		
		$options[$this->pages_key] = $pages;
		update_option($this->option_key, $options);
	}
	
	function get_page($page_name) {
		$options = get_option($this->option_key);
		$pages = $options[$this->pages_key];
		
		return $pages[$page_name];
	}
	
	function remove_page($page_name) {
		$options = get_option($this->option_key);
		$pages = $options[$this->pages_key];
		
		unset($pages[$page_name]);
		
		$options[$this->pages_key] = $pages;
		update_option($this->option_key, $options);
	}
}

?>
