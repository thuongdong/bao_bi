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
/** The name of the database for WordPress */
define('DB_NAME', 'ina9a6de_print');

/** MySQL database username */
define('DB_USER', 'ina9a6de_print');

/** MySQL database password */
define('DB_PASSWORD', 'printing_88');

/** MySQL hostname */
define( 'DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'sBQyg^Zl:i[Vwc+AsmN68+H6sO0)(*v52/6=WP<fs0CZ%-wth!8awTtEVbm37~Wj');
define('SECURE_AUTH_KEY',  'wNX-iG8;tyC]uysV`ci?!#BI?Fiu;_t#=KJ#Jiv/z2aViRFvJii0*R^M;~*fG tg');
define('LOGGED_IN_KEY',    '_k*6SlA8^~<@vx_))8(_H adww;IAyk<M3&g@H*rOgZY~$<NJAB6_7HKdc9,;ESO');
define('NONCE_KEY',        'B>^VNR;94R_wIBB.d?B`ZaE*W8d/NCD(K$8R_o7pgp&S,kltW9hs?uefwBPRel+%');
define('AUTH_SALT',        'fr{65N2X*%v8R)rJXjh=8hM:n&]0h$2XxFv~sVd5?2=9IwZheL(yvIz84%?I=~O ');
define('SECURE_AUTH_SALT', ') G!MnY_y5%7^Zh@3Q#8U  ;%jZ<rUg+M:Xv7Cu=OVu>M8P(#TwXjfiIV8M[p1`)');
define('LOGGED_IN_SALT',   'BV@;D!Br^[_hFLyU!:L}JX}I)be!lu97L`_]<]3n=J$p;t#`PeovI6O7L3L*LS@4');
define('NONCE_SALT',       '[eZ5/2BUq.{Zl/e2EelLn6/tSULd4QDnvszL^1`wc!v[BzEuzLjH[0MoK14(o_60');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
