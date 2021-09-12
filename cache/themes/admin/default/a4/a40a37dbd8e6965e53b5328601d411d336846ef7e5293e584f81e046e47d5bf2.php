<?php

/* add_plan.html */
class __TwigTemplate_c9e4e49a380e4c41b10791e42f67ee11fc05322c0882cd84c367c6e0d63ac9df extends Twig_Template
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
    <div class=\"page\">
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
        echo twig_escape_filter($this->env, _get("title2"), "html", null, true);
        echo "
                  </h1>
                </div>
                <div class=\"row\">
                    <div class=\"col-12\">
                        ";
        // line 15
        echo twig_include($this->env, $context, "plans_menu.html");
        echo "

                        <form class=\"card surfow_ajaxform\"
                        data-redirect=\"";
        // line 18
        echo twig_escape_filter($this->env, router("admin_plans"), "html", null, true);
        echo "\"
                        data-method=\"post\"
                        data-action=\"manage-plan\"
                        data-type=\"user\" >
                        <input type=\"hidden\" name=\"action\" value=\"add\" />
                        ";
        // line 23
        echo twig_escape_filter($this->env, put_session_key(), "html", null, true);
        echo "
                          <div class=\"card-body p-6\">
                            <div class=\"surfow_alert\" ></div>

                            <div class=\"row\">
                            <div class=\"col-lg-6 col-12\">

                            <div class=\"form-group\">
                              <label class=\"form-label\">";
        // line 31
        echo twig_escape_filter($this->env, l("plan_name"), "html", null, true);
        echo "</label>
                              <div class=\"input-icon\">
                                <span class=\"input-icon-addon\">
                                    <i class=\"fe fe-package\"></i>
                                </span>
                                <input type=\"text\" name=\"name\" class=\"form-control\" placeholder=\"";
        // line 36
        echo twig_escape_filter($this->env, l("plan_name"), "html", null, true);
        echo "\">
                              </div>
                            </div>

                            <div class=\"form-group\">
                              <label class=\"form-label\">";
        // line 41
        echo twig_escape_filter($this->env, l("price"), "html", null, true);
        echo "</label>
                              <div class=\"input-icon\">
                                <span class=\"input-icon-addon\">
                                    <i class=\"fe fe-dollar-sign\"></i>
                                </span>
                                <input type=\"text\" name=\"price\" value=\"10\" class=\"form-control\" placeholder=\"";
        // line 46
        echo twig_escape_filter($this->env, l("price"), "html", null, true);
        echo "\">
                              </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"form-label\">";
        // line 51
        echo twig_escape_filter($this->env, l("plan_type"), "html", null, true);
        echo "</div>
                                <div class=\"custom-switches-stacked\">
                                  <label class=\"custom-switch\">
                                    <input type=\"radio\" name=\"type\" value=\"upgrade\" class=\"change_plan_type custom-switch-input\" checked=\"\">
                                    <span class=\"custom-switch-indicator\"></span>
                                    <span class=\"custom-switch-description\">";
        // line 56
        echo twig_escape_filter($this->env, l("upgrade_plan"), "html", null, true);
        echo "</span>
                                  </label>
                                  <label class=\"custom-switch\">
                                    <input type=\"radio\" name=\"type\" value=\"traffic\" class=\"change_plan_type custom-switch-input\">
                                    <span class=\"custom-switch-indicator\"></span>
                                    <span class=\"custom-switch-description\">";
        // line 61
        echo twig_escape_filter($this->env, l("traffic_plan"), "html", null, true);
        echo "</span>
                                  </label>
                                  <label class=\"custom-switch\">
                                    <input type=\"radio\" name=\"type\" value=\"websites\" class=\"change_plan_type custom-switch-input\">
                                    <span class=\"custom-switch-indicator\"></span>
                                    <span class=\"custom-switch-description\">";
        // line 66
        echo twig_escape_filter($this->env, l("websites_plan"), "html", null, true);
        echo "</span>
                                  </label>
                                  <label class=\"custom-switch\">
                                    <input type=\"radio\" name=\"type\" value=\"sessions\" class=\"change_plan_type custom-switch-input\">
                                    <span class=\"custom-switch-indicator\"></span>
                                    <span class=\"custom-switch-description\">";
        // line 71
        echo twig_escape_filter($this->env, l("sessions_plan"), "html", null, true);
        echo "</span>
                                  </label>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"form-label\">";
        // line 77
        echo twig_escape_filter($this->env, l("featured_plan"), "html", null, true);
        echo "</div>
                                <label class=\"custom-switch\">
                                  <input type=\"checkbox\" name=\"featured\" valuee=\"on\" class=\"custom-switch-input\">
                                  <span class=\"custom-switch-indicator\"></span>
                                  <span class=\"custom-switch-description\">";
        // line 81
        echo twig_escape_filter($this->env, l("activate"), "html", null, true);
        echo "</span>
                                </label>
                            </div>

                            </div>
                            <div class=\"col-lg-6 col-12\">
                                <div id=\"points\" style=\"display:none;\" class=\"form-group\">
                                  <label class=\"form-label\">";
        // line 88
        echo twig_escape_filter($this->env, l("plan_points"), "html", null, true);
        echo "</label>
                                  <div class=\"input-icon\">
                                    <span class=\"input-icon-addon\">
                                        <i class=\"fe fe-database\"></i>
                                    </span>
                                    <input type=\"number\" name=\"points\" value=\"1\" class=\"form-control\" placeholder=\"";
        // line 93
        echo twig_escape_filter($this->env, l("plan_points"), "html", null, true);
        echo "\">
                                  </div>
                                </div>
                                <div id=\"websites\" class=\"form-group\">
                                  <label class=\"form-label\">";
        // line 97
        echo twig_escape_filter($this->env, l("website_slots"), "html", null, true);
        echo "</label>
                                  <div class=\"input-icon\">
                                    <span class=\"input-icon-addon\">
                                        <i class=\"fe fe-globe\"></i>
                                    </span>
                                    <input type=\"number\" name=\"websites\" value=\"1\" class=\"form-control\" placeholder=\"";
        // line 102
        echo twig_escape_filter($this->env, l("website_slots"), "html", null, true);
        echo "\">
                                  </div>
                                </div>
                                <div id=\"sessions\" class=\"form-group\">
                                  <label class=\"form-label\">";
        // line 106
        echo twig_escape_filter($this->env, l("session_slots"), "html", null, true);
        echo "</label>
                                  <div class=\"input-icon\">
                                    <span class=\"input-icon-addon\">
                                        <i class=\"fe fe-server\"></i>
                                    </span>
                                    <input type=\"number\" name=\"sessions\" value=\"1\" class=\"form-control\" placeholder=\"";
        // line 111
        echo twig_escape_filter($this->env, l("session_slots"), "html", null, true);
        echo "\">
                                  </div>
                                </div>
                                <div id=\"ratio\" class=\"form-group\">
                                  <label class=\"form-label\">";
        // line 115
        echo twig_escape_filter($this->env, l("traffic_ratio"), "html", null, true);
        echo "</label>
                                  <div class=\"input-icon\">
                                    <span class=\"input-icon-addon\">
                                        <i class=\"fe fe-percent\"></i>
                                    </span>
                                    <input type=\"number\" name=\"ratio\" value=\"1\" class=\"form-control\" placeholder=\"";
        // line 120
        echo twig_escape_filter($this->env, l("traffic_ratio"), "html", null, true);
        echo "\">
                                  </div>
                                </div>

                                <div id=\"duration\" class=\"form-group\">
                                    <label class=\"form-label\">";
        // line 125
        echo twig_escape_filter($this->env, l("plan_duration"), "html", null, true);
        echo "</label>
                                    <div class=\"row gutters-xs\">
                                      <div class=\"col-4\">
                                          <input type=\"number\" name=\"duration\" value=\"6\" class=\"form-control\" placeholder=\"";
        // line 128
        echo twig_escape_filter($this->env, l("plan_duration"), "html", null, true);
        echo "\">
                                      </div>
                                      <div class=\"col-8\">
                                          <div class=\"selectgroup w-100\">
                                            <label class=\"selectgroup-item\">
                                              <input type=\"radio\" name=\"duration_type\" value=\"d\" class=\"selectgroup-input\">
                                              <span class=\"selectgroup-button\">";
        // line 134
        echo twig_escape_filter($this->env, l("day"), "html", null, true);
        echo "</span>
                                            </label>
                                            <label class=\"selectgroup-item\">
                                              <input type=\"radio\" name=\"duration_type\" value=\"m\" class=\"selectgroup-input\" checked=\"\">
                                              <span class=\"selectgroup-button\">";
        // line 138
        echo twig_escape_filter($this->env, l("month"), "html", null, true);
        echo "</span>
                                            </label>
                                            <label class=\"selectgroup-item\">
                                              <input type=\"radio\" name=\"duration_type\" value=\"y\" class=\"selectgroup-input\">
                                              <span class=\"selectgroup-button\">";
        // line 142
        echo twig_escape_filter($this->env, l("year"), "html", null, true);
        echo "</span>
                                            </label>
                                          </div>
                                      </div>
                                    </div>
                                </div>

                            </div>
                            </div>

                            <div class=\"form-footer mt-0\">
                              <button type=\"submit\" class=\"surfow_submit btn btn-indigo btn-pill\"><i class=\"fe fe-plus mr-2\"></i> ";
        // line 153
        echo twig_escape_filter($this->env, l("add_plan"), "html", null, true);
        echo "</button>
                            </div>
                          </div>
                        </form>
                        <script>
                        require([\"jquery\"], function(\$){
                            \$(document).ready(function(){
                                \$('.change_plan_type').change(function(){
                                    var type = \$(this).val();
                                    if(type == \"upgrade\")
                                    {
                                        \$('#websites').add('#sessions').add('#ratio').add('#duration').slideDown(300);
                                        \$('#points').slideUp(300);
                                    }

                                    if(type == \"traffic\")
                                    {
                                        \$('#websites').add('#sessions').add('#ratio').add('#duration').slideUp(300);
                                        \$('#points').slideDown(300);
                                    }

                                    if(type == \"websites\")
                                    {
                                        \$('#points').add('#sessions').add('#ratio').add('#duration').slideUp(300);
                                        \$('#websites').slideDown(300);
                                    }

                                    if(type == \"sessions\")
                                    {
                                        \$('#points').add('#websites').add('#ratio').add('#duration').slideUp(300);
                                        \$('#sessions').slideDown(300);
                                    }
                                });
                            });
                        });
                        </script>

                    </div>
                </div>
              </div>
          </div>
        </div>
        ";
        // line 195
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
    </div>
";
        // line 197
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "add_plan.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  315 => 197,  310 => 195,  265 => 153,  251 => 142,  244 => 138,  237 => 134,  228 => 128,  222 => 125,  214 => 120,  206 => 115,  199 => 111,  191 => 106,  184 => 102,  176 => 97,  169 => 93,  161 => 88,  151 => 81,  144 => 77,  135 => 71,  127 => 66,  119 => 61,  111 => 56,  103 => 51,  95 => 46,  87 => 41,  79 => 36,  71 => 31,  60 => 23,  52 => 18,  46 => 15,  38 => 10,  30 => 5,  26 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "add_plan.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\add_plan.html");
    }
}
