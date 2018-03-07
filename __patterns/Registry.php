<?php

namespace Registry;

abstract class Registry {
    private static $objects;

    public static function set($key, $value) {
        self::$objects[$key] = $value;
    }

    public static function get($key) {
        if(isset(self::$objects[$key])) {
            return self::$objects[$key];
        }
        return null;
    }
}