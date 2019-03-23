<?php
/**
 * Created by PhpStorm.
 * User: lucky
 * Date: 22.02.19
 * Time: 17:47
 */

namespace shop;


trait TSingletone{

    private static $instance;

    public static function instance() {
        if(self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

}