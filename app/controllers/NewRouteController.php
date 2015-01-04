<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/27
 * Time: 17:19
 */

require_once __DIR__."/../util/Constant.php";
require_once __DIR__."/../util/Util.php";

class NewRouteController extends BaseController {

    /*
     * when enter the create_route page
     *
     */
    public function newRoute() {

        $allAreas = HwRouteArea::all();

        if(!isset($allAreas)) {
            return View::make("error");
        }

        $dataArr = array();
        foreach($allAreas as $area) {
            // $dataArr[$area->name] = $area->route_num;
            $dataArr[$area->id] = $area->name;
            // array_push($dataArr, $area->name);
        }

        return View::make("create_route")->with('dataArr', $dataArr);
    }

    /*
     * click the submit button write to the database
     *
     *
     */
    public function addRoute() {
        if($_SERVER['REQUEST_METHOD'] != "POST") {
            return Constant::$RETURN_FAIL;
        }
        else {

            if(!isset($_POST['routeTitle']) || !isset($_POST['routeClass']) || !isset($_POST['routeDetail'])
                || !isset($_POST['centerLocation']) || !isset($_POST['points']) || !isset($_POST["routeType"])) {
                return Constant::$RETURN_FAIL;
            }

            $routeTitle = $_POST['routeTitle'];
            $routeClass = $_POST['routeClass'];
            $routeDetail = $_POST['routeDetail'];
            $centerLocation = $_POST['centerLocation'];
            $points = $_POST['points'];
            $routeId = $_POST['routeId'];
            $formerAreaId = $_POST['areaId'];
            $routeType = $_POST["routeType"];
            // echo $formerAreaId." ".$routeClass;
            if($routeId != "") {
                try {
                    DB::beginTransaction();
                    $route = HwRoute::find($routeId);
                    $route->route_title = $routeTitle;
                    $route->route_description = $routeDetail;
                    $route->route_area_id = $routeClass;
                    $route->route_points = $points;
                    $route->route_location = $centerLocation;
                    $route->route_length = Util::getTotalDistance($points);
                    $route->route_type = $routeType;
                    $route->save();

                    $formerArea = HwRouteArea::whereRaw('id = ?', array($formerAreaId))->get();
                    $nowArea = HwRouteArea::whereRaw('id = ?', array($routeClass))->get();
                    // print_r($formerArea);
                    $formerArea[0]->route_num = $formerArea[0]->route_num - 1;
                    $nowArea[0]->route_num = $nowArea[0]->route_num + 1;
                    $formerArea[0]->save();
                    $nowArea[0]->save();
                    DB::commit();
                } catch(Exception $e) {
                    return $e->getTraceAsString();
                    // return Constant::$RETURN_FAIL;
                }

                return Constant::$RETURN_SUCCESS;

            } else {
                DB::beginTransaction();

                $area = HwRouteArea::whereRaw('id = ?', array($routeClass))->get();
                if(count($area) != 1) {
                    DB::rollback();
                    return Constant::$RETURN_FAIL;
                }

                $area[0]->route_num = $area[0]->route_num + 1;
                $area[0]->save();

                $hwRoute = new HwRoute();
                $hwRoute->route_description = $routeDetail;
                $hwRoute->route_location = $centerLocation;
                $hwRoute->route_points = $points;
                $hwRoute->is_lock = Constant::$UNLOCK;
                $hwRoute->participate_number = 0;
                $hwRoute->route_area_id = $routeClass;
                $hwRoute->route_title = $routeTitle;
                $hwRoute->route_type = $routeType;
                $hwRoute->route_length = Util::getTotalDistance($points);

                $hwRoute->save();
                $id = $hwRoute->id;
                if(!isset($id) || $id <= 0) {
                    DB::rollback();
                    return Constant::$RETURN_FAIL;
                }
                else {
                    DB::commit();
                    return Constant::$RETURN_SUCCESS;
                }
            }



        }
    }
}