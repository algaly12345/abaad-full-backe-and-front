<?php

namespace App\Traits;
use Illuminate\Support\Facades\Config;


// In a bootstrap file or at the top of your PHP file
if (!defined('DOMAIN_POINTED_DIRECTORY')) {
    define('DOMAIN_POINTED_DIRECTORY', 'public'); // or whatever value is appropriate
}

trait ThemeHelper
{
    public function get_theme_routes(): array
    {
        $theme_routes = [];

        try {
            if (DOMAIN_POINTED_DIRECTORY == 'public') {
                if (theme_root_path() != 'default' && is_file(base_path('public/themes/'.theme_root_path().'/public/addon/theme_routes.php'))) {
                    $theme_routes = include(base_path('public/themes/'.theme_root_path().'/public/addon/theme_routes.php')); // theme_root_path()
                }
            } else {
                if (theme_root_path() != 'default' && is_file(base_path('resources/themes/'.theme_root_path().'/public/addon/theme_routes.php'))) {
                    $theme_routes = include('resources/themes/'.theme_root_path().'/public/addon/theme_routes.php'); // theme_root_path()
                }
            }
        } catch (\Exception $exception) {
            // Handle exception if needed
        }

        return $theme_routes;
    }
}
