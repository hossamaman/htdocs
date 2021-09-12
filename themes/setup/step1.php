<?php include("header.php"); ?>
<?php include("head.php"); ?>
<div id="content" class="sd-content siimple-content--large">
    <h3>Database configuration</h3>
    <div class="siimple-grid">
        <div class="surfow_alert"></div>
        <form class="db_configure" method="post" >
        <div class="siimple-grid-row">
            <div class="siimple-grid-col siimple-grid-col--8 siimple-grid-col--sm-12">
                <div class="siimple-field">
                    <div class="siimple-field-label">Database Host</div>
                    <input required="" type="text" value="<?php echo htmlentities($GLOBALS["_SETTINGS"]["DB"]["HOST"]); ?>" name="db_host" class="siimple-input siimple-input--fluid" placeholder="localhost">
                    <div class="siimple-field-helper">eg: localhost or sql.mysite.com ...</div>
                </div>
                <div class="siimple-field">
                    <div class="siimple-field-label">Database Name</div>
                    <input required="" type="text" value="<?php echo htmlentities($GLOBALS["_SETTINGS"]["DB"]["NAME"]); ?>" name="db_name" class="siimple-input siimple-input--fluid" placeholder="Name of an existing database">
                    <div class="siimple-field-helper">this database should be exists before continue</div>
                </div>
                <div class="siimple-field">
                    <div class="siimple-field-label">Database User</div>
                    <input required="" type="text" value="<?php echo htmlentities($GLOBALS["_SETTINGS"]["DB"]["USER"]); ?>" name="db_user" class="siimple-input siimple-input--fluid" placeholder="an user that linked to the database above">
                    <div class="siimple-field-helper">this user must be linked to the database </div>
                </div>
                <div class="siimple-field">
                    <div class="siimple-field-label">Database Password</div>
                    <input type="text" value="<?php echo htmlentities($GLOBALS["_SETTINGS"]["DB"]["PASS"]); ?>" name="db_pass" class="siimple-input siimple-input--fluid" placeholder="database password">
                    <div class="siimple-field-helper">the password of the user above</div>
                </div>
                <div class="siimple-field-label">Admin Path</div>
                <label style="display:inline-block;height:34px;line-height:34px;font-size:17px;font-weight:300;color:#ffffff;padding-left:10px;padding-right:10px;padding-top:0;padding-bottom:0;border:0;border-radius:5px;outline:0;background-color:#6574cd;vertical-align:top;box-sizing:border-box;" class="siimple-label"><?php echo url; ?></label>
                <input required="" type="text" style="border-bottom-left-radius:0;border-top-left-radius:0;margin-left: -10px;" name="sys_admin" class="siimple-input" value="<?php echo htmlentities($GLOBALS["_SETTINGS"]["ADMINPATH"]); ?>" placeholder="control">
            </div>
            <div class="siimple-grid-col siimple-grid-col--4 siimple-grid-col--sm-12">
                <div class="siimple-field">
                    <div class="siimple-field-label">Database Engine</div>
                    <select required="" name="db_engine" class="siimple-select siimple-select--fluid">
                        <?php
                        $engines = list_db_engine();
                        if(!empty($engines) && is_array($engines)) {
                            foreach($engines as $engine)
                            {
                                echo "<option value='".$engine."'>".strtoupper($engine)."</option>";
                            }
                        } ?>
                    </select>
                    <div class="siimple-field-helper">PDO always wins this battle with ease</div>
                </div>
                <div class="siimple-field">
                    <div class="siimple-field-label">Timezone</div>
                    <select required="" name="sys_timezone" class="siimple-select siimple-select--fluid">
                        <?php
                        $zones = list_timezones();
                        if(!empty($zones) && is_array($zones)) {
                            foreach($zones as $key => $zone)
                            {
                                echo "<option value='".$key."'>".htmlentities($zone)."</option>";
                            }
                        } ?>
                    </select>
                    <div class="siimple-field-helper">Select your default timezone</div>
                </div>
                <div class="siimple-field">
                    <div class="siimple-field-label">Protocol</div>
                    <select required="" name="sys_protocol" class="siimple-select siimple-select--fluid">
                        <?php
                        $prots = list_protocol();
                        if(!empty($prots) && is_array($prots)) {
                            foreach($prots as $prot)
                            {
                                echo "<option value='".$prot."'>".strtoupper($prot)."</option>";
                            }
                        } ?>
                    </select>
                    <div class="siimple-field-helper">Select your default protocol</div>
                </div>
                <div class="sd-navigation">
                    <a class="showloading sd-navigation-prev" href="<?php echo url; ?>?back=true">
                        <div class="sd-navigation-title">Previous</div>
                        <div class="sd-navigation-detail">Requirements</div>
                    </a>
                    <a class="sd-navigation-next" onclick="$('.db_configure_submit').click();" href="javascript:void(0);">
                        <div class="sd-navigation-title">Next</div>
                        <div class="sd-navigation-detail">Continue</div>
                    </a>
                </div>
                <input class="db_configure_submit" style="opacity:0;" type="submit" value="" />
            </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.db_configure').submit(function(e){
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
