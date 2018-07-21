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

class pollpress_table {
	var $wpdb;
	var $table_prefix;
	var $table_name;
	
	function pollpress_table($table_name) {
		global $table_prefix, $wpdb;
		
		$this->wpdb = $wpdb;
		$this->table_prefix = $table_prefix . "pollpress_";
		$this->table_name = $this->table_prefix . $table_name;	
		
		if( function_exists('add_action') )
			add_action ('activate_' . POLLPRESS_NAME, array(&$this, 'make_table'));
	}
		
	function make_table() {		
		if ( $this->wpdb->get_var("SHOW TABLES LIKE '$this->table_name'") != $this->table_name) {
			$this->create_self();
		}
	}
	
	function create_self() {
		$create_table = $this->create_sql();
		
		require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
		dbDelta($create_table);
	}
	
	function create_sql() {
		return '';
	}
	
	function get_name() {
		return $this->table_name;
	}
}

?>