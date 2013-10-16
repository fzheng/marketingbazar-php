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
define('DB_NAME', 'marketingbazar_com');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'fy410228');

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
define('AUTH_KEY',         'P^(8&wex*Hg=gHOtawP[v.:ChMJJc5V9DIicgZb$2xHG2tWAG^wvxIQq-}; RmY_');
define('SECURE_AUTH_KEY',  'B(-3[2|`|oKd2Nh1%Wl2CgZPuMv4(|d650vBEC&kpI-=k=m#Rpw(cxBcSPm+hqa ');
define('LOGGED_IN_KEY',    'ch@765_cl-zlBKN@jnc`9Db},8^GNRnFU4UxkjX-S4$s}AT3I-w}=lvA`2{UjPw!');
define('NONCE_KEY',        'F8>McsV$jDnk7s7Vj&8wf1y6.&0;_&svP8n1vadLzEBU$G+wxCN5J,.ePwLo(CW9');
define('AUTH_SALT',        '2{_P:|5KB|XOc<X4CZ-&M0.7zL,$,#T2<qW`J&Qp{>>15S4-Ge*wanRk#abLKl2L');
define('SECURE_AUTH_SALT', '=i|j.]Gh~9/#`T{RVWZ_eL*)!C^Z3?*7[|_x+XN9LJ(Aa$6_?wKz&I%&+A{J`Y#o');
define('LOGGED_IN_SALT',   '_j$KeHv4GL4%:?(&;(kMPDe7jR%6GM1pfz5+hzU>dO)G#qh/xnU<y{ntTU}a`Ngm');
define('NONCE_SALT',       'VfkpN+GKG+R]|!lt*(q,&^K!E]*r{1>FrQ]BfnprPWV7>m2O;9(n=TFUl/fNF!O_');

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
