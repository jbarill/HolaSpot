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
define( 'WPCACHEHOME', '/home/holaspot/public_html/trade/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('WP_CACHE', true); //Added by WP-Cache Manager
define('DB_NAME', 'holaspot_wrdp2');

/** MySQL database username */
define('DB_USER', 'holaspot_wrdp2');

/** MySQL database password */
define('DB_PASSWORD', 'Rac0vRaf07N73Cdz');

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
define('AUTH_KEY',         'kB*9Y4_c$(Yv/W1ROLODVx*0Li6za=UP0Ks@0oFh?J*!2^4Cq9C~Sl0avQ9TDwBl;4iU_pZZt6$Vuw');
define('SECURE_AUTH_KEY',  '4m<P_\`t=A9vU(8$i!=W0rAid8@F\`/52AYQlbaaD_t@=0qlRrTP^NVv*?YK7OP\`^4UMp4(>u_xB1::');
define('LOGGED_IN_KEY',    '7(emIu4Fl$WFB/r6)6@NlV-Bg@BZmBCBCyG#(yVs7k6CPSkl3K66Dif(_SK>O>M<MjLxRAc7cuVs^I');
define('NONCE_KEY',        'kkla3)qxt:!0Kcr4ghmm\`GHZ/CmJh=RsE^15?mA-yja0oM<VfXORt-w7SVM$-x8p5jmrpbsRFT!FCvY=O(M');
define('AUTH_SALT',        '*Bt*r!7rWt\`T6_r=V~r_r1RE6/4;H1lGVoz^@*@6Y~9f=?@#H7ehi;qM|HP@efoHn\`#YTB3NPS_XPGRpl2');
define('SECURE_AUTH_SALT', 'P(U(TToOoM7hfb^iD;O_M4|_>89Zc@C2J=Ve7e;AL/4-m9|VLRDkFa-jfN#dIdPVs>SGLYc2HxZh4KnpgT');
define('LOGGED_IN_SALT',   'juepg9q(#K8mV?1tsUMUQL-#H_:o~O(b(a\`HmT^9QhIY!GX/pEYfo#qF(JT6)M');
define('NONCE_SALT',       'R-Gz#9TgIt5TR<3jkq$0GV_fsi?lOL>MD\`Qe39A*UGOIU:96|2bD>MiWZaF\`|^g_$pj;rX2hbF0_V');

/**#@-*/
define('AUTOSAVE_INTERVAL', 600 );
define('WP_POST_REVISIONS', 1);
define( 'WP_CRON_LOCK_TIMEOUT', 120 );
define( 'WP_AUTO_UPDATE_CORE', true );
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
add_filter( 'auto_update_plugin', '__return_true' );
add_filter( 'auto_update_theme', '__return_true' );
