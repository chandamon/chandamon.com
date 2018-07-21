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

require_once('pollpress_filter.php');
require_once('pollpress_table_poll.php');

class pollpress_filter_users_drafts extends pollpress_filter {

	function pollpress_filter_users_drafts() {
		$this->pollpress_filter('get_users_drafts');
	}
	
	function process($data) {
		// Get the SQL we want to inject into $data, which is a query string
		$poll_table = new pollpress_table_poll();
		$sql_to_inject = $poll_table->get_exclude_polls_sql();
		
		// Splice out the SQL sequence so we can insert right after
		//	the WHERE keyword.
		$where_and_after = stristr($data, "WHERE");
		$and_after = substr($where_and_after, 5); // truncate off WHERE
		$where_and_before = substr($data, 0, strlen($data) - strlen($and_after));
		
		// Inject our sql
		$modified_query = $where_and_before . ' ' . $sql_to_inject . ' AND ' . $and_after;
		
		
		return $modified_query;
	}
}

?>
