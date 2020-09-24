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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_bao_bi' );

/** MySQL database username */
define( 'DB_USER', 'wp_bao_bi' );

/** MySQL database password */
define( 'DB_PASSWORD', '888' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.Ti+DPqH*mNC[Q.nsN>Fg&b2-E@fr) qJ>Bfmg|q3?)ZEU&9 qt/LEn2)YmwA[!C' );
define( 'SECURE_AUTH_KEY',  's8Q<HNYg-qHcDU_5fwr_DANkOw6Ci,>,{+n7xa/6E+`@o9Si*NbF=o%8EA?`hSn+' );
define( 'LOGGED_IN_KEY',    'M;+ti(WEYCv?S#%Ufs%Ve^7Bt$%`s<^@fqnNS#J@V^#QAZfI uY0v;?@,=<Uw`<I' );
define( 'NONCE_KEY',        'a Ihv]Ski$|ijaFkxF].1=P4.Y!aX$eEyDb7n6[l{/JpTY9|-F?#xkryUI6eK]}8' );
define( 'AUTH_SALT',        'Tz1I CIjA_BJZ;i!3v3{(VFE)LEmDCdc&wfIF:V>|D3%EvuIL9`ua6`V3i(~kkDz' );
define( 'SECURE_AUTH_SALT', '&vi:fd DU;epABx>t >A|+S:eo4Q#-qz``a3a~Zr107]a{siF+&+-L-J|(oaC2Sk' );
define( 'LOGGED_IN_SALT',   'h`-436+!f/0}+NvU%p(Y/2OD`veax6#dE4X&alr+Ytd@f5M5}GdT&DhH~(d)r^00' );
define( 'NONCE_SALT',       '&ED*UL]3;-lWFxDo]{nY`;hR|poi?:=hgUc?iH Wz%Kzk|DIzND+E[Es0:?5fVyw' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
