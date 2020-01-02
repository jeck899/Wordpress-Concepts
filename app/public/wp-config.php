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
// LOCAL DATABASE SETTINGS
	/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
}
else{
	// LIVE DATABASE SETTINGS
/** The name of the database for WordPress */
define( 'DB_NAME', 'albertd3_conceptdata' );

/** MySQL database username */
define( 'DB_USER', 'albertd3_wp50' );

/** MySQL database password */
define( 'DB_PASSWORD', 'admin' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
}




/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '8ibKfQXwaPsdRVSs6V/1q/iFzjZRQx2emcR7Hbc4U3oIUBOV5WCMLzlJ6FMPwQaZviwwfsSDgiVzHE31KpgpNg==');
define('SECURE_AUTH_KEY',  '/+6fYbr2wJJfHr7LYDqd2Cf1ryINQtvld2MrFKHf08opVRltd9HnDy/KVVyxmBpMSmADGgs99NdGS5xgG+es7A==');
define('LOGGED_IN_KEY',    '7X68nsW85oZA5QtHXDToUJYE8zPvBUSZIBy3U6mqfs7AWnVRd5niN1ytCfds6v097XuwgRQ11MnAFW6dKD8q+g==');
define('NONCE_KEY',        'EAUgu9qPRizG7pV7CXI9px4N1/6jfzThqT5Bko0tFFvjBoCJklxieXHq7dfoTTj4fJtYhs9Y2m5FC4OqdYVN5A==');
define('AUTH_SALT',        'V9OXFSw2f3Yq2k5y5COAFnoSsjTq8bh05rZrf0ze9M/gaMZ2pONCbmWuRfUDJo65tjg5LhwtH2MhXMLC2IIViw==');
define('SECURE_AUTH_SALT', 'iBezicui7NLhQhBYMzI3GtkOwLBXH9Ba74rZYJFAkO9Ffo0x/E3eZDCwFY4g5OWvKSMKDwErD7+NXCD2sc163g==');
define('LOGGED_IN_SALT',   'GJVd8rRESWbqUnGVcUz/qE6anNxwxRdcLHIPYJSTu4+fMiGZ2nFsWCNq4yHPi6VTBbMtmEkAWAQt4bG2zbSY2g==');
define('NONCE_SALT',       'ANQdZdS0QWrqlFnvtNCaIvkQpIB2DQIU7uoBPpV8bgvbaXAmDajATssE4MaxBw9rR5kUd3eC26FpCuqJFkzUtg==');

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
