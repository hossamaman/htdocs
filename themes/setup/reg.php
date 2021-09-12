<?php include("header.php"); ?>
<?php include("head.php"); ?>
<div id="content" class="sd-content siimple-content--large">
    <h3>Updating license</h3>
    <div class="siimple-grid">
        <div class="surfow_alert"></div>
        <form class="license_configure" method="post" >
        <div class="siimple-grid-row">
            <div class="siimple-grid-col siimple-grid-col--8 siimple-grid-col--sm-12">
                <div style="padding-top:0;padding-bottom:10px;" class="siimple-jumbotron">
                    <div class="siimple-jumbotron-subtitle siimple--color-primary">Looks like your files moved</div>
                    <div class="siimple-jumbotron-detail">current license is not valid for this path, you must update your license once the path changed for security reasons</div>
                </div>
            </div>
            <div class="siimple-grid-col siimple-grid-col--4 siimple-grid-col--sm-12">
                <div class="siimple-field">
                    <div class="siimple-field-label">Purchase code</div>
                    <input required="" type="text" value="" name="reg_code" class="siimple-input siimple-input--fluid" placeholder="XXXXXXXXXXXXXXX....">
                    <div class="siimple-field-helper">your purchase code, provided by codecanyon</div>
                </div>
                <div class="sd-navigation">
                    <a style="display:none;" class="showloading sd-navigation-prev" href="<?php echo url; ?>?back=true">
                        <div class="sd-navigation-title">Previous</div>
                        <div class="sd-navigation-detail">...</div>
                    </a>
                    <a class="sd-navigation-next" onclick="$('.license_submit').click();" href="javascript:void(0);">
                        <div class="sd-navigation-title">Next</div>
                        <div class="sd-navigation-detail">Update license</div>
                    </a>
                </div>
                <input class="license_submit" style="opacity:0;" type="submit" value="" />
            </div>

            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.license_configure').submit(function(e){
        e.preventDefault();
        var data = $(this).serialize();
        $('.surfow_loading').fadeIn(300);
        setTimeout(function(){
            $.ajax({
                url: "<?php echo url; ?>",
                method: "POST",
                data: data,
                success: function(data){
                    if(data["status"])
                    {
                        window.location = data["message"];
                    } else {
                        $('.surfow_loading').fadeOut(200);
                        $('.surfow_alert').html(""+data["message"]).addClass("siimple-alert siimple-alert--error");
                    }
                },
                error: function(){
                    $('.surfow_loading').fadeOut(200);
                    $('.surfow_alert').html("somthing went wrong...").addClass("siimple-alert siimple-alert--error");
                }
            });
        }, 500);
    });
});
</script>
<?php include("footer.php"); ?>
