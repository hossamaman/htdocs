var wait_before_send = null;
$(document).ready(function() {

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
        if($(this).find(".surfow_alert").length > 0)
        {
            var alert   = $(this).find(".surfow_alert");
        } else {
            var alert   = $("#surfow_alert");
        }
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
                        }, 600);
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

    $(".plugin_action").click(function(e){
        e.preventDefault();
        var ele = $(this);
        var key = ele.data("key");
        var action = ele.data("action");
        var redirect = ele.data("redirect");
        var alert = $("#surfow_alert");

        var check = confirm(app_check_message.toString());
        if(check)
        {
            ele.parent().parent().parent().parent().parent()
            .css({"position":"fixed"})
            .addClass("card-fullscreen")
            .addClass("active");

            surfow_request("post", "user", "manage-plugin", "key="+key+"&action="+action, function(returned){
                if(returned != null)
                {
                    if(returned["type"] == "success")
                    {
                        surfow_redirect(redirect);
                    } else {
                        surfow_alert(alert, "danger", returned["message"]);
                        ele.parent().parent().parent().parent().parent()
                        .css({"position":"relative"})
                        .removeClass("card-fullscreen")
                        .removeClass("active");
                    }
                } else {
                    surfow_alert(alert, "warning", app_network_error);
                    ele.parent().parent().parent().parent().parent()
                    .css({"position":"relative"})
                    .removeClass("card-fullscreen")
                    .removeClass("active");
                }
            });
        }
    });

    $(".manage_currency").click(function(e){
        e.preventDefault();
        var main_ele = $(this).parent().parent();
        var ele = $(this);
        var alert  = $("#surfow_alert");

        var action = $(this).data("action");
        var code = main_ele.find("input[name=code]").val();


        if(action == "delete")
        {
            var check = confirm(app_check_message.toString());
            var data = "action=delete&code="+code;
        } else {
            var name = main_ele.find("input[name=name]").val();
            var value = main_ele.find("input[name=value]").val();
            var check = true;
            var data = "action=edit&code="+code+"&name="+name+"&value="+value;
        }

        if(check)
        {
            ele.attr({"disabled":"disabled"}).addClass("btn-loading");
            surfow_request("post", "user", "manage-currencies", data, function(returned){
                if(returned != null)
                {
                    if(returned["type"] == "success")
                    {
                        if(action == "delete")
                        {
                            main_ele.fadeOut(300);
                            setTimeout(function(){
                                surfow_alert(alert, "success", returned["message"]);
                                ele.removeAttr("disabled").removeClass("btn-loading");
                                main_ele.remove();
                            }, 400)
                        } else {
                            ele.removeAttr("disabled").removeClass("btn-loading");
                            ele.find("i").removeClass("fe-save").addClass("fe-check");
                            setTimeout(function(){
                                ele.find("i").removeClass("fe-check").addClass("fe-save");
                            }, 1000);
                        }

                    } else {
                        ele.removeAttr("disabled").removeClass("btn-loading");
                        surfow_alert(alert, "danger", returned["message"]);
                    }
                } else {
                    ele.removeAttr("disabled").removeClass("btn-loading");
                    surfow_alert(alert, "warning", app_network_error);
                }
            });
        }
    });

    $('.item_action').click(function(){
        var target = $(this).data("target");
        var action = $(this).data("action");
        var table = $(this).data("table");
        var id = $(this).data("id");
        var enable_btn = $('#enable_'+target);
        var disable_btn = $('#disable_'+target);
        var delete_btn = $('#delete_'+target);
        var selected_item = $('#item_'+target);
        var alert = $('#surfow_alert');

        if(action == "enable" || action == "disable")
        {
            var loading = enable_btn.parent().parent().find("[data-toggle=dropdown] i");
            if(loading.parent().hasClass("btn"))
            {
                loading.parent().addClass("btn-loading");
            } else {
                loading.removeClass("fe").addClass("surfow-loader");
            }
            var data = "table="+table+"&id="+id;
            surfow_request("post", "user", "change-status", data, function(returned){
                if(loading.parent().hasClass("btn"))
                {
                    loading.parent().removeClass("btn-loading");
                } else {
                    loading.removeClass("surfow-loader").addClass("fe");
                }
                if(returned != null)
                {
                    if(returned["type"] == "success")
                    {
                        selected_item.find(".avatar span.avatar-status").toggleClass("bg-danger");
                        selected_item.find(".avatar span.avatar-status").toggleClass("bg-indigo");
                        if(action == "enable")
                        {
                            enable_btn.slideUp(300)
                            disable_btn.slideDown(300);
                        } else {
                            disable_btn.slideUp(300)
                            enable_btn.slideDown(300);
                        }
                    } else {
                        surfow_alert(alert, "danger", returned["message"]);
                    }
                } else {
                    surfow_alert(alert, "warning", app_network_error);
                }
            });
        }

        if(action == "delete")
        {
            var check = confirm(app_check_message.toString());
            if(check)
            {
                var loading = delete_btn.parent().parent().find("[data-toggle=dropdown] i");
                if(loading.parent().hasClass("btn"))
                {
                    loading.parent().addClass("btn-loading");
                } else {
                    loading.removeClass("fe").addClass("surfow-loader");
                }
                var data = "table="+table+"&id="+id;
                surfow_request("post", "user", "delete-item", data, function(returned){
                    if(loading.parent().hasClass("btn"))
                    {
                        loading.parent().removeClass("btn-loading");
                    } else {
                        loading.removeClass("surfow-loader").addClass("fe");
                    }
                    if(returned != null)
                    {
                        if(returned["type"] == "success")
                        {
                            selected_item.fadeOut(500);
                            setTimeout(function(){
                                selected_item.remove();
                            }, 400);
                        } else {
                            surfow_alert(alert, "danger", returned["message"]);
                        }
                    } else {
                        surfow_alert(alert, "warning", app_network_error);
                    }
                });
            }
        }
    });


    $('.item_confirmation').click(function(){
        var target = $(this).data("target");
        var action = $(this).data("action");
        var table = $(this).data("table");
        var val = $(this).data("val");
        var id = $(this).data("id");
        var activate_btn = $('#activate_'+target);
        var deactivate_btn = $('#deactivate_'+target);
        var selected_item = $('#item_'+target);
        var alert = $('#surfow_alert');

        if(action == "activate" || action == "deactivate")
        {
            if(action == "activate")
            {
                var loading = activate_btn;
                var show_item = deactivate_btn;
                var data = "table="+table+"&id="+id+"&col=activated&data="+val;
            } else {
                var loading = deactivate_btn;
                var show_item = activate_btn;
                var data = "table="+table+"&id="+id+"&col=activated&data="+val;
            }

            loading.addClass("btn-loading");
            surfow_request("post", "user", "change-specific", data, function(returned){
                loading.removeClass("btn-loading");
                if(returned != null)
                {
                    if(returned["type"] == "success")
                    {
                        selected_item.find(".card-value i.fe").toggleClass("fe-clock");
                        selected_item.find(".card-value i.fe").toggleClass("fe-activity");
                        loading.fadeOut(100);
                        setTimeout(function(){
                            show_item.fadeIn(300);
                        }, 150);
                    } else {
                        surfow_alert(alert, "danger", returned["message"]);
                    }
                } else {
                    surfow_alert(alert, "warning", app_network_error);
                }
            });
        }
    });

    $('.item_report').click(function(){
        var target = $(this).data("target");
        var action = $(this).data("action");
        var table = $(this).data("table");
        var val = $(this).data("val");
        var id = $(this).data("id");
        var activate_btn = $('#report_'+target);
        var deactivate_btn = $('#remove_report_'+target);
        var selected_item = $('#item_'+target);
        var alert = $('#surfow_alert');

        if(action == "report" || action == "remove_report")
        {
            if(action == "report")
            {
                var loading = activate_btn;
                var show_item = deactivate_btn;
                var data = "table="+table+"&id="+id+"&col=reported&data="+val;
            } else {
                var loading = deactivate_btn;
                var show_item = activate_btn;
                var data = "table="+table+"&id="+id+"&col=reported&data="+val;
            }

            loading.addClass("btn-loading");
            surfow_request("post", "user", "change-specific", data, function(returned){
                loading.removeClass("btn-loading");
                if(returned != null)
                {
                    if(returned["type"] == "success")
                    {
                        selected_item.find(".card-value i.fe").toggleClass("fe-clock");
                        selected_item.find(".card-value i.fe").toggleClass("fe-activity");
                        loading.fadeOut(100);
                        setTimeout(function(){
                            show_item.fadeIn(300);
                        }, 150);
                    } else {
                        surfow_alert(alert, "danger", returned["message"]);
                    }
                } else {
                    surfow_alert(alert, "warning", app_network_error);
                }
            });
        }
    });

    $('.payment_confirmation').change(function(){
        var action = $(this).data("action");
        var id = $(this).data("id");
        var alert = $('#surfow_alert');
        var data = "action="+action+"&id="+id;
        var loading = $(this).parent().parent().parent();

        loading.css({
            "opacity":"0.5",
            "pointer-events":"none"
        });
        surfow_request("post", "user", "manage-payments", data, function(returned){
            loading.css({
                "opacity":"",
                "pointer-events":""
            });
            if(returned != null)
            {
                if(returned["type"] == "success")
                {
                    surfow_alert(alert, "success", loading.data("message"));
                } else {
                    surfow_alert(alert, "danger", returned["message"]);
                }
            } else {
                surfow_alert(alert, "warning", app_network_error);
            }
        });
    });

    $('.homepage_manage').change(function(){
        var action = $(this).data("action");
        var theme = $(this).data("theme");
        var alert = $('#surfow_alert');
        var data = "action="+action+"&theme="+theme;
        var loading = $(this).parent().parent().parent();

        loading.css({
            "opacity":"0.5",
            "pointer-events":"none"
        });
        surfow_request("post", "user", "manage-homepage", data, function(returned){
            loading.css({
                "opacity":"",
                "pointer-events":""
            });
            if(returned != null)
            {
                if(returned["type"] == "success")
                {
                    surfow_alert(alert, "success", returned["message"]);
                } else {
                    surfow_alert(alert, "danger", returned["message"]);
                }
            } else {
                surfow_alert(alert, "warning", app_network_error);
            }
        });
    });

    $('.cancel_purchase').click(function(){
        var id = $(this).data("id");
        var target = $(this).data("target");
        var alert = $('#surfow_alert');
        var data = "id="+id;
        var loading = $(this);
        var item = $('#item_'+target);

        loading.addClass('btn-loading');
        surfow_request("post", "user", "cancel-order", data, function(returned){
            loading.removeClass('btn-loading');
            if(returned != null)
            {
                if(returned["type"] == "success")
                {
                    item.fadeOut(3000);
                    setTimeout(function(){
                        item.remove();
                    }, 350);
                } else {
                    surfow_alert(alert, "danger", returned["message"]);
                }
            } else {
                surfow_alert(alert, "warning", app_network_error);
            }
        });
    });

    $('.referral_confirmation').change(function(){
        var action = $(this).data("action");
        var id = $(this).data("id");
        var alert = $('#surfow_alert');
        var data = "action="+action+"&id="+id;
        var loading = $(this).parent().parent().parent();

        loading.css({
            "opacity":"0.5",
            "pointer-events":"none"
        });
        surfow_request("post", "user", "manage-referrals", data, function(returned){
            loading.css({
                "opacity":"",
                "pointer-events":""
            });
            if(returned != null)
            {
                if(returned["type"] == "success")
                {
                    //
                } else {
                    surfow_alert(alert, "danger", returned["message"]);
                }
            } else {
                surfow_alert(alert, "warning", app_network_error);
            }
        });
    });

});
