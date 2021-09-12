<?php

/* stats/stats_3.html */
class __TwigTemplate_4e952730ecb2488c0ffa5121caf124cc18f26e5ace98089d4f517ee747c6bbbe extends Twig_Template
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
        echo "<div class=\"card\">
  <div class=\"card-body\">
    <div class=\"map\">
      <div class=\"map-content\" id=\"online-map\"></div>
    </div>
    ";
        // line 6
        echo twig_escape_filter($this->env, do_action("template", "online_map"), "html", null, true);
        echo "
  </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "stats/stats_3.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  26 => 6,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "stats/stats_3.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\stats\\stats_3.html");
    }
}
