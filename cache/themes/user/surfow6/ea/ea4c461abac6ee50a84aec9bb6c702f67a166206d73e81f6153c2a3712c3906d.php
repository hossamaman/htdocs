<?php

/* head_menu.html */
class __TwigTemplate_980f003d9f49d69ec1348bf388ef7ed2e222bf063e464bd10d4456ab88898c41 extends Twig_Template
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
        echo "    <div class=\"page-main\">
          <div class=\"header py-4\">
            <div class=\"container\">
              <div class=\"d-flex\">
                <a class=\"header-brand\" href=\"";
        // line 5
        echo twig_escape_filter($this->env, router("dashboard"), "html", null, true);
        echo "\">
                  <img src=\"";
        // line 6
        echo twig_escape_filter($this->env, s("generale/logo"), "html", null, true);
        echo "\" class=\"header-brand-img\" alt=\"";
        echo twig_escape_filter($this->env, s("generale/name"), "html", null, true);
        echo "\">
                </a>
                <div class=\"d-flex order-lg-2 ml-auto\">
                  <div class=\"nav-item\">
                      ";
        // line 10
        $context["wallet"] = get("wallet");
        // line 11
        echo "                      <a style=\"text-decoration:none;\" class=\"text-green\" href=\"";
        echo twig_escape_filter($this->env, router("wallet"), "html", null, true);
        echo "\"> ";
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["wallet"] ?? null), "confirmed", array(), "array"), 1, ".", ","), "html", null, true);
        echo " <i class=\"fe fe-dollar-sign\" ></i></a>
                  </div>
                  <div class=\"nav-item\">
                      <a style=\"text-decoration:none;\"  class=\"text-indigo\" href=\"";
        // line 14
        echo twig_escape_filter($this->env, router("dashboard"), "html", null, true);
        echo "\"> ";
        echo twig_escape_filter($this->env, do_action("template", "user_points"), "html", null, true);
        echo " <i class=\"fe fe-database\" ></i></a>
                  </div>
                  <div class=\"dropdown\">
                    <a href=\"";
        // line 17
        echo twig_escape_filter($this->env, router("settings"), "html", null, true);
        echo "\" class=\"nav-link pr-0 leading-none\" data-toggle=\"dropdown\">
                      <span class=\"avatar avatar-indigo\">";
        // line 18
        echo twig_escape_filter($this->env, twig_slice($this->env, twig_upper_filter($this->env, u("username")), 0, 2), "html", null, true);
        echo "
                          <span class=\"avatar-status bg-green\"></span>
                      </span>
                      <span class=\"ml-2 d-none d-lg-block\">
                        <span class=\"text-default\">";
        // line 22
        echo twig_escape_filter($this->env, twig_slice($this->env, twig_upper_filter($this->env, u("username")), 0, 25), "html", null, true);
        echo "</span>
                        <small class=\"text-muted d-block mt-1\">";
        // line 23
        echo twig_escape_filter($this->env, twig_slice($this->env, u("email"), 0, 25), "html", null, true);
        echo "</small>
                      </span>
                    </a>
                    <div class=\"dropdown-menu dropdown-menu-right dropdown-menu-arrow\">
                      <a class=\"dropdown-item\" href=\"";
        // line 27
        echo twig_escape_filter($this->env, router("settings"), "html", null, true);
        echo "\">
                        <i class=\"dropdown-icon text-indigo fe fe-settings\"></i> ";
        // line 28
        echo twig_escape_filter($this->env, l("edit_settings"), "html", null, true);
        echo "
                      </a>
                      <a class=\"dropdown-item\" href=\"";
        // line 30
        echo twig_escape_filter($this->env, router("billing"), "html", null, true);
        echo "\">
                        <i class=\"dropdown-icon text-indigo fe fe-map\"></i> ";
        // line 31
        echo twig_escape_filter($this->env, l("billing_addresses"), "html", null, true);
        echo "
                      </a>
                      ";
        // line 33
        if ((twig_lower_filter($this->env, s("defaults/withdrawal_status")) == "yes")) {
            // line 34
            echo "                      <a class=\"dropdown-item\" href=\"";
            echo twig_escape_filter($this->env, router("affiliate"), "html", null, true);
            echo "\">
                        <i class=\"dropdown-icon text-indigo fe fe-user-check\"></i> ";
            // line 35
            echo twig_escape_filter($this->env, l("affiliate_settings"), "html", null, true);
            echo "
                      </a>
                      ";
        }
        // line 38
        echo "                      <a class=\"dropdown-item\" href=\"";
        echo twig_escape_filter($this->env, router("cards"), "html", null, true);
        echo "\">
                        <i class=\"dropdown-icon text-indigo fe fe-credit-card\"></i> ";
        // line 39
        echo twig_escape_filter($this->env, l("saved_cards"), "html", null, true);
        echo "
                      </a>
                      <a class=\"dropdown-item\" href=\"";
        // line 41
        echo twig_escape_filter($this->env, router("contact"), "html", null, true);
        echo "\">
                        <i class=\"dropdown-icon text-indigo fe fe-help-circle\"></i> ";
        // line 42
        echo twig_escape_filter($this->env, l("contact"), "html", null, true);
        echo "
                      </a>
                      <a class=\"dropdown-item\" href=\"";
        // line 44
        echo twig_escape_filter($this->env, router("logout"), "html", null, true);
        echo "\">
                        <i class=\"dropdown-icon text-indigo fe fe-log-out\"></i> ";
        // line 45
        echo twig_escape_filter($this->env, l("logout"), "html", null, true);
        echo "
                      </a>
                    </div>
                  </div>
                </div>
                <a href=\"#\" class=\"header-toggler d-lg-none ml-3 ml-lg-0\" data-toggle=\"collapse\" data-target=\"#headerMenuCollapse\">
                  <span class=\"header-toggler-icon\"></span>
                </a>
              </div>
            </div>
          </div>
";
    }

    public function getTemplateName()
    {
        return "head_menu.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  133 => 45,  129 => 44,  124 => 42,  120 => 41,  115 => 39,  110 => 38,  104 => 35,  99 => 34,  97 => 33,  92 => 31,  88 => 30,  83 => 28,  79 => 27,  72 => 23,  68 => 22,  61 => 18,  57 => 17,  49 => 14,  40 => 11,  38 => 10,  29 => 6,  25 => 5,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "head_menu.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\head_menu.html");
    }
}
