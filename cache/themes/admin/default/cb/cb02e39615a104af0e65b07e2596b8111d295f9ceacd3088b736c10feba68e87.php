<?php

/* head_menu.html */
class __TwigTemplate_9ba7451c5206b0f3f2f58d6072f2b1e283e4f477107805c3d39175871953beef extends Twig_Template
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
        echo twig_escape_filter($this->env, router("admin"), "html", null, true);
        echo "\">
                  <img src=\"";
        // line 6
        echo twig_escape_filter($this->env, storage("data/surfow.png"), "html", null, true);
        echo "\" class=\"header-brand-img\" alt=\"";
        echo twig_escape_filter($this->env, s("generale/name"), "html", null, true);
        echo "\">
                </a>
                <div class=\"d-flex order-lg-2 ml-auto\">
                  <div class=\"nav-item d-none d-md-flex\">
                      <a target=\"_blank\" href=\"https://support.surfow.info/open\" class=\"nav-link pr-0 leading-none\" >
                        <span class=\"avatar avatar-gray\"><i class=\"fe fe-life-buoy\"></i></span>
                        <span class=\"ml-2 d-none d-lg-block\">
                          <span class=\"text-default\">";
        // line 13
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, l("need_help")), "html", null, true);
        echo "</span>
                          <small class=\"text-muted d-block mt-1\">";
        // line 14
        echo twig_escape_filter($this->env, l("open_ticket"), "html", null, true);
        echo "</small>
                        </span>
                      </a>
                      <a href=\"";
        // line 17
        echo twig_escape_filter($this->env, router("admin_builder"), "html", null, true);
        echo "\" class=\"nav-link pr-0 leading-none\" >
                        <span class=\"avatar avatar-gray\"><i class=\"fe fe-layout\"></i></span>
                        <span class=\"ml-2 d-none d-lg-block\">
                          <span class=\"text-default\">";
        // line 20
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, l("homepage_builder")), "html", null, true);
        echo "</span>
                          <small class=\"text-muted d-block mt-1\">";
        // line 21
        echo twig_escape_filter($this->env, l("click_here_to_edit"), "html", null, true);
        echo "</small>
                        </span>
                      </a>
                  </div>
                  <div class=\"dropdown\">
                    <a href=\"";
        // line 26
        echo twig_escape_filter($this->env, router("admin_account"), "html", null, true);
        echo "\" class=\"nav-link pr-0 leading-none\" data-toggle=\"dropdown\">
                      <span class=\"avatar avatar-indigo\">";
        // line 27
        echo twig_escape_filter($this->env, twig_slice($this->env, twig_upper_filter($this->env, u("username")), 0, 2), "html", null, true);
        echo "
                          <span class=\"avatar-status bg-green\"></span>
                      </span>
                      <span class=\"ml-2 d-none d-lg-block\">
                        <span class=\"text-default\">";
        // line 31
        echo twig_escape_filter($this->env, twig_slice($this->env, twig_upper_filter($this->env, u("username")), 0, 25), "html", null, true);
        echo "</span>
                        <small class=\"text-muted d-block mt-1\">";
        // line 32
        echo twig_escape_filter($this->env, twig_slice($this->env, u("email"), 0, 25), "html", null, true);
        echo "</small>
                      </span>
                    </a>
                    <div class=\"dropdown-menu dropdown-menu-right dropdown-menu-arrow\">
                      <a class=\"dropdown-item\" href=\"";
        // line 36
        echo twig_escape_filter($this->env, router("admin_account"), "html", null, true);
        echo "\">
                        <i class=\"dropdown-icon text-indigo fe fe-settings\"></i> ";
        // line 37
        echo twig_escape_filter($this->env, l("admin_account"), "html", null, true);
        echo "
                      </a>
                      <a class=\"dropdown-item\" target=\"_blank\" href=\"https://support.surfow.info\">
                        <i class=\"dropdown-icon text-indigo fe fe-mail\"></i> ";
        // line 40
        echo twig_escape_filter($this->env, l("need_help"), "html", null, true);
        echo "
                      </a>
                      <a class=\"dropdown-item\" target=\"_blank\" href=\"https://support.surfow.info/open\">
                        <i class=\"dropdown-icon text-indigo fe fe-life-buoy\"></i> ";
        // line 43
        echo twig_escape_filter($this->env, l("open_ticket"), "html", null, true);
        echo "
                      </a>
                      <a class=\"dropdown-item\" href=\"";
        // line 45
        echo twig_escape_filter($this->env, router("admin_logout"), "html", null, true);
        echo "\">
                        <i class=\"dropdown-icon text-indigo fe fe-log-out\"></i> ";
        // line 46
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
        return array (  116 => 46,  112 => 45,  107 => 43,  101 => 40,  95 => 37,  91 => 36,  84 => 32,  80 => 31,  73 => 27,  69 => 26,  61 => 21,  57 => 20,  51 => 17,  45 => 14,  41 => 13,  29 => 6,  25 => 5,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "head_menu.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\head_menu.html");
    }
}
