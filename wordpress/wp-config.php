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
define( 'DB_NAME', 'wpw' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'O#-/]^@2h=vhF)qu_6Z)~E,a>DVU>*4~7r+e5+^7QfFe%padp9AOHcaa.]?1c%`c' );
define( 'SECURE_AUTH_KEY',  'nNKKPjF5NVXL3~7L8oJsE_C`6jE.<YJmmojiPQ$W4ewnhen~qjxtQss:9A*u.OG!' );
define( 'LOGGED_IN_KEY',    '(}+N)pLPCDTbazO7qRUwKikmekIeEDJwmRq@7]>|([gn6Cz[$fYAxrmxQY:lYw1+' );
define( 'NONCE_KEY',        'O-)1,nH+yZdJazM(R N(.OH%Tv/88nwKu/+[T|j+&jJwIewPx.GN`P~/bd9hh:Nf' );
define( 'AUTH_SALT',        '}u:#:<V}80Z;PeZ^Wl_YNih@{,8diSd46xQEJMp;z}iirZr.;AaM>Cx%IM2wdF^)' );
define( 'SECURE_AUTH_SALT', 'He>D1eP#c@t$3Ju66k<hc@YITc[EKVLc(y_R~rjw41;j8%A(zukSg{A0)@lPB3^6' );
define( 'LOGGED_IN_SALT',   'C0$s1~Q[:.Kpt(t8eBg|-e*;|)Y5&e0sma]Qd{I6[&&qGN6K3tAHfDj+&;WG-kyD' );
define( 'NONCE_SALT',       'oM}.HpOLB2GQ/s}Td>5{Ve}p9]oQo,F:U[OC}#pDs_nT|KG<)o[e*J<5sOk~co<a' );

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
