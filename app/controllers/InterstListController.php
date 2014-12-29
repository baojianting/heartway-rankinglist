<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/28
 * Time: 16:38
 */

require_once __DIR__."/../util/Constant.php";
class InterstListController extends BaseController {

    private static $ACTION_LOCK = "lock-action";
    private static $ACTION_UNLOCK = "unlock-action";
    private static $ACTION_VIEW = "view-action";
    private static $ACTION_EDIT = "edit-action";

    public function getInterstList() {
        if($_SERVER['REQUEST_METHOD'] != "GET") {
            return Constant::$RETURN_FAIL;
        }
        else {
            if(!isset($_GET['areaId'])) {
                return Constant::$RETURN_FAIL;
            } else {
                $areaName = $_GET['areaId'];
                $results = DB::select("select a.id, a.name, r.id, r.route_description, r.route_location, r.route_points,
                            r.is_lock, r.participate_number, r.route_title, a.detail from hw_route r, hw_route_area a where a.name
                            = ? and a.id = r.route_area_id", array($areaName));
                if(!isset($results)) {
                    return View::make("error");
                }
                return View::make("interst_list")->with("datas", $results);
            }
        }
    }


    public function InterstListAction() {
        if($_SERVER['REQUEST_METHOD'] != "POST") {
            return Constant::$RETURN_FAIL;
        }
        else {
            if(!isset($_POST['id']) || !isset($_POST['type'])) {
                return Constant::$RETURN_FAIL;
            }
            $actionType = $_POST['type'];
            $routeId = $_POST['id'];

            if($actionType != self::$ACTION_EDIT) {

                $route = HwRoute::find($routeId);
                if(!isset($route)) {
                    return Constant::$RETURN_FAIL;
                }
            }

            if($actionType == self::$ACTION_LOCK) {

                $route->is_lock = Constant::$LOCK;
                $route->save();
                return Constant::$RETURN_SUCCESS;
            } else if($actionType == self::$ACTION_UNLOCK) {

                $route->is_lock = Constant::$UNLOCK;
                $route->save();
                return Constant::$RETURN_SUCCESS;
            } else if($actionType == self::$ACTION_EDIT) {
                $route = DB::select("select r.id, r.route_description, route_location, route_points, is_lock, participate_number,
                            route_area_id, route_title, name from hw_route r, hw_route_area a where r.id = ? and r.route_area_id = a.id"
                            , array($routeId));
                $areas = HwRouteArea::all();

                if(!isset($areas) || count($areas) <= 0) {
                    return View::make("error");
                }
                if(!isset($route) || count($route) != 1) {
                    return View::make("error");
                }
                $returnArr = array();
                $returnArr["areas"] = $areas;
                $returnArr["route"] = $route;

                return View::make("create_route")->with("editArr", $returnArr);
            } else if($actionType == self::$ACTION_VIEW) {
                return View::make("detail")->with("route", $route);
            }

        }
    }

} 