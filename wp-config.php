<?php
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

// ** MySQL settings - You can get this info from your web host ** //
if(file_exists(dirname(__FILE__) . '/local.php')){
	//local database
	define( 'DB_NAME', 'local' );
	define( 'DB_USER', 'root' );
	define( 'DB_PASSWORD', 'root' );
	define( 'DB_HOST', 'localhost' );
}else{
	//live database
	define( 'DB_NAME', 'dbv358spw52ksd' );
	define( 'DB_USER', 'uher6ehwwmz6b' );
	define( 'DB_PASSWORD', 'p5arz2veednb' );
	define( 'DB_HOST', 'localhost' );
}


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
define('AUTH_KEY',         '6R6SCczLf3ILKsavc7sVJw4jqVaUouTE6V+vgNLQ4vVSyBAmjj32O9cl3y5vX9PZVdp/SalLN9nLX9rP1cl07w==');
define('SECURE_AUTH_KEY',  'TdrjogBFE+jOCglJmmbMisfwu7lbAc/Tgqm5W4o+ZgmtwxbXvO7K8TD/uQwbhbmI2dMtpzRtAQuy1DUPhL6G+Q==');
define('LOGGED_IN_KEY',    'pIyHdIonfM3tBGoD4rrke6sX1m8eK2VgKTzm9aDmeaLPNXn2xnu+rEivUBsa5+ZiHhgsDIcmAl/76kHUnoX/Ow==');
define('NONCE_KEY',        'yu0Qu4Gxon1dRCtocUWIO7FBUJ4dr1nUceDM1nUM/hI3KSDZYRKTmiSmUVWDDO/sLHum0ah9FXcpKGuvEqhogg==');
define('AUTH_SALT',        'yO3x9lcG0rbdmLkfB8a1V/BcdMVU52W8EmCmcJQE3Tal6DYI1QW9j87NjOKi+x8snJ9JCskGb5J0uh49rPPyHA==');
define('SECURE_AUTH_SALT', 'NWezjbkpnUpqVM8JoHVjMAoAobsC+/55Ab3ckobMzLgP8kf5yFSk9Dqu+VkS+3SPcOOAr4uy38wmRuPQcDTQ/A==');
define('LOGGED_IN_SALT',   'rrv6YkYNfgLNoSyuFE5ZwkarMZjYhWM/XYGtw4pStg35Pf6cXg3V9VUTO6jLjA9CvTtyNjb+sX8bcuamGz3EuQ==');
define('NONCE_SALT',       'XM9OncojybNDrHuW3Xfkj7DLwsWCn16S48Tj29fA0Hx8Ah7V5QlEH6zWukLSxUZ8cBOyiTVWQSM5orROkzJw4Q==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
