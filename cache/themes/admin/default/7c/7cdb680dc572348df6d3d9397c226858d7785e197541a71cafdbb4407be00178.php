<?php

/* search_form.html */
class __TwigTemplate_364eb4d14cdc762ea0ac02bc3b5d314c8e0d7e85b0dd8ef9c89797e061ce6bba extends Twig_Template
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
        echo "<form action=\"";
        echo twig_escape_filter($this->env, router("admin_search"), "html", null, true);
        echo "\" method=\"GET\" class=\"input-icon my-3 my-lg-0\">
    <input type=\"hidden\" id=\"search_type\" name=\"type\" value=\"";
        // line 2
        if (get("search_type")) {
            echo twig_escape_filter($this->env, _get("search_type"), "html", null, true);
        } else {
            echo "customers";
        }
        echo "\" />
    <div class=\"input-group\">
        <input placeholder=\"";
        // line 4
        echo twig_escape_filter($this->env, l("search_for"), "html", null, true);
        echo "\" id=\"search_query\" name=\"q\" value=\"";
        echo twig_escape_filter($this->env, _get("search_query"), "html", null, true);
        echo "\" class=\"form-control\" type=\"text\">
        <div class=\"input-group-append\">
            <button type=\"submit\" class=\"btn btn-indigo\"><i class=\"fe fe-search\" ></i></button>
            <button data-toggle=\"dropdown\" type=\"button\" class=\"btn btn-indigo dropdown-toggle\" aria-expanded=\"false\"></button>
            <div class=\"dropdown-menu dropdown-menu-right\" x-placement=\"bottom-end\" >
                  <a class=\"dropdown-item search_switch\" data-key=\"customers\" data-title=\"";
        // line 9
        echo twig_escape_filter($this->env, l("users"), "html", null, true);
        echo "\" href=\"javascript:void(0)\">
                    <i class=\"fe fe-users text-indigo\"></i> ";
        // line 10
        echo twig_escape_filter($this->env, l("users"), "html", null, true);
        echo "
                  </a>
                  <a class=\"dropdown-item search_switch\" data-key=\"websites\" data-title=\"";
        // line 12
        echo twig_escape_filter($this->env, l("websites"), "html", null, true);
        echo "\" href=\"javascript:void(0)\">
                    <i class=\"fe fe-globe text-indigo\"></i> ";
        // line 13
        echo twig_escape_filter($this->env, l("websites"), "html", null, true);
        echo "
                  </a>
                  <a class=\"dropdown-item search_switch\" data-key=\"payments\" data-title=\"";
        // line 15
        echo twig_escape_filter($this->env, l("payments"), "html", null, true);
        echo "\" href=\"javascript:void(0)\">
                    <i class=\"fe fe-briefcase text-indigo\"></i> ";
        // line 16
        echo twig_escape_filter($this->env, l("payments"), "html", null, true);
        echo "
                  </a>
                  <div class=\"dropdown-divider\"></div>
                  <a class=\"dropdown-item\" href=\"javascript:void(0)\">
                    <i class=\"fe fe-x text-indigo\"></i> ";
        // line 20
        echo twig_escape_filter($this->env, l("cancel"), "html", null, true);
        echo "
                  </a>
              </div>
        </div>
    </div>
</form>
<script>
require(['jquery'], function(\$){
    \$(document).ready(function(){
        \$('.search_switch').click(function(){
            var type_title = \$(this).data(\"title\");
            var key = \$(this).data(\"key\");
            \$('#search_type').val(key);
            \$('#search_query').attr({\"placeholder\":type_title.toString()});
        });
    });
});
</script>
";
    }

    public function getTemplateName()
    {
        return "search_form.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 20,  65 => 16,  61 => 15,  56 => 13,  52 => 12,  47 => 10,  43 => 9,  33 => 4,  24 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "search_form.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\search_form.html");
    }
}
