<?php

/* dashboard.html */
class __TwigTemplate_10a52b8014a4279305f88305ad9e5ead14388acc8d0ee8a33d6b75f6c80648eb extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        ob_start();
        echo twig_include($this->env, $context, "header.html");
        echo "
    <div data=\"\" class=\"page dashboard\">
      <div class=\"page-main\">
          ";
        // line 4
        echo twig_include($this->env, $context, "head_menu.html");
        echo "
          ";
        // line 5
        echo twig_include($this->env, $context, "main_menu.html");
        echo "
          <div class=\"my-3 my-md-5\">
          <div class=\"container\">
              <div class=\"page-header\">
                <h1 class=\"page-title\">
                   ";
        // line 10
        echo twig_escape_filter($this->env, l("dashboard"), "html", null, true);
        echo "
                </h1>
              </div>
            <div class=\"row row-cards\">

                <div id=\"stats_1\" style=\"display:none;\" class=\"col-12 load_area\">


                </div>

                <div id=\"stats_2\" style=\"display:none;\" class=\"col-12 col-lg-4 load_area\">
                    <div class=\"loader loader-active\" ></div>

                </div>
                <div id=\"stats_3\" style=\"display:none;\" class=\"col-12 col-lg-8 load_area\">
                    <div class=\"loader loader-active\" ></div>

                </div>


                <div id=\"stats_4\" style=\"display:none;\" class=\"col-lg-6 load_area\">
                  <div class=\"loader loader-active\" ></div>

                </div>

                <div id=\"stats_5\" style=\"display:none;\" class=\"col-lg-6 load_area\">
                  <div class=\"loader loader-active\" ></div>

                </div>

            </div>
          </div>
        </div>

      </div>
      ";
        // line 45
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
      <script>
          require([\"jquery\"], function(\$){
              function load_area(area_number=1)
              {
                  var current = \"#stats_\"+area_number;
                  console.log(current);
                  \$(current).html('<div class=\"loader loader-active\" ></div>').slideDown(500);
                  \$.ajax({
                      url: \"";
        // line 54
        echo twig_escape_filter($this->env, router("dashboard"), "html", null, true);
        echo "?load=\"+area_number,
                      success: function(json_data){
                          if(json_data[\"type\"] == \"success\")
                          {
                              \$(current).html(json_data[\"message\"]);
                          }
                          if(area_number < 5)
                          {
                              load_area(Math.floor(area_number+1));
                          }
                      }
                  });
              }
              function reload_area()
              {
                  \$('.load_area').slideUp(500);
                  load_area(1);
              }
              \$(document).ready(function(){
                  setTimeout(function(){
                      load_area(1);
                  }, 500);
              });
          });
      </script>
    </div>
";
        // line 80
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "dashboard.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  117 => 80,  88 => 54,  76 => 45,  38 => 10,  30 => 5,  26 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "dashboard.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\dashboard.html");
    }
}
