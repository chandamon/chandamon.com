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
require_once('pollpress_controller_options.php');

class pollpress_filter_the_content extends pollpress_filter {
	var $factory = null;
	var $css_included = false;
	var $color = '#00F';
	var $options_controller = null;
	
	function pollpress_filter_the_content() {
		$this->pollpress_filter('the_content');
		$this->factory = new pollpress_poll_factory();
		$this->options_controller = new pollpress_controller_options();
	}
	
	function generate_report($matches) {
		$poll_id = $matches[1];
		$poll = $this->factory->get_poll($poll_id);
		$options = $poll->get_options();
				
		$report = '';
		// spit out the css file
		if ( !$css_included ) {
			$report .= '<link rel="stylesheet" type="text/css" href="' . POLLPRESS_CSS_URL . '" />';
			$css_included = true;
		}
		
		// Tally up the total votes
		$total_votes = 0;
		foreach ( $options as $option ) {
			$total_votes += $option->get_votes();
		}

		// Actually generate the code
		$report .= '<div class="pollpress-report">';
		foreach ( $options as $option ) {
			$percentage = 0;
			if ( $total_votes != 0 )
				$percentage = round( ($option->get_votes() * 100) / $total_votes );
			
			$report .= '<table class="pollpress-bar">';
			$report .= '<caption class="pollpress-bar-answer">' . $option->get_text() . '</caption>';
			$report .= '<tr>';
			$report .= '<td class="pollpress-bar-color" style="background-color: ' . $this->color . '; width: ' . $percentage . '%"></td>';
			$report .= '<td class="pollpress-bar-votes">' . $option->get_votes() . ' ' . __('votes') . '<span style="color: ' . $this->color . '"> / ' . $percentage . '%</span></td>';
			$report .= '</tr>';
			$report .= '</table>';			
		}
		$report .= '<p class="pollpress-bar-total-votes">' . $total_votes . ' ' . __('total votes.') . '</p>';
		$report .= '<br style="clear:both;" />';
		$report .= '</div>';
		
		return $report;
	}
	
	function process($data) {
		$this->color = $this->options_controller->get_bar_color();
		
		// <poll id="22" />
		$regex = '/<[p|P][o|O][l|L][l|L]\s+[i|I][d|D]\s*=\s*"(\d+)"\s+\/>/';
		$modified_data = preg_replace_callback($regex, array(&$this, 'generate_report'), $data);
		
		return $modified_data;
	}
}

?>
