<?php

/* websites.html */
class __TwigTemplate_6df05a4ea2d75f2da745f2044d97e4b71f24ed5bf5be40584c5112f503562549 extends Twig_Template
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

                    <div class=\"page-header\">
                      <h1 class=\"page-title\">
                         ";
        // line 10
        echo twig_escape_filter($this->env, l("websites"), "html", null, true);
        echo "
                      </h1>
                    </div>
                    <div id=\"surfow_alert\" ></div>

                    <div class=\"card\">
                      <div class=\"card-status card-status-left bg-indigo\"></div>
                      <div class=\"card-body btn-list\">
                          <a href=\"";
        // line 18
        echo twig_escape_filter($this->env, router("add_website"), "html", null, true);
        echo "\" class=\"btn btn-lg btn-indigo btn-pill mb-1\"><i class=\"fe fe-plus\"></i> ";
        echo twig_escape_filter($this->env, l("add_website"), "html", null, true);
        echo "</a>
                      </div>
                    </div>

                    ";
        // line 22
        $context["items"] = get("items");
        // line 23
        echo "                    ";
        if (($context["items"] ?? null)) {
            // line 24
            echo "                        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 25
                echo "                        ";
                $context["current_color"] = twig_random($this->env, array(0 => "blue", 1 => "azure", 2 => "indigo", 3 => "purple", 4 => "pink", 5 => "orange", 6 => "lime", 7 => "teal", 8 => "cyan", 9 => "gray", 10 => "gray-dark"));
                // line 26
                echo "                        <div id=\"item-";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()), "html", null, true);
                echo "\" class=\"card\">
                          <div class=\"card-status card-status-left bg-";
                // line 27
                echo twig_escape_filter($this->env, ($context["current_color"] ?? null), "html", null, true);
                echo "\"></div>
                          <div class=\"card-header\">
                            <h3 class=\"card-title text-";
                // line 29
                echo twig_escape_filter($this->env, ($context["current_color"] ?? null), "html", null, true);
                echo "\">
                                <span class=\"avatar avatar-sm\" style=\"background-color:#ffffff;background-image: url('";
                // line 30
                echo twig_escape_filter($this->env, fv(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "url", array())), "html", null, true);
                echo "');background-size: 16px 16px;\"></span>
                                ";
                // line 31
                echo twig_escape_filter($this->env, twig_slice($this->env, twig_replace_filter(twig_lower_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "url", array())), array("http://" => "", "https://" => "", "ftp://" => "")), 0, 14), "html", null, true);
                echo "...
                            </h3>
                            <div class=\"card-options\" style=\"display: table-cell;\" >
                                ";
                // line 34
                $context["live_now"] = website_live(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()));
                // line 35
                echo "                                ";
                if ((($context["live_now"] ?? null) > 0)) {
                    // line 36
                    echo "                                    <span class=\"status-icon bg-success\"></span> ";
                    echo twig_escape_filter($this->env, ($context["live_now"] ?? null), "html", null, true);
                    echo " <small>";
                    echo twig_escape_filter($this->env, l("visiting_now"), "html", null, true);
                    echo "</small>
                                ";
                } else {
                    // line 38
                    echo "                                    <span class=\"status-icon bg-warning\"></span> ";
                    echo twig_escape_filter($this->env, ($context["live_now"] ?? null), "html", null, true);
                    echo " <small>";
                    echo twig_escape_filter($this->env, l("visiting_now"), "html", null, true);
                    echo "</small>
                                ";
                }
                // line 40
                echo "                            </div>
                          </div>
                          <div class=\"card-body\">
                                <div title=\"";
                // line 43
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "activated", array()) == "1")) {
                    echo " ";
                    echo twig_escape_filter($this->env, l("confirmed_website"), "html", null, true);
                    echo " ";
                } else {
                    echo " ";
                    echo twig_escape_filter($this->env, l("pending_website"), "html", null, true);
                    echo " ";
                }
                echo "\" class=\"card-value float-right text-";
                echo twig_escape_filter($this->env, ($context["current_color"] ?? null), "html", null, true);
                echo "\">
                                    <i class=\"fe fe-";
                // line 44
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "activated", array()) == "1")) {
                    echo "activity";
                } else {
                    echo "clock";
                }
                echo "\"></i>
                                </div>
                                <h3 class=\"mb-1\">";
                // line 46
                echo twig_escape_filter($this->env, website_weekly_hits(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array())), "html", null, true);
                echo "</h3>
                                <div class=\"text-muted\">";
                // line 47
                echo twig_escape_filter($this->env, l("weekly_hits"), "html", null, true);
                echo "</div>
                          </div>
                          <div class=\"card-chart-bg\">
                                <div id=\"website-";
                // line 50
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()), "html", null, true);
                echo "\" style=\"height: 100%\"></div>
                          </div>
                          <div class=\"card-footer btn-list\">
                              <a href=\"#\" data-id=\"";
                // line 53
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()), "html", null, true);
                echo "\" title=\"";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "enabled", array()) == "1")) {
                    echo twig_escape_filter($this->env, l("pause_website"), "html", null, true);
                } else {
                    echo twig_escape_filter($this->env, l("activate_website"), "html", null, true);
                }
                echo "\" class=\"website_status_toggle btn btn-icon btn-primary btn-";
                echo twig_escape_filter($this->env, ($context["current_color"] ?? null), "html", null, true);
                echo "\">
                                  <i class=\"fe fe-";
                // line 54
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "enabled", array()) == "1")) {
                    echo "pause";
                } else {
                    echo "play";
                }
                echo "\"></i>
                              </a>
                              <a href=\"";
                // line 56
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "url", array()), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, l("view"), "html", null, true);
                echo "\" target=\"_blank\" class=\"btn btn-icon btn-secondary text-";
                echo twig_escape_filter($this->env, ($context["current_color"] ?? null), "html", null, true);
                echo "\"><i class=\"fe fe-external-link\" ></i></a>
                              <a href=\"";
                // line 57
                echo twig_escape_filter($this->env, router("copy_website", (("{\"id\":\"" . twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array())) . "\"}")), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, l("duplicate"), "html", null, true);
                echo "\" class=\"btn btn-icon btn-secondary text-";
                echo twig_escape_filter($this->env, ($context["current_color"] ?? null), "html", null, true);
                echo "\"><i class=\"fe fe-copy\" ></i></a>
                              <a href=\"";
                // line 58
                echo twig_escape_filter($this->env, router("edit_website", (("{\"id\":\"" . twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array())) . "\"}")), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, l("edit"), "html", null, true);
                echo "\" class=\"btn btn-icon btn-secondary text-";
                echo twig_escape_filter($this->env, ($context["current_color"] ?? null), "html", null, true);
                echo "\"><i class=\"fe fe-edit-2\" ></i></a>
                              <a href=\"#\" data-ele=\"#item-";
                // line 59
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()), "html", null, true);
                echo "\" data-id=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()), "html", null, true);
                echo "\" title=\"";
                echo twig_escape_filter($this->env, l("delete"), "html", null, true);
                echo "\" class=\"website_delete btn btn-icon btn-secondary text-";
                echo twig_escape_filter($this->env, ($context["current_color"] ?? null), "html", null, true);
                echo "\"><i class=\"fe fe-trash\" ></i> <span class=\"surfow_hide\">";
                echo twig_escape_filter($this->env, l("popup_check_message"), "html", null, true);
                echo "</span></a>
                          </div>
                          ";
                // line 61
                echo twig_escape_filter($this->env, website_weekly_stats(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()), ($context["current_color"] ?? null)), "html", null, true);
                echo "
                        </div>
                        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 64
            echo "                        ";
            echo twig_escape_filter($this->env, _get("pagination"), "html", null, true);
            echo "
                    ";
        } else {
            // line 66
            echo "                        <p>";
            echo twig_escape_filter($this->env, l("error_empty_items"), "html", null, true);
            echo "</p>
                    ";
        }
        // line 68
        echo "

        ";
        // line 70
        echo twig_include($this->env, $context, "ads_col2.html");
        echo "
      </div>
      ";
        // line 72
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
    </div>
";
        // line 74
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "websites.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  256 => 74,  251 => 72,  246 => 70,  242 => 68,  236 => 66,  230 => 64,  221 => 61,  208 => 59,  200 => 58,  192 => 57,  184 => 56,  175 => 54,  163 => 53,  157 => 50,  151 => 47,  147 => 46,  138 => 44,  124 => 43,  119 => 40,  111 => 38,  103 => 36,  100 => 35,  98 => 34,  92 => 31,  88 => 30,  84 => 29,  79 => 27,  74 => 26,  71 => 25,  66 => 24,  63 => 23,  61 => 22,  52 => 18,  41 => 10,  34 => 6,  30 => 5,  26 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "websites.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\websites.html");
    }
}
