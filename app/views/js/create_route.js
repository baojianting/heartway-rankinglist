/**
 * Created by bao on 2014/12/28.
 */

$(document).ready(function () {


    function check() {
        var routeTitle = $("#routeTitle").val();
        var routeClass = $("#routeClass").val();
        var routeDetail = $("#routeDetail").val();
        var centerLocation = $("#centerLocation").val();
        var points = $("#points").val();
        if(trim(routeTitle) != "" && trim(routeClass) != "" && trim(routeDetail) != "" &&
            trim(centerLocation) != "" && trim(points) != "") {
            return true;
        }
        else {
            return false;
        }
    }

    // click the submit button
    $("#submit").click(function() {

        if(!check()) {
            alert("内容未填写完整，请填写完整");
            return;
        }
        var routeId = $("#hidden-route-id").val();
        var routeTitle = trim($("#routeTitle").val());
        var routeClass = trim($("#routeClass").val());
        var routeDetail = trim($("#routeDetail").val());
        var centerLocation = trim($("#centerLocation").val());
        var points = $("#points").val();
        var areaId = $("#hidden-route-area-id").val();
        var routeType = $("#routeType").val();
        // console.log(routeType);
        // console.log(routeId);
        // console.log(routeTitle + " " + routeClass + " " + routeDetail + " " + centerLocation + " " + points);
        // post("add_route", {"areaId": areaId, "routeId": routeId, "routeTitle": routeTitle, "routeClass": routeClass, "routeDetail": routeDetail,
        //    "centerLocation": centerLocation, "points": points});

        $.post("add_route", {"areaId": areaId, "routeId": routeId, "routeTitle": routeTitle, "routeClass": routeClass, "routeDetail": routeDetail,
            "centerLocation": centerLocation, "points": points, "routeType": routeType}, function (data) {
            // console.log(data);
            if(data == "success") {
                alert("操作成功");
                window.location.href="new_route";
            } else {
                console.log(data);
                alert("操作失败");
            }
        });

    });
});