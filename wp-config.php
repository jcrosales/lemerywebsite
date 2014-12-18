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
define('DB_NAME', 'lemery');

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
define('AUTH_KEY',         'FGisEx.X@%gz6&o)2:1U9dOA(5(ON1@M~WH`s6:#|k ZET<HOxY=2>hZp-]w7g>Z');
define('SECURE_AUTH_KEY',  ')GL >QVK1B2k0c7O4rO]G+%aM6%NB0|RJ`6t8p,e}hb5HphZBwlC)*,SbP25h!e{');
define('LOGGED_IN_KEY',    's)^h}<c]T7j%EkF<9N~USp96o~Ti#ng<C Zb5s7dpn0r@[|q[WYf.k_8K3o~$.g3');
define('NONCE_KEY',        'Nz9P ;.Ome(?IuJQ![7U/SyGM@g9bgm||>C>og8$C,7A&_K&3dl[_1Lk<+qjMB >');
define('AUTH_SALT',        '8VVWEQZ;npw^l/U5a/KMUF*NXM+=j >-%&o2AKaf:YVFFNn1xJp!LKoUE:f_rc^l');
define('SECURE_AUTH_SALT', 'aoG_|/zd~trJ.sm-6-S~27;6q3!p{-fa^d93cKt.5V[`/*`$M6l#L1G@$~q?g?Gu');
define('LOGGED_IN_SALT',   'BRTNu ](Slb5:L6|s,Vs&X<Wxs+7+v=_`o5XKiji+J#<#-Ec+^BLbFY^7D`=|.)J');
define('NONCE_SALT',       '$H35SbAg*K.$a)Fn9t+.])[zlmNE#[|([%(# !:NJ7Z@5u}gXsEP+K3F#yx%v`f(');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
