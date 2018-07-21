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

require_once('pollpress_controller.php');
require_once('pollpress_poll_factory.php');

class pollpress_controller_manage extends pollpress_controller {
	var $factory = null;
	var $polls = array();
	var $poll = null; // for the comment page
	var $polls_per_page = 15;
	var $poll_count = 0;
	var $current_page = 0;
	var $poll_start_index = 0;
	var $poll_stop_index = 0;
	
	function pollpress_controller_manage() {
		$this->pollpress_controller('edit.php', 'Polls', 'pollpress_view_manage.php');
	}
	
	function dispatch() {
		// For now, just get all the polls. Later we should filter them
		$this->factory = new pollpress_poll_factory();
		
		// See if this is an operation or not
		if ( isset( $_GET['op'] ) && isset( $_GET['id'] ) ) {
			$id = (int) $_GET['id'];
			$poll = $this->factory->get_poll( $option_id );
			switch ( $_GET['op'] ) {
				case 'delete':
					check_admin_referer('delete-poll_' . $poll->get_id());
					if ( current_user_can('edit_post', $poll->get_post_id() ) )
						$poll->destroy();
					break;
			}
		}

		// Get the all appropriate polls for this page
		if ( isset( $_GET['s'] ) ) {
			$this->polls = $this->factory->get_polls_with_text( $_GET['s'] );
		} else if ( isset( $_GET['m'] ) ) {
			$year = (int)substr($_GET['m'], 0, 4);
			$month = (int)substr($_GET['m'], 4, 2);
			$this->polls = $this->factory->get_polls_in_month($year, $month);
		} else if ( isset( $_GET['id'] ) && isset( $_GET['c'] ) ) {
			$id = (int) $_GET['id'];
			$this->poll = $this->factory->get_poll($id);
			array_push($this->polls, $this->poll);
		} else {
			$this->polls = $this->factory->get_all_polls_by_date();
		}
		
		// Figure out what page we're on
		$this->poll_count = count($this->polls);
		if ( isset( $_GET['p'] ) ) {
			$this->current_page = (int)$_GET['p'];
		}
		$this->poll_start_index = $this->current_page * $this->polls_per_page;
		$this->poll_stop_index = $this->poll_start_index + $this->polls_per_page;
		if ( $this->poll_stop_index > $this->poll_count )
			$this->poll_stop_index = $this->poll_count;
			
		// Now that we know the indices, strip down the array
		$this->polls = array_slice($this->polls, $this->poll_start_index, $this->poll_stop_index - $this->poll_start_index);
	}
	
	function get_polls() {
		return $this->polls;
	}
	
	function get_months_for_polls() {
		return $this->factory->get_months_for_polls();
	}
	
	function next_polls_link($text) {
		if ( $this->poll_stop_index < $this->poll_count ) {
			$next_page = $this->current_page + 1;
			echo '<a href="' . POLLPRESS_MANAGE . '&p=' . $next_page;
			if ( isset( $_GET['s'] ) ) {
				echo '&s=' . $_GET['s'];
			} else if ( isset( $_GET['m'] ) ) {
				echo '&m=' . $_GET['m'];
			}
			echo '">' . $text . '</a>';
		}
	}
	
	function previous_polls_link($text) {
		if ( $this->current_page > 0 ) {
			$next_page = $this->current_page - 1;

			echo '<a href="' . POLLPRESS_MANAGE . '&p=' . $next_page;
			if ( isset( $_GET['s'] ) ) {
				echo '&s=' . $_GET['s'];
			} else if ( isset( $_GET['m'] ) ) {
				echo '&m=' . $_GET['m'];
			}
			echo '">' . $text . '</a>';
		}
	}
	
	function page_title() {
		if ( isset( $_GET['m'] ) ) {
			global $month;

			$my_year = substr($_GET['m'], 0, 4);
			$my_month = $month[substr($_GET['m'], 4, 2)];

			echo ' ' . $my_month . ' ' . $my_year;
		} elseif ( isset( $_GET['s'] ) ) {
			printf(__('Search Polls for &#8220;%s&#8221;'), wp_specialchars($_GET['s']) );
		} else {
			if ( isset( $_GET['c'] ) )
				printf(__('Comments on %s'), $this->poll->get_title());
			elseif ( ! isset( $_GET['p'] ) || $_GET['p'] == 0 )
				_e('Last 15 Polls');
			else
				_e('Previous Polls');
		}
	}
	
	function drafts($drafts) {
		$i = 0;
		foreach ($drafts as $draft) {
			if (0 != $i)
				echo ', ';
			$poll_title = stripslashes($draft->get_title());
			if ($poll_title == '')
				$poll_title = sprintf(__('Poll #%s'), $draft->get_id());
			echo "<a href='" . POLLPRESS_WRITE . "&id=" . $draft->get_id() . "' title='" . __('Edit this draft') . "'>" . $poll_title . "</a>";
			++$i;
		}	
	}
	
	function get_users_poll_drafts($user_id) {
		$user_id = (int) $user_id;
		return $this->factory->get_draft_polls($user_id);		
	}

	function get_others_poll_drafts($user_id) {
		$user_id = (int) $user_id;
		return $this->factory->get_others_draft_polls($user_id);		
	}
	
}

?>
