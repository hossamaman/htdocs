<div class="sd-footer siimple-footer--large">
    <div class="siimple-grid-row">
        <div class="siimple-grid-col siimple-grid-col--12 siimple-grid-col--sm-12">
            <div class="sd-footer-title"><?php echo htmlentities(strtoupper(_script_name)); ?></div>
            <div class="sd-footer-subtitle">
                Current version: <strong><?php echo htmlentities(_script_version); ?></strong>
            </div>
            <div class="sd-footer-subtitle">
                Developer: <strong>Hassan Azzi</strong> | <strong>devknown@gmail.com</strong>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.showloading').click(function(){
        $('.surfow_loading').fadeIn(100);
    });
    $('.surfow_loading').fadeOut(100);
    $("#content").css({
        "min-height" : Math.floor($(window).height() - 575)+"px"
    });
    $(window).resize(function(){
        $("#content").css({
            "min-height" : Math.floor($(window).height() - 575)+"px"
        });
    });
});
</script>
</body>
</html>
