<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/** Enable W3 Total Cache */


define('CONCATENATE_SCRIPTS', false);
define('DISALLOW_FILE_EDIT', true);
define('WP_AUTO_UPDATE_CORE', 'minor');// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp' );

/** MySQL database username */
define( 'DB_USER', 'wp_v2yad' );

/** MySQL database password */
define( 'DB_PASSWORD', 'xo*3BOzfM73H%wb2' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', '9pR::nE%!d6E!25;G-9n@0[hEtP)K9o%73VpXeu+|oC-bmb;JZ49t/A12098G0_3');
define('SECURE_AUTH_KEY', '5|_+#0E|WYD)@0wo(4H1m0C6PSPU3N744Iy%4E5:j6&tI66W367Lcxxvi@YOkFz7');
define('LOGGED_IN_KEY', 'cW&_k5PqB288S62N_08)ivXFsP;V15ctYp!8j8527@613om/%qPX2QSk(1NO6AIA');
define('NONCE_KEY', '![4j;3q0iQGV6hYln(YF;J35ZYH(X/2Y8|+6e3oYw&14)4&QB2di-2C]EbcU7*6h');
define('AUTH_SALT', 'p(794ayz:YXO@&l/P3wR89W5_XRur1nF/KlGlPDL2BczRYc3z]h:J35GNhMB4]X2');
define('SECURE_AUTH_SALT', '5D-60q!2P_TJV0#aoJ9Nt36B3@Y875;V7[9r[_9Rc&~pK%8faa6pn#8hgj!:;]h2');
define('LOGGED_IN_SALT', '6Y4p(5@-1!M!5Z6V7t/C;1rwcI)*O[7Y2R%LU]!b2_daNWD3zp)aAw;/Ajh+f;@_');
define('NONCE_SALT', '38b]ul_981jCCr|%6#luRg&lL!]Lj;K2ajCC3R7z98e!Cl/kpo4IdS:|8R%vK68J');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'WczHvwFL1_';


define('WP_ALLOW_MULTISITE', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
