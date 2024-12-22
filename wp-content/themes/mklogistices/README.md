## mklogistics

### Requirements
- Lando: https://github.com/lando/lando/releases/tag/v3.20.4
- Node: v16.17.0

### Install
- lando start
- npm install
- Create a new file `wp-config.php` in the root of the project and add the following:
```php
<?php
define( 'DB_NAME', 'wordpress' );
define( 'DB_USER', 'wordpress' );
define( 'DB_PASSWORD', 'wordpress' );
define( 'DB_HOST', 'database' );
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );
define( 'IS_VITE_DEVELOPMENT', true );

define( 'AUTH_KEY', 'put your unique phrase here' );
define( 'SECURE_AUTH_KEY', 'put your unique phrase here' );
define( 'LOGGED_IN_KEY', 'put your unique phrase here' );
define( 'NONCE_KEY', 'put your unique phrase here' );
define( 'AUTH_SALT', 'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT', 'put your unique phrase here' );
define( 'NONCE_SALT', 'put your unique phrase here' );

define( 'WP_DEBUG', false );
define( 'WP_DEBUG_LOG', false );
define( 'WP_DEBUG_DISPLAY', false );

define( 'WP_AUTO_UPDATE_CORE', false );

if (isset($_SERVER['HTTP_HOST'])) {
    // HTTP is still the default scheme for now.
    $scheme = 'http';
    // If we have detected that the end use is HTTPS, make sure we pass that
    // through here, so <img> tags and the like don't generate mixed-mode
    // content warnings.
    if (isset($_SERVER['HTTP_USER_AGENT_HTTPS']) && $_SERVER['HTTP_USER_AGENT_HTTPS'] == 'ON') {
        $scheme = 'https';
        $_SERVER['HTTPS'] = 'on';
    }
    define('WP_HOME', $scheme . '://' . $_SERVER['HTTP_HOST']);
    define('WP_SITEURL', $scheme . '://' . $_SERVER['HTTP_HOST']);
}
```
- Assures the `IS_VITE_DEVELOPMENT` value is true

### Start development
- npm run dev

### Build
- npm run build

### Deploy
- npm run build
- Commit all files in dist folder to git with "Process styles and scripts"
- Push to Pantheon

### New component
- npm run create-component -- --name=component-name
