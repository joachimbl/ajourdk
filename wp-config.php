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

define('DB_NAME', 'ajourdk');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '8PVS:7cZ1I.:!i8755+*j&my$-W)qc >Pqtk&jcx7Aw`g@`]c :`$%CrE~I,BOL+');
define('SECURE_AUTH_KEY',  'La,HmN/}&F&=9V{>$cx($Cj!*DyulmK5;r@^k!&Kaz]K~RQ8LRZ0#:`M%$Tvsz?S');
define('LOGGED_IN_KEY',    '%i:E|Zum]YDEyekWI(F.^{YTK7w5(8kQ7]Iu{tAv~{UG0~K3wf?bR<?_]Da11m!Q');
define('NONCE_KEY',        's?U8IK<r~d+z^,wO=6(o@, ?k:+i|zJU+jF.HTx4*q -rY;GG# AxHyg2Zr;R8W=');
define('AUTH_SALT',        ' @Kx3M|f(8<}=-PNxmb7M+-h`|M[NO$=L)tdT)<16-@YM.hM4<}G:t!#M[7y$<P)');
define('SECURE_AUTH_SALT', ',C6y[BRP{N7l`(J]q7IqDic6rnD<f1/D jNXFFFgrLPLHrWedQgxTdwg&I3I~%v+');
define('LOGGED_IN_SALT',   '98WLs:Y6;Q`ly?g;jvZtP&L)5oR:0g9FVjsZ6#~>V]Z&MbfuTlA5fjdFxFr$=yHA');
define('NONCE_SALT',       'n_Q$it;b+kHFdT5JiRR:^o$3GXjN_|tf[Av..5Z;dI>e9#+PI?bsen5@R^~va)+N');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'ajour_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define ('WPLANG', 'da_DK');

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
