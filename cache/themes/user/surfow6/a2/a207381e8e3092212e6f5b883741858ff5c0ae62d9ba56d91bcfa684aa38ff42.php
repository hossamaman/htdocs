<?php

/* main_menu.html */
class __TwigTemplate_337e44b997565da338252902ecf5826a812aac553527c0f89ecf12065ccbcc22 extends Twig_Template
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
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 7
        echo twig_escape_filter($this->env, router("browsing"), "html", null, true);
        echo "\" style=\"border-color: #6574cd;\" class=\"btn btn-pill ";
        if ( !is_routed("browsing")) {
            echo "btn-outline-indigo";
        } else {
            echo "btn-indigo text-white";
        }
        echo " btn-block\"><i class=\"";
        if ( !is_routed("browsing")) {
            echo "text-indigo";
        } else {
            echo "text-white";
        }
        echo " fe fe-zap\"></i> ";
        echo twig_escape_filter($this->env, l("traffic_exchange"), "html", null, true);
        echo "</a>
                  </li>
              </div>
              <div class=\"col-lg order-lg-first\">
                <ul class=\"nav nav-tabs border-0 flex-column flex-lg-row\">
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 13
        echo twig_escape_filter($this->env, router("dashboard"), "html", null, true);
        echo "\" class=\"nav-link ";
        if (is_routed("dashboard")) {
            echo "active";
        }
        echo "\"><i class=\"text-indigo fe fe-pie-chart\"></i> ";
        echo twig_escape_filter($this->env, l("dashboard"), "html", null, true);
        echo "</a>
                  </li>
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 16
        echo twig_escape_filter($this->env, router("websites"), "html", null, true);
        echo "\" class=\"nav-link ";
        if ((((is_routed("websites") || is_routed("add_website")) || is_routed("edit_website")) || is_routed("copy_website"))) {
            echo "active";
        }
        echo "\"><i class=\"text-indigo fe fe-server\"></i> ";
        echo twig_escape_filter($this->env, l("websites"), "html", null, true);
        echo "</a>
                  </li>
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 19
        echo twig_escape_filter($this->env, router("payments"), "html", null, true);
        echo "\" class=\"nav-link ";
        if ((((is_routed("payments") || is_routed("order_type")) || is_routed("thank_you")) || is_routed("checkout"))) {
            echo "active";
        }
        echo "\"><i class=\"text-indigo fe fe-package\"></i> ";
        echo twig_escape_filter($this->env, l("buy"), "html", null, true);
        echo "</a>
                  </li>
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 22
        echo twig_escape_filter($this->env, router("wallet"), "html", null, true);
        echo "\" class=\"nav-link ";
        if ((((((is_routed("wallet") || is_routed("deposit")) || is_routed("process_deposit")) || is_routed("prepare_payment")) || is_routed("done_payment")) || is_routed("withdrawal"))) {
            echo "active";
        }
        echo "\"><i class=\"text-indigo fe fe-briefcase\"></i> ";
        echo twig_escape_filter($this->env, l("wallet"), "html", null, true);
        echo "</a>
                  </li>
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 25
        echo twig_escape_filter($this->env, router("referrals"), "html", null, true);
        echo "\" class=\"nav-link ";
        if (is_routed("referrals")) {
            echo "active";
        }
        echo "\"><i class=\"text-indigo fe fe-users\"></i> ";
        echo twig_escape_filter($this->env, l("referrals"), "html", null, true);
        echo "</a>
                  </li>
                  <li class=\"nav-item\">
                    <a href=\"";
        // line 28
        echo twig_escape_filter($this->env, router("settings"), "html", null, true);
        echo "\" class=\"nav-link ";
        if (((((((is_routed("settings") || is_routed("affiliate")) || is_routed("billing")) || is_routed("add_address")) || is_routed("edit_address")) || is_routed("cards")) || is_routed("add_card"))) {
            echo "active";
        }
        echo "\"><i class=\"text-indigo fe fe-sliders\"></i> ";
        echo twig_escape_filter($this->env, l("settings"), "html", null, true);
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
        return array (  111 => 28,  99 => 25,  87 => 22,  75 => 19,  63 => 16,  51 => 13,  28 => 7,  21 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "main_menu.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\main_menu.html");
    }
}
