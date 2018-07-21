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

class pollpress_poll_option {
	var $options_table;

	var $option_id = -1;
	var $poll = null;
	var $text = '';
	var $votes = 0;
	var $order = 0;
	
	function pollpress_poll_option($options_table, $poll, $raw_option = null) {
		$this->options_table = $options_table;
		$this->poll = $poll;
		if ( $raw_option != null ) {
			$this->option_id = $raw_option->option_id;
			$this->text = stripslashes($raw_option->option_text);
			$this->votes = $raw_option->option_votes;
			$this->order = $raw_option->option_order;
		}
	}
	
	function get_id() {
		return $this->option_id;
	}
	
	function get_order() {
		return $this->order;
	}
	
	function get_text() {
		return $this->text;
	}
	
	function get_votes() {
		return $this->votes;
	}
	
	function get_poll() {
		return $this->poll;
	}
	
	function set_text($text) {
		$this->text = $text;
	}
	
	function set_order($order) {
		$this->order = $order;
	}
	
	function set_id($option_id) {
		$this->option_id = $option_id;
	}
	
	function set_votes($votes) {
		$this->votes = $votes;
	}
	
	function save() {
		return $this->options_table->save_option($this);
	}
	
	function destroy() {
		return $this->options_table->destroy_option($this);
	}
}

?>
