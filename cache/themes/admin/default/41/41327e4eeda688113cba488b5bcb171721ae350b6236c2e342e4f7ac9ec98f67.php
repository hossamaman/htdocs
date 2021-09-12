<?php

/* main_menu.html */
class __TwigTemplate_482f555714b06888579e1d236bc611d0edc49d24c24a6db00c202eb74fd066ea extends Twig_Template
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
        // line 2
        echo "        <div class=\"header collapse d-lg-flex p-0\" id=\"headerMenuCollapse\">
          <div class=\"container\">
            <div class=\"row align-items-center\">
              <div class=\"col-lg-3 ml-auto\">
                ";
        // line 6
        echo twig_include($this->env, $context, "search_form.html");
        echo "
              </div>
              <div class=\"col-lg order-lg-first\">
                <ul class=\"nav nav-tabs border-0 flex-column flex-lg-row\">
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 11
        echo twig_escape_filter($this->env, router("admin_home"), "html", null, true);
        echo "\" class=\"nav-link\"><i class=\"text-indigo fe fe-activity\"></i> ";
        echo twig_escape_filter($this->env, l("admin_overview"), "html", null, true);
        echo "</a>
                  </li>
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 14
        echo twig_escape_filter($this->env, router("admin_checking_list"), "html", null, true);
        echo "\" class=\"nav-link\"><i class=\"text-indigo fe fe-check-circle\"></i> ";
        echo twig_escape_filter($this->env, l("checking_list"), "html", null, true);
        echo "</a>
                  </li>
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 17
        echo twig_escape_filter($this->env, router("admin_settings"), "html", null, true);
        echo "\" class=\"nav-link\"><i class=\"text-indigo fe fe-settings\"></i> ";
        echo twig_escape_filter($this->env, l("settings"), "html", null, true);
        echo "</a>
                  </li>
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 20
        echo twig_escape_filter($this->env, router("admin_users"), "html", null, true);
        echo "\" class=\"nav-link\"><i class=\"text-indigo fe fe-users\"></i> ";
        echo twig_escape_filter($this->env, l("profiles"), "html", null, true);
        echo "</a>
                  </li>
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 23
        echo twig_escape_filter($this->env, router("admin_plans"), "html", null, true);
        echo "\" class=\"nav-link\"><i class=\"text-indigo fe fe-package\"></i> ";
        echo twig_escape_filter($this->env, l("plans"), "html", null, true);
        echo "</a>
                  </li>
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 26
        echo twig_escape_filter($this->env, router("admin_newsletteres"), "html", null, true);
        echo "\" class=\"nav-link\"><i class=\"text-indigo fe fe-mail\"></i> ";
        echo twig_escape_filter($this->env, l("newsletteres"), "html", null, true);
        echo "</a>
                  </li>
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 29
        echo twig_escape_filter($this->env, router("admin_admins"), "html", null, true);
        echo "\" class=\"nav-link\"><i class=\"text-indigo fe fe-user-check\"></i> ";
        echo twig_escape_filter($this->env, l("admins"), "html", null, true);
        echo "</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "main_menu.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 29,  75 => 26,  67 => 23,  59 => 20,  51 => 17,  43 => 14,  35 => 11,  27 => 6,  21 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "main_menu.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\main_menu.html");
    }
}
