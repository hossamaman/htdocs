<?php include("header.php"); ?>
<?php include("head.php"); ?>
<div id="content" class="sd-content siimple-content--large">
    <h3>License</h3>
    <div class="siimple-grid">
        <div class="surfow_alert"></div>
        <form class="license_configure" method="post" >
        <div class="siimple-grid-row">
            <div class="siimple-grid-col siimple-grid-col--8 siimple-grid-col--sm-12">
                <div style="padding-top:0;padding-bottom:10px;" class="siimple-jumbotron">
                    <div class="siimple-jumbotron-subtitle siimple--color-primary">Regular license</div>
                    <div class="siimple-jumbotron-detail"><a class="sd-content-typo-link" href="https://codecanyon.net/licenses/terms/regular" target="_blank" >read more</a> about the regular license</div>
                </div>
                <div class="siimple-tip siimple-tip--grey" >
                    <span class="siimple-tag siimple-tag--success">YOU CAN</span>
                    <div style="margin-bottom:0px;" class="siimple-list" >
                        <div class="siimple-list-item" >use this item for one of your own business (or one client)</div>
                        <div class="siimple-list-item" >freely customize it for personal use</div>
                        <div class="siimple-list-item" >hire me or any other developer to customize it for you</div>
                    </div>
                </div>

                <div class="siimple-tip siimple-tip--grey" >
                    <span class="siimple-tag siimple-tag--error">YOU CAN'T</span>
                    <div style="margin-bottom:0px;" class="siimple-list" >
                        <div class="siimple-list-item" >use this item for multiple projects (even personal projects)</div>
                        <div class="siimple-list-item" >"multi-use" the license</div>
                        <div class="siimple-list-item" >allow the end user to access or download the source code</div>
                        <div class="siimple-list-item" >sell or re-distribute this item except to one client, you will need the Extended License for multiple clients/projects</div>
                    </div>
                </div>

                <div style="padding-top:0;padding-bottom:10px;" class="siimple-jumbotron">
                    <div class="siimple-jumbotron-subtitle siimple--color-primary">Extended license</div>
                    <div class="siimple-jumbotron-detail"><a class="sd-content-typo-link" href="https://codecanyon.net/licenses/terms/extended" target="_blank" >read more</a> about the extended license</div>
                </div>
                <div class="siimple-tip siimple-tip--grey" >
                    <span class="siimple-tag siimple-tag--success">YOU CAN</span>
                    <div style="margin-bottom:0px;" class="siimple-list" >
                        <div class="siimple-list-item" >develop one single sellable/licensable End Product (mentioned <a class="sd-content-typo-link" href="https://codecanyon.net/licenses/terms/extended" target="_blank" >here</a>)</div>
                        <div class="siimple-list-item" >modify or manipulate the Item</div>
                        <div class="siimple-list-item" >combine the Item with other works and make a derivative work from it</div>
                        <div class="siimple-list-item" >sell and make any number of copies of the single End Product</div>
                    </div>
                </div>

                <div class="siimple-tip siimple-tip--grey" >
                    <span class="siimple-tag siimple-tag--error">YOU CAN'T</span>
                    <div style="margin-bottom:0px;" class="siimple-list" >
                        <div class="siimple-list-item" >use the Item to create more than one unique End Product</div>
                        <div class="siimple-list-item" >"multi-use" the license</div>
                        <div class="siimple-list-item" >re-distribute the Item as stock, in a tool or template, or with source files. You can’t do this with an Item either on its own or bundled with other items, and even if you modify the Item. You can’t re-distribute or make available the Item as-is or with superficial modifications.</div>
                    </div>
                </div>

                <div style="padding-top:0;padding-bottom:10px;" class="siimple-jumbotron">
                    <div class="siimple-jumbotron-subtitle siimple--color-primary">Purchase code !!</div>
                    <div class="siimple-jumbotron-detail">this is how to find your purchase code</div>
                </div>
                <iframe class="wistia_embed" src="//fast.wistia.net/embed/iframe/9w90nzsgbf" name="wistia_embed" scrolling="no" allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen" webkitallowfullscreen="webkitallowfullscreen" oallowfullscreen="oallowfullscreen" msallowfullscreen="msallowfullscreen" width="640" height="360" frameborder="0"></iframe>
                <br><a class="sd-content-typo-link" href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code-" target="_blank">video source</a>
            </div>
            <div class="siimple-grid-col siimple-grid-col--4 siimple-grid-col--sm-12">
                <?php if(!$GLOBALS["is_product_registered"]): ?>
                <div class="siimple-field">
                    <div class="siimple-field-label">Purchase code</div>
                    <input required="" type="text" value="" name="purchase_code" class="siimple-input siimple-input--fluid" placeholder="XXXXXXXXXXXXXXX....">
                    <div class="siimple-field-helper">your purchase code, provided by codecanyon</div>
                </div>
                <div class="sd-navigation">
                    <a class="showloading sd-navigation-prev" href="<?php echo url; ?>?back=true">
                        <div class="sd-navigation-title">Previous</div>
                        <div class="sd-navigation-detail">Database</div>
                    </a>
                    <a class="sd-navigation-next" onclick="$('.license_submit').click();" href="javascript:void(0);">
                        <div class="sd-navigation-title">Next</div>
                        <div class="sd-navigation-detail">Continue</div>
                    </a>
                </div>
                <input class="license_submit" style="opacity:0;" type="submit" value="" />
            <?php else: ?>
                <div class="siimple-field">
                    <div style="color:#4acf7f;font-size:1.6em;" class="siimple-field-label">Registred</div>
                    <div class="siimple-field-helper">your website is activated</div>
                </div>
                <div class="sd-navigation">
                    <a class="showloading sd-navigation-prev" href="<?php echo url; ?>?back=true">
                        <div class="sd-navigation-title">Previous</div>
                        <div class="sd-navigation-detail">Database</div>
                    </a>
                    <a class="sd-navigation-next complete_installation" href="javascript:void(0);">
                        <div class="sd-navigation-title">Install</div>
                        <div class="sd-navigation-detail">Complete installation</div>
                    </a>
                </div>
            <?php endif; ?>
            </div>

            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.complete_installation').click(function(e){
        var data = "process_installation=true";
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
