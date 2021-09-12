<?php

/* user_profile.html */
class __TwigTemplate_595233be0dfff6214945da5e271496909fcc0c2edd8efc26887c8f015c5481bc extends Twig_Template
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
";
        // line 2
        $context["user"] = get("user");
        // line 3
        echo "    <div class=\"page\">
        <div class=\"page-main\">
          ";
        // line 5
        echo twig_include($this->env, $context, "head_menu.html");
        echo "
          ";
        // line 6
        echo twig_include($this->env, $context, "main_menu.html");
        echo "
          <div class=\"my-3 my-md-5\">
              <div class=\"container\">
                <div class=\"page-header\">
                  <h1 class=\"page-title\">
                    ";
        // line 11
        echo twig_escape_filter($this->env, _get("title2"), "html", null, true);
        echo "
                  </h1>
                </div>
                <div class=\"row\">
                    <div class=\"col-lg-3 col-md-12\">
                        ";
        // line 16
        echo twig_include($this->env, $context, "profile_menu.html");
        echo "
                    </div>
                    <div class=\"col-lg-9 col-md-12\">
                        <div class=\"card\">

                          <div class=\"card-body\">
                              <div class=\"row\">

                                <div class=\"col-sm-6 col-lg-3\">
                                  <div class=\"card p-3\">
                                    <div class=\"d-flex align-items-center\">
                                      <span class=\"stamp stamp-md bg-indigo mr-3\">
                                        <i class=\"fe fe-shield\"></i>
                                      </span>
                                      <div>
                                          <h4 class=\"m-0\"><a class=\"text-uppercase\" >
                                              ";
        // line 32
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "type", array()) == "pro")) {
            // line 33
            echo "                                                <small>";
            echo twig_escape_filter($this->env, l("paid_account"), "html", null, true);
            echo "</small>
                                              ";
        } else {
            // line 35
            echo "                                                <small>";
            echo twig_escape_filter($this->env, l("free_account"), "html", null, true);
            echo "</small>
                                              ";
        }
        // line 37
        echo "                                          </a>
                                          </h4>
                                      </div>
                                    </div>
                                  </div>
                                </div>

                                  <div class=\"col-sm-6 col-lg-3\">
                                    <div class=\"card p-3\">
                                      <div class=\"d-flex align-items-center\">
                                        <span class=\"stamp stamp-md bg-indigo mr-3\">
                                          <i class=\"fe fe-globe\"></i>
                                        </span>
                                        <div>
                                          <h4 class=\"m-0\"><a class=\"text-uppercase\" >
                                              ";
        // line 52
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "website_slots", array()), "html", null, true);
        echo "
                                              <small>";
        // line 53
        echo twig_escape_filter($this->env, l("website_slots"), "html", null, true);
        echo "</small></a>
                                          </h4>
                                        </div>
                                    </div>
                                    </div>
                                  </div>

                                  <div class=\"col-sm-6 col-lg-3\">
                                    <div class=\"card p-3\">
                                      <div class=\"d-flex align-items-center\">
                                        <span class=\"stamp stamp-md bg-indigo mr-3\">
                                          <i class=\"fe fe-server\"></i>
                                        </span>
                                        <div>
                                            <h4 class=\"m-0\"><a class=\"text-uppercase\" >
                                                ";
        // line 68
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "session_slots", array()), "html", null, true);
        echo "
                                                <small>";
        // line 69
        echo twig_escape_filter($this->env, l("session_slots"), "html", null, true);
        echo "</small></a>
                                            </h4>
                                        </div>
                                    </div>
                                    </div>
                                  </div>

                                  <div class=\"col-sm-6 col-lg-3\">
                                    <div class=\"card p-3\">
                                      <div class=\"d-flex align-items-center\">
                                        <span class=\"stamp stamp-md bg-indigo mr-3\">
                                          <i class=\"fe fe-percent\"></i>
                                        </span>
                                        <div>
                                          <h4 class=\"m-0\"><a class=\"text-uppercase\" >
                                              ";
        // line 84
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "traffic_ratio", array()), "html", null, true);
        echo "%
                                              <small>";
        // line 85
        echo twig_escape_filter($this->env, l("traffic_ratio"), "html", null, true);
        echo "</small></a>
                                          </h4>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class=\"col-6 col-sm-4 col-lg-4\">
                                    <div class=\"card\">
                                      <div class=\"card-body p-3 text-center\">
                                        <div class=\"text-right text-green\">
                                          <i class=\"fe fe-database\"></i>
                                        </div>
                                        <div class=\"h1 m-0\">";
        // line 98
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "points", array()), 0, ".", ","), "html", null, true);
        echo "</div>
                                        <div class=\"text-muted mb-4\">";
        // line 99
        echo twig_escape_filter($this->env, l("points"), "html", null, true);
        echo "</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class=\"col-6 col-sm-4 col-lg-4\">
                                    <div class=\"card\">
                                      <div class=\"card-body p-3 text-center\">
                                        <div class=\"text-right text-orange\">
                                          <i class=\"fe fe-database\"></i>
                                        </div>
                                        <div class=\"h1 m-0\">";
        // line 109
        echo twig_escape_filter($this->env, do_action("template", "monthly_earning"), "html", null, true);
        echo "</div>
                                        <div class=\"text-muted mb-4\">";
        // line 110
        echo twig_escape_filter($this->env, l("monthly_earning"), "html", null, true);
        echo "</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class=\"col-6 col-sm-4 col-lg-4\">
                                    <div class=\"card\">
                                      <div class=\"card-body p-3 text-center\">
                                        <div class=\"text-right text-blue\">
                                          <i class=\"fe fe-database\"></i>
                                        </div>
                                        <div class=\"h1 m-0\">";
        // line 120
        echo twig_escape_filter($this->env, do_action("template", "weekly_earning"), "html", null, true);
        echo "</div>
                                        <div class=\"text-muted mb-4\">";
        // line 121
        echo twig_escape_filter($this->env, l("weekly_earning"), "html", null, true);
        echo "</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class=\"col-6 col-sm-4 col-lg-4\">
                                    <div class=\"card\">
                                      <div class=\"card-body p-3 text-center\">
                                        <div class=\"text-right text-green\">
                                          <i class=\"fe fe-bar-chart-2\"></i>
                                        </div>
                                        <div class=\"h1 m-0\">";
        // line 131
        echo twig_escape_filter($this->env, do_action("template", "hits_in_6_months"), "html", null, true);
        echo "</div>
                                        <div class=\"text-muted mb-4\">";
        // line 132
        echo twig_escape_filter($this->env, l("6_months_hits"), "html", null, true);
        echo "</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class=\"col-6 col-sm-4 col-lg-4\">
                                    <div class=\"card\">
                                      <div class=\"card-body p-3 text-center\">
                                        <div class=\"text-right text-orange\">
                                          <i class=\"fe fe-bar-chart-2\"></i>
                                        </div>
                                        <div class=\"h1 m-0\">";
        // line 142
        echo twig_escape_filter($this->env, do_action("template", "monthly_hits"), "html", null, true);
        echo "</div>
                                        <div class=\"text-muted mb-4\">";
        // line 143
        echo twig_escape_filter($this->env, l("monthly_hits"), "html", null, true);
        echo "</div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class=\"col-6 col-sm-4 col-lg-4\">
                                    <div class=\"card\">
                                      <div class=\"card-body p-3 text-center\">
                                        <div class=\"text-right text-blue\">
                                          <i class=\"fe fe-bar-chart-2\"></i>
                                        </div>
                                        <div class=\"h1 m-0\">";
        // line 153
        echo twig_escape_filter($this->env, do_action("template", "weekly_hits"), "html", null, true);
        echo "</div>
                                        <div class=\"text-muted mb-4\">";
        // line 154
        echo twig_escape_filter($this->env, l("weekly_hits"), "html", null, true);
        echo "</div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class=\"col-lg-12\">
                                    <h3><i class=\"fe fe-bar-chart-2 text-orange\" ></i> ";
        // line 160
        echo twig_escape_filter($this->env, l("stats_today"), "html", null, true);
        echo "</h3>
                                    <div id=\"stats_in_24\" style=\"height: 12rem\"></div>
                                    ";
        // line 162
        echo twig_escape_filter($this->env, do_action("template", "stats_in_24"), "html", null, true);
        echo "
                                  </div>

                                  <div class=\"col-lg-12\">
                                    <h3><i class=\"fe fe-bar-chart-2 text-orange\" ></i> ";
        // line 166
        echo twig_escape_filter($this->env, l("stats_6months"), "html", null, true);
        echo "</h3>
                                    <div id=\"stats_in_6months\" style=\"height: 12rem\"></div>
                                    ";
        // line 168
        echo twig_escape_filter($this->env, do_action("template", "stats_in_6months"), "html", null, true);
        echo "
                                  </div>
                              </div>

                          </div>
                        </div>
                    </div>
                </div>
              </div>
          </div>
        </div>
        ";
        // line 179
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
    </div>
";
        // line 181
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "user_profile.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  298 => 181,  293 => 179,  279 => 168,  274 => 166,  267 => 162,  262 => 160,  253 => 154,  249 => 153,  236 => 143,  232 => 142,  219 => 132,  215 => 131,  202 => 121,  198 => 120,  185 => 110,  181 => 109,  168 => 99,  164 => 98,  148 => 85,  144 => 84,  126 => 69,  122 => 68,  104 => 53,  100 => 52,  83 => 37,  77 => 35,  71 => 33,  69 => 32,  50 => 16,  42 => 11,  34 => 6,  30 => 5,  26 => 3,  24 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "user_profile.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\user_profile.html");
    }
}
