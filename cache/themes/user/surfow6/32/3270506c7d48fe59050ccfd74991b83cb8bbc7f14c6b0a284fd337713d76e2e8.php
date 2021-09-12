<?php

/* upgrade_plans.html */
class __TwigTemplate_3012d5e235b2874aef3ab4ddd2659a95e7f528083ef90eefa64ffeb4034c3b98 extends Twig_Template
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
            ";
        // line 6
        echo twig_include($this->env, $context, "ads_col1.html");
        echo "
            ";
        // line 7
        $context["items"] = get("items");
        // line 8
        echo "            <div class=\"page-header d-flex\">
              <h1 class=\"page-title\">
                 ";
        // line 10
        echo twig_escape_filter($this->env, l("upgrade_account"), "html", null, true);
        echo "
              </h1>
              <div class=\"text-right ml-auto\">";
        // line 12
        echo twig_escape_filter($this->env, currency_options(), "html", null, true);
        echo "</div>
            </div>

            <div class=\"row\">

                ";
        // line 17
        $context["items"] = get("items");
        // line 18
        echo "                ";
        if (($context["items"] ?? null)) {
            // line 19
            echo "                    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 20
                echo "                    ";
                $context["color"] = "azure";
                // line 21
                echo "                    <div class=\"col-lg-4\">
                        <div class=\"card";
                // line 22
                if ( !check_plan(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()))) {
                    echo " disabled_plan";
                }
                echo "\">
                            ";
                // line 23
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "featured", array(), "array") == "1")) {
                    echo "<div class=\"card-status bg-";
                    echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                    echo "\"></div>";
                }
                // line 24
                echo "                            <div class=\"card-body text-center\">
                              <div class=\"card-category text-";
                // line 25
                echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "name", array()), "html", null, true);
                echo "</div>
                              <div class=\"display-3 my-4\">";
                // line 26
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, currency_convert(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "price", array())), 1, ".", ","), "html", null, true);
                echo "<small style=\"font-size:0.3em;\" >";
                echo twig_escape_filter($this->env, twig_upper_filter($this->env, current_currency()), "html", null, true);
                echo "</small></div>
                              <div class=\"list-group list-group-transparent mt-0 mb-0\">
                                  <span class=\"text-left list-group-item list-group-item-action d-flex align-items-center\" >
                                      <span class=\"icon mr-3\"><i class=\"fe fe-clock text-";
                // line 29
                echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                echo "\"></i></span>
                                      ";
                // line 30
                echo twig_escape_filter($this->env, plan_duration(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "duration", array())), "html", null, true);
                echo "
                                  </span>
                                  ";
                // line 32
                if ((twig_lower_filter($this->env, s("exchange/source")) != "yes")) {
                    // line 33
                    echo "                                  <span class=\"text-left list-group-item list-group-item-action d-flex align-items-center\" >
                                      <span class=\"icon mr-3\"><i class=\"fe fe-activity text-";
                    // line 34
                    echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                    echo "\"></i></span>
                                       ";
                    // line 35
                    echo twig_escape_filter($this->env, l("traffic_source"), "html", null, true);
                    echo "
                                  </span>
                                  ";
                }
                // line 38
                echo "                                  <span class=\"text-left list-group-item list-group-item-action d-flex align-items-center\" >
                                      <span class=\"icon mr-3\"><i class=\"fe fe-globe text-";
                // line 39
                echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                echo "\"></i></span>
                                      +";
                // line 40
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "website_slots", array()), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, l("website_slots"), "html", null, true);
                echo "
                                  </span>
                                  <span class=\"text-left list-group-item list-group-item-action d-flex align-items-center\" >
                                      <span class=\"icon mr-3\"><i class=\"fe fe-server text-";
                // line 43
                echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                echo "\"></i></span>
                                      +";
                // line 44
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "session_slots", array()), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, l("session_slots"), "html", null, true);
                echo "
                                  </span>
                                  <span class=\"text-left list-group-item list-group-item-action d-flex align-items-center\" >
                                      <span class=\"icon mr-3\"><i class=\"fe fe-percent text-";
                // line 47
                echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                echo "\"></i></span>
                                      ";
                // line 48
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "traffic_ratio", array()), "html", null, true);
                echo "% ";
                echo twig_escape_filter($this->env, l("traffic_ratio"), "html", null, true);
                echo "
                                  </span>
                                  ";
                // line 50
                if ((twig_lower_filter($this->env, s("geotarget/access")) != "free")) {
                    // line 51
                    echo "                                  <span class=\"text-left list-group-item list-group-item-action d-flex align-items-center\" >
                                      <span class=\"icon mr-3\"><i class=\"fe fe-tablet text-";
                    // line 52
                    echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                    echo "\"></i></span>
                                       ";
                    // line 53
                    echo twig_escape_filter($this->env, l("custom_useragent"), "html", null, true);
                    echo "
                                  </span>
                                  ";
                }
                // line 56
                echo "                                  ";
                if ((twig_lower_filter($this->env, s("exchange/useragent")) != "free")) {
                    // line 57
                    echo "                                  <span class=\"text-left list-group-item list-group-item-action d-flex align-items-center\" >
                                      <span class=\"icon mr-3\"><i class=\"fe fe-map-pin text-";
                    // line 58
                    echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                    echo "\"></i></span>
                                       ";
                    // line 59
                    echo twig_escape_filter($this->env, l("get_target"), "html", null, true);
                    echo "
                                  </span>
                                  ";
                }
                // line 62
                echo "                                  <span class=\"text-left list-group-item list-group-item-action d-flex align-items-center\" >
                                      <span class=\"icon mr-3\"><i class=\"fe fe-cpu text-";
                // line 63
                echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                echo "\"></i></span>
                                      ";
                // line 64
                echo twig_escape_filter($this->env, l("instant_activation"), "html", null, true);
                echo "
                                  </span>
                              </div>
                              <div class=\"text-center mt-6\">
                                <a href=\"";
                // line 68
                echo twig_escape_filter($this->env, router("checkout", (("{\"id\":\"" . surfow_encrypt(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()))) . "\"}")), "html", null, true);
                echo "\" class=\"btn btn-";
                echo twig_escape_filter($this->env, ($context["color"] ?? null), "html", null, true);
                echo " btn-block\"><i class=\"fe fe-shopping-cart\"></i> ";
                echo twig_escape_filter($this->env, l("choose_plan"), "html", null, true);
                echo "</a>
                              </div>
                            </div>
                        </div>
                    </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 74
            echo "                ";
        } else {
            // line 75
            echo "                    <p>";
            echo twig_escape_filter($this->env, l("error_empty_items"), "html", null, true);
            echo "</p>
                ";
        }
        // line 77
        echo "
            </div>
            ";
        // line 79
        echo twig_escape_filter($this->env, _get("pagination"), "html", null, true);
        echo "

            ";
        // line 81
        echo twig_include($this->env, $context, "ads_col2.html");
        echo "
      </div>
      ";
        // line 83
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
    </div>
";
        // line 85
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "upgrade_plans.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  253 => 85,  248 => 83,  243 => 81,  238 => 79,  234 => 77,  228 => 75,  225 => 74,  209 => 68,  202 => 64,  198 => 63,  195 => 62,  189 => 59,  185 => 58,  182 => 57,  179 => 56,  173 => 53,  169 => 52,  166 => 51,  164 => 50,  157 => 48,  153 => 47,  145 => 44,  141 => 43,  133 => 40,  129 => 39,  126 => 38,  120 => 35,  116 => 34,  113 => 33,  111 => 32,  106 => 30,  102 => 29,  94 => 26,  88 => 25,  85 => 24,  79 => 23,  73 => 22,  70 => 21,  67 => 20,  62 => 19,  59 => 18,  57 => 17,  49 => 12,  44 => 10,  40 => 8,  38 => 7,  34 => 6,  30 => 5,  26 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "upgrade_plans.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\upgrade_plans.html");
    }
}
