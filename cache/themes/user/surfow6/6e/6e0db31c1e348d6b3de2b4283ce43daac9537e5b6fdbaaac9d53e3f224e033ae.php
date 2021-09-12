<?php

/* ads_col1.html */
class __TwigTemplate_9ba351b550d0b87c707e88d75968d16aebce306e724f8c2105f35f34cd3b355a extends Twig_Template
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
        echo "<div class=\"my-3 my-md-5\">
    <div class=\"container\">
        <div class=\"row\">
            ";
        // line 4
        if ( !s("ads/show_sidebar_ads")) {
            // line 5
            echo "            <div class=\"col-lg-2 col-md-12\"></div>
            <div class=\"col-lg-8 col-md-12\">
            ";
        } else {
            // line 8
            echo "            <div class=\"col-lg-9 col-md-12\">
            ";
        }
        // line 10
        echo "            ";
        if (s("ads/show_line_ads")) {
            // line 11
            echo "                ";
            echo twig_escape_filter($this->env, _s("ads/top"), "html", null, true);
            echo "
            ";
        }
    }

    public function getTemplateName()
    {
        return "ads_col1.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 11,  35 => 10,  31 => 8,  26 => 5,  24 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "ads_col1.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\ads_col1.html");
    }
}
