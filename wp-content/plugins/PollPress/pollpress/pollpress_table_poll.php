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

class pollpress_table_poll extends pollpress_table {
	
	function pollpress_table_poll() {
		$this->pollpress_table("polls");
	}
		
	function create_sql() {		
		return "CREATE TABLE $this->table_name (
			id bigint(20) NOT NULL AUTO_INCREMENT, 
			title text NOT NULL, 
			post_id bigint(20) NOT NULL default '0',
			UNIQUE KEY id (id) );";
	}
	
	function get_poll($options_table, $poll_id) {
		$poll_id = (int)$poll_id;
		
		// The poll comes in blank. Fill in the data
		$raw_poll = $this->wpdb->get_row("SELECT 
			id AS poll_id, 
			title AS poll_title, 
			post_id AS poll_post_id
			FROM $this->table_name 
			WHERE id = $poll_id");
				
		return $this->convert_raw_poll($raw_poll, $options_table);
	}
	
	function get_all_polls($options_table) {
		$raw_polls = $this->wpdb->get_results("SELECT 
			id AS poll_id, 
			title AS poll_title, 
			post_id AS poll_post_id
			FROM $this->table_name 
			ORDER BY id DESC");
		
		return $this->convert_raw_polls($raw_polls, $options_table);
	}
	
	function get_all_polls_by_date($options_table) {
		$poll_table = $this->table_name;
		$post_table = $this->wpdb->posts;

		$raw_polls = $this->wpdb->get_results("SELECT 
			$poll_table.id AS poll_id, 
			$poll_table.title AS poll_title, 
			$poll_table.post_id AS poll_post_id
			FROM $poll_table, $post_table 
			WHERE $poll_table.post_id = $post_table.ID
			AND $post_table.post_status = 'publish'
			ORDER BY $post_table.post_date DESC");

		return $this->convert_raw_polls($raw_polls, $options_table);
	}

	function get_all_published_polls_by_date($options_table) {
		$poll_table = $this->table_name;
		$post_table = $this->wpdb->posts;
		$today = current_time('mysql');

		$raw_polls = $this->wpdb->get_results("SELECT 
			$poll_table.id AS poll_id, 
			$poll_table.title AS poll_title, 
			$poll_table.post_id AS poll_post_id
			FROM $poll_table, $post_table 
			WHERE $poll_table.post_id = $post_table.ID
			AND $post_table.post_status = 'publish'
			AND $post_table.post_date <= '$today'
			ORDER BY $post_table.post_date DESC");

		return $this->convert_raw_polls($raw_polls, $options_table);
	}

	function get_polls_with_text($options_table, $text) {
		$subquery = $options_table->get_options_with_text_sql('%' . $text . '%');
		$poll_table = $this->table_name;
		$post_table = $this->wpdb->posts;
		$search_text = $this->wpdb->escape($text);

		$raw_polls = $this->wpdb->get_results("SELECT 
			$poll_table.id AS poll_id, 
			$poll_table.title AS poll_title, 
			$poll_table.post_id AS poll_post_id
			FROM $poll_table, $post_table
			WHERE ($poll_table.title LIKE '%$search_text%' 
			OR $poll_table.id IN ($subquery))
			AND $poll_table.post_id = $post_table.ID
			AND $post_table.post_status = 'publish'
			ORDER BY $post_table.post_date DESC");

		return $this->convert_raw_polls($raw_polls, $options_table);
	}

	function get_posts_with_text_sql($options_table, $text) {
		$subquery = $options_table->get_options_with_text_sql($text);

		return "SELECT post_id
			FROM $this->table_name
			WHERE id IN ($subquery)";
	}
	
	function get_polls_in_month($options_table, $year, $month) {
		$poll_table = $this->table_name;
		$post_table = $this->wpdb->posts;
		
		$raw_polls = $this->wpdb->get_results("SELECT 
			$poll_table.id AS poll_id, 
			$poll_table.title AS poll_title, 
			$poll_table.post_id AS poll_post_id
			FROM $poll_table, $post_table
			WHERE YEAR($post_table.post_date) = $year
			AND MONTH($post_table.post_date) = $month
			AND $poll_table.post_id = $post_table.ID
			AND $post_table.post_status = 'publish'
			ORDER BY $post_table.post_date DESC");
		
		return $this->convert_raw_polls($raw_polls, $options_table);
	}

	function get_current_poll($options_table) {
		$poll_table = $this->table_name;
		$post_table = $this->wpdb->posts;
		$today = current_time('mysql');

		$raw_poll = $this->wpdb->get_row("SELECT 
			$poll_table.id AS poll_id, 
			$poll_table.title AS poll_title, 
			$poll_table.post_id AS poll_post_id
			FROM $poll_table, $post_table 
			WHERE $poll_table.post_id = $post_table.ID
			AND $post_table.post_status = 'publish'
			AND $post_table.post_date <= '$today'
			ORDER BY $post_table.post_date DESC");

		if ( $raw_poll == null ) {
			return $raw_poll;
		}
		
		return $this->convert_raw_poll($raw_poll, $options_table);
	}
	
	
	function get_draft_polls($options_table, $user_id) {
		$poll_table = $this->table_name;
		$post_table = $this->wpdb->posts;
		$user_id = (int)$user_id;
		
		$raw_polls = $this->wpdb->get_results("SELECT 
			$poll_table.id AS poll_id, 
			$poll_table.title AS poll_title, 
			$poll_table.post_id AS poll_post_id
			FROM $poll_table
			WHERE $poll_table.post_id IN 
				(SELECT $post_table.ID 
					FROM $post_table
					WHERE $post_table.post_status = 'draft' 
					AND $post_table.post_author = $user_id)
			ORDER BY $poll_table.id DESC");
		
		return $this->convert_raw_polls($raw_polls, $options_table);
	}
	
	function get_others_draft_polls($options_table, $user_id) {
		$poll_table = $this->table_name;
		$post_table = $this->wpdb->posts;
		
		$user_id = (int)$user_id;
		$user = get_userdata( $user_id );
		$level_key = $this->wpdb->prefix . 'user_level';
		$editable = get_editable_user_ids( $user_id );
		$raw_polls = array();
		
		if( $editable ) {
			$editable = join(',', $editable);
			$raw_polls = $this->wpdb->get_results("SELECT 
				$poll_table.id AS poll_id, 
				$poll_table.title AS poll_title, 
				$poll_table.post_id AS poll_post_id
				FROM $poll_table
				WHERE $poll_table.post_id IN 
					(SELECT $post_table.ID 
						FROM $post_table
						WHERE $post_table.post_status = 'draft' 
						AND $post_table.post_author IN ($editable)
						AND $post_table.post_author != '$user_id')
				ORDER BY $poll_table.id DESC");
		}

		return $this->convert_raw_polls($raw_polls, $options_table);
	}
	
	function get_poll_count() {
		return $this->wpdb->get_var("SELECT 
			COUNT(DISTINCT id) 
			FROM $this->table_name");
	}
	
	function get_post($post_id) {
		$post_id = (int)$post_id;
		$post_table = $this->wpdb->posts;
		return $this->wpdb->get_row("SELECT
			ID, post_author, post_date, post_category, comment_count
			FROM $post_table
			WHERE ID = $post_id");
	}
	
	function convert_raw_poll($raw_poll, $options_table) {
		$poll = new pollpress_poll($this, $options_table);
		$poll->set_id($raw_poll->poll_id);
		$poll->set_title( stripslashes($raw_poll->poll_title) );
		$poll->set_post_id($raw_poll->poll_post_id);

		return $poll;
	}
	
	function convert_raw_polls($raw_polls, $options_table) {
		$polls = array();
		if ( count($raw_polls) ) {
			foreach ( $raw_polls as $raw_poll ) :
				$poll = $this->convert_raw_poll($raw_poll, $options_table);
				array_push($polls, $poll);
			endforeach;
		}
		return $polls;
	}
	
	function save_poll($poll) {
		if ( $poll->get_id() == -1 ) {
			// Never been saved. Insert
			$meta_text = $this->wpdb->escape( $poll->get_title() );
			$meta_post_id = (int)$poll->get_post_id();
			
			$this->wpdb->query("INSERT INTO {$this->table_name} VALUES (null, '$meta_text', $meta_post_id)");
			
			$poll->set_id($this->wpdb->insert_id);
		} else {
			// Just update
			$meta_text = $this->wpdb->escape( $poll->get_title() );
			$meta_id = (int)$poll->get_id();
			$meta_post_id = (int)$poll->get_post_id();

			$this->wpdb->query("UPDATE {$this->table_name} SET title = '$meta_text', post_id = $meta_post_id WHERE id = $meta_id");

		}
		
		return $poll; // return since it might have changed
	}
	
	function destroy_poll($poll) {
		$meta_id = (int)$poll->get_id();
		
		$this->wpdb->query("DELETE FROM {$this->table_name} WHERE id = $meta_id");
	}

	function get_months_for_polls() {
		$table_name = $this->wpdb->posts;
		return $this->wpdb->get_results("SELECT 
			DISTINCT YEAR(post_date) AS yyear, 
			MONTH(post_date) AS mmonth 
			FROM $table_name 
			WHERE post_date != '0000-00-00 00:00:00' 
			AND id IN (SELECT id FROM $this->table_name)
			ORDER BY post_date DESC");
	}
	
	function get_exclude_polls_sql() {
		$poll_table = $this->table_name;

		return "ID NOT IN (SELECT $poll_table.post_id FROM $poll_table)";
	}
	
	function get_post_ids_of_polls() {
		return $this->wpdb->get_col("SELECT post_id FROM $this->table_name");
	}
}

?>
