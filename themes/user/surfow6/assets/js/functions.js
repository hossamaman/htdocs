let surfow_post = function(url, data, call_post = function(){})
{
	$.ajax({
		url : url,
		type: "POST",
		data: data,
		success: function(surfow_post_response, textStatus, jqXHR)
		{
			call_post(surfow_post_response);
		},
		error: function(jqXHR, textStatus, errorThrown)
		{
			call_post(null);
		}
	});
}

let surfow_get = function(url, call_get = function(){})
{
	$.ajax({
		url : url,
		type: "GET",
		success: function(surfow_post_response, textStatus, jqXHR)
		{
			call_get(surfow_post_response);
		},
		error: function(jqXHR, textStatus, errorThrown)
		{
			call_get(null);
		}
	});
}

let surfow_request = function(request_type, type, action, data, called_request = function(){})
{
	if(type == "user")
    {
        var request_url = app_url + "/api/ajax/user/" + action;
        if(request_type == "post")
        {
            surfow_post(request_url, data, function(res){
                called_request(res);
            });
        } else {
            data != "" ? data = "?"+data : data = "";
            surfow_get(request_url + data, function(res){
                called_request(res);
            });
        }
    }
    else if(type == "guest")
    {
        var request_url = app_url + "/api/ajax/guest/" + action;
        if(request_type == "post")
        {
            surfow_post(request_url, data, function(res){
                called_request(res);
            });
        } else {
            data != "" ? data = "?"+data : data = "";
            surfow_get(request_url + data, function(res){
                called_request(res);
            });
        }
    }
    else {
        called_request(null);
    }
}

let surfow_alert = function(ele, type, text)
{
	if(ele && ele != undefined && ele != null)
	{
		ele.html('<div style="display:none;" class="alert alert-' + type + '" role="alert">' + text.toString() + '</div>');
		setTimeout(function(){ ele.find('div:first').fadeIn(300) }, 30);
		$('html, body').animate({
	        scrollTop: ele.offset().top
	    }, 1000);
	}
}

let surfow_redirect = function(url)
{
	check_url = document.createElement("a"); check_url.href = url.toString();
	if(window.location.host == check_url.host)
	{
		window.location.replace(url);
	} else {
		window.location.replace(app_url);
	}
}

function estimated_visits(seconds, ele="#calculate_visits", pointparams=1)
{
	  var onepointseconds = 60;
	  var defpoints = 10000;
	  var res = Math.floor((onepointseconds/(seconds*pointparams))*defpoints);
	  $(ele).html(res);
}
