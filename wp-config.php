<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** Enable W3 Total Cache Edge Mode */
define('W3TC_EDGE_MODE', true); // Added by W3 Total Cache



// ** MySQL settings ** //
define('DB_NAME', 'chandamo_chandamon2009');    // The name of the database
define('DB_USER', 'chandamon');     // Your MySQL username
define('DB_PASSWORD', 'smccxb'); // ...and password
define('DB_HOST', 'localhost:/tmp/mysql5.sock');    // 99% chance you won't need to change this value
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');


// You can have multiple installations in one database if you give each a unique prefix
$table_prefix  = 'wp_';   // Only numbers, letters, and underscores please!

// Change this to localize WordPress.  A corresponding MO file for the
// chosen language must be installed to wp-includes/languages.
// For example, install de.mo to wp-includes/languages and set WPLANG to 'de'
// to enable German language support.
define ('WPLANG', '');

/* That's all, stop editing! Happy blogging. */

define('ABSPATH', dirname(__FILE__).'/');

require_once(ABSPATH.'wp-settings.php');
//mysql_query("SET NAMES 'utf8'") or die('SET NAMES failed');
?>