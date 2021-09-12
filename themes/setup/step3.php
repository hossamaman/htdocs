<?php include("header.php"); ?>
<?php include("head.php"); ?>
<div id="content" class="sd-content siimple-content--large">
    <div class="siimple-grid">
        <div class="surfow_alert"></div>
        <form class="finish_configure" method="post" >
        <div class="siimple-grid-row">
            <div class="siimple-grid-col siimple-grid-col--8 siimple-grid-col--sm-12">
                <div class="siimple-jumbotron--success">
                    <div class="siimple-jumbotron-subtitle siimple--color-success">Congratulations! </div>
                    <?php if(setup_type == "new_installation"): ?>
                        <div class="siimple-jumbotron-detail">You have successfully installed <?php echo _script_name; ?> <?php echo _script_version; ?></div>
                    <?php endif; ?>
                    <?php if(setup_type == "upgrade"): ?>
                        <div class="siimple-jumbotron-detail">You have successfully upgraded to <?php echo _script_name; ?> <?php echo _script_version; ?></div>
                    <?php endif; ?>
                </div>

            </div>
            <div class="siimple-grid-col siimple-grid-col--4 siimple-grid-col--sm-12">
                <div class="siimple-box">
                    <?php if(setup_type == "new_installation"): ?>
                        <div class="siimple-box-subtitle" >create admin account</div>
                    <?php endif; ?>
                    <?php if(setup_type == "upgrade"): ?>
                        <div class="siimple-box-subtitle" >admin panel</div>
                    <?php endif; ?>
                <div class="sd-navigation">
                    <a style="display:none" class="sd-navigation-prev" href="#">
                        <div class="sd-navigation-title">Previous</div>
                        <div class="sd-navigation-detail">...</div>
                    </a>
                    <?php if(setup_type == "new_installation"): ?>
                        <a class="sd-navigation-next" onclick="$('.finish_submit').click();" href="javascript:void(0);">
                            <div class="sd-navigation-title">Create account</div>
                            <div class="sd-navigation-detail">Continue</div>
                        </a>
                    <?php endif; ?>
                    <?php if(setup_type == "upgrade"): ?>
                        <a class="sd-navigation-next" onclick="$('.finish_submit').click();" href="javascript:void(0);">
                            <div class="sd-navigation-title">Finish</div>
                            <div class="sd-navigation-detail">Continue</div>
                        </a>
                    <?php endif; ?>

                </div>
                </div>
                <input name="finish" type="hidden" value="true" />
                <input class="finish_submit" style="opacity:0;" type="submit" value="" />
            </div>
            </form>
        </div>
        <div style="background-repeat: no-repeat;background-size: auto 100%;background-position: bottom center;min-width: 256px;min-height: 256px;background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBoZWlnaHQ9IjUxMnB4IiB2aWV3Qm94PSItNCAxIDUxMSA1MTEuOTk5OTMiIHdpZHRoPSI1MTJweCI+PHBhdGggZD0ibTI0My40ODQzNzUgMzU1Ljc5Njg3NWgyNi4wMzEyNXYyNi4wMzUxNTZoLTI2LjAzMTI1em0wIDAiIGZpbGw9IiNlYTZiNjUiLz48cGF0aCBkPSJtMjUyLjE1MjM0NCA2MC4yMzQzNzUgNjkuODE2NDA2LTUxLjUzOTA2MyAzNi4wNzQyMTkgNDguODcxMDk0LTY5LjgxMjUgNTEuNTM5MDYzem0wIDAiIGZpbGw9IiNkYzRkNDEiLz48cGF0aCBkPSJtMTY1LjM4MjgxMiAxNDcuNTIzNDM4aDM0LjcxMDkzOHY1Mi4wNzAzMTJoLTM0LjcxMDkzOHptMCAwIiBmaWxsPSIjZjlkN2MwIi8+PHBhdGggZD0ibTEzOS4zNDc2NTYgMTczLjU1ODU5NC0zNC43MTA5MzctMzQuNzEwOTM4LTEzLjc2NTYyNS00OC4xNjQwNjJjLTIuMTI4OTA2LTcuNDQ1MzEzLTguOTMzNTk0LTEyLjU3ODEyNS0xNi42Nzk2ODgtMTIuNTgyMDMyLTkuNTgyMDMxLjAwNzgxMy0xNy4zNDc2NTYgNy43ODUxNTctMTcuMzM5ODQ0IDE3LjM3MTA5NCAwIDEuMjU3ODEzLjEzNjcxOSAyLjUxMTcxOS40MTAxNTcgMy43NDIxODhsMTIuNjY0MDYyIDU2Ljk4ODI4MSA2OS40MjE4NzUgNjAuNzQ2MDk0aDguNjc5Njg4di00My4zOTA2MjV6bTAgMCIgZmlsbD0iI2Y5ZDdjMCIvPjxwYXRoIGQ9Im0yMjYuMTI4OTA2IDE3My43MjI2NTYgNTAuNDY4NzUtOC4zMjAzMTIgMzkuMDUwNzgyLTMxLjM5ODQzOGM2LjAzNTE1Ni00Ljg1NTQ2OCAxNC41NTg1OTMtNS4xMjUgMjAuODkwNjI0LS42NjAxNTYgNy44MjQyMTkgNS41MzUxNTYgOS42Nzk2ODggMTYuMzY3MTg4IDQuMTQ0NTMyIDI0LjE5NTMxMi0uNzI2NTYzIDEuMDI3MzQ0LTEuNTY2NDA2IDEuOTcyNjU3LTIuNDk2MDk0IDIuODIwMzEzbC00My4yNTM5MDYgMzkuMjM0Mzc1LTY4LjgwNDY4OCA5LjU0Mjk2OS04LjY3OTY4Ny0xLjA4MjAzMXYtMzQuNzE0ODQ0em0wIDAiIGZpbGw9IiNmOWQ3YzAiLz48cGF0aCBkPSJtMzU1LjI1MzkwNiAyMDguNTIzNDM4Yy0yLjc1NzgxMi4wMDM5MDYtNS4zNTU0NjgtMS4zMDQ2ODgtNi45OTIxODctMy41MjM0MzhsLTEwMy4wNDI5NjktMTM5LjYyODkwNmMtMi44NDM3NS0zLjg1OTM3NS0yLjAyMzQzOC05LjI5Mjk2OSAxLjgzNTkzOC0xMi4xMzY3MTkgMy44NTkzNzQtMi44NDM3NSA5LjI4OTA2Mi0yLjAyMzQzNyAxMi4xMzY3MTggMS44MzU5MzdsMTAzLjA4NTkzOCAxMzkuNjI4OTA3YzIuODM5ODQ0IDMuODU5Mzc1IDIuMDE1NjI1IDkuMjkyOTY5LTEuODQzNzUgMTIuMTMyODEyLTEuNDc2NTYzIDEuMDg5ODQ0LTMuMjY1NjI1IDEuNjc5Njg4LTUuMTAxNTYzIDEuNjkxNDA3em0wIDAiIGZpbGw9IiNkOWQ5ZDkiLz48ZyBmaWxsPSIjZmJkNjk5Ij48cGF0aCBkPSJtMzkxLjAwNzgxMiAzNzMuMTUyMzQ0aDE3LjM1NTQ2OXYxNy4zNTU0NjhoLTE3LjM1NTQ2OXptMCAwIi8+PHBhdGggZD0ibTM5MS4wMDc4MTIgMzM4LjQ0MTQwNmgxNy4zNTU0Njl2MTcuMzU1NDY5aC0xNy4zNTU0Njl6bTAgMCIvPjxwYXRoIGQ9Im0zNS4yMTA5MzggNDY4LjYwOTM3NWgxNy4zNTU0Njh2MTcuMzU1NDY5aC0xNy4zNTU0Njh6bTAgMCIvPjxwYXRoIGQ9Im0zNS4yMTA5MzggNDMzLjg5ODQzOGgxNy4zNTU0Njh2MTcuMzU1NDY4aC0xNy4zNTU0Njh6bTAgMCIvPjxwYXRoIGQ9Im0zOTEuMDA3ODEyIDI4Ni4zNzEwOTRoMTcuMzU1NDY5djE3LjM1OTM3NWgtMTcuMzU1NDY5em0wIDAiLz48cGF0aCBkPSJtMzY0Ljk3NjU2MiAyNjAuMzM5ODQ0aDE3LjM1NTQ2OXYxNy4zNTU0NjhoLTE3LjM1NTQ2OXptMCAwIi8+PHBhdGggZD0ibTM5MS4wMDc4MTIgMjM0LjMwNDY4OGgxNy4zNTU0Njl2MTcuMzU1NDY4aC0xNy4zNTU0Njl6bTAgMCIvPjxwYXRoIGQ9Im00MTcuMDQyOTY5IDI2MC4zMzk4NDRoMTcuMzU1NDY5djE3LjM1NTQ2OGgtMTcuMzU1NDY5em0wIDAiLz48L2c+PHBhdGggZD0ibTM1LjIxMDkzOCAzODEuODMyMDMxaDE3LjM1NTQ2OHYxNy4zNTU0NjloLTE3LjM1NTQ2OHptMCAwIiBmaWxsPSIjZjI3ZTU1Ii8+PHBhdGggZD0ibTM1LjIxMDkzOCAzNDcuMTE3MTg4aDE3LjM1NTQ2OHYxNy4zNTkzNzRoLTE3LjM1NTQ2OHptMCAwIiBmaWxsPSIjZmJiNTQwIi8+PHBhdGggZD0ibS41IDM0Ny4xMTcxODhoMTcuMzU1NDY5djE3LjM1OTM3NGgtMTcuMzU1NDY5em0wIDAiIGZpbGw9IiNmMjdlNTUiLz48cGF0aCBkPSJtMzUuMjEwOTM4IDMxMi40MDYyNWgxNy4zNTU0Njh2MTcuMzU1NDY5aC0xNy4zNTU0Njh6bTAgMCIgZmlsbD0iI2YyN2U1NSIvPjxwYXRoIGQ9Im02OS45MjU3ODEgMzQ3LjExNzE4OGgxNy4zNTU0Njl2MTcuMzU5Mzc0aC0xNy4zNTU0Njl6bTAgMCIgZmlsbD0iI2YyN2U1NSIvPjxwYXRoIGQ9Im00NjAuNDMzNTk0IDY5LjQyMTg3NWgxNy4zNTU0Njh2MTcuMzU5Mzc1aC0xNy4zNTU0Njh6bTAgMCIgZmlsbD0iIzk5ZDhhYSIvPjxwYXRoIGQ9Im00MzQuMzk4NDM4IDk1LjQ1NzAzMWgxNy4zNTU0Njh2MTcuMzU1NDY5aC0xNy4zNTU0Njh6bTAgMCIgZmlsbD0iIzk5ZDhhYSIvPjxwYXRoIGQ9Im00ODYuNDY0ODQ0IDk1LjQ1NzAzMWgxNy4zNTU0Njh2MTcuMzU1NDY5aC0xNy4zNTU0Njh6bTAgMCIgZmlsbD0iIzk5ZDhhYSIvPjxwYXRoIGQ9Im00NjAuNDMzNTk0IDEyMS40OTIxODhoMTcuMzU1NDY4djE3LjM1NTQ2OGgtMTcuMzU1NDY4em0wIDAiIGZpbGw9IiM5OWQ4YWEiLz48cGF0aCBkPSJtODcuMjgxMjUgMGgxNy4zNTU0Njl2MTcuMzU1NDY5aC0xNy4zNTU0Njl6bTAgMCIgZmlsbD0iI2YyN2U1NSIvPjxwYXRoIGQ9Im02OS45MjU3ODEgMTcuMzU1NDY5aDE3LjM1NTQ2OXYxNy4zNTU0NjloLTE3LjM1NTQ2OXptMCAwIiBmaWxsPSIjZjI3ZTU1Ii8+PHBhdGggZD0ibTEwNC42MzY3MTkgMTcuMzU1NDY5aDE3LjM1NTQ2OXYxNy4zNTU0NjloLTE3LjM1NTQ2OXptMCAwIiBmaWxsPSIjZjI3ZTU1Ii8+PHBhdGggZD0ibTg3LjI4MTI1IDM0LjcxMDkzOGgxNy4zNTU0Njl2MTcuMzU1NDY4aC0xNy4zNTU0Njl6bTAgMCIgZmlsbD0iI2YyN2U1NSIvPjxwYXRoIGQ9Im0yNTMuMDgyMDMxIDE2OS40NzI2NTYtMjYuOTUzMTI1IDQuNDQxNDA2di0uMzU1NDY4aC04Ni43ODEyNWwtMTYuMzk0NTMxLTE2LjM5MDYyNS0yMS4zNzg5MDYgMjYuNzI2NTYyIDM3Ljc3MzQzNyAzMy4wNTQ2ODh2NjAuNzQ2MDkzaDg2Ljc4MTI1di02OC4zMzk4NDNsMzMuOTgwNDY5LTQuNzE4NzV6bTAgMCIgZmlsbD0iI2ZiYjU0MCIvPjxwYXRoIGQ9Im0xMzkuMzQ3NjU2IDI2OS4wMTU2MjV2MTMwLjE3MTg3NWgzNC43MTA5Mzh2LTk1LjQ1NzAzMWg0My4zOTA2MjV2MzQuNzEwOTM3aDM0LjcxMDkzN3YtNDMuMzkwNjI1YzAtMTQuMzc4OTA2LTExLjY1NjI1LTI2LjAzNTE1Ni0yNi4wMzEyNS0yNi4wMzUxNTZ6bTAgMCIgZmlsbD0iIzI3N2JhYSIvPjxwYXRoIGQ9Im0xOTEuNDE0MDYyIDQzMy44OTg0MzhoLTUyLjA2NjQwNnYtNDMuMzkwNjI2aDM0LjcxMDkzOGM5LjU4NTkzNyAwIDE3LjM1NTQ2OCA3Ljc2OTUzMiAxNy4zNTU0NjggMTcuMzU1NDY5em0wIDAiIGZpbGw9IiNlYTZiNjUiLz48cGF0aCBkPSJtMjE3LjQ0OTIxOSAzMjkuNzYxNzE5aDM0LjcxMDkzN2M5LjU4NTkzOCAwIDE3LjM1NTQ2OSA3Ljc2OTUzMSAxNy4zNTU0NjkgMTcuMzU1NDY5djE3LjM1OTM3NGgtNTIuMDY2NDA2em0wIDAiIGZpbGw9IiNlYTZiNjUiLz48cGF0aCBkPSJtMTQ4LjAyNzM0NCA4Ni43ODEyNWg2OS40MjE4NzV2MzQuNzEwOTM4YzAgMTkuMTcxODc0LTE1LjUzOTA2MyAzNC43MTA5MzctMzQuNzEwOTM4IDM0LjcxMDkzN3MtMzQuNzE0ODQzLTE1LjUzOTA2My0zNC43MTQ4NDMtMzQuNzEwOTM3di0zNC43MTA5Mzh6bTAgMCIgZmlsbD0iI2Y5ZDdjMCIvPjxwYXRoIGQ9Im0yMTcuNDQ5MjE5IDEwNC4xMzY3MTktNTIuMDY2NDA3LTE3LjM1NTQ2OS0xNy4zNTU0NjggMTcuMzU1NDY5di0xNy4zNTU0NjljMC0xOS4xNzE4NzUgMTUuNTM5MDYyLTM0LjcxNDg0NCAzNC43MTA5MzctMzQuNzE0ODQ0czM0LjcxMDkzOCAxNS41NDI5NjkgMzQuNzEwOTM4IDM0LjcxNDg0NHptMCAwIiBmaWxsPSIjODM0YjEwIi8+PHBhdGggZD0ibTQ5NS4xNDQ1MzEgNTEyaC0xMzAuMTY3OTY5bC01Mi4wNzAzMTItOTUuNDU3MDMxaDg2Ljc4MTI1bDI3LjYxMzI4MSA0My4zOTA2MjVoNDEuODA4NTk0em0wIDAiIGZpbGw9IiM0MjhkYzUiLz48cGF0aCBkPSJtNjEuMjQ2MDk0IDUxMiA1Mi4wNjY0MDYtODYuNzgxMjVoODYuNzgxMjVsNDMuMzkwNjI1LTYwLjc0MjE4OGg4Ni43NzczNDRsMzQuNzE0ODQzIDE0Ny41MjM0Mzh6bTAgMCIgZmlsbD0iIzQ3OTljZiIvPjwvc3ZnPgo=);">
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.finish_configure').submit(function(e){
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
