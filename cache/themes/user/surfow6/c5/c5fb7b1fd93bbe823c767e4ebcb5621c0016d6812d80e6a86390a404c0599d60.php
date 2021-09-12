<?php

/* stats/stats_4.html */
class __TwigTemplate_106c47e1b267caf278015e7311c4a04913d036c8bff3d1cfdebe69392916a922 extends Twig_Template
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
        echo "<span><i class=\"fe fe-activity text-green\"></i> ";
        echo twig_escape_filter($this->env, l("stats_today"), "html", null, true);
        echo "</span>
<div  class=\"card\">
  <div id=\"stats_in_24\" style=\"height: 15rem\"></div>
  ";
        // line 4
        echo twig_escape_filter($this->env, do_action("template", "stats_in_24"), "html", null, true);
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "stats/stats_4.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  26 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "stats/stats_4.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\stats\\stats_4.html");
    }
}
