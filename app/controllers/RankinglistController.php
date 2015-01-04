<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2015/1/3
 * Time: 14:49
 */

require_once __DIR__. "/../Util/Constant.php";

class RankinglistController extends BaseController {

    public function getRouteArea() {
        if($_SERVER["REQUEST_METHOD"] == "POST") {

            $areas = HwRouteArea::all();
            if(!isset($areas) || count($areas) == 0) {
                return Constant::$RETURN_FAIL;
            }

            print_r($areas);

        } else {
            return Constant::$RETURN_FAIL;
        }
     }
} 