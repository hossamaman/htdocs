<?php include("header.php"); ?>
<?php include("head.php"); ?>
<div id="content" class="sd-content siimple-content--large">
    <div style="text-align:center;padding: 60px 0px;"  >
        <a id="check_requirements" style="height:55px;line-height:55px;padding: 0px 30px;" class="siimple-btn siimple-btn--grey flipInX animated">
            <?php if(setup_type == "new_installation"){
                 echo "Install ".htmlentities(_script_name)." ".htmlentities(_script_version);
             } else if(setup_type == "upgrade") {
                 echo "Upgrade to ".htmlentities(_script_name)." ".htmlentities(_script_version);
             } ?>
        </a>
    </div>
    <div id="append_area" class="siimple-list siimple-list--hover" style="max-width:100%;">
    </div>
    <div id="result" style="display:none;">
        <div style="display:none;" class="done siimple-box siimple-box--success">
            <div class="siimple-box-title">You are ready</div>
            <div class="siimple-box-subtitle">your server meet all requirements</div>
            <br><a href="<?php echo url; ?>?next=true" style="height:55px;line-height:55px;padding: 0px 30px;" class="showloading siimple-btn siimple-btn--grey flipInX animated">Continue</a>
        </div>
        <div style="display:none;" class="error siimple-box siimple-box--error">
            <div class="siimple-box-title">Sorry! You are missing some requirements</div>
            <div class="siimple-box-subtitle">Get them fixed or just Contact your hosting provider to fix them if possible or move to a different host that meets all the requirements stated above</div>
            <br><a id="refresh" style="height:55px;line-height:55px;padding: 0px 30px;" class="siimple-btn siimple-btn--grey flipInX animated">Try check again</a>
        </div>
    </div>
</div>
<script>
function scroll_content(data)
{
    $("html, body").delay(300).animate({
        scrollTop: $(data).offset().top
    }, 300);
}

$(document).ready(function(){
    $('#check_requirements, #refresh').click(function(){
        scroll_content('body');
        $('.surfow_loading').fadeIn(100);
        var ele_append = $("#append_area");
        ele_append.html("");
        $('#result, #result .done, #result .error').hide();
        setTimeout(function(){
            $.ajax({
                url: "<?php echo url; ?>",
                method: "POST",
                data: "check=requirements",
                success: function(data){
                    $('#check_requirements').parent().fadeOut(100);
                    ele_append.css({
                        "min-height":"800px"
                    });
                    scroll_content('#content');
                    $('.surfow_loading').fadeOut(100);
                    var time = 200;
                    $.each(data.report, function(key, item) {
                        var one = item;
                        setTimeout(function(){

                            if(one.status)
                            {
                                content = '<div class="siimple-list-item flipInX animated">';
                                content += '<span class="siimple-tag siimple-tag--success siimple-tag--rounded">PASSED</span>';
                                error_class_start = '';
                                error_class_end = '';
                            } else {
                                content = '<div class="siimple-list-item fadeIn animated">';
                                content += '<span class="siimple-tag siimple-tag--error siimple-tag--rounded">REQUIRED</span>';
                                error_class_start = '<br><div class="siimple-alert siimple-alert--error">';
                                error_class_end = '</div>';
                            }
                            content += '<div class="siimple-list-title" >'+one.title+'</div>';
                            content += '<div class="siimple-list-description" >'+error_class_start+one.message+error_class_end+'</div>';
                            content += '</div>';
                            ele_append.append(content);
                            if(data.report.length == Math.floor(key+1))
                            {
                                $('#result').fadeIn(100);
                                if(data.result)
                                {
                                    $('#result .done').fadeIn(100);
                                } else {
                                    $('#result .error').fadeIn(100);
                                }

                            }
                        },  time);
                        time += 200;
                    });
                },
                error: function(){
                    $('.surfow_loading').fadeOut(100);
                    ele_append.html("somthing went wrong...").css({"color":"red"});
                }
            });
        }, 200);
    });
});
</script>
<?php include("footer.php"); ?>
