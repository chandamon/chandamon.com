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

function pp_deleteSomething( what, poll_id, option_id, message ) {
	if ( confirm(message) ) {
		return pp_ajaxDelete( what, poll_id, option_id );
	}
	
	return false;
}

function pp_ajaxDelete( what, poll_id, option_id ) {
	ajaxDel = new sack('../wp-content/plugins/PollPress/pollpress_list_manipulation.php');

	if ( ajaxDel.failed ) {
		return true;
	}
	
	ajaxDel.myResponseElement = getResponseElement();
	ajaxDel.method = 'POST';
	ajaxDel.onLoading = function() { ajaxDel.myResponseElement.innerHTML = 'Sending Data...'; };
	ajaxDel.onLoaded = function() { ajaxDel.myResponseElement.innerHTML = 'Data Sent...'; };
	ajaxDel.onInteractive = function() { ajaxDel.myResponseElement.innerHTML = 'Processing Data...'; };

	if ( option_id != -1 ) {
		ajaxDel.onCompletion = function() { pp_removeThisItem( what + '-' + option_id); };
		ajaxDel.runAJAX('id=' + poll_id + '&op=delete-' + what + '&oid=' + option_id + '&' + ajaxDel.encVar('cookie', document.cookie));
	} else {
		ajaxDel.onCompletion = function() { removeThisItem( what + '-' + poll_id); };
		ajaxDel.runAJAX('id=' + poll_id + '&op=delete-' + what + '&' + ajaxDel.encVar('cookie', document.cookie));
	}
	
	return false;
}

function pp_removeThisItem(item_name) {
	removeThisItem(item_name);
	
	var f = document.getElementById('pollpreview');
	if ( f ) f.contentWindow.location.reload(true);
}