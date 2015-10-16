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
define('DB_NAME', 'wp_pp');

/** MySQL database username */
define('DB_USER', 'rootlive');

/** MySQL database password */
define('DB_PASSWORD', 'RHUSJMIN');

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
define('AUTH_KEY',         '&?`gZU$k_{:@r}I)JXGsP%|<iqL-m){z]WPJW?s Te`hb)C||+IvEPG~DZ30d2+v');
define('SECURE_AUTH_KEY',  'nec3Tethw6g~$X&hDcBCQ+rO_ehogK%._ia*p!TWu#UN:6%.|C4H%tUW<jE6h9on');
define('LOGGED_IN_KEY',    ',>6s@=>p~#HZHt-<hq?3^@Y[w|_J<w#t$,A7S;EaqUySM._-I5+=D[v8+3ypN%Pt');
define('NONCE_KEY',        ')mSo9(M]I/`4no2O<BC+.%Qv*`A.3FimCAVr:W67+zHyVbNgvxpwzIjK= AC*^zQ');
define('AUTH_SALT',        'i$,3@Q-RTVI`}HskB#dWjR=t%*2HR7[.`?YOo5b)oNL{_1ZB~=3-/2n)9S*U~JBT');
define('SECURE_AUTH_SALT', '^U6|A-O(FY-_4.%HEkC/ck]x&bEWahw7`L?2D4-U-N6PhmvDDu?M&SSy+AS9Z4zy');
define('LOGGED_IN_SALT',   'oo.JZtSO|6]EiYP2)!tj=|b9<a]JG@:7FvqeTo_/|eJe/p%6?O!M*2AZasGM qG*');
define('NONCE_SALT',       'EXN*Q05+OX)tX*=Fd?>m=7Y?Wt^o%G8|+bre;!kiD#d n3IJy?w|S~G:GcjZkmx`');

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
/* Multisite */
define( 'WP_ALLOW_MULTISITE', true );
define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'pangeapanel.com');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
