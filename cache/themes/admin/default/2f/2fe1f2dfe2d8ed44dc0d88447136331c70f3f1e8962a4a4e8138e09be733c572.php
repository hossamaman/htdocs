<?php

/* plans.html */
class __TwigTemplate_2f72d3c14f3046715333c9fd8aaa09400a1b5cba1e59a0e7c2cd9630ddd90514 extends Twig_Template
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
                    ";
        // line 14
        $context["items"] = get("items");
        // line 15
        echo "                    <div class=\"col-12\">
                        ";
        // line 16
        echo twig_include($this->env, $context, "plans_menu.html");
        echo "
                        ";
        // line 17
        if (($context["items"] ?? null)) {
            // line 18
            echo "                        <div class=\"card\">
                          <div class=\"table-responsive\">
                            <table class=\"table table-hover table-outline table-vcenter text-nowrap card-table\">
                              <thead>
                                <tr>
                                  <th class=\"text-center w-1\"><i class=\"icon-people\"></i></th>
                                  <th>";
            // line 24
            echo twig_escape_filter($this->env, l("name"), "html", null, true);
            echo "</th>
                                  <th>";
            // line 25
            echo twig_escape_filter($this->env, l("price"), "html", null, true);
            echo "</th>
                                  <th class=\"text-center\">";
            // line 26
            echo twig_escape_filter($this->env, l("plan_type"), "html", null, true);
            echo "</th>
                                  <th>";
            // line 27
            echo twig_escape_filter($this->env, l("featured"), "html", null, true);
            echo "</th>
                                  <th class=\"text-center\"><i class=\"icon-settings\"></i></th>
                                </tr>
                              </thead>
                              <tbody>

                                ";
            // line 33
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 34
                echo "                                ";
                $context["uniqueid"] = surfow_encrypt(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()));
                // line 35
                echo "                                ";
                $context["this_table"] = "plans";
                // line 36
                echo "                                <tr id=\"item_";
                echo twig_escape_filter($this->env, ($context["uniqueid"] ?? null), "html", null, true);
                echo "\" >
                                  <td class=\"text-center\">
                                    <span class=\"avatar\">";
                // line 38
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()), "html", null, true);
                echo "
                                        ";
                // line 39
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "status", array())) {
                    // line 40
                    echo "                                        <span class=\"avatar-status bg-indigo\"></span>
                                        ";
                } else {
                    // line 42
                    echo "                                        <span class=\"avatar-status bg-danger\"></span>
                                        ";
                }
                // line 44
                echo "                                    </span>
                                  </td>
                                  <td>
                                    <div>";
                // line 47
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "name", array())) {
                    echo " ";
                    echo twig_escape_filter($this->env, twig_upper_filter($this->env, twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "name", array()))), "html", null, true);
                    echo " ";
                } else {
                    echo "N/A";
                }
                echo "</div>
                                    <div class=\"small text-muted\">
                                      ";
                // line 49
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "created_at", array())) {
                    echo " ";
                    echo twig_escape_filter($this->env, l("added"), "html", null, true);
                    echo " ";
                    echo twig_escape_filter($this->env, time_ago(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "created_at", array())), "html", null, true);
                    echo " ";
                } else {
                    echo "N/A";
                }
                // line 50
                echo "                                    </div>
                                  </td>
                                  <td class=\"text-left\">
                                      <div><i class=\"fe fe-dollar-sign text-orange\" ></i> ";
                // line 53
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "price", array()));
                echo "</div>
                                  </td>
                                  <td class=\"text-center\">
                                      ";
                // line 56
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "type", array()) == "upgrade")) {
                    // line 57
                    echo "                                        <div><img class=\"user-type\" src=\"";
                    echo twig_escape_filter($this->env, storage("data/upgrade_plan.svg"), "html", null, true);
                    echo "\" /></div>
                                        <div><small>";
                    // line 58
                    echo twig_escape_filter($this->env, l("upgrade_plan"), "html", null, true);
                    echo "</small></div>
                                      ";
                }
                // line 60
                echo "                                      ";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "type", array()) == "traffic")) {
                    // line 61
                    echo "                                        <div><img class=\"user-type\" src=\"";
                    echo twig_escape_filter($this->env, storage("data/points_plan.svg"), "html", null, true);
                    echo "\" /></div>
                                        <div><small>";
                    // line 62
                    echo twig_escape_filter($this->env, l("traffic_plan"), "html", null, true);
                    echo "</small></div>
                                      ";
                }
                // line 64
                echo "                                      ";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "type", array()) == "websites")) {
                    // line 65
                    echo "                                        <div><img class=\"user-type\" src=\"";
                    echo twig_escape_filter($this->env, storage("data/websites_plan.svg"), "html", null, true);
                    echo "\" /></div>
                                        <div><small>";
                    // line 66
                    echo twig_escape_filter($this->env, l("websites_plan"), "html", null, true);
                    echo "</small></div>
                                      ";
                }
                // line 68
                echo "                                      ";
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "type", array()) == "sessions")) {
                    // line 69
                    echo "                                        <div><img class=\"user-type\" src=\"";
                    echo twig_escape_filter($this->env, storage("data/sessions_plan.svg"), "html", null, true);
                    echo "\" /></div>
                                        <div><small>";
                    // line 70
                    echo twig_escape_filter($this->env, l("sessions_plan"), "html", null, true);
                    echo "</small></div>
                                      ";
                }
                // line 72
                echo "                                  </td>
                                  <td>
                                      ";
                // line 74
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "featured", array())) {
                    // line 75
                    echo "                                      <span class=\"text-green\"><i class=\"fe fe-star\"></i>  ";
                    echo twig_escape_filter($this->env, twig_upper_filter($this->env, l("featured")), "html", null, true);
                    echo "</span>
                                      ";
                } else {
                    // line 77
                    echo "                                      <span class=\"text-muted\"><i class=\"fe fe-star\"></i>  ";
                    echo twig_escape_filter($this->env, twig_upper_filter($this->env, l("not_featured")), "html", null, true);
                    echo "</span>
                                      ";
                }
                // line 79
                echo "                                  </td>
                                  <td class=\"text-center\">
                                    <div class=\"item-action dropdown\">
                                      <a href=\"javascript:void(0)\" data-toggle=\"dropdown\" class=\"icon\" aria-expanded=\"false\"><i class=\"fe fe-more-vertical\"></i></a>
                                      <div class=\"dropdown-menu dropdown-menu-right\" x-placement=\"bottom-end\" >
                                        <a href=\"";
                // line 84
                echo twig_escape_filter($this->env, router("admin_edit_plan", array("id" => twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()))), "html", null, true);
                echo "\" class=\"dropdown-item\" ><i class=\"dropdown-icon fe fe-edit-2\"></i> ";
                echo twig_escape_filter($this->env, l("edit"), "html", null, true);
                echo "</a>
                                        <a id=\"enable_";
                // line 85
                echo twig_escape_filter($this->env, ($context["uniqueid"] ?? null), "html", null, true);
                echo "\" data-action=\"enable\" data-table=\"";
                echo twig_escape_filter($this->env, ($context["this_table"] ?? null), "html", null, true);
                echo "\" data-id=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()), "html", null, true);
                echo "\" data-target=\"";
                echo twig_escape_filter($this->env, ($context["uniqueid"] ?? null), "html", null, true);
                echo "\" href=\"javascript:void(0)\" class=\"item_action dropdown-item\" ";
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "status", array())) {
                    echo "style=\"display:none;\"";
                }
                echo " ><i class=\"dropdown-icon fe fe-play\"></i> ";
                echo twig_escape_filter($this->env, l("enable"), "html", null, true);
                echo "</a>
                                        <a id=\"disable_";
                // line 86
                echo twig_escape_filter($this->env, ($context["uniqueid"] ?? null), "html", null, true);
                echo "\" data-action=\"disable\" data-table=\"";
                echo twig_escape_filter($this->env, ($context["this_table"] ?? null), "html", null, true);
                echo "\" data-id=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()), "html", null, true);
                echo "\" data-target=\"";
                echo twig_escape_filter($this->env, ($context["uniqueid"] ?? null), "html", null, true);
                echo "\" href=\"javascript:void(0)\" class=\"item_action dropdown-item\" ";
                if ( !twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "status", array())) {
                    echo "style=\"display:none;\"";
                }
                echo " ><i class=\"dropdown-icon fe fe-pause\"></i> ";
                echo twig_escape_filter($this->env, l("disable"), "html", null, true);
                echo "</a>
                                        <a id=\"delete_";
                // line 87
                echo twig_escape_filter($this->env, ($context["uniqueid"] ?? null), "html", null, true);
                echo "\" data-action=\"delete\" data-table=\"";
                echo twig_escape_filter($this->env, ($context["this_table"] ?? null), "html", null, true);
                echo "\" data-id=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()), "html", null, true);
                echo "\" data-target=\"";
                echo twig_escape_filter($this->env, ($context["uniqueid"] ?? null), "html", null, true);
                echo "\" href=\"javascript:void(0)\" class=\"item_action dropdown-item\"><i class=\"dropdown-icon fe fe-trash\"></i> ";
                echo twig_escape_filter($this->env, l("delete"), "html", null, true);
                echo "</a>
                                        <div class=\"dropdown-divider\"></div>
                                        <a href=\"javascript:void(0)\" class=\"dropdown-item\"><i class=\"dropdown-icon fe fe-x\"></i> ";
                // line 89
                echo twig_escape_filter($this->env, l("cancel"), "html", null, true);
                echo "</a>
                                      </div>
                                    </div>
                                  </td>
                                </tr>
                                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 95
            echo "
                              </tbody>
                            </table>
                          </div>
                        </div>
                        ";
            // line 100
            echo twig_escape_filter($this->env, _get("pagination"), "html", null, true);
            echo "
                    </div>
                    ";
        } else {
            // line 103
            echo "                    <p class=\"p-3 text-muted\" ><i class=\"fe fe-activity\" ></i> ";
            echo twig_escape_filter($this->env, l("nothing_found"), "html", null, true);
            echo "</p>
                    ";
        }
        // line 105
        echo "                </div>
              </div>
          </div>
        </div>
        ";
        // line 109
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
    </div>
";
        // line 111
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "plans.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  321 => 111,  316 => 109,  310 => 105,  304 => 103,  298 => 100,  291 => 95,  279 => 89,  266 => 87,  250 => 86,  234 => 85,  228 => 84,  221 => 79,  215 => 77,  209 => 75,  207 => 74,  203 => 72,  198 => 70,  193 => 69,  190 => 68,  185 => 66,  180 => 65,  177 => 64,  172 => 62,  167 => 61,  164 => 60,  159 => 58,  154 => 57,  152 => 56,  146 => 53,  141 => 50,  131 => 49,  120 => 47,  115 => 44,  111 => 42,  107 => 40,  105 => 39,  101 => 38,  95 => 36,  92 => 35,  89 => 34,  85 => 33,  76 => 27,  72 => 26,  68 => 25,  64 => 24,  56 => 18,  54 => 17,  50 => 16,  47 => 15,  45 => 14,  38 => 10,  30 => 5,  26 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "plans.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\plans.html");
    }
}
