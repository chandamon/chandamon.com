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

class pollpress_filter_others_drafts extends pollpress_filter {
	var $post_ids_of_polls = null;
	
	function pollpress_filter_others_drafts() {
		$this->pollpress_filter('get_others_drafts');
	}
	
	function is_post_not_a_poll($post) {
		$found = array_search($post->ID, $this->post_ids_of_polls);
		
		if ( ($found === null) || ($found === false) )
			return true;
			
		return false;
	}
	
	function process($data) {
		if ( $data == null )
			return $data;
			
		// $data is unfortunately the results of the sql query (as opposed to the sql query itself)
		//	So run our own sql query, then manually hack up the resulting array (ugh).
		$poll_table = new pollpress_table_poll();
		$this->post_ids_of_polls = $poll_table->get_post_ids_of_polls();
				
		// This is an inefficient n*m algorithm. If I could only touch the SQL...
		$modified_data = array_filter($data, array(&$this, "is_post_not_a_poll"));
		
		return $modified_data;
	}
	
}

?>
