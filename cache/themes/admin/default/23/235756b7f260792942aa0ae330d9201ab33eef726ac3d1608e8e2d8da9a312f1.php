<?php

/* overview.html */
class __TwigTemplate_b7cefaa800b02fa8eb5086ba371c63345fe0e9ccf8707591a5d3079bc9c94646 extends Twig_Template
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
        // line 11
        echo twig_escape_filter($this->env, get("title2"), "html", null, true);
        echo "
              </h1>
            </div>
            <div id=\"surfow_alert\"></div>
            <div class=\"row row-cards\">

                <div class=\"col-12 col-sm-12 col-lg-12\">
                    <div class=\"card card-body pb-0 pt-0 mb-4\" >
                        <div class=\"card-status card-status-left bg-indigo\"></div>
                        <ul class=\"nav nav-tabs border-0 mt-0 mb-0\">
                            <li class=\"nav-item\">
                                <a href=\"";
        // line 22
        echo twig_escape_filter($this->env, router("admin_latest_payments"), "html", null, true);
        echo "\" class=\"nav-link\"><i class=\"fe fe-dollar-sign text-red\"></i> ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, get("all_money_pending"), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, l("pending_status"), "html", null, true);
        echo "</a>
                            </li>
                            <li class=\"nav-item\">
                                <a href=\"";
        // line 25
        echo twig_escape_filter($this->env, router("admin_latest_payments"), "html", null, true);
        echo "\" class=\"nav-link\"><i class=\"fe fe-dollar-sign text-green\"></i> ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, get("all_money_confirmed"), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, l("confirmed"), "html", null, true);
        echo "</a>
                            </li>
                            <li class=\"nav-item\">
                                <a href=\"";
        // line 28
        echo twig_escape_filter($this->env, router("admin_latest_payments"), "html", null, true);
        echo "\" class=\"nav-link\"><i class=\"fe fe-dollar-sign text-orange\"></i> ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, get("all_money_withdrawal"), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, l("waiting_for_withdrawal"), "html", null, true);
        echo "</a>
                            </li>
                        </ul>
                    </div>
                </div>

              <div class=\"col-6 col-sm-4 col-lg-2\">
                <div class=\"card\">
                  <div class=\"card-body p-3 text-center\">
                    <div class=\"text-right text-indigo\">
                      <i class=\"fe fe-users\"></i>
                    </div>
                    <div class=\"h1 m-0\">";
        // line 40
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, get("users_count"), 0, ".", ","), "html", null, true);
        echo "</div>
                    <div class=\"text-muted mb-4\">";
        // line 41
        echo twig_escape_filter($this->env, l("users"), "html", null, true);
        echo "</div>
                  </div>
                </div>
              </div>

              <div class=\"col-6 col-sm-4 col-lg-2\">
                <div class=\"card\">
                  <div class=\"card-body p-3 text-center\">
                    <div class=\"text-right text-indigo\">
                      <i class=\"fe fe-globe\"></i>
                    </div>
                    <div class=\"h1 m-0\">";
        // line 52
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, get("websites_count"), 0, ".", ","), "html", null, true);
        echo "</div>
                    <div class=\"text-muted mb-4\">";
        // line 53
        echo twig_escape_filter($this->env, l("websites"), "html", null, true);
        echo "</div>
                  </div>
                </div>
              </div>

              <div class=\"col-6 col-sm-4 col-lg-2\">
                <div class=\"card\">
                  <div class=\"card-body p-3 text-center\">
                    <div class=\"text-right text-indigo\">
                      <i class=\"fe fe-shopping-cart\"></i>
                    </div>
                    <div class=\"h1 m-0\">";
        // line 64
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, get("purchases_count"), 0, ".", ","), "html", null, true);
        echo "</div>
                    <div class=\"text-muted mb-4\">";
        // line 65
        echo twig_escape_filter($this->env, l("purchases"), "html", null, true);
        echo "</div>
                  </div>
                </div>
              </div>

              <div class=\"col-6 col-sm-4 col-lg-2\">
                <div class=\"card\">
                  <div class=\"card-body p-3 text-center\">
                    <div class=\"text-right text-indigo\">
                      <i class=\"fe fe-dollar-sign\"></i>
                    </div>
                    <div class=\"h1 m-0\">";
        // line 76
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, get("payments_count"), 0, ".", ","), "html", null, true);
        echo "</div>
                    <div class=\"text-muted mb-4\">";
        // line 77
        echo twig_escape_filter($this->env, l("payments"), "html", null, true);
        echo "</div>
                  </div>
                </div>
              </div>

              <div class=\"col-12 col-sm-8 col-lg-4\">
                <span class=\"text-indigo\"><i class=\"fe fe-database text-indigo\"></i> ";
        // line 83
        echo twig_escape_filter($this->env, l("earned_by_system"), "html", null, true);
        echo "</span>
                <div class=\"card bg-indigo\">
                  <div class=\"card-body p-1 text-center\">
                    <div class=\"display-4 font-weight-bold mt-2 mb-5 text-white\">";
        // line 86
        echo twig_escape_filter($this->env, short_points(get("points_earned_count")), "html", null, true);
        echo "</div>
                  </div>
                </div>
              </div>

              <div class=\"col-lg-6\">
                  <div class=\"card\">
                    <div class=\"card-body\">
                      <div class=\"map\">
                        <div class=\"map-content\" id=\"online-map\"></div>
                      </div>
                      ";
        // line 97
        echo twig_escape_filter($this->env, do_action("template", "online_map"), "html", null, true);
        echo "
                    </div>
                  </div>
              </div>

              <div class=\"col-lg-3\">
                  <span><i class=\"fe fe-activity text-green\"></i> ";
        // line 103
        echo twig_escape_filter($this->env, l("in_6months"), "html", null, true);
        echo "</span>
                  <div class=\"row\">
                      <div class=\"col-lg-12\">
                        <div class=\"card\">
                          <div class=\"card-body p-3 text-center\">
                            <div class=\"text-right text-indigo\">
                              <i class=\"fe fe-database\"></i>
                            </div>
                            <div class=\"h5\">";
        // line 111
        echo twig_escape_filter($this->env, l("points"), "html", null, true);
        echo "</div>
                            <div class=\"display-4 font-weight-bold mb-5\">";
        // line 112
        echo twig_escape_filter($this->env, short_points(get("points_count")), "html", null, true);
        echo "</div>
                          </div>
                        </div>
                      </div>

                      <div class=\"col-lg-12\">
                        <div class=\"card\">
                          <div class=\"card-body p-3 text-center\">
                            <div class=\"text-right text-indigo\">
                              <i class=\"fe fe-pie-chart\"></i>
                            </div>
                            <div class=\"h5\">";
        // line 123
        echo twig_escape_filter($this->env, l("hits"), "html", null, true);
        echo "</div>
                            <div class=\"display-4 font-weight-bold mb-4\">";
        // line 124
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, get("hits_count"), 0, ".", ","), "html", null, true);
        echo "</div>
                          </div>
                        </div>
                      </div>
                  </div>
              </div>

              <div class=\"col-lg-3\">
                <span><i class=\"fe fe-map-pin text-green\"></i> ";
        // line 132
        echo twig_escape_filter($this->env, l("top_countries"), "html", null, true);
        echo "</span>
                <div class=\"p-3\">
                  <div class=\"mt-4\">
                    <div id=\"top_countries\" style=\"height: 15rem\"></div>
                  </div>
                </div>
                ";
        // line 138
        echo twig_escape_filter($this->env, do_action("template", "top_countries"), "html", null, true);
        echo "
              </div>

              <div class=\"col-lg-12\">
                <span><i class=\"fe fe-activity text-green\"></i> ";
        // line 142
        echo twig_escape_filter($this->env, l("6months_statistics"), "html", null, true);
        echo "</span>
                <div class=\"card\">
                 <div id=\"all_hits\" style=\"height: 15rem\"></div>
                </div>
                ";
        // line 146
        echo twig_escape_filter($this->env, do_action("template", "all_hits"), "html", null, true);
        echo "
              </div>

            </div>

          </div>
        </div>

      </div>
      ";
        // line 155
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
    </div>
";
        // line 157
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "overview.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  272 => 157,  267 => 155,  255 => 146,  248 => 142,  241 => 138,  232 => 132,  221 => 124,  217 => 123,  203 => 112,  199 => 111,  188 => 103,  179 => 97,  165 => 86,  159 => 83,  150 => 77,  146 => 76,  132 => 65,  128 => 64,  114 => 53,  110 => 52,  96 => 41,  92 => 40,  73 => 28,  63 => 25,  53 => 22,  39 => 11,  30 => 5,  26 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "overview.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\overview.html");
    }
}
