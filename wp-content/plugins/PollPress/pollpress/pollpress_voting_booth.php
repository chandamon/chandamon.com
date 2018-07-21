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

require_once('pollpress_poll_factory.php');
require_once('pollpress_helpers_comment.php');
require_once('pollpress_controller_options.php');

function get_pollpress_voting_booth($poll_id, $include_header) {
	$page = '';
	
	$factory = new pollpress_poll_factory();
	$options_controller = new pollpress_controller_options();
	
	if ( $poll_id == 0 ) {
		$poll = $factory->get_current_poll();
	} else {
		$poll = $factory->get_poll($poll_id);
	}
	
	if ( $poll != null ) {
		$total_votes = 0;

		$page .= '<link rel="stylesheet" type="text/css" href="' . POLLPRESS_CSS_URL . '" />';
		$page .= '<div class="pollpress-voting-booth">';
		if ( $include_header )
			$page .= '<h2>' . __('Poll') . '</h2>';
		$page .= '<form action="' . POLLPRESS_VOTE_URL . '" method="post">';
		$page .= '<input type="hidden" name="_wpnonce" value="' . wp_create_nonce('poll-vote_' . $poll->get_id()) . '" />';
		$page .= '<p>' . $poll->get_title() . '</p>';
		$page .= '<input type="hidden" name="poll_id" value="' . $poll->get_id() . '" />';
		$page .= '<input type="hidden" name="redirect_to" value="' . get_permalink($poll->get_post_id()) . '" />';
		$page .= '<ul class="pollpress-options">';
	
		$options = $poll->get_options();
		foreach ( $options as $option ) {
			$total_votes = $total_votes + $option->get_votes();
			$page .= '<li>';
			$page .= '<input type="radio" name="poll_option" value="' . $option->get_id() . '">';
			$page .= $option->get_text();
			$page .= '</input>';
			$page .= '</li>';
		}
	
		$page .= '</ul>';
	
		$page .= '<p>';
		$page .= '<input type="submit" name="poll_submit" value="' . __('Vote') . '" />';
		$page .= ' [ <a href="' . get_permalink($poll->get_post_id()) . '">' . __('Results') . '</a>';
		$page .= ' | ';
		$page .= '<a href="' . get_permalink( $options_controller->get_page(__('Polls')) ) . '">' . __('Polls') . '</a> ]';
		$page .= '</p>';
	
		$page .= '<p>';
		$page .= __('Comments:') . get_poll_comments_number($poll) . ' | ' . __('Votes:') . $total_votes;
		$page .= '</p>';
		$page .= '</form>';
		$page .= '</div>';
	}
	
	return $page;
}

function pollpress_voting_booth($poll_id = 0) {
	echo get_pollpress_voting_booth($poll_id, true);
}

?>