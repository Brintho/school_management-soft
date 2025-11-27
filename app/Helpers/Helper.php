<?php

use App\Models\Role;

if (! function_exists('getAppUrl')) {
    function getAppUrl()
    {
        $protocol    = (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
        $hostname    = $_SERVER['HTTP_HOST'] ?? '127.0.0.1';
        $script_name = $_SERVER['SCRIPT_NAME'] ?? '/index.php';

        $app_url = $protocol . '://' . $hostname . $script_name;

        return str_replace('/index.php', '', $app_url);
    }
}

if (! function_exists('getAssetUrl')) {
    function getAssetUrl()
    {
        $app_url = getAppUrl();
        return file_exists('public') ? $app_url . '/public' : $app_url;
    }
}

if (! function_exists('uuid')) {
    function uuid()
    {
        return Str::uuid();
    }
}

if (! function_exists('display')) {
    function display($val)
    {
        return $val ?? translate('N/A');
    }
}

if (! function_exists('allowedFileSize')) {
    function allowedFileSize()
    {
        return 2048;
    }
}

if (! function_exists('allowedFileExt')) {
    function allowedFileExt()
    {
        return 'jpg,jpeg,png';
    }
}

if (! function_exists('getRoleId')) {
    function getRoleId($roleName)
    {
        $role = Role::where('title', $roleName)->first();

        if (! $role) {
            throw new Exception('Role not found: ' . $roleName);
        }

        return $role->id;
    }
}

if (! function_exists('getSchoolId')) {
    function getSchoolId()
    {
        return auth()->user()->school_id;
    }
}

if (! function_exists('getImage')) {
    function getImage($path = null)
    {
        if (empty($path) || ! is_string($path)) {
            return asset('assets/global/images/default.png');
        }

        if ($path == 'user') {
            return asset('assets/global/images/avatar.jpg');
        }

        if (file_exists(public_path($path))) {
            return asset($path);
        }

        return asset('assets/global/images/default.png');
    }
}

if (! function_exists('ellipsis')) {
    function ellipsis($long_string, $max_character = 30)
    {
        $long_string  = strip_tags($long_string);
        $short_string = strlen($long_string) > $max_character ? mb_substr($long_string, 0, $max_character) . "..." : $long_string;
        return $short_string;
    }
}

if (! function_exists('path')) {
    function path($data)
    {
        return route('modal', $data);
    }
}

if (! function_exists('translate')) {
    function translate($data)
    {
        return $data;
    }
}

if (! function_exists('slugify')) {
    function slugify($phrase)
    {
        return Str::slug($phrase ?? '');
    }
}

if (! function_exists('goBack')) {
    function goBack($status, $message, $route = null)
    {
        $redirect = $route ? redirect($route) : redirect()->back();
        return $redirect->with($status, $message);
    }
}