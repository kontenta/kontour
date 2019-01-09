<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Title
    |--------------------------------------------------------------------------
    |
    | Display name for header and page title of admin pages
    |
     */

    'title' => 'Kontour ' . env('APP_NAME') . ' ' . env('APP_ENV'),

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

    /*
    |--------------------------------------------------------------------------
    | Stylesheets & javascripts
    |--------------------------------------------------------------------------
    |
    | Stylesheets & javascripts to load on all admin pages.
    | Can be full or relative urls.
    | You may even use the asset() helper.
    |
     */

    'stylesheets' => [
        //'css/kontour.css',
    ],
    'javascripts' => [
        //'js/kontour.js',
    ],

    /*
    |--------------------------------------------------------------------------
    | Widgets
    |--------------------------------------------------------------------------
    |
    | Configure the widgets to load on all admin-pages.
    |
     */

    'global_widgets' => [
        \Kontenta\Kontour\Contracts\MenuWidget::class => 'kontourNav',
        \Kontenta\Kontour\Contracts\UserAccountWidget::class => 'kontourHeader',
        \Kontenta\Kontour\Contracts\PersonalRecentVisitsWidget::class => 'kontourWidgets',
        \Kontenta\Kontour\Contracts\TeamRecentVisitsWidget::class => 'kontourWidgets',
    ],

    /*
    |--------------------------------------------------------------------------
    | Recent visits
    |--------------------------------------------------------------------------
    |
    | Number of links to show in recent visits widgets.
    |
     */

    'max_recent_visits' => [
        'personal' => 7,
        'team' => 9,
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu overrides
    |--------------------------------------------------------------------------
    |
    | Restructure the menu, overriding menu item positions.
    |
     */

    'menu_heading_names' => [
        //'Design' => 'Style',
    ],

    'menu_item_headings' => [
        //'Admin users' => 'Admin',
    ],

    'menu_heading_order' => [
        //'Design',
        //'Management',
    ],

    'menu_item_order' => [
        //'Roles',
        //'Admin users',
    ],
];
