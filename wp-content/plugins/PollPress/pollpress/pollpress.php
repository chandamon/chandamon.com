<?php
/*
Plugin Name: PollPress
Plugin URI: http://www.losingfight.com/blog/2006/09/11/pollpress-wordpress-plugin/
Description: Adds the ability to create, view, and vote on polls, similar to sites like slashdot.org.
Version: 1.0
Author: Andy Finnell
Author URI: http://www.losingfight.com/blog/
*/

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


define('POLLPRESS_PATH', ABSPATH . 	'wp-content/plugins/pollpress');
define('POLLPRESS_URL',	get_bloginfo('url') . 	'/wp-content/plugins/pollpress');
define('POLLPRESS_NAME', 'pollpress/pollpress.php');

define('POLLPRESS_WRITE', 'post.php?page=pollpress/pollpress_view_write.php');
define('POLLPRESS_EDIT_OPTION', 'post.php?page=pollpress/pollpress_view_edit_option.php');
define('POLLPRESS_MANAGE', 'edit.php?page=pollpress/pollpress_view_manage.php');
define('POLLPRESS_OPTIONS', 'options-general.php?page=pollpress/pollpress_view_options.php');

define('POLLPRESS_MANAGE_PAGE', 'pollpress/pollpress_view_manage.php');
define('POLLPRESS_CSS_URL', POLLPRESS_URL . '/pollpress.css');
define('POLLPRESS_VOTE_URL', POLLPRESS_URL . '/pollpress_vote.php');

require_once(POLLPRESS_PATH . '/pollpress_controller_write.php');
require_once(POLLPRESS_PATH . '/pollpress_controller_manage.php');
require_once(POLLPRESS_PATH . '/pollpress_controller_options.php');

require_once(POLLPRESS_PATH . '/pollpress_filter_posts_where.php');
require_once(POLLPRESS_PATH . '/pollpress_filter_users_drafts.php');
require_once(POLLPRESS_PATH . '/pollpress_filter_others_drafts.php');
require_once(POLLPRESS_PATH . '/pollpress_filter_the_content.php');
require_once(POLLPRESS_PATH . '/pollpress_filter_page_polls.php');

require_once(POLLPRESS_PATH . '/pollpress_page_controller_polls.php');

require_once(POLLPRESS_PATH . '/pollpress_voting_booth.php');

$pp_controller_write = new pollpress_controller_write();
$pp_controller_manage = new pollpress_controller_manage();
$pp_controller_options = new pollpress_controller_options();

$pp_page_controller_polls = new pollpress_page_controller_polls();

$pp_filter_posts_where = new pollpress_filter_posts_where();
$pp_filter_users_drafts = new pollpress_filter_users_drafts();
$pp_filter_others_drafts = new pollpress_filter_others_drafts();
$pp_filter_the_content = new pollpress_filter_the_content();
$pp_filter_page_polls = new pollpress_filter_page_polls();

?>
