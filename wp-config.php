<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hn_alpha');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '(&5cFfwhB gFt/~_#V^=B,m@)*)]743=JeBFSE{I{@T8Hr;Mh)#+E+p55:xY[$6/');
define('SECURE_AUTH_KEY',  '%$1FMtyL=><E>~O-Va;H2VF%V/hj.5mK8(-/Z5aq5)v[?)$35=tV;hi8/o9mrlG$');
define('LOGGED_IN_KEY',    '#@S3IS,yEaZ@%0pD4!9FCJ3h6gAi.y~4w!Rqp1y)tlX!`Y]+fGs:Rtn=t6YCVUBo');
define('NONCE_KEY',        'L*kRvo`jTA3Its27jyI5o^Vcffn_$ey_2Q|=+;.]d_35^d`+j%vtN1Mt0nlA|^LE');
define('AUTH_SALT',        'jM.N{lT*=Dx1(;yEw##/3OMSo+NAwldH!qI=>*&mC[p)N:Efz-QZWBYWfHGm8^Pq');
define('SECURE_AUTH_SALT', '/V6m(=bMP|Z:uC}N^i3AKYrZZzk8 fUoGzE|hO]B3d d50taQ2tVE&M,!V%N/ K]');
define('LOGGED_IN_SALT',   's3o&f}LfiAn4]`9%G.sY^/$MHt9Xs;4+fCgk<5(&)wrElOnK5.@*0xX>Bg/YDJLW');
define('NONCE_SALT',       '&v;R@k3yS}797 q !AZ]gb-Gn3?83HwbKgyM,]h7+*U:`|mg&Lx/[@UF1,+W|G8Q');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
