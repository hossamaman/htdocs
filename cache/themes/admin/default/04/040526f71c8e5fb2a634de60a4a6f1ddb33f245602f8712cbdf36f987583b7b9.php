<?php

/* users.html */
class __TwigTemplate_93274c80eeea14cbcd8534cf74bbddff66cb020295f4a9b60c043d3e73011b79 extends Twig_Template
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
                <div id=\"surfow_alert\" ></div>
                <div class=\"row\">

                    ";
        // line 16
        $context["items"] = get("items");
        // line 17
        echo "                    <div class=\"col-12\">
                        ";
        // line 18
        echo twig_include($this->env, $context, "users_menu.html");
        echo "
                        ";
        // line 19
        if (($context["items"] ?? null)) {
            // line 20
            echo "                        <div class=\"card\">
                          <div class=\"table-responsive\">
                            <table class=\"table table-hover table-outline table-vcenter text-nowrap card-table\">
                              <thead>
                                <tr>
                                  <th class=\"text-center w-1\"><i class=\"icon-people\"></i></th>
                                  <th>";
            // line 26
            echo twig_escape_filter($this->env, l("user"), "html", null, true);
            echo "</th>
                                  <th>";
            // line 27
            echo twig_escape_filter($this->env, l("user_balance"), "html", null, true);
            echo "</th>
                                  <th class=\"text-center\">";
            // line 28
            echo twig_escape_filter($this->env, l("account_type"), "html", null, true);
            echo "</th>
                                  <th>";
            // line 29
            echo twig_escape_filter($this->env, l("activity"), "html", null, true);
            echo "</th>
                                  <th class=\"text-center\"><i class=\"icon-settings\"></i></th>
                                  <th class=\"text-center\"><i class=\"icon-settings\"></i></th>
                                </tr>
                              </thead>
                              <tbody>

                                ";
            // line 36
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 37
                echo "                                ";
                $context["uniqueid"] = surfow_encrypt(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()));
                // line 38
                echo "                                ";
                $context["this_table"] = "users";
                // line 39
                echo "                                ";
                $context["wallet"] = user_wallet(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()));
                // line 40
                echo "                                <tr id=\"item_";
                echo twig_escape_filter($this->env, ($context["uniqueid"] ?? null), "html", null, true);
                echo "\" >
                                  <td class=\"text-center\">
                                    <div class=\"avatar d-block\" style=\"background-image: url('";
                // line 42
                echo twig_escape_filter($this->env, gravatar(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "email", array())), "html", null, true);
                echo "')\">
                                      ";
                // line 43
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "status", array())) {
                    // line 44
                    echo "                                      <span class=\"avatar-status bg-indigo\"></span>
                                      ";
                } else {
                    // line 46
                    echo "                                      <span class=\"avatar-status bg-danger\"></span>
                                      ";
                }
                // line 48
                echo "                                    </div>
                                  </td>
                                  <td>
                                    <div>";
                // line 51
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "username", array())) {
                    echo " @";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "username", array()));
                    echo " ";
                } else {
                    echo "N/A";
                }
                echo "</div>
                                    <div class=\"small text-muted\">
                                      ";
                // line 53
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "created_at", array())) {
                    echo " ";
                    echo twig_escape_filter($this->env, l("registered"), "html", null, true);
                    echo " ";
                    echo twig_escape_filter($this->env, time_ago(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "created_at", array())), "html", null, true);
                    echo " ";
                }
                // line 54
                echo "                                    </div>
                                  </td>
                                  <td>
                                    <div><i class=\"fe fe-database text-green\" ></i> ";
                // line 57
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "points", array()), 2, ".", ","), "html", null, true);
                echo "</div>
                                    <div><i class=\"fe fe-dollar-sign text-orange\" ></i> ";
                // line 58
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["wallet"] ?? null), "confirmed", array()), 2, ".", ","), "html", null, true);
                echo "</div>
                                  </td>
                                  <td class=\"text-center\">
                                      ";
                // line 61
                if ((twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "type", array()) == "pro")) {
                    // line 62
                    echo "                                        <div><img class=\"user-type\" src=\"";
                    echo twig_escape_filter($this->env, storage("data/pro.svg"), "html", null, true);
                    echo "\" /></div>
                                        <div><small>";
                    // line 63
                    echo twig_escape_filter($this->env, l("paid_account"), "html", null, true);
                    echo "</small></div>
                                      ";
                } else {
                    // line 65
                    echo "                                        <div><img class=\"user-type\" src=\"";
                    echo twig_escape_filter($this->env, storage("data/free.svg"), "html", null, true);
                    echo "\" /></div>
                                        <div><small>";
                    // line 66
                    echo twig_escape_filter($this->env, l("free_account"), "html", null, true);
                    echo "</small></div>
                                      ";
                }
                // line 68
                echo "                                  </td>
                                  <td>
                                    <div class=\"small text-muted\">";
                // line 70
                echo twig_escape_filter($this->env, l("last_seen"), "html", null, true);
                echo "</div>
                                    <div>";
                // line 71
                if (twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "last_run", array())) {
                    echo " ";
                    echo twig_escape_filter($this->env, time_ago(twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "last_run", array())), "html", null, true);
                    echo " ";
                } else {
                    echo "N/A";
                }
                echo "</div>
                                  </td>
                                  <td class=\"text-center\">
                                    <a class=\"btn btn-pill btn-indigo text-white\" href=\"";
                // line 74
                echo twig_escape_filter($this->env, router("admin_user_profile", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()))), "html", null, true);
                echo "\" ><i class=\"fe fe-pie-chart\" ></i> ";
                echo twig_escape_filter($this->env, l("overview"), "html", null, true);
                echo "</a>
                                  </td>
                                  <td class=\"text-center\">
                                    <div class=\"item-action dropdown\">
                                      <a href=\"javascript:void(0)\" data-toggle=\"dropdown\" class=\"icon\" aria-expanded=\"false\"><i class=\"fe fe-more-vertical\"></i></a>
                                      <div class=\"dropdown-menu dropdown-menu-right\" x-placement=\"bottom-end\" >
                                        <a href=\"";
                // line 80
                echo twig_escape_filter($this->env, router("admin_edit_user", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), $context["item"], "id", array()))), "html", null, true);
                echo "\" class=\"dropdown-item\" ><i class=\"dropdown-icon fe fe-edit-2\"></i> ";
                echo twig_escape_filter($this->env, l("edit"), "html", null, true);
                echo "</a>
                                        <a id=\"enable_";
                // line 81
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
                // line 82
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
                // line 83
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
                // line 85
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
            // line 91
            echo "
                              </tbody>
                            </table>
                          </div>
                        </div>
                        ";
            // line 96
            echo twig_escape_filter($this->env, _get("pagination"), "html", null, true);
            echo "
                    </div>
                    ";
        } else {
            // line 99
            echo "                    <p class=\"p-3 text-muted\" ><i class=\"fe fe-activity\" ></i> ";
            echo twig_escape_filter($this->env, l("nothing_found"), "html", null, true);
            echo "</p>
                    ";
        }
        // line 101
        echo "

                </div>
              </div>
          </div>
        </div>
        ";
        // line 107
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
    </div>
";
        // line 109
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "users.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  308 => 109,  303 => 107,  295 => 101,  289 => 99,  283 => 96,  276 => 91,  264 => 85,  251 => 83,  235 => 82,  219 => 81,  213 => 80,  202 => 74,  190 => 71,  186 => 70,  182 => 68,  177 => 66,  172 => 65,  167 => 63,  162 => 62,  160 => 61,  154 => 58,  150 => 57,  145 => 54,  137 => 53,  126 => 51,  121 => 48,  117 => 46,  113 => 44,  111 => 43,  107 => 42,  101 => 40,  98 => 39,  95 => 38,  92 => 37,  88 => 36,  78 => 29,  74 => 28,  70 => 27,  66 => 26,  58 => 20,  56 => 19,  52 => 18,  49 => 17,  47 => 16,  38 => 10,  30 => 5,  26 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "users.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\users.html");
    }
}
