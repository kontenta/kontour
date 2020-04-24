<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Route registration
    |--------------------------------------------------------------------------
    |
    | The Kontour service provider registers admin auth and dashboard routes
    | unless turned off here.
    |
     */

    'register_routes' => true,

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
    | Stylesheets & javascripts that load on all admin pages.
    | Can be full or relative urls.
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

    // Move all links from one heading to another
    'menu_heading_names' => [
        //'Design' => 'Style', //Any links put in heading 'Design' will end up under heading 'Style'
    ],

    // Move specific links to another heading
    'menu_item_headings' => [
        //'Admin users' => 'Admin', //The 'Admin users' link will end up under heading 'Admin'
    ],

    // Reorder headings
    'menu_heading_order' => [
        //'Design',
        //'Management',
    ],

    // Reorder links relative each other
    'menu_item_order' => [
        //'Roles',
        //'Admin users',
    ],

    // Remove links altogether
    'menu_hidden_items' => [
        //'Roles'
    ],

    /*
    |--------------------------------------------------------------------------
    | Time format
    |--------------------------------------------------------------------------
    |
    | The default time format is used for displaying non-relative times.
    | Example:
    | D, M j, Y H:i T
    | Mon, Mar 25, 2019 10:51 UTC
    |
     */
    'time_format' => 'D, M j, Y H:i T',
];
