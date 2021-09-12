<?php

/* plans_menu.html */
class __TwigTemplate_d50b9bf4ce3107be27184ab1932ad36016d687cf1ef48e46e50a5a666a189df9 extends Twig_Template
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
        echo "<div class=\"card card-body pb-0 pt-0 mb-4\" >
    <div class=\"card-status card-status-left bg-indigo\"></div>
    <ul class=\"nav nav-tabs border-0 mt-0 mb-0\">
        <li class=\"nav-item\">
            <a href=\"";
        // line 5
        echo twig_escape_filter($this->env, router("admin_plans"), "html", null, true);
        echo "\" class=\"nav-link\"><i class=\"fe fe-package\"></i> ";
        echo twig_escape_filter($this->env, l("plans"), "html", null, true);
        echo "</a>
        </li>
        <li class=\"nav-item\">
            <a href=\"";
        // line 8
        echo twig_escape_filter($this->env, router("admin_add_plan"), "html", null, true);
        echo "\" class=\"nav-link\" ><i class=\"fe fe-plus\" ></i> ";
        echo twig_escape_filter($this->env, l("add_plan"), "html", null, true);
        echo "</a>
        </li>
    </ul>
</div>
";
    }

    public function getTemplateName()
    {
        return "plans_menu.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  33 => 8,  25 => 5,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "plans_menu.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\plans_menu.html");
    }
}
