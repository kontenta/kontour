<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Authentication Guard
    |--------------------------------------------------------------------------
    |
    | Name of the default Guard used for admin tools.
    |
    | If you've added a configuration for a separate Guard for admin pages in
    | your app's config/auth.php you should set that guard's name here.
    |
    */

    'guard' => 'web',

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Name of the configuration for admin password resets.
    |
    | If you want to use another password configuration than the default, add
    | the configuration to 'passwords' in your app's config/auth.php and set
    | the configuration name here.
    |
    */

    //'passwords' => 'users',

    /*
    |--------------------------------------------------------------------------
    | URL Prefix
    |--------------------------------------------------------------------------
    |
    | Common prefix for the admin urls.
    |
    */

    'url_prefix' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Domain
    |--------------------------------------------------------------------------
    |
    | Domain name for admin routes.
    |
    | Set a domain name here if your admin pages should reside on another
    | domain or sub-domain than the rest of your app.
    |
    */

    'domain' => null,

];
