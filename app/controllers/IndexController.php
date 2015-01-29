<?php
/**
 * Created by PhpStorm.
 * User: bao
 * Date: 2014/12/27
 * Time: 16:09
 */

class IndexController extends BaseController {

    public function getIndex() {
	if(Session::get("username")!=null){
		$username = Session::get("username");
		$password = Session::get("password");
	}else{
		$username = Input::get('username');
		$password = Input::get('password');
		Session::put('username', $username);
		Session::put('password', $password);
	}
        $allAreas = HwRouteArea::all();

        if(!isset($allAreas)) {
            return View::make("error");
        }

        $dataArr = array();
        foreach($allAreas as $area) {
            $dataArr[$area->name] = $area->route_num;
        }
        return View::make("index")->with(['dataArr'=>$dataArr, 'username'=>Session::get('username'),'password'=>Session::get('password')]);
    }
} 
