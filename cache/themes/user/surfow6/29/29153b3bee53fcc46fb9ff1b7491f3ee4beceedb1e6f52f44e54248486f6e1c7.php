<?php

/* stats/stats_2.html */
class __TwigTemplate_bf07e725f1c0af73897b12b4623ed56f03da341e84da6bb3b475c87271d0b76f extends Twig_Template
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
        echo "<p class=\"text-uppercase\"><i class=\"text-green fe fe-activity\" ></i> ";
        echo twig_escape_filter($this->env, l("live"), "html", null, true);
        echo "</p>
<div  class=\"row\" >
    <div class=\"col-6 col-sm-4 col-lg-6\">
      <div class=\"card\">
        <div class=\"card-body p-3 text-center\">
          <div class=\"text-right text-green\">
            <i class=\"fe fe-database\"></i>
          </div>
          <div class=\"h1 m-0\">";
        // line 9
        echo twig_escape_filter($this->env, do_action("template", "user_points"), "html", null, true);
        echo "</div>
          <div class=\"text-muted mb-4\">";
        // line 10
        echo twig_escape_filter($this->env, l("points"), "html", null, true);
        echo "</div>
        </div>
      </div>
    </div>
    <div class=\"col-6 col-sm-4 col-lg-6\">
      <div class=\"card\">
        <div class=\"card-body p-3 text-center\">
          <div class=\"text-right text-orange\">
            <i class=\"fe fe-database\"></i>
          </div>
          <div class=\"h1 m-0\">";
        // line 20
        echo twig_escape_filter($this->env, do_action("template", "monthly_earning"), "html", null, true);
        echo "</div>
          <div class=\"text-muted mb-4\">";
        // line 21
        echo twig_escape_filter($this->env, l("monthly_earning"), "html", null, true);
        echo "</div>
        </div>
      </div>
    </div>
    <div class=\"col-6 col-sm-4 col-lg-6\">
      <div class=\"card\">
        <div class=\"card-body p-3 text-center\">
          <div class=\"text-right text-blue\">
            <i class=\"fe fe-database\"></i>
          </div>
          <div class=\"h1 m-0\">";
        // line 31
        echo twig_escape_filter($this->env, do_action("template", "weekly_earning"), "html", null, true);
        echo "</div>
          <div class=\"text-muted mb-4\">";
        // line 32
        echo twig_escape_filter($this->env, l("weekly_earning"), "html", null, true);
        echo "</div>
        </div>
      </div>
    </div>
    <div class=\"col-6 col-sm-4 col-lg-6\">
      <div class=\"card\">
        <div class=\"card-body p-3 text-center\">
          <div class=\"text-right text-green\">
            <i class=\"fe fe-bar-chart-2\"></i>
          </div>
          <div class=\"h1 m-0\">";
        // line 42
        echo twig_escape_filter($this->env, do_action("template", "hits_in_6_months"), "html", null, true);
        echo "</div>
          <div class=\"text-muted mb-4\">";
        // line 43
        echo twig_escape_filter($this->env, l("6_months_hits"), "html", null, true);
        echo "</div>
        </div>
      </div>
    </div>
    <div class=\"col-6 col-sm-4 col-lg-6\">
      <div class=\"card\">
        <div class=\"card-body p-3 text-center\">
          <div class=\"text-right text-orange\">
            <i class=\"fe fe-bar-chart-2\"></i>
          </div>
          <div class=\"h1 m-0\">";
        // line 53
        echo twig_escape_filter($this->env, do_action("template", "monthly_hits"), "html", null, true);
        echo "</div>
          <div class=\"text-muted mb-4\">";
        // line 54
        echo twig_escape_filter($this->env, l("monthly_hits"), "html", null, true);
        echo "</div>
        </div>
      </div>
    </div>
    <div class=\"col-6 col-sm-4 col-lg-6\">
      <div class=\"card\">
        <div class=\"card-body p-3 text-center\">
          <div class=\"text-right text-blue\">
            <i class=\"fe fe-bar-chart-2\"></i>
          </div>
          <div class=\"h1 m-0\">";
        // line 64
        echo twig_escape_filter($this->env, do_action("template", "weekly_hits"), "html", null, true);
        echo "</div>
          <div class=\"text-muted mb-4\">";
        // line 65
        echo twig_escape_filter($this->env, l("weekly_hits"), "html", null, true);
        echo "</div>
        </div>
      </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "stats/stats_2.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  120 => 65,  116 => 64,  103 => 54,  99 => 53,  86 => 43,  82 => 42,  69 => 32,  65 => 31,  52 => 21,  48 => 20,  35 => 10,  31 => 9,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "stats/stats_2.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\stats\\stats_2.html");
    }
}
