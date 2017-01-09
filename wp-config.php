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
define('DB_NAME', 'levyweb');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '6w/_v`:>HvnSub;^nr6k~m)0S/vh&n4wh~1cu[P8H]wuQ8|qFpxtg#AQptk$L9mz');
define('SECURE_AUTH_KEY',  'qXYgh$9F^4b-worA<nK3Gj#n0o< J]DeKv3%L@9,aM8ThA[uf3<a`Rnv^Cu9Pxf@');
define('LOGGED_IN_KEY',    ':D/a1jzU.OP7yJO#6l4-qy59Fl@KUbX] _vbqK)9m2S*KYzJDvb~C&6xsnqeiqLM');
define('NONCE_KEY',        'k2mF/(H<45NoF1yx-0#e`Z{4jI[AI~xTxA-_8L*H,1WcW-BzFcvY0v1 lB8IhDUt');
define('AUTH_SALT',        'QgM&_)A?2nQ<oU=6Ce v=wxPdB/GURI2vc}=WXg5S@0s4&WwbD~MLUe!X!!7=Y>/');
define('SECURE_AUTH_SALT', '0dua0ta[H/bwxXwPqXmcdDeprOt<~`A)nw+^s:kNU6dcd)L!hx%6_8*<*c+W)IW:');
define('LOGGED_IN_SALT',   'B0t*K^%RC>43%,S$|4|(J8#>sdhl<Z>y3+VPoIqK]|0w+M$oyFMJF}p{:2%4@K%U');
define('NONCE_SALT',       'Of dZ?om4~qKg!kj:3S;Dcnn$%wuiYWx8[GB<2K,sp3^XnM3X]mi72fpDhQ1e_4Z');

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

/** Apply Argentina language to site */
define('WPLANG', "es_AR");
