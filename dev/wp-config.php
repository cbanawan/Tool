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
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'JRM');

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
define('AUTH_KEY',         '|vn-_sS60br96E+vhl+mFv8Mx~.v:k|lJC?A.pC5rO.VSp5S=Q+R3S*7@0WS1=QO');
define('SECURE_AUTH_KEY',  'Ku1t3f`FU:$<MTk9H4<IibrHJJ0I%OmG4&s5a3w*eiE;y,bUQ 2YZxQ_bGmMsR8+');
define('LOGGED_IN_KEY',    'qMJVg rJeCwS7L6joLmN&xnK#%y^~I>i[qTmv>-CF)W=bd?:MCvpUr3L,I+}je~,');
define('NONCE_KEY',        '7PP~M[%`|t`qQ#?suC]Ww:+TCIkD~|jL#|t..4,|e? r[nYaPad2B6.D-oQm-kf7');
define('AUTH_SALT',        '#D{2@2^vA4))>_xR A`2a^DuFZx|XI3-<uOOvp)&uu!I0<>dh:P(nn-+1+h?uysy');
define('SECURE_AUTH_SALT', 'QDrLzn 6Uzm`l_MpFcmDhGp$qQk+f(5gvk1Lw(t[sH,!{)Po0g5C#6W-|efD29:|');
define('LOGGED_IN_SALT',   'V{]UVb5WL?|FCH<bzzTXD^Al0Fu1(!.yGUsfmMrWwBO_&ER ~2L 21}xi!$8GQa8');
define('NONCE_SALT',       '51/&k{JuwiKD(z+vcfYl7+0W$y%K+k`;8QYv%v^ ,QC6 3~Y3,|{^eW+^`Gd31oJ');

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
define('DOMAIN_CURRENT_SITE', 'www.pangeapanel.com');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
