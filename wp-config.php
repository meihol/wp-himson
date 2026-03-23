<?php


/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_himson_d' );

/** Database username */
define( 'DB_USER', 'wp_himson_u' );

/** Database password */
define( 'DB_PASSWORD', 'r0h}Q4.3TY' );

/** Database hostname */
define( 'DB_HOST', 'ec2-43-205-168-50.ap-south-1.compute.amazonaws.com' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'm|W*FcaG`F&dIwI r krRfT^{ilO$7252bB*{zfII1$F0~r39iM:Y(toBHP+@o/g' );
define( 'SECURE_AUTH_KEY',   'Y J*`S||Lm.m4cdl#96s$K+0$I2-R2;cxt`Ltm@&#F?}Xx/=F.)MiEREeC<.J#>G' );
define( 'LOGGED_IN_KEY',     'e,!HvngSS1J;Kd!ltl*1+O5*!)9L?qK(,K}K;%!Y-OBd,qHyJhpnppC~a-U+!X&p' );
define( 'NONCE_KEY',         '!mj^/@D TuR)GAx`GXD2}<OX|~?v~vN8[s..?+%*f~I}g6nh$d,4)4{V(7$99+#{' );
define( 'AUTH_SALT',         'DSy:,gLd>XBYq<@/QW&4[DB*S_w5I`Vye&OJ0p^><.OfG.:0i9z-.or@Z-^RmS&P' );
define( 'SECURE_AUTH_SALT',  'J;V9On^a!ni:AZ;J?vu=sE<YE:)u:d(w)f_<82~*uR3?*s,_pJ9YLjPey]NZ4#ej' );
define( 'LOGGED_IN_SALT',    'ZaXy/$[uHH9`cBW-o{9/)Nd9 Q.Fn_(f)Z2`+IL0=8&C.U|qQTlR=}pWw0#T`%|~' );
define( 'NONCE_SALT',        '9mMpj#(gjMJg+eH s=LxHS+)),HZNCgde5U7YRUYv:zh)wPE*yV*!^wr (qDif3w' );
define( 'WP_CACHE_KEY_SALT', 'ZMTwMMi#Z@lT1Pq1T6=C;azJo{-Oz6S7E!tg64=tL#p>&/x^p2wIB;8d/f+ztL,6' );


/**#@-*/

/**
 * WordPress database table prefix.
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



/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', true );
define( 'DISALLOW_FILE_EDIT', true );
define( 'DISABLE_WP_CRON' , true );
define( 'DISALLOW_FILE_MODS', true );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
