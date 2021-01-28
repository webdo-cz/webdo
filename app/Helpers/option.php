<?php

if (! function_exists('option')) {
    function option($name){
        $cache = cache('options');
        if (array_key_exists($name, $cache)) {
            if (array_key_exists('value', $cache[$name])) {
                return $cache[$name]['value'];
            }else {
                return $cache[$name];
            }
        }else {
            if(env('APP_DEBUG', false)) {
                return "Undefined option: " . $name;
            }else {
                return null;
            }
        }
    }
}

if (! function_exists('option_exists')) {
    function option_exists($name){
        $cache = cache('options');
        if($cache == null) {

        }else {
            if (array_key_exists($name, $cache)) {
                return true;
            }else {
                return false;
            }
        }
        
    }
}