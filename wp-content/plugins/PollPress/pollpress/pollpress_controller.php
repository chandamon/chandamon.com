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

class pollpress_controller {
	var $parent_menu;
	var $menu_name;
	var $view_name;
	
	function pollpress_controller($parent_menu, $menu_name, $view_name) {
		$this->parent_menu = $parent_menu;
		$this->menu_name = $menu_name;
		$this->view_name = $view_name;
		
		if( function_exists('add_action') )
			add_action ('admin_menu', array(&$this, 'add_pages'));
	}
	
	function add_pages() {
		add_submenu_page($this->parent_menu, __($this->menu_name), __($this->menu_name), 1, POLLPRESS_PATH . '/' . $this->view_name);		
	}
	
}

?>
