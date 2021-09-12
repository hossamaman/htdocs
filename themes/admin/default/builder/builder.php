

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <base href="<?php _turl(); ?>/builder/">
      <title><?php echo l("admin_builder") ?></title>
      <link href="<?php _turl(); ?>/builder/css/editor.css" rel="stylesheet">
      <link href="<?php _turl(); ?>/builder/css/line-awesome.css" rel="stylesheet">
   </head>
   <body>
      <div id="vvveb-builder">
      <div id="top-panel">
         <a href="<?php _router("admin_builder") ?>" class="float-left back_dashboard" ><i class="la la-arrow-left"></i> <?php _l("back_to_dashboard") ?></a>
         <div class="btn-group mr-5" role="group">
            <button class="btn btn-light" title="<?php _l("undo"); ?> (Ctrl/Cmd + Z)" id="undo-btn" data-vvveb-action="undo" data-vvveb-shortcut="ctrl+z">
            <i class="la la-undo"></i>
            </button>
            <button class="btn btn-light"  title="<?php _l("redo"); ?> (Ctrl/Cmd + Shift + Z)" id="redo-btn" data-vvveb-action="redo" data-vvveb-shortcut="ctrl+shift+z">
            <i class="la la-undo la-flip-horizontal"></i>
            </button>
         </div>
         <div class="btn-group mr-5" role="group">
             <button class="btn btn-light" title="<?php _l("restore_template"); ?>" id="restore-btn" data-vvveb-action="restore" >
             <i class="la la-rotate-left"></i> <span style="font-size:0.8em;font-weight:300;"><?php _l("restore_template"); ?></span>
             </button>
            <button class="btn btn-light" title="<?php _l("fullscreen"); ?> (F11)" id="fullscreen-btn" data-toggle="button" aria-pressed="false" data-vvveb-action="fullscreen">
            <i class="la la-arrows"></i> <span style="font-size:0.8em;font-weight:300;"><?php _l("fullscreen"); ?></span>
            </button>
            <button class="btn btn-light" title="<?php _l("preview"); ?>" id="preview-btn" type="button" data-toggle="button" aria-pressed="false" data-vvveb-action="preview">
            <i class="la la-eye"></i> <span style="font-size:0.8em;font-weight:300;"><?php _l("preview"); ?></span>
            </button>
            <button class="btn btn-light" title="<?php _l("download"); ?>" id="download-btn" data-vvveb-action="download" download="index.html">
            <i class="la la-download"></i> <span style="font-size:0.8em;font-weight:300;"><?php _l("download"); ?></span>
            </button>
            <button class="btn btn-light" title="<?php _l("publish"); ?> (Ctrl + Q)" id="save-btn" data-vvveb-action="save" data-vvveb-shortcut="ctrl+q">
            <i class="la la-save"></i> <span style="font-size:0.8em;font-weight:300;"><?php _l("publish"); ?></span>
            </button>
            <a href="<?php _router("home"); ?>" target="_blank" class="btn btn-light" title="<?php _l("view_website"); ?>" >
            <i class="la la-eye"></i> <span style="font-size:0.8em;font-weight:300;"><?php _l("view_website"); ?></span>
            </a>
         </div>
         <div class="btn-group float-right" role="group">
            <button id="mobile-view" data-view="mobile" class="btn btn-light"  title="<?php _l("mobile_view"); ?>" data-vvveb-action="viewport">
            <i class="ion-iphone"></i>
            </button>
            <button id="tablet-view"  data-view="tablet" class="btn btn-light"  title="<?php _l("tablet_view"); ?>" data-vvveb-action="viewport">
            <i class="ion-ipad"></i>
            </button>
            <button id="desktop-view"  data-view="" class="btn btn-light"  title="<?php _l("desktop_view"); ?>" data-vvveb-action="viewport">
            <i class="ion-monitor"></i>
            </button>
         </div>
      </div>
      <div id="left-panel">
         <div id="filemanager">
            <div class="header"><a href="javascript:void(0)">Elements</a></div>
            <div class="tree nano">
               <ol class="nano-content">
               </ol>
            </div>
         </div>
         <div id="components">
            <div class="header">
               <input class="form-control form-control-sm" placeholder="Search..." type="text" id="component-search"  data-vvveb-action="componentSearch" data-vvveb-on="keyup">
               <button id="clear-backspace"  data-vvveb-action="clearComponentSearch">
               <i class="ion-backspace"></i>
               </button>
            </div>
            <div id="components-sidepane" class="sidepane">
               <div class="nano" >
                  <ul id="components-list" class="nano-content clearfix" ></ul>
               </div>
            </div>
         </div>
      </div>
      <div id="canvas">
         <div id="iframe-wrapper" >
            <div id="iframe-layer">
               <div id="highlight-box">
                  <div id="highlight-name"></div>
               </div>
               <div id="select-box">
                  <div id="wysiwyg-editor">
                     <a id="bold-btn" href="" title="Bold"><i><strong>B</strong></i></a>
                     <a id="italic-btn" href="" title="Italic"><i>I</i></a>
                     <a id="underline-btn" href="" title="Underline"><u>u</u></a>
                     <a id="strike-btn" href="" title="Strikeout"><strike>S</strike></a>
                     <a id="link-btn" href="" title="Create link"><strong>a</strong></a>
                  </div>
                  <div id="select-actions">
                     <a id="drag-box" href="" title="Drag element"><i class="ion-arrow-move"></i></a>
                     <a id="parent-box" href="" title="Select parent"><i class="ion-reply"></i></a>
                     <a id="up-box" href="" title="Move element up"><i class="ion-arrow-up-a"></i></a>
                     <a id="down-box" href="" title="Move element down"><i class="ion-arrow-down-a"></i></a>
                     <a id="clone-box" href="" title="Clone element"><i class="ion-ios-copy"></i></a>
                     <a id="delete-box" href="" title="Remove element"><i class="ion-trash-a"></i></a>
                  </div>
               </div>
            </div>
            <iframe src="about:none" title="<?php echo htmlentities(homepage_path); ?>.html" id="iframe1"></iframe>
         </div>
      </div>
      <div id="right-panel" >
         <div class="nano">
            <div id="component-properties" class="nano-content">
               <p style="font-weight:300;padding:20px 20px;" >select an element</p>
            </div>
         </div>
      </div>
      <div id="bottom-panel">
         <div class="btn-group" role="group">
            <button id="code-editor-btn btn-sm" data-view="mobile" class="btn btn-light btn-sm"  title="Code editor" data-vvveb-action="toggleEditor">
            <i class="ion-code"></i> Code editor
            </button>
            <div id="toggleEditorJsExecute" class="custom-control custom-checkbox mt-1" style="display:none">
               <input type="checkbox" class="custom-control-input" id="customCheck" name="example1" data-vvveb-action="toggleEditorJsExecute">
               <label class="custom-control-label" for="customCheck"><small>Run code on edit</small></label>
            </div>
         </div>
         <div id="vvveb-code-editor">
            <textarea class="form-control"></textarea>
            <div>
            </div>
         </div>
      </div>
      <!-- templates -->
      <script id="vvveb-input-textinput" type="text/html">
         <div>
         	<input name="{%=key%}" type="text" class="form-control"/>
         </div>

      </script>
      <script id="vvveb-input-checkboxinput" type="text/html">
         <div class="custom-control custom-checkbox">
         	  <input name="{%=key%}" class="custom-control-input" type="checkbox" id="{%=key%}_check">
         	  <label class="custom-control-label" for="{%=key%}_check">{% if (typeof text !== 'undefined') { %} {%=text%} {% } %}</label>
         </div>

      </script>
      <script id="vvveb-input-radioinput" type="text/html">
         <div>

         	{% for ( var i = 0; i < options.length; i++ ) { %}

         	<label class="custom-control custom-radio  {% if (typeof inline !== 'undefined' && inline == true) { %}custom-control-inline{% } %}"  title="{%=options[i].title%}">
         	  <input name="{%=key%}" class="custom-control-input" type="radio" value="{%=options[i].value%}" id="{%=key%}{%=i%}" {%if (options[i].checked) { %}checked="{%=options[i].checked%}"{% } %}>
         	  <label class="custom-control-label" for="{%=key%}{%=i%}">{%=options[i].text%}</label>
         	</label>

         	{% } %}

         </div>

      </script>
      <script id="vvveb-input-radiobuttoninput" type="text/html">
         <div class="btn-group btn-group-toggle  {%if (extraclass) { %}{%=extraclass%}{% } %} clearfix" data-toggle="buttons">

         	{% for ( var i = 0; i < options.length; i++ ) { %}

         	<label class="btn btn-light  {%if (options[i].checked) { %}active{% } %}" for="{%=key%}{%=i%} " title="{%=options[i].title%}">
         	  <input name="{%=key%}" class="custom-control-input" type="radio" value="{%=options[i].value%}" id="{%=key%}{%=i%}" {%if (options[i].checked) { %}checked="{%=options[i].checked%}"{% } %}>
         	  {%if (options[i].icon) { %}<i class="{%=options[i].icon%}"></i>{% } %}
         	  {%=options[i].text%}
         	</label>

         	{% } %}

         </div>

      </script>
      <script id="vvveb-input-toggle" type="text/html">
         <div class="toggle">
             <input type="checkbox" name="{%=key%}" value="{%=on%}" data-value-off="{%=off%}" data-value-on="{%=on%}" class="toggle-checkbox" id="{%=key%}">
             <label class="toggle-label" for="{%=key%}">
                 <span class="toggle-inner"></span>
                 <span class="toggle-switch"></span>
             </label>
         </div>

      </script>
      <script id="vvveb-input-header" type="text/html">
         <h6 class="header">{%=header%}</h6>

      </script>
      <script id="vvveb-input-select" type="text/html">
         <div>

         	<select class="form-control custom-select">
         		{% for ( var i = 0; i < options.length; i++ ) { %}
         		<option value="{%=options[i].value%}">{%=options[i].text%}</option>
         		{% } %}
         	</select>

         </div>

      </script>
      <script id="vvveb-input-listinput" type="text/html">
         <div class="row">

         	{% for ( var i = 0; i < options.length; i++ ) { %}
         	<div class="col-6">
         		<div class="input-group">
         			<input name="{%=key%}_{%=i%}" type="text" class="form-control" value="{%=options[i].text%}"/>
         			<div class="input-group-append">
         				<button class="input-group-text btn btn-sm btn-danger">
         					<i class="ion-trash-a"></i>
         				</button>
         			</div>
         		  </div>
         		  <br/>
         	</div>
         	{% } %}


         	{% if (typeof hide_remove === 'undefined') { %}
         	<div class="col-12">

         		<button class="btn btn-sm btn-outline-primary">
         			<i class="ion-trash-a"></i> Add new
         		</button>

         	</div>
         	{% } %}

         </div>

      </script>
      <script id="vvveb-input-grid" type="text/html">
         <div class="row">
         	<div class="mb-1 col-12">

         		<label>Flexbox</label>
         		<select class="form-control custom-select" name="col">

         			<option value="">None</option>
         			{% for ( var i = 1; i <= 12; i++ ) { %}
         			<option value="{%=i%}" {% if ((typeof col !== 'undefined') && col == i) { %} selected {% } %}>{%=i%}</option>
         			{% } %}

         		</select>
         		<br/>
         	</div>

         	<div class="col-6">
         		<label>Extra small</label>
         		<select class="form-control custom-select" name="col-xs">

         			<option value="">None</option>
         			{% for ( var i = 1; i <= 12; i++ ) { %}
         			<option value="{%=i%}" {% if ((typeof col_xs !== 'undefined') && col_xs == i) { %} selected {% } %}>{%=i%}</option>
         			{% } %}

         		</select>
         		<br/>
         	</div>

         	<div class="col-6">
         		<label>Small</label>
         		<select class="form-control custom-select" name="col-sm">

         			<option value="">None</option>
         			{% for ( var i = 1; i <= 12; i++ ) { %}
         			<option value="{%=i%}" {% if ((typeof col_sm !== 'undefined') && col_sm == i) { %} selected {% } %}>{%=i%}</option>
         			{% } %}

         		</select>
         		<br/>
         	</div>

         	<div class="col-6">
         		<label>Medium</label>
         		<select class="form-control custom-select" name="col-md">

         			<option value="">None</option>
         			{% for ( var i = 1; i <= 12; i++ ) { %}
         			<option value="{%=i%}" {% if ((typeof col_md !== 'undefined') && col_md == i) { %} selected {% } %}>{%=i%}</option>
         			{% } %}

         		</select>
         		<br/>
         	</div>

         	<div class="col-6 mb-1">
         		<label>Large</label>
         		<select class="form-control custom-select" name="col-lg">

         			<option value="">None</option>
         			{% for ( var i = 1; i <= 12; i++ ) { %}
         			<option value="{%=i%}" {% if ((typeof col_lg !== 'undefined') && col_lg == i) { %} selected {% } %}>{%=i%}</option>
         			{% } %}

         		</select>
         		<br/>
         	</div>

         	{% if (typeof hide_remove === 'undefined') { %}
         	<div class="col-12">

         		<button class="btn btn-sm btn-outline-light text-danger">
         			<i class="ion-trash-a"></i> Remove
         		</button>

         	</div>
         	{% } %}

         </div>

      </script>
      <script id="vvveb-input-textvalue" type="text/html">
         <div class="row">
         	<div class="col-6 mb-1">
         		<label>Value</label>
         		<input name="value" type="text" value="{%=value%}" class="form-control"/>
         	</div>

         	<div class="col-6 mb-1">
         		<label>Text</label>
         		<input name="text" type="text" value="{%=text%}" class="form-control"/>
         	</div>

         	{% if (typeof hide_remove === 'undefined') { %}
         	<div class="col-12">

         		<button class="btn btn-sm btn-outline-light text-danger">
         			<i class="ion-trash-a"></i> Remove
         		</button>

         	</div>
         	{% } %}

         </div>

      </script>
      <script id="vvveb-input-rangeinput" type="text/html">
         <div>
         	<input name="{%=key%}" type="range" min="{%=min%}" max="{%=max%}" step="{%=step%}" class="form-control"/>
         </div>

      </script>
      <script id="vvveb-input-imageinput" type="text/html">
         <div>
         	<input name="{%=key%}" type="text" class="form-control"/>
         	<input name="file" type="file" class="form-control"/>
         </div>

      </script>
      <script id="vvveb-input-colorinput" type="text/html">
         <div>
         	<input name="{%=key%}" type="color" value="{%=value%}" pattern="#[a-f0-9]{6}" class="form-control"/>
         </div>

      </script>
      <script id="vvveb-input-numberinput" type="text/html">
         <div>
         	<input name="{%=key%}" type="number" value="{%=value%}"
         		  {% if (typeof min !== 'undefined' && min != false) { %}min="{%=min%}"{% } %}
         		  {% if (typeof max !== 'undefined' && max != false) { %}max="{%=max%}"{% } %}
         		  {% if (typeof step !== 'undefined' && step != false) { %}step="{%=step%}"{% } %}
         	class="form-control"/>
         </div>
      </script>
      <script id="vvveb-input-button" type="text/html">
         <div>
         	<button class="btn btn-sm btn-primary">
         		<i class="ion-trash-a"></i> {%=text%}
         	</button>
         </div>
      </script>
      <script id="vvveb-input-cssunitinput" type="text/html">
         <div class="input-group" id="cssunit-{%=key%}">
         	<input name="number" type="number" value="{%=value%}"
         		  {% if (typeof min !== 'undefined' && min != false) { %}min="{%=min%}"{% } %}
         		  {% if (typeof max !== 'undefined' && max != false) { %}max="{%=max%}"{% } %}
         		  {% if (typeof step !== 'undefined' && step != false) { %}step="{%=step%}"{% } %}
         	class="form-control"/>
         	 <div class="input-group-append">
         	<select class="form-control custom-select small-arrow" name="unit">
         		<option>em&ensp;</option>
         		<option>px</option>
         		<option>%</option>
         		<option>rem</option>
         		<option>auto</option>
         	</select>
         	</div>
         </div>

      </script>
      <script id="vvveb-filemanager-page" type="text/html">
         <li data-url="{%=url%}" data-page="{%=name%}">
         	<label for="{%=name%}"><span>{%=title%}</span></label> <input type="checkbox" checked id="{%=name%}" />
         	<ol></ol>
         </li>
      </script>
      <script id="vvveb-filemanager-component" type="text/html">
         <li data-url="{%=url%}" data-component="{%=name%}" class="file">
         	<a href="{%=url%}"><span>{%=title%}</span></a>
         </li>
      </script>
      <script id="vvveb-input-sectioninput" type="text/html">
         <label class="header" data-header="{%=key%}" for="header_{%=key%}"><span>&ensp;{%=header%}</span> <div class="header-arrow"></div></label>
         <input class="header_check" type="checkbox" {% if (typeof expanded !== 'undefined' && expanded == false) { %} {% } else { %}checked="true"{% } %} id="header_{%=key%}">
         <div class="section" data-section="{%=key%}"></div>

      </script>
      <script id="vvveb-property" type="text/html">
         <div class="form-group {% if (typeof col !== 'undefined' && col != false) { %} col-sm-{%=col%} d-inline-block {% } else { %}row{% } %}" data-key="{%=key%}" {% if (typeof group !== 'undefined' && group != null) { %}data-group="{%=group%}" {% } %}>

         	{% if (typeof name !== 'undefined' && name != false) { %}<label class="{% if (typeof inline === 'undefined' ) { %}col-sm-4{% } %} control-label" for="input-model">{%=name%}</label>{% } %}

         	<div class="{% if (typeof inline === 'undefined') { %}col-sm-{% if (typeof name !== 'undefined' && name != false) { %}8{% } else { %}12{% } } %} input"></div>

         </div>

      </script>
      <div class="modal fade" id="textarea-modal" tabindex="-1" role="dialog" aria-labelledby="textarea-modal" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title"><?php _l("publish"); ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="<?php _l("close"); ?>">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <div style="padding:35px 20px;text-align:center;" >
                      <button type="button" id="do_publish" data-check="publish" class="btn btn-lg btn-primary" style="font-weight:300;" ><i class="la la-save"></i> <?php _l("publish"); ?></button>
                      <br><br><span style="margin-right:10px;" id="publish_error"></span>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="restore-modal" tabindex="-1" role="dialog" aria-labelledby="restore-modal" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title"><?php _l("restore_default_content"); ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="<?php _l("close"); ?>">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                   <div style="padding:35px 20px;text-align:center;" >
                       <button type="button" id="do_restore" data-check="restore" class="btn btn-lg btn-primary" style="font-weight:300;" ><i class="la la-rotate-left"></i> <?php _l("restore_template"); ?></button>
                       <br><br><span style="margin-right:10px;" id="restore_error"></span>
                   </div>
               </div>
            </div>
         </div>
      </div>
      <script src="<?php _turl(); ?>/builder/js/jquery.min.js"></script>
      <script src="<?php _turl(); ?>/builder/js/jquery.nanoscroller.min.js"></script>
      <script src="<?php _turl(); ?>/builder/js/jquery.hotkeys.js"></script>
      <script src="<?php _turl(); ?>/builder/js/popper.min.js"></script>
      <script src="<?php _turl(); ?>/builder/js/bootstrap.min.js"></script>
      <script src="<?php _turl(); ?>/builder/libs/builder/builder.js"></script>
      <script src="<?php _turl(); ?>/builder/libs/builder/undo.js"></script>
      <script src="<?php _turl(); ?>/builder/libs/builder/inputs.js"></script>
      <script src="<?php _turl(); ?>/builder/libs/builder/components-bootstrap4.js"></script>
      <script src="<?php _turl(); ?>/builder/libs/builder/components-widgets.js"></script>
      <link href="<?php _turl(); ?>/builder/libs/codemirror/lib/codemirror.css" rel="stylesheet"/>
      <link href="<?php _turl(); ?>/builder/libs/codemirror/theme/material.css" rel="stylesheet"/>
      <script src="<?php _turl(); ?>/builder/libs/codemirror/lib/codemirror.js"></script>
      <script src="<?php _turl(); ?>/builder/libs/codemirror/lib/xml.js"></script>
      <script src="<?php _turl(); ?>/builder/libs/codemirror/lib/formatting.js"></script>
      <script src="<?php _turl(); ?>/builder/libs/builder/plugin-codemirror.js"></script>
      <script>
         $(document).ready(function(){
         	Vvveb.Builder.init('<?php echo homepage_url; ?>', function() {
         		//run code after page/iframe is loaded
         	});
         	Vvveb.Gui.init()
         	Vvveb.FileManager.init();
         	Vvveb.FileManager.addPages(
         	[
         		{name:"<?php echo htmlentities(homepage_path); ?>", title:"<?php echo htmlentities(homepage_name); ?>",  url: "<?php echo homepage_url; ?>"}
         	]);
         	Vvveb.FileManager.loadPage("<?php echo htmlentities(homepage_path); ?>");
             $(".nano").nanoScroller({ flash: true });
             $(".nano").mouseover(function(){
                 setTimeout(function () {
                     $(".nano").nanoScroller();
                 }, 30);
             });
             $('#do_publish').click(function(){
                 var item = $(this);
                 var check = $(this).data("check");
                 if(check == "publish")
                 {
                     var backp = $(this).html();
                     var data = Vvveb.Builder.getHtml();
                     var action = 'publish';
                     var theme = '<?php echo htmlentities(homepage_key); ?>';
                     var postobj = {
                         action: action,
                         theme: theme,
                         data: data
                     };
                     $('#publish_error').html("");
                     item.data("check", "loading");
                     item.html("<i class='la la-refresh la-spin'></i> <?php echo l("loading")."..."; ?>");
                     $.ajax({
                         url: '<?php _router("admin"); ?>/api/ajax/user/manage-homepage',
                         data: postobj,
                         method: 'POST',
                         success: function(data){
                             item.data("check", "publish");
                             item.html(backp);
                             if(data["type"] == "success")
                             {
                                 $('#publish_error').html("<i class='la la-check'></i> "+data["message"]).css({"color":"green"});
                             } else {
                                 $('#publish_error').html("<i class='la la-warning'></i> "+data["message"]).css({"color":"red"});
                             }
                         },
                         error: function(error){
                             item.data("check", "publish");
                             item.html(backp);
                             $('#publish_error').html("<i class='la la-warning'></i>  <?php _l("error_connect"); ?>").css({"color":"red"});
                         }
                     });
                 }
             });

             $('#do_restore').click(function(){
                 var item = $(this);
                 var check = $(this).data("check");
                 if(check == "restore")
                 {
                     var backp = $(this).html();
                     var action = 'restore';
                     var theme = '<?php echo htmlentities(homepage_key); ?>';
                     $('#restore_error').html("");
                     item.data("check", "loading");
                     item.html("<i class='la la-refresh la-spin'></i> <?php echo l("loading")."..."; ?>");
                     $.ajax({
                         url: '<?php _router("admin"); ?>/api/ajax/user/manage-homepage',
                         data: 'action='+action+'&theme='+theme,
                         method: 'POST',
                         success: function(data){
                             item.data("check", "restore");
                             item.html(backp);
                             if(data["type"] == "success")
                             {
                                 $('#restore_error').html("<i class='la la-check'></i> "+data["message"]).css({"color":"green"});
                                 setTimeout(function(){
                                     window.location = window.location.href;
                                 }, 1000);
                             } else {
                                 $('#restore_error').html("<i class='la la-warning'></i> "+data["message"]).css({"color":"red"});
                             }
                         },
                         error: function(error){
                             item.data("check", "restore");
                             item.html(backp);
                             $('#restore_error').html("<i class='la la-warning'></i>  <?php _l("error_connect"); ?>").css({"color":"red"});
                         }
                     });
                 }
             });

         });
      </script>
   </body>
</html>
