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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'gspcoco_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         'P!9M:Qa~]}]pos}`c ar9wQJDqe:K{d:P/Ov>(oE{*fkm{r>Hi-`7I4U(|,4|+F!' );
define( 'SECURE_AUTH_KEY',  'W!8s!E+/U!n$Gfc0.`vu2<:j,9]RVBi(HXCF>KG^Nt{Ka8;:#[V/OsOGG1CEtZUV' );
define( 'LOGGED_IN_KEY',    '$0[o.Ed(B*PYwV%FzWBK32::)*k_CSarBqCX(7iD2?A^HGB8H B8+7T0NNbp][?}' );
define( 'NONCE_KEY',        'Gq_X}MvzanLP%]tWx%t|uk-/cAzzb/Hyl4<yn99nAX}<~,W$5FZ>S(,$2*Cw9e`m' );
define( 'AUTH_SALT',        '.EYgK}I|~J4SB%a46u9X?jYEz/5x8d9XE4hNk#a=IHi]k9a%{Szgf_/P@*FE$n@x' );
define( 'SECURE_AUTH_SALT', '[`*R5/I_-OaLel)y:U^N{<HRo?^[]M}4m,qL5Fbznn|0%F9cN:sxM?iq5Plz2dXt' );
define( 'LOGGED_IN_SALT',   'rIpln!u1yQ|)D Y%DIN)E^%N6xc6%XjMO,I@8P11{Eq5Arlc|dP:ZH_XcuJ$AEo_' );
define( 'NONCE_SALT',       '~i2Wb]<I?PUcaAVp0rsk:15A9cXF{&%|0]xe C$Q7iZtGXb*13agzg>e(<|[{(H<' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
