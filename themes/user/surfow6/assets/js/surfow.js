var Browsing_Area = {
    window_area: null,
    window_name: "",
    url: null,
    counter: null,
    close_status: null,
    browsing_tick: null,
    on_close: function(){},
    duration_intv: null,
    progress_intv: null
};
var Surfow_Session = {
    start: function(success = function(){}, error = function(){ return false; }) {
        Browsing_Area.window_name = "surfow_"+Math.floor(Math.random() * Math.floor(999));
        Browsing_Area.window_area = window.open("about:blank", Browsing_Area.window_name, "", true);
        if(Browsing_Area.window_area == null)
        {
            return error();
        } else {
            Browsing_Area.close_status = false;
            if(Browsing_Area.close_status != true)
            {
                Browsing_Area.browsing_tick = setInterval(function() {
                    if(Browsing_Area.window_area != null)
                    {
                        if (Browsing_Area.window_area.closed) {
                          clearInterval(Browsing_Area.browsing_tick);
                          Browsing_Area.close_status = true;
                          Browsing_Area.window_area = null;
                          Browsing_Area.on_close();
                        }
                    }
                }, 200);
            }
            Browsing_Area.window_area.focus();
            return success();
        }
    },
    update: function(url, error = function(){ return false; }) {
        if(Browsing_Area.window_area == null)
        {
            Browsing_Area.window_area = null;
            return error();
        } else {
            Browsing_Area.window_area.location = url;
        }
	},
	stop: function(error = function(){ return false; }) {
        if(!Browsing_Area.close_status && Browsing_Area.window_area != null)
        {
            Browsing_Area.window_area.close();
            Browsing_Area.window_area = null;
            clearInterval(Browsing_Area.browsing_tick);
            Browsing_Area.on_close();
        } else {
            return error();
        }
    },
    is_closed: function() {
        return Browsing_Area.close_status;
    },
    on_closed: function(callback = function(){}) {
        Browsing_Area.on_close = function(){ callback(); };
    },
    status: function(error = function(){ return false; }) {
        if(Browsing_Area.window_area != null)
        {
            return Browsing_Area.window_area;
        } else {
            return error();
        }
    },
    progress: function(duration, progress_callback/* = function(){}*/, duration_callback = function(){})
    {
        clearInterval(Browsing_Area.progress_intv);
        clearInterval(Browsing_Area.duration_intv);

        var current_duration = duration;
        //var current_progress = 0;
        //progress_callback(current_progress);
        duration_callback(current_duration);
        //var progress_timer = ((100/(duration))*100);
        /*Browsing_Area.progress_intv = setInterval(function(){
            if(current_progress >= 100)
            {
                clearInterval(Browsing_Area.progress_intv);
                Browsing_Area.progress_intv = null;
            }
            current_progress = current_progress+1;
            if(current_progress <= 100){
                progress_callback(current_progress);
            }
        }, progress_timer);*/
        progress_callback.style = "width:0%; transition:none !important";
        setTimeout(function(){
            progress_callback.style = "width:100%; transition:"+Math.floor(duration)+"s !important";
        }, 500);
        Browsing_Area.duration_intv = setInterval(function(){
            current_duration--;
            if(current_duration <= 0)
            {
                clearInterval(Browsing_Area.duration_intv);
                Browsing_Area.duration_intv = null;
            }
            if(current_duration >= 0){
                duration_callback(current_duration);
            }
        }, 1000);
    }
}
