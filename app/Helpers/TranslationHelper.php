<?php

if (!function_exists('getTranslations')) {
    function getTranslations($keys = [])
    {
        $translations = [];
        foreach ($keys as $key) {
            $translations[$key] = trans($key);
        }
        return $translations;
    }
}
