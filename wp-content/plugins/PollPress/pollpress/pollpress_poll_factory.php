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

include_once('pollpress_table_poll.php');
include_once('pollpress_table_option.php');
include_once('pollpress_poll.php');

class pollpress_poll_factory {
	var $polls_table;
	var $options_table;
	
	function pollpress_poll_factory() {
		$this->polls_table = new pollpress_table_poll();
		$this->options_table = new pollpress_table_option();
	}
	
	function create_poll() {
		return new pollpress_poll($this->polls_table, $this->options_table);
	}
	
	function get_poll($poll_id) {
		return $this->polls_table->get_poll($this->options_table, $poll_id);
	}
	
	function get_all_polls() {
		return $this->polls_table->get_all_polls($this->options_table);
	}
	
	function get_all_polls_by_date() {
		return $this->polls_table->get_all_polls_by_date($this->options_table);
	}

	function get_all_published_polls_by_date() {
		return $this->polls_table->get_all_published_polls_by_date($this->options_table);
	}
	
	function get_polls_with_text($text) {
		return $this->polls_table->get_polls_with_text($this->options_table, $text);
	}
	
	function get_polls_in_month($year, $month) {
		return $this->polls_table->get_polls_in_month($this->options_table, $year, $month);
	}
	
	function get_poll_count() {
		return $this->polls_table->get_poll_count();
	}
	
	function get_draft_polls($user_id) {
		return $this->polls_table->get_draft_polls($this->options_table, $user_id);
	}
	
	function get_others_draft_polls($user_id) {
		return $this->polls_table->get_others_draft_polls($this->options_table, $user_id);
	}

	function get_months_for_polls() {
		return $this->polls_table->get_months_for_polls();
	}
	
	function get_current_poll() {
		return $this->polls_table->get_current_poll($this->options_table);
	}
	
	function get_posts_with_text_sql($text) {
		return $this->polls_table->get_posts_with_text_sql($this->options_table, $text);
	}
}

?>
