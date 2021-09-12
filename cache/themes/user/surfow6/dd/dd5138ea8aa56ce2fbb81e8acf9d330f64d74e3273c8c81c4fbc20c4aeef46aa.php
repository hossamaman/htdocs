<?php

/* 404.html */
class __TwigTemplate_009366dc825691ffe656f0a1c776f51ef8c6c1d25612f8fc0bd1c104fb965525 extends Twig_Template
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
          <div class=\"page-content\">
            <div class=\"container text-center\">
              <div class=\"display-1 text-indigo mb-5\"><i class=\"fe fe-alert-octagon\"></i> 404</div>
              <h1 class=\"h2 mb-3\">";
        // line 6
        echo twig_escape_filter($this->env, l("error404_message"), "html", null, true);
        echo "</h1>
              <p class=\"h4 text-indigo font-weight-normal mb-7\">";
        // line 7
        echo twig_escape_filter($this->env, twig_upper_filter($this->env, s("generale/name")), "html", null, true);
        echo " &copy; </p>
              <a class=\"btn btn-indigo btn-pill btn-lg\" href=\"javascript:history.back()\">
                <i class=\"fe fe-arrow-left mr-2\"></i> ";
        // line 9
        echo twig_escape_filter($this->env, l("go_back"), "html", null, true);
        echo "
              </a>
            </div>
          </div>
        </div>
";
        // line 14
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "404.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  45 => 14,  37 => 9,  32 => 7,  28 => 6,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "404.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\404.html");
    }
}
