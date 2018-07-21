<?php
	
	$layout = get_option(SHORT_NAME . 'theme_layout');
	
	if ($layout == 'Layout - 2') {
		require_once(TEMPLATEPATH . '/layout/layout-v2.php');
	}
	
	else if ($layout == 'Layout - 3') {
		require_once(TEMPLATEPATH . '/layout/layout-v3.php');
	}

	else if ($layout == 'Layout - 4') {
		require_once(TEMPLATEPATH . '/layout/layout-v4.php');
	}
	
	else if ($layout == 'Layout - 5') {
		require_once(TEMPLATEPATH . '/layout/layout-v5.php');
	}
	
	else if ($layout == 'Layout - 6') {
		require_once(TEMPLATEPATH . '/layout/layout-v6.php');
	}
	
	else if ($layout == 'Layout - 7') {
		require_once(TEMPLATEPATH . '/layout/layout-v7.php');
	}
	
	else if ($layout == 'Layout - 8') {
		require_once(TEMPLATEPATH . '/layout/layout-v8.php');
	}
	
	else if ($layout == 'Layout - 9') {
		require_once(TEMPLATEPATH . '/layout/layout-v9.php');
	}
	
	else {
		require_once(TEMPLATEPATH . '/layout/layout-v1.php');
	}
	
?>