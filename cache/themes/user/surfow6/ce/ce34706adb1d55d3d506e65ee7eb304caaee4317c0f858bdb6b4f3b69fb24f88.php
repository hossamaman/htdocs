<?php

/* stats/stats_5.html */
class __TwigTemplate_63c1b30524f29c8f8be3e80f0d48f8db91009b55c809b25ffbefbea3938ccdfa extends Twig_Template
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
        echo twig_escape_filter($this->env, l("stats_6months"), "html", null, true);
        echo "</span>
<div class=\"card\">
  <div id=\"stats_in_6months\" style=\"height: 15rem\"></div>
  ";
        // line 4
        echo twig_escape_filter($this->env, do_action("template", "stats_in_6months"), "html", null, true);
        echo "
</div>
";
    }

    public function getTemplateName()
    {
        return "stats/stats_5.html";
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
        return new Twig_Source("", "stats/stats_5.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\stats\\stats_5.html");
    }
}
