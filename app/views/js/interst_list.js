/**
 * Created by bao on 2014/12/28.
 */


$(document).ready(function() {

    /*
      click the lock button
     */
    $(document).on("click", ".lock-btn",function(e) {
        var id = $(e.target).attr("id").substr(8);
        $.post("interst_action", {"id": id, "type": "lock-action"}, function(data) {
            if(data == "success") {
                alert("禁用成功");
                $("#switch-btn").html("<td><button type=\"button\" class=\"btn btn-info unlock-btn\" id=\"unlock-btn" + id + "\">启动</button></td>");
            } else {
                alert("操作失败");
            }
        });
    });
    /*
    $(".lock-btn").click(function(e) {
        var id = $(e.target).attr("id").substr(8);
        $.post("interst_action", {"id": id, "type": "lock-action"}, function(data) {
            if(data == "success") {
                alert("禁用成功");
                $("#switch-btn").html("<td><button type=\"button\" class=\"btn btn-info unlock-btn\" id=\"unlock-btn" + id + "\">启动</button></td>");
            } else {
                alert("操作失败");
            }
        });
    });
    */
    $(document).on("click", ".unlock-btn", function(e) {
        var id = $(e.target).attr("id").substr(10);
        $.post("interst_action", {"id": id, "type": "unlock-action"}, function(data) {
            if(data == "success") {
                alert("启动成功");
                $("#switch-btn").html("<td><button type=\"button\" class=\"btn btn-danger lock-btn\" id=\"lock-btn" + id + "\">禁用</button></td>");
            } else {
                alert("操作失败");
            }
        });
    });
    /*
    $(".unlock-btn").click(function(e) {
        var id = $(e.target).attr("id").substr(10);
        $.post("interst_action", {"id": id, "type": "unlock-action"}, function(data) {
            if(data == "success") {
                alert("启动成功");
                $("#switch-btn").html("<td><button type=\"button\" class=\"btn btn-danger lock-btn\" id=\"lock-btn" + id + "\">启动</button></td>");
            } else {
                alert("操作失败");
            }
        });
    });
    */
    $(".view-btn").click(function(e) {
        var id = $(e.target).attr("id").substr(8);
        /*
        $.post("interst_action", {"id": id, "type": "view-action"}, function(data) {
            console.log(data);
        });
        */
        post("interst_action", {"id": id, "type": "view-action"});
    });

    $(".edit-btn").click(function(e) {
        var id = $(e.target).attr("id").substr(8);
        /*
        $.post("interst_action", {"id": id, "type": "edit-action"}, function(data) {
            console.log(data);
        });
        */
        post("interst_action", {"id": id, "type": "edit-action"});
    });
});