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
require_once('pollpress_poll_factory.php');

class pollpress_filter_page_polls extends pollpress_filter {
	var $factory = null;
	var $current_page = 0;
	var $polls_per_page = 15;
	
	function pollpress_filter_page_polls() {
		$this->pollpress_filter('the_content');
		$this->factory = new pollpress_poll_factory();
	}
	
	function generate_page($matches) {
		$page = '';
		
		// Strip down to the base URL
		$base_url = $_SERVER['REQUEST_URI'];
		$base_url = preg_replace('/[\?|\&]offset=\d+/', '', $base_url);
		$base_url = preg_replace('/[\?|\&]op=edit/', '', $base_url);
		$base_url = preg_replace('/[\?|\&]id=\d+/', '', $base_url);
		$append_option = '?';
		if ( strstr($base_url, '?') )
			$append_option = '&';

		if ( isset( $_GET['id'] ) && isset( $_GET['op'] ) && $_GET['op'] == 'edit') {
			$id = (int) $_GET['id'];
			$page = $this->generate_voting_booth($base_url, $append_option, $id);
		} else {
			$page = $this->generate_poll_list($base_url, $append_option);
		}
		
		return $page;
	}
	
	function generate_voting_booth($base_url, $append_option, $poll_id) {
		$page = get_pollpress_voting_booth($poll_id, false);

		return $page;
	}
	
	function generate_poll_list($base_url, $append_option) {
		$page = '';

		// Figure out what page we're on
		$polls = $this->factory->get_all_published_polls_by_date();
		$poll_count = count($polls);
		if ( isset( $_GET['offset'] ) ) {
			$this->current_page = (int)$_GET['offset'];
		}
		$poll_start_index = $this->current_page * $this->polls_per_page;
		$poll_stop_index = $poll_start_index + $this->polls_per_page;
		if ( $poll_stop_index > $poll_count )
			$poll_stop_index = $poll_count;
			
		// Now that we know the indices, strip down the array
		$polls = array_slice($polls, $poll_start_index, $poll_stop_index - $poll_start_index);
		
			
		// Iterate all the polls and output them
		if ( $poll_count ) {
			$page .= '<link rel="stylesheet" type="text/css" href="' . POLLPRESS_CSS_URL . '" />';

			$page .= '<ul class="pollpress-poll-list">';
			foreach ( $polls as $poll ) {
				// Tally the total number of votes for this poll
				$total_votes = 0;
				$options = $poll->get_options();
				foreach ( $options as $option ) {
					$total_votes = $total_votes + $option->get_votes();
				}
				
				$post = $poll->get_post();
				
				// Generate the info this poll
				$page .= '<li>';
				$page .= '<h4><a href="' . $base_url . $append_option . 'op=edit&id=' . $poll->get_id() . '">' . $poll->get_title() . '</a></h4>';
				$page .= '<p>' . __('On ') . mysql2date('l F d\, \@g:i:sa', $post->post_date) . '</p>';
				$page .= '<p>' . __('Votes: ') . $total_votes . '</p>';
				$page .= '</li>';
			}
			$page .= '</ul>';
		}
		
		
		// Navigation controls
		$page .= '<p class="pollpress-poll-navigation">';
		if ( $poll_stop_index < $poll_count ) {
			$next_page = $this->current_page + 1;
			$page .= '<a href="' . $base_url . $append_option . 'offset=' . $next_page . '">' . __('&laquo; Last 15 matches') . '</a>';
		}
		if ( ($poll_stop_index < $poll_count) && ($this->current_page > 0) ) {
			$page .= ' | ';
		}
		if ( $this->current_page > 0 ) {
			$next_page = $this->current_page - 1;
			$page .= '<a href="' . $base_url . $append_option . 'offset=' . $next_page . '">' . __('Next 15 matches &raquo;') . '</a>';
		}
		$page .= '</p>';

		return $page;
	}
	
	function process($data) {
		// <poll-list />
		$regex = '/<[p|P][o|O][l|L][l|L]-[l|L][i|I][s|S][t|T]\s+\/>/';
		$modified_data = preg_replace_callback($regex, array(&$this, 'generate_page'), $data);

		return $modified_data;
	}
}

?>
