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

require_once('pollpress_poll_option.php');

class pollpress_poll {
	var $polls_table;
	var $options_table;
	
	var $title = '';
	var $poll_id = -1;
	var $post_id = 0;
	
	function pollpress_poll($polls_table, $options_table) {
		$this->polls_table = $polls_table;
		$this->options_table = $options_table;
	}
	
	
	function get_title() {
		return $this->title;
	}
	
	function get_options() {
		$options = array();
		$raw_options = $this->options_table->get_options($this->poll_id);
		if ( count( $raw_options ) ) {
			foreach ( $raw_options as $option ) :
				array_push($options, new pollpress_poll_option($this->options_table, $this, $option) );
			endforeach;
		}
		
		
		return $options;
	}
	
	function get_option($option_id) {
		$raw_option = $this->options_table->get_option($option_id);
		
		return new pollpress_poll_option($this->options_table, $this, $raw_option);
	}
		
	function get_id() {
		return $this->poll_id;
	}
	
	function get_post_id() {
		return $this->post_id;
	}
	
	function get_post() {
		return $this->polls_table->get_post($this->post_id);
	}
	
	function set_title($title) {
		$this->title = $title;
	}

	function set_id($poll_id) {
		$this->poll_id = $poll_id;
	}
		
	function set_post_id($post_id) {
		$this->post_id = $post_id;
	}
	
	function create_option($title) {
		// Create a new option and set the text
		$new_option = new pollpress_poll_option($this->options_table, $this);
		$new_option->set_text($title);
		
		// We need to determine the order it should be at, so hit
		//	the db, and figure out what the next one is
		$options = $this->get_options();
		$order = 0;
		foreach ( $options as $option ) :
			if ( $option->get_order() >= $order ) {
				$order = $option->get_order() + 1;
			}
		endforeach;
		$new_option->set_order($order);
		
		// Return the new option
		return $new_option;
	}
	
	function save() {
		return $this->polls_table->save_poll($this);
	}
	
	function destroy() {
		wp_delete_post($this->post_id);
		$this->polls_table->destroy_poll($this);
		$this->options_table->destroy_poll($this);
	}
}
?>
