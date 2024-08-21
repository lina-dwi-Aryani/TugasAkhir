<?php

return [

    'title' => 'DINAS SOSIAL DIY',
    'title_prefix' => '',
    'title_postfix' => '',

    'use_ico_only' => false,
    'use_full_favicon' => false,

    'google_fonts' => [
        'allowed' => true,
    ],

    'logo' => '<b>DINAS SOSIAL</b> DIY',
    'logo_img' => 'vendor/adminlte/dist/img/logodinas.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'DINSOS Logo',

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logodinas.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 80,
            'height' => 80,
        ],
    ],

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/logodinas.png',
            'alt' => 'DINAS SOSIAL DIY Image',
            'effect' => 'animation__shake',
            'width' => 80,
            'height' => 80,
        ],
    ],

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => 'bg-primary',
    'classes_auth_body' => '',
    'classes_auth_footer' => 'bg-light',
    'classes_auth_icon' => 'fas fa-user',
    'classes_auth_btn' => 'btn-flat btn-primary',

    'classes_body' => '',
    'classes_brand' => 'bg-primary',
    'classes_brand_text' => 'white',
    'classes_content_wrapper' => 'bg-light',
    'classes_content_header' => 'bg-white',
    'classes_content' => 'bg-white',
    'classes_sidebar' => 'sidebar-light-primary elevation-4',
    'classes_sidebar_nav' => 'nav-child-indent',
    'classes_topnav' => 'navbar-dark navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 's',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

   'menu' => [
    [
        'type' => 'fullscreen-widget',
        'topnav_right' => true,
    ],
    [
        'type' => 'sidebar-menu-search',
        'text' => 'search',
    ],
    [
        'text' => 'Dashboard',
        'url' => 'dashboard',
        'icon' => 'fas fa-tachometer-alt',
        'label' => 4,
        'label_color' => 'success',
    ],
    ['header' => 'Pengguna'],
    [
        'text' => 'User',
        'url' => 'users',
        'icon' => 'fas fa-fw fa-user',
    ],
    ['header' => 'DATA KEGIATAN BENCANA'],
    [
        'text' => 'Kegiatan',
        'icon' => 'fas fa-fw fa-share',
        'submenu' => [
            [
                'text' => 'Data Kegiatan',
                'url' => '/kegiatan',
            ],
            [
                'text' => 'Data per Kabupaten',
                'url' => '#',
                'submenu' => [
                    [
                        'text' => 'DIY',
                        'url' => '/kota',
                        'shift' => 'ml-2',
                    ],
                    [
                        'text' => 'Bantul',
                        'url' => '/bantul',
                        'shift' => 'ml-2',
                    ],
                    [
                        'text' => 'Kulon Progo',
                        'url' => '/kp',
                        'shift' => 'ml-2',
                    ],
                    [
                        'text' => 'Gunung Kidul',
                        'url' => '/gk',
                        'shift' => 'ml-2',
                    ],
                    [
                        'text' => 'Sleman',
                        'url' => '/sleman',
                        'shift' => 'ml-2',
                    ],
                ],
            ],
        ],
    ],
    ['header' => 'Download'],
    [
        'text' => 'Download Laporan per Kabupaten',
        'url' => '#', // The URL here seems to be the parent of the submenu. Adjust as necessary.
        'icon' => 'fas fa-fw fa-download',
        'submenu' => [
            [
                'text' => 'DIY',
                'url' => 'export/kota', // Adjust the URL path as necessary.
                'shift' => 'ml-2',
            ],
            [
                'text' => 'Bantul',
                'url' => 'export/bantul',
                'shift' => 'ml-2',
            ],
            [
                'text' => 'Kulon Progo',
                'url' => 'export/kp',
                'shift' => 'ml-2',
            ],
            [
                'text' => 'Gunung Kidul',
                'url' => 'export/gk',
                'shift' => 'ml-2',
            ],
            [
                'text' => 'Sleman',
                'url' => 'export/sleman',
                'shift' => 'ml-2',
            ],
        ],
    ],
],


    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    'livewire' => false,
];
