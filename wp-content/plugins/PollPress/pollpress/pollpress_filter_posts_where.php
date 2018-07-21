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
require_once('pollpress_poll_factory.php');

class pollpress_filter_posts_where extends pollpress_filter {
	var $search_regex = '/[\s+|\(]post_title\s+LIKE\s*\'([^\']*)\'[\s+|\)]/';
	var $factory = null;
	
	function pollpress_filter_posts_where() {
		$this->pollpress_filter('posts_where');
		$this->factory = new pollpress_poll_factory();
	}
	
	function process($data) {
		// If they're looking for a specific post, allow that. Just don't list
		$num_matches_one = preg_match('/\s+ID\s*=\s*\d+/', $data);
		$num_matches_two = preg_match('/[\s+|\(]post_name\s*=\s*\'[^\']*\'[\s+|\)]/', $data);
		if ( ($num_matches_one > 0) || ($num_matches_two > 0) )
			return $data;
		
		// Similarly, if they're looking in a specific category, allow it
		$num_matches = preg_match('/[\s+|\(]category_id\s*=\s*\'?\d+\'?[\s+|\)]/', $data);
		if ( $num_matches > 0 )
			return $data;
		
		// Allow searches to go through
		$matches = array();
		$num_matches = preg_match($this->search_regex, $data, $matches);
		if ( $num_matches > 0 )
			return $this->inject_options_search_sql($data, $matches);
		
		// They're trying to list, so exclude Polls
		$poll_table = new pollpress_table_poll();
				
		return $data . ' AND ' . $poll_table->get_exclude_polls_sql();
	}
	
	function inject_options_search_sql($data, $matches) {
		$subquery = $this->factory->get_posts_with_text_sql( $matches[1] );		
		$segments = preg_split($this->search_regex, $data, 2);
		
		$data = $segments[0] . $matches[0] . ' OR (ID IN (' . $subquery . ')) ' . $segments[1];
			
		return $data;
	}
}

?>
