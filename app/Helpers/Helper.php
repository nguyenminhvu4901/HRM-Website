<?php

if (!function_exists('checkSuperAdmin')) {
    function checkSuperAdmin(): bool
    {
        return session()->get('level') === 1;
    }
}

if (!function_exists('checkAdmin')) {
    function checkAdmin(): bool
    {
        return session()->get('level') === 0;
    }
}
