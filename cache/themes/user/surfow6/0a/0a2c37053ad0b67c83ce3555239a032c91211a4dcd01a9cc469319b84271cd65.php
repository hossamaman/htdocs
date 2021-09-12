<?php

/* checkout.html */
class __TwigTemplate_19cdd89815bfb0ea7831117bf6fb8ac0eb0ad8a3b98baef6bd71c047fd7d80f8 extends Twig_Template
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
        // line 8
        $context["wallet"] = get("wallet");
        // line 9
        echo "            ";
        $context["item"] = get("plan");
        // line 10
        echo "                    <div class=\"page-header\">
                      <h1 class=\"page-title\">
                         ";
        // line 12
        echo twig_escape_filter($this->env, l("checkout"), "html", null, true);
        echo "
                      </h1>
                    </div>
                    <div id=\"surfow_alert\" ></div>

                    <form class=\"surfow_ajaxform\"
                    data-redirect=\"";
        // line 18
        echo twig_escape_filter($this->env, router("thank_you", (("{\"key\":\"" . surfow_encrypt(twig_get_attribute($this->env, $this->getSourceContext(), ($context["item"] ?? null), "id", array()))) . "\"}")), "html", null, true);
        echo "\"
                    data-method=\"post\"
                    data-action=\"make-order\"
                    data-type=\"user\" >
                    ";
        // line 22
        echo twig_escape_filter($this->env, put_session_key(), "html", null, true);
        echo "
                    <input type=\"hidden\" name=\"id\" value=\"";
        // line 23
        echo twig_escape_filter($this->env, surfow_encrypt(twig_get_attribute($this->env, $this->getSourceContext(), ($context["item"] ?? null), "id", array())), "html", null, true);
        echo "\" />
                    <div class=\"surfow_alert mb-1 mt-1\" ></div>
                    <div class=\"card\">
                      <div class=\"card-status card-status-left bg-indigo\"></div>
                      <div class=\"card-body\">
                          <div class=\"row\">
                              <div class=\"col-lg-8\" >
                                  <div class=\"checkout-area\">
                                      ";
        // line 31
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["wallet"] ?? null), "confirmed", array(), "array") >= twig_get_attribute($this->env, $this->getSourceContext(), ($context["item"] ?? null), "price", array()))) {
            // line 32
            echo "                                      <div class=\"list-group list-group-transparent mt-0 mb-0\">
                                          <span class=\"list-group-item list-group-item-action d-flex align-items-center\" >
                                              <span class=\"icon mr-3\"><i class=\"fe fe-package\"></i></span>
                                              ";
            // line 35
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["item"] ?? null), "name", array()), "html", null, true);
            echo "
                                          </span>
                                          <span class=\"list-group-item list-group-item-action d-flex align-items-center\" >
                                              <span class=\"icon mr-3\"><i class=\"fe fe-user\"></i></span>
                                              @";
            // line 39
            echo twig_escape_filter($this->env, u("username"));
            echo "
                                          </span>
                                          <span class=\"list-group-item text-green list-group-item-action d-flex align-items-center\" >
                                              <span class=\"icon mr-3\"><i class=\"fe fe-dollar-sign\"></i></span>
                                              \$";
            // line 43
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["item"] ?? null), "price", array()), 1, ".", ","), "html", null, true);
            echo " (";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, currency_convert(twig_get_attribute($this->env, $this->getSourceContext(), ($context["item"] ?? null), "price", array())), 1, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, current_currency()), "html", null, true);
            echo ")
                                          </span>
                                          <span class=\"list-group-item text-orange list-group-item-action d-flex align-items-center\" >
                                              <span class=\"icon mr-3\"><i class=\"fe fe-briefcase\"></i></span>
                                              \$";
            // line 47
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["wallet"] ?? null), "confirmed", array(), "array"), 1, ".", ","), "html", null, true);
            echo "
                                          </span>
                                      </div>
                                      ";
        } else {
            // line 51
            echo "                                      <div class=\"alert alert-secondary\">
                                          ";
            // line 52
            echo twig_escape_filter($this->env, l("error_insufficient_credit"), "html", null, true);
            echo "
                                          <div class=\"list-group list-group-transparent mt-0 mb-0\">
                                              <span class=\"list-group-item text-red list-group-item-action d-flex align-items-center\" >
                                                  <span class=\"icon mr-3\"><i class=\"fe fe-briefcase\"></i></span>
                                                  \$";
            // line 56
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["wallet"] ?? null), "confirmed", array(), "array"), 1, ".", ","), "html", null, true);
            echo "
                                              </span>
                                              <span class=\"list-group-item text-orange list-group-item-action d-flex align-items-center\" >
                                                  <span class=\"icon mr-3\"><i class=\"fe fe-dollar-sign\"></i></span>
                                                  ";
            // line 60
            echo twig_escape_filter($this->env, sprintf(l("the_cost_is"), ("\$" . twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["item"] ?? null), "price", array()), 1, ".", ","))), "html", null, true);
            echo "
                                              </span>
                                              <span class=\"list-group-item text-green list-group-item-action d-flex align-items-center\" >
                                                  <span class=\"icon mr-3\"><i class=\"fe fe-plus\"></i></span>
                                                  ";
            // line 64
            $context["needed"] = (twig_get_attribute($this->env, $this->getSourceContext(), ($context["item"] ?? null), "price", array()) - twig_get_attribute($this->env, $this->getSourceContext(), ($context["wallet"] ?? null), "confirmed", array(), "array"));
            // line 65
            echo "                                                  ";
            echo twig_escape_filter($this->env, sprintf(l("funds_needed_is"), ("\$" . twig_number_format_filter($this->env, ($context["needed"] ?? null), 1, ".", ","))), "html", null, true);
            echo "
                                              </span>
                                          </div>
                                      </div>
                                      <a href=\"";
            // line 69
            echo twig_escape_filter($this->env, router("deposit"), "html", null, true);
            echo "?add=";
            echo twig_escape_filter($this->env, ($context["needed"] ?? null), "html", null, true);
            echo "\" class=\"m-4 btn btn-lg btn-indigo btn-pill\">";
            echo twig_escape_filter($this->env, l("add_credit"), "html", null, true);
            echo " <i class=\"fe fe-plus\"></i> </a>
                                      ";
        }
        // line 71
        echo "                              </div>
                              </div>
                              <div class=\"col-lg-4\" >
                                  ";
        // line 74
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["wallet"] ?? null), "confirmed", array(), "array") >= twig_get_attribute($this->env, $this->getSourceContext(), ($context["item"] ?? null), "price", array()))) {
            // line 75
            echo "                                  <p><b class=\"text-indigo\">\$";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["item"] ?? null), "price", array()), 1, ".", ","), "html", null, true);
            echo " </b>
                                  (";
            // line 76
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, currency_convert(twig_get_attribute($this->env, $this->getSourceContext(), ($context["item"] ?? null), "price", array())), 1, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, twig_upper_filter($this->env, current_currency()), "html", null, true);
            echo ")
                                  ";
            // line 77
            echo twig_escape_filter($this->env, l("will_be_deducted"), "html", null, true);
            echo "
                                  <b class=\"text-indigo\">\$";
            // line 78
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["wallet"] ?? null), "confirmed", array(), "array"), 1, ".", ","), "html", null, true);
            echo "</b> (";
            echo twig_escape_filter($this->env, l("wallet"), "html", null, true);
            echo ")</p>
                                  ";
        }
        // line 80
        echo "                                  <hr>
                                  <div class=\"form-group\">
                                    <label class=\"custom-control custom-checkbox\">
                                      <input type=\"checkbox\" name=\"agree\" checked=\"\" class=\"custom-control-input\" />
                                      <span class=\"custom-control-label\">";
        // line 84
        echo twig_escape_filter($this->env, l("i_agree"), "html", null, true);
        echo " <a href=\"";
        echo twig_escape_filter($this->env, router("page", "{\"name\":\"tos\"}"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, l("tos"), "html", null, true);
        echo "</a></span>
                                    </label>
                                  </div>
                                  <div class=\"btn-list mt-2\">
                                      <button type=\"submit\" ";
        // line 88
        if ((twig_get_attribute($this->env, $this->getSourceContext(), ($context["wallet"] ?? null), "confirmed", array(), "array") < twig_get_attribute($this->env, $this->getSourceContext(), ($context["item"] ?? null), "price", array()))) {
            echo "disabled=\"\"";
        }
        echo " class=\"surfow_submit btn btn-lg btn-indigo btn-pill mb-2\">";
        echo twig_escape_filter($this->env, l("buy_now"), "html", null, true);
        echo " <i class=\"fe fe-shopping-cart\"></i></button>
                                      <a href=\"";
        // line 89
        echo twig_escape_filter($this->env, router("payments"), "html", null, true);
        echo "\" class=\"btn btn-lg btn-azure btn-pill mb-1\">";
        echo twig_escape_filter($this->env, l("cancel"), "html", null, true);
        echo " <i class=\"fe fe-x\"></i> </a>
                                  </div>
                              </div>
                          </div>

                      </div>
                    </div>
                </form>

                ";
        // line 98
        echo twig_include($this->env, $context, "refund_policy.html");
        echo "
        ";
        // line 99
        echo twig_include($this->env, $context, "ads_col2.html");
        echo "
      </div>
      ";
        // line 101
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
    </div>
";
        // line 103
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "checkout.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  243 => 103,  238 => 101,  233 => 99,  229 => 98,  215 => 89,  207 => 88,  196 => 84,  190 => 80,  183 => 78,  179 => 77,  173 => 76,  168 => 75,  166 => 74,  161 => 71,  152 => 69,  144 => 65,  142 => 64,  135 => 60,  128 => 56,  121 => 52,  118 => 51,  111 => 47,  100 => 43,  93 => 39,  86 => 35,  81 => 32,  79 => 31,  68 => 23,  64 => 22,  57 => 18,  48 => 12,  44 => 10,  41 => 9,  39 => 8,  34 => 6,  30 => 5,  26 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "checkout.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\checkout.html");
    }
}
