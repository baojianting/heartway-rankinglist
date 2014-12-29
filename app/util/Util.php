<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/28
 * Time: 9:34
 */

class Util {

    public static function formatPoints($points) {

        $points = str_replace(array("(", ")"), " ", $points);
        // echo $points;
        return $points;
    }
} 