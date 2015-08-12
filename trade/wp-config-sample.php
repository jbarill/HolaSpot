<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'holaspot_trade');

/** MySQL database username */
define('DB_USER', 'holaspot_user');

/** MySQL database password */
define('DB_PASSWORD', 'p@ssw0rd');

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
define('AUTH_KEY',         '>cD19K4KwRGp+Dv_NGc&8_D%DpKxBf61hHyuYH:/dAG.JnFgpr`Kzc_Pfu,A 2W{');
define('SECURE_AUTH_KEY',  'Hl-Cy gxS|d(APfjF6hEI-|}{Z_M=XL= CMRrD.A*#*4?l{^.kQ7c9?Vu+%c/895');
define('LOGGED_IN_KEY',    'BPpXpOUr}I(:nqf<!vT>kr }R50yB`{Tb)p]N-nA0~T.SmY]$.6/b2#ZBERN=8^.');
define('NONCE_KEY',        '7k973fUiEF0*[6cqgk9)[`4|(4d92D(m:q2EhDS[a0DZIhD*-,9|$dWdxl_P}R4[');
define('AUTH_SALT',        '+o|u+>,0_+E|s- e.bonU<{bRG;--mz}5>gJhpO1P=K0@avwtTo;}+1-+@bV^8jg');
define('SECURE_AUTH_SALT', 'M##bQr9mVq7J%vDxL47}7=K`tmWg<IKn|pkE7*(]HqFB[]wZ~6byGNhJ&D,N<7Z1');
define('LOGGED_IN_SALT',   '6}GF_3|a],D,@^0[fYYwsKqi;iQ7N!(do9| (#D1#s*PxD.-39q(<Lxis|rTnfut');
define('NONCE_SALT',       'wz@o:h4~|10_]..}a[6|^|VvT9,e`xl*;a8/*8X&3L$u_sx%w!U|YK%7d[B1vKlu');

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
