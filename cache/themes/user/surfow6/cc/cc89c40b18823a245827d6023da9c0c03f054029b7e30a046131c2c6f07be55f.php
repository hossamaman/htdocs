<?php

/* order.html */
class __TwigTemplate_9438d72b8c96f73c4329c79e106fcac3a242aae6ba05eb87c53e8344ce5ec963 extends Twig_Template
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
        echo twig_escape_filter($this->env, l("order"), "html", null, true);
        echo "
              </h1>
            </div>

            <div class=\"row\">

                <div class=\"col-lg-12\">
                  <div class=\"card\">
                    <div class=\"row\">
                        <div class=\"col-lg-6\">
                            <div class=\"card-body mt-6 text-center\">
                              <h1 style=\"font-weight:300;\" >";
        // line 21
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, l("buy_traffic")), "html", null, true);
        echo "</h1>
                            </div>
                        </div>
                        <div class=\"col-lg-2\">
                            <div class=\"card-body text-center\">
                                <div class=\"display-3 my-4\"><i class=\"fe fe-zap text-indigo\" ></i></div>
                            </div>
                        </div>
                        <div class=\"col-lg-4\">
                            <div class=\"card-body text-center\">
                                <div class=\"text-center mt-6\">
                                    <a href=\"";
        // line 32
        echo twig_escape_filter($this->env, router("order_type", "{\"type\":\"traffic\"}"), "html", null, true);
        echo "\" class=\"btn btn-pill btn-icon btn-indigo btn-block\"><i class=\"fe fe-zap\" ></i> ";
        echo twig_escape_filter($this->env, l("explore_plans"), "html", null, true);
        echo "</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>

              <div class=\"col-lg-4\">
                <div class=\"card\">
                  <div class=\"card-status bg-azure\"></div>
                  <div class=\"card-body text-center\">
                    <div class=\"card-category\">";
        // line 44
        echo twig_escape_filter($this->env, l("upgrade_now"), "html", null, true);
        echo "</div>
                    <div class=\"display-3 my-4\"><i class=\"fe fe-package text-azure\" ></i></div>
                    <div class=\"text-center mt-6\">
                      <a href=\"";
        // line 47
        echo twig_escape_filter($this->env, router("order_type", "{\"type\":\"upgrade\"}"), "html", null, true);
        echo "\" class=\"btn btn-pill btn-icon btn-azure btn-block\"><i class=\"fe fe-package\" ></i> ";
        echo twig_escape_filter($this->env, l("explore_plans"), "html", null, true);
        echo "</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class=\"col-lg-4\">
                <div class=\"card\">
                  <div class=\"card-status bg-orange\"></div>
                  <div class=\"card-body text-center\">
                    <div class=\"card-category\">";
        // line 57
        echo twig_escape_filter($this->env, l("session_slots"), "html", null, true);
        echo "</div>
                    <div class=\"display-3 my-4\"><i class=\"fe fe-server text-orange\" ></i></div>
                    <div class=\"text-center mt-6\">
                      <a href=\"";
        // line 60
        echo twig_escape_filter($this->env, router("order_type", "{\"type\":\"sessions\"}"), "html", null, true);
        echo "\" class=\"btn btn-pill btn-icon btn-orange btn-block\"><i class=\"fe fe-server\" ></i> ";
        echo twig_escape_filter($this->env, l("explore_plans"), "html", null, true);
        echo "</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class=\"col-lg-4\">
                <div class=\"card\">
                  <div class=\"card-status bg-cyan\"></div>
                  <div class=\"card-body text-center\">
                    <div class=\"card-category\">";
        // line 70
        echo twig_escape_filter($this->env, l("website_slots"), "html", null, true);
        echo "</div>
                    <div class=\"display-3 my-4\"><i class=\"fe fe-globe text-cyan\" ></i></div>
                    <div class=\"text-center mt-6\">
                      <a href=\"";
        // line 73
        echo twig_escape_filter($this->env, router("order_type", "{\"type\":\"websites\"}"), "html", null, true);
        echo "\" class=\"btn btn-pill btn-icon btn-cyan btn-block\"><i class=\"fe fe-globe\" ></i> ";
        echo twig_escape_filter($this->env, l("explore_plans"), "html", null, true);
        echo "</a>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <h1 class=\"page-title mb-2\">
               ";
        // line 82
        echo twig_escape_filter($this->env, l("purchases"), "html", null, true);
        echo "
            </h1>

            <div class=\"card\">
              <div class=\"card-status card-status-left bg-indigo\"></div>
              <div class=\"card-body\">
                  <div class=\"table-responsive\">
                      <table class=\"table card-table table-vcenter text-nowrap\">
                        <thead>
                          <tr>
                            <th>";
        // line 92
        echo twig_escape_filter($this->env, l("name"), "html", null, true);
        echo "</th>
                            <th>";
        // line 93
        echo twig_escape_filter($this->env, l("status"), "html", null, true);
        echo "</th>
                            <th>";
        // line 94
        echo twig_escape_filter($this->env, l("amount"), "html", null, true);
        echo "</th>
                            <th>";
        // line 95
        echo twig_escape_filter($this->env, l("date"), "html", null, true);
        echo "</th>
                          </tr>
                        </thead>
                        <tbody>
                            ";
        // line 99
        $context["items"] = get("items");
        // line 100
        echo "                            ";
        if (($context["items"] ?? null)) {
            // line 101
            echo "                                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 102
                echo "                                <tr>
                                  <td><span class=\"text-muted\">";
                // line 103
                echo twig_escape_filter($this->env, get_plan_name(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "plan_id", array())), "html", null, true);
                echo "</span></td>
                                  <td><span class=\"status-icon bg-success\"></span> ";
                // line 104
                echo twig_escape_filter($this->env, l("done"), "html", null, true);
                echo "</td>
                                  <td>
                                      <div>\$";
                // line 106
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "amount", array()), "html", null, true);
                echo "</div><div class=\"small text-muted\">";
                echo twig_escape_filter($this->env, twig_upper_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "currency", array())), "html", null, true);
                echo "</div>
                                  </td>
                                  <td>";
                // line 108
                echo twig_escape_filter($this->env, time_ago(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "created_at", array())), "html", null, true);
                echo "</td>
                                </tr>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 111
            echo "                                ";
            echo twig_escape_filter($this->env, _get("pagination"), "html", null, true);
            echo "
                            ";
        } else {
            // line 113
            echo "                                <p>";
            echo twig_escape_filter($this->env, l("error_empty_items"), "html", null, true);
            echo "</p>
                            ";
        }
        // line 115
        echo "                        </tbody>
                      </table>
                  </div>
              </div>
            </div>

            ";
        // line 121
        echo twig_include($this->env, $context, "refund_policy.html");
        echo "

            ";
        // line 123
        echo twig_include($this->env, $context, "ads_col2.html");
        echo "
      </div>
      ";
        // line 125
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
    </div>
";
        // line 127
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "order.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  253 => 127,  248 => 125,  243 => 123,  238 => 121,  230 => 115,  224 => 113,  218 => 111,  209 => 108,  202 => 106,  197 => 104,  193 => 103,  190 => 102,  185 => 101,  182 => 100,  180 => 99,  173 => 95,  169 => 94,  165 => 93,  161 => 92,  148 => 82,  134 => 73,  128 => 70,  113 => 60,  107 => 57,  92 => 47,  86 => 44,  69 => 32,  55 => 21,  41 => 10,  34 => 6,  30 => 5,  26 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "order.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\order.html");
    }
}
