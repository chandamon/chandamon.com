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

include_once('pollpress_table.php');

class pollpress_table_option extends pollpress_table {
	
	function pollpress_table_option() {
		$this->pollpress_table('options');
	}
			
	function create_sql() {
		return "CREATE TABLE $this->table_name (
			id bigint(20) NOT NULL AUTO_INCREMENT, 
			poll_id bigint(20) NOT NULL, 
			text text NOT NULL, 
			votes bigint(20) NOT NULL, 
			option_order int(7) NOT NULL, 
			UNIQUE KEY id (id) );";
	}
	
	function get_options_with_text_sql($text) {
		$search_text = $this->wpdb->escape($text);
		return "SELECT $this->table_name.poll_id 
			FROM $this->table_name 
			WHERE $this->table_name.text LIKE '$search_text'";
	}
	
	function get_options($poll_id) {
		$poll_id = (int)$poll_id;
		return $this->wpdb->get_results("SELECT 
			id AS option_id, 
			poll_id AS poll_id, 
			text AS option_text, 
			votes AS option_votes, 
			option_order AS option_order 
			FROM $this->table_name 
			WHERE poll_id = $poll_id 
			ORDER BY option_order");
	}
	
	function get_option($option_id) {
		$option_id = (int)$option_id;
		
		return $this->wpdb->get_row("SELECT 
			id AS option_id, 
			poll_id AS poll_id, 
			text AS option_text, 
			votes AS option_votes, 
			option_order AS option_order 
			FROM $this->table_name 
			WHERE id = $option_id");	
	}
	
	function save_option($option) {
		if ( $option->get_id() == -1 ) {
			// New, so insert
			$poll = $option->get_poll();
			$meta_text = $this->wpdb->escape( $option->get_text() );
			$meta_poll_id = (int)$poll->get_id();
			$meta_votes = (int)$option->get_votes();
			$meta_order = (int)$option->get_order();
						
			$this->wpdb->query("INSERT INTO {$this->table_name} VALUES (null, $meta_poll_id, '$meta_text', $meta_votes, $meta_order)");
			
			$option->set_id($this->wpdb->insert_id);
		} else {
			// Existing, so update
			$meta_text = $this->wpdb->escape( $option->get_text() );
			$meta_id = (int)$option->get_id();
			$meta_votes = (int)$option->get_votes();
			$meta_order = (int)$option->get_order();

			$this->wpdb->query("UPDATE {$this->table_name} SET text = '$meta_text', votes = $meta_votes, option_order = $meta_order WHERE id = $meta_id");
		}
		
		return $option; // return since it might have changed
	}
	
	function destroy_option($option) {
		$meta_id = (int)$option->get_id();
		
		$this->wpdb->query("DELETE FROM {$this->table_name} WHERE id = $meta_id");
	}
	
	function destroy_poll($poll) {
		$meta_id = (int)$poll->get_id();
		
		$this->wpdb->query("DELETE FROM {$this->table_name} WHERE poll_id = $meta_id");
	}
	
	function vote($option_id) {
		$option_id = (int)$option_id;
		$votes = $this->wpdb->get_var("SELECT votes FROM $this->table_name WHERE id = $option_id");
		$votes = $votes + 1;
		
		$this->wpdb->query("UPDATE $this->table_name SET votes = $votes WHERE id = $option_id");
	}
}

?>
