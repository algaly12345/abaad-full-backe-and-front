<?php

if (!function_exists('theme_asset')) {
    function theme_asset($path = null): string
    {
        $themeName = theme_root_path();
        if($themeName == 'default'){
            return asset( $path);
        }else{
            if (DOMAIN_POINTED_DIRECTORY == 'public') {
                return asset( 'public/themes/'.$themeName.'/public/'.$path);
            }else{
                return asset( 'resources/themes/'.$themeName.'/public/'.$path);
            }
        }
    }
}

if (!function_exists('theme_root_path')) {
    function theme_root_path(): string
    {
        return env('WEB_THEME') == null ? 'default' : env('WEB_THEME');
    }
}


