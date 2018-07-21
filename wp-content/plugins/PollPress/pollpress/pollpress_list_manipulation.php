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

require_once('../../../wp-config.php');
require_once('../../../wp-admin/admin-functions.php');
require_once('../../../wp-admin/admin-db.php');
require_once('pollpress_poll_factory.php');

header("Content-type: text/plain", true);

if ( !is_user_logged_in() )
	die('-1');
if ( !check_ajax_referer() )
	die('-1');

$pp_poll_factory = new pollpress_poll_factory();

function grab_results() {
	global $ajax_results;
	$ajax_results = func_get_arg(0);
}

function get_out_now() { exit; }
add_action('shutdown', 'get_out_now', -1);

switch ( $_POST['op'] ) {
	case 'delete-poll':
		$id = (int)$_POST['id'];
		$pp_poll = $pp_poll_factory->get_poll( $id );
		
		if ( !current_user_can('edit_post', $pp_poll->get_post_id()) )	{
			die('-1');
		}
		
		$pp_poll->destroy();
		
		die('1');
		break;
		
	case 'delete-option':
		$id = (int)$_POST['id'];
		$option_id = (int)$_POST['oid'];
		
		$pp_poll = $pp_poll_factory->get_poll( $id );
		
		if ( !current_user_can('edit_post', $pp_poll->get_post_id()) )	{
			die('-1');
		}

		$pp_option = $pp_poll->get_option( $option_id );
		$pp_option->destroy();
		
		die('1');
		break;
}

?>
