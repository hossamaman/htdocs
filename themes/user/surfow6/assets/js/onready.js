var wait_before_send = null;
$(document).ready(function() {

    $("a[href*='t-exchange://']").click(function(e)
    {
        var openurl = $(this).attr("href");
        e.preventDefault();
        window.protocolCheck($(this).attr("href"), function () {
            alert("You must download and install the exchange software");
        }, function () {
            //window.location = openurl;
        });
        e.preventDefault ? e.preventDefault() : e.returnValue = false;
    });

    $(".page-main").css({
        "min-height" : Math.floor($(window).height() - 155)+"px"
    });

    $(window).resize(function(){
        $(".page-main").css({
            "min-height" : Math.floor($(window).height() - 155)+"px"
        });
    });

    if($("#headerMenuCollapse").is(':visible'))
    {
        $("#headerMenuCollapse").css({"z-index":"99999999999999"});
        $("#headerMenuCollapse").stick_in_parent();
    }
    $(window).resize(function(){
        if(!$("#headerMenuCollapse").is(':visible'))
        {
            $("#headerMenuCollapse").trigger("sticky_kit:detach");
        } else {
            $("#headerMenuCollapse").stick_in_parent();
        }
    });

    $(".surfow_ajaxform").submit(function(e){
        e.preventDefault();
        var alert   = $(this).find(".surfow_alert");
        var loading = $(this).find(".surfow_submit");
        var action  = $(this).data("action");
        var type    = $(this).data("type");
        var method  = $(this).data("method");
        var redirect  = $(this).data("redirect");
        loading.attr({"disabled":"disabled"}).addClass("btn-loading");
        surfow_request(method, type, action, $(this).serialize(), function(returned){
            if(returned != null)
            {
                if(returned["type"] == "success")
                {
                    surfow_alert(alert, "success", returned["message"]);
                    if(redirect.length > 7) {
                        setTimeout(function(){
                            surfow_redirect(redirect);
                        }, 1000);
                    } else {
                        loading.removeAttr("disabled").removeClass("btn-loading");
                    }
                } else {
                    loading.removeAttr("disabled").removeClass("btn-loading");
                    surfow_alert(alert, "danger", returned["message"]);
                }
            } else {
                loading.removeAttr("disabled").removeClass("btn-loading");
                surfow_alert(alert, "warning", app_network_error);
            }
        });
    });

    $(".surfow_getredirect").submit(function(e){
        e.preventDefault();
        var alert   = $(this).find(".surfow_alert");
        var loading = $(this).find(".surfow_submit");
        var action  = $(this).data("action");
        var type    = $(this).data("type");
        var method  = $(this).data("method");
        loading.attr({"disabled":"disabled"}).addClass("btn-loading");
        surfow_request(method, type, action, $(this).serialize(), function(returned){
            if(returned != null)
            {
                if(returned["type"] == "success")
                {
                    if(returned["message"].length > 7) {
                        surfow_redirect(returned["message"]);
                    } else {
                        loading.removeAttr("disabled").removeClass("btn-loading");
                    }
                } else {
                    loading.removeAttr("disabled").removeClass("btn-loading");
                    surfow_alert(alert, "danger", returned["message"]);
                }
            } else {
                loading.removeAttr("disabled").removeClass("btn-loading");
                surfow_alert(alert, "warning", app_network_error);
            }
        });
    });

    $(".website_status_toggle").click(function(e){
        e.preventDefault();
        var ele = $(this);
        var id = ele.data("id");
        var alert = $("#surfow_alert");
        var action = "";

        ele.attr({"disabled":"disabled"}).addClass("btn-loading");
        if(ele.find("i").hasClass("fe-play"))
        {
            action = "play";
        } else {
            action = "pause";
        }

        surfow_request("post", "user", "website-status", "id="+id+"&action="+action, function(returned){
            ele.removeAttr("disabled").removeClass("btn-loading");
            if(returned != null)
            {
                if(returned["type"] == "success")
                {
                    if(ele.find("i").hasClass("fe-play"))
                    {
                        ele.find("i").removeClass("fe-play").addClass("fe-pause");
                    } else {
                        ele.find("i").removeClass("fe-pause").addClass("fe-play");
                    }
                } else {
                    surfow_alert(alert, "danger", returned["message"]);
                }
            } else {
                surfow_alert(alert, "warning", app_network_error);
            }
        });
    });

    $(".website_delete").click(function(e){
        e.preventDefault();
        var ele = $(this);
        var id = ele.data("id");
        var main_ele = ele.data("ele");
        var alert = $("#surfow_alert");
        var action = "";

        if(!ele.find("span").hasClass("surfow_hide"))
        {
            ele.attr({"disabled":"disabled"}).addClass("btn-loading");
            surfow_request("post", "user", "website-delete", "id="+id, function(returned){
                ele.removeAttr("disabled").removeClass("btn-loading");
                if(returned != null)
                {
                    if(returned["type"] == "success")
                    {
                        $(main_ele).slideUp(300);
                        setTimeout(function(){ $(main_ele).remove(); }, 300);
                    } else {
                        surfow_alert(alert, "danger", returned["message"]);
                    }
                } else {
                    surfow_alert(alert, "warning", app_network_error);
                }
            });
        } else
        {
            ele.find("span").fadeIn(300).removeClass("surfow_hide");
        }
    });

    $(".address_delete").click(function(e){
        e.preventDefault();
        var ele = $(this);
        var id = ele.data("id");
        var main_ele = ele.data("ele");
        var alert = $("#surfow_alert");

        $(main_ele).addClass("active");
        surfow_request("post", "user", "delete-address", "id="+id, function(returned){
            if(returned != null)
            {
                if(returned["type"] == "success")
                {
                    $(main_ele).slideUp(300);
                    setTimeout(function(){ $(main_ele).remove(); }, 300);
                } else {
                    $(main_ele).removeClass("active");
                    surfow_alert(alert, "danger", returned["message"]);
                }
            } else {
                $(main_ele).removeClass("active");
                surfow_alert(alert, "warning", app_network_error);
            }
        });
    });

    $(".card_delete").click(function(e){
        e.preventDefault();
        var ele = $(this);
        var id = ele.data("id");
        var main_ele = ele.data("ele");
        var alert = $("#surfow_alert");

        $(main_ele).addClass("active");
        surfow_request("post", "user", "delete-card", "id="+id, function(returned){
            if(returned != null)
            {
                if(returned["type"] == "success")
                {
                    $(main_ele).slideUp(300);
                    setTimeout(function(){ $(main_ele).remove(); }, 300);
                } else {
                    $(main_ele).removeClass("active");
                    surfow_alert(alert, "danger", returned["message"]);
                }
            } else {
                $(main_ele).removeClass("active");
                surfow_alert(alert, "warning", app_network_error);
            }
        });
    });

    $(".session_delete").click(function(e){
        e.preventDefault();
        var ele = $(this);
        var id = ele.data("id");
        var main_ele = ele.data("ele");
        var alert = $("#surfow_alert");

        $(main_ele).addClass("active");
        surfow_request("post", "user", "delete-session", "id="+id, function(returned){
            if(returned != null)
            {
                if(returned["type"] == "success")
                {
                    $(main_ele).slideUp(300);
                    setTimeout(function(){ $(main_ele).remove(); }, 300);
                } else {
                    $(main_ele).removeClass("active");
                    surfow_alert(alert, "danger", returned["message"]);
                }
            } else {
                $(main_ele).removeClass("active");
                surfow_alert(alert, "warning", app_network_error);
            }
        });
    });

    $('.select_currency').change(function(e){
        e.preventDefault();
        var new_currency = $(this).val();
        var currency_url = $(this).data("url");
        window.location = currency_url+'?currency='+new_currency;
    });

    $('.loading-onclick').click(function(){
        $(this).addClass("btn-loading");
    });
});
