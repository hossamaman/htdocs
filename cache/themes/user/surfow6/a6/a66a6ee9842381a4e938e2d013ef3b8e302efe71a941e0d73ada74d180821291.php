<?php

/* stats/stats_1.html */
class __TwigTemplate_0117837d579e05d5f5dd65997ddd7c827ae9a4ddebcbdcd900d58f1bbd58b9ec extends Twig_Template
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
        echo "<div class=\"row\" >
    <div  class=\"col-sm-6 col-lg-3\">
        <div class=\"card p-3\">
          <div class=\"d-flex align-items-center\">
            <span class=\"stamp stamp-md bg-cyan mr-3\">
              <i class=\"fe fe-shield\"></i>
            </span>
            <div >
              <h4 class=\"m-0\"><a class=\"text-uppercase\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, router("order_type", "{\"type\":\"upgrade\"}"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_title_string_filter($this->env, do_action("template", "account_type")), "html", null, true);
        echo "</a></h4>
              <small class=\"text-muted\">";
        // line 10
        echo twig_escape_filter($this->env, l("account_type"), "html", null, true);
        echo "</small>
            </div>
          </div>
          <a href=\"";
        // line 13
        echo twig_escape_filter($this->env, router("settings"), "html", null, true);
        echo "\" class=\"ml-7 btn btn-pill btn-secondary btn-sm\">";
        echo twig_escape_filter($this->env, l("edit_settings"), "html", null, true);
        echo "</a>
        </div>
    </div>

    ";
        // line 17
        $context["slots"] = get("slots");
        // line 18
        echo "    <div class=\"col-sm-6 col-lg-3\">
    <div class=\"card p-3\">
      <div class=\"d-flex align-items-center\">
        <span class=\"stamp stamp-md bg-indigo mr-3\">
          <i class=\"fe fe-globe\"></i>
        </span>
        <div>
          <h4 class=\"m-0\"><a class=\"text-uppercase\" href=\"";
        // line 25
        echo twig_escape_filter($this->env, router("websites"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["slots"] ?? null), "used_websites", array(), "array"), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["slots"] ?? null), "allowed_websites", array(), "array"), "html", null, true);
        echo " <small>";
        echo twig_escape_filter($this->env, l("website_slots"), "html", null, true);
        echo "</small></a></h4>
          <small class=\"text-muted\">";
        // line 26
        echo twig_escape_filter($this->env, sprintf(l("slots_left"), twig_get_attribute($this->env, $this->getSourceContext(), ($context["slots"] ?? null), "websites_left", array(), "array")), "html", null, true);
        echo "</small>
        </div>
    </div>
    <div class=\"progress progress-xs mt-4 mb-1\">
      <div class=\"progress-bar bg-indigo\" role=\"progressbar\" style=\"width: ";
        // line 30
        echo twig_escape_filter($this->env, ((100 * twig_get_attribute($this->env, $this->getSourceContext(), ($context["slots"] ?? null), "used_websites", array(), "array")) / twig_get_attribute($this->env, $this->getSourceContext(), ($context["slots"] ?? null), "allowed_websites", array(), "array")), "html", null, true);
        echo "%\" aria-valuenow=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["slots"] ?? null), "used_websites", array(), "array"), "html", null, true);
        echo "\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
    </div>
    </div>
    </div>

    <div class=\"col-sm-6 col-lg-3\">
    <div class=\"card p-3\">
      <div class=\"d-flex align-items-center\">
        <span class=\"stamp stamp-md bg-orange mr-3\">
          <i class=\"fe fe-server\"></i>
        </span>
        <div>
            <h4 class=\"m-0\"><a class=\"text-uppercase\" href=\"";
        // line 42
        echo twig_escape_filter($this->env, router("browsing"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["slots"] ?? null), "used_sessions", array(), "array"), "html", null, true);
        echo "/";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["slots"] ?? null), "allowed_sessions", array(), "array"), "html", null, true);
        echo " <small>";
        echo twig_escape_filter($this->env, l("session_slots"), "html", null, true);
        echo "</small></a></h4>
            <small class=\"text-muted\">";
        // line 43
        echo twig_escape_filter($this->env, sprintf(l("slots_left"), twig_get_attribute($this->env, $this->getSourceContext(), ($context["slots"] ?? null), "sessions_left", array(), "array")), "html", null, true);
        echo "</small>
        </div>
    </div>
    <div class=\"progress progress-xs mt-4 mb-1\">
      <div class=\"progress-bar bg-orange\" role=\"progressbar\" style=\"width: ";
        // line 47
        echo twig_escape_filter($this->env, ((100 * twig_get_attribute($this->env, $this->getSourceContext(), ($context["slots"] ?? null), "used_sessions", array(), "array")) / twig_get_attribute($this->env, $this->getSourceContext(), ($context["slots"] ?? null), "allowed_sessions", array(), "array")), "html", null, true);
        echo "%\" aria-valuenow=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["slots"] ?? null), "used_sessions", array(), "array"), "html", null, true);
        echo "\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
    </div>
    </div>
    </div>

    <div class=\"col-sm-6 col-lg-3\">
    <div class=\"card p-3\">
      <div class=\"d-flex align-items-center\">
        <span class=\"stamp stamp-md bg-azure mr-3\">
          <i class=\"fe fe-percent\"></i>
        </span>
        <div>
          <h4 class=\"m-0\"><a class=\"text-uppercase\" href=\"";
        // line 59
        echo twig_escape_filter($this->env, router("order_type", "{\"type\":\"upgrade\"}"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, u("traffic_ratio"), "html", null, true);
        echo "% <small>";
        echo twig_escape_filter($this->env, l("traffic_ratio"), "html", null, true);
        echo "</small></a></h4>
          <small class=\"text-muted\">";
        // line 60
        echo twig_escape_filter($this->env, sprintf(l("ratio_explained"), u("traffic_ratio"), "%"), "html", null, true);
        echo "</small>
        </div>
      </div>
      <div class=\"progress progress-xs mt-4 mb-1\">
        <div class=\"progress-bar bg-azure\" role=\"progressbar\" style=\"width: ";
        // line 64
        echo twig_escape_filter($this->env, u("traffic_ratio"), "html", null, true);
        echo "%\" aria-valuenow=\"";
        echo twig_escape_filter($this->env, u("traffic_ratio"), "html", null, true);
        echo "\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div>
      </div>
    </div>
    </div>

</div>
";
    }

    public function getTemplateName()
    {
        return "stats/stats_1.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  144 => 64,  137 => 60,  129 => 59,  112 => 47,  105 => 43,  95 => 42,  78 => 30,  71 => 26,  61 => 25,  52 => 18,  50 => 17,  41 => 13,  35 => 10,  29 => 9,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "stats/stats_1.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\stats\\stats_1.html");
    }
}
