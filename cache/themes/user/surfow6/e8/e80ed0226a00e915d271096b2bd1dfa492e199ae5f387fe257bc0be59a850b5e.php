<?php

/* refund_policy.html */
class __TwigTemplate_d2e67ff495be422261178245acef7d31c96fd152a831104e2b9e2f9e89f5592f extends Twig_Template
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
        if ((s("defaults/show_refund_policy") == "yes")) {
            // line 2
            echo "<h1 class=\"page-title mb-2\">
   ";
            // line 3
            echo twig_escape_filter($this->env, l("refund_policy"), "html", null, true);
            echo "
</h1>

<div class=\"card\">
  <div class=\"card-status card-status-left bg-green\"></div>
  <div class=\"card-body\">
      <div class=\"list-group list-group-transparent mt-0 mb-0\">
          <span class=\"list-group-item list-group-item-action d-flex align-items-center text-green\" >
              <span class=\"icon mr-3\"><i class=\"fe fe-shield text-green\"></i></span>
              ";
            // line 12
            echo twig_escape_filter($this->env, l("secure_payment_note"), "html", null, true);
            echo "
          </span>
          <span class=\"list-group-item list-group-item-action d-flex align-items-center text-green\" >
              <span class=\"icon mr-3\"><i class=\"fe fe-thumbs-up text-green\"></i></span>
              ";
            // line 16
            echo twig_escape_filter($this->env, sprintf(l("refund_hint"), s("defaults/refund")), "html", null, true);
            echo "
          </span>
          <span class=\"list-group-item list-group-item-action d-flex align-items-center text-green\" >
              <span class=\"icon mr-3\"><i class=\"fe fe-cpu text-green\"></i></span>
              ";
            // line 20
            echo twig_escape_filter($this->env, l("instant_activation"), "html", null, true);
            echo "
          </span>
      </div>
      <a href=\"";
            // line 23
            echo twig_escape_filter($this->env, router("contact"), "html", null, true);
            echo "\" class=\"ml-3 mt-3 btn btn-pill btn-icon btn-green\"><i class=\"fe fe-help-circle\" ></i> ";
            echo twig_escape_filter($this->env, l("have_question"), "html", null, true);
            echo "</a>
  </div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "refund_policy.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 23,  50 => 20,  43 => 16,  36 => 12,  24 => 3,  21 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "refund_policy.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\refund_policy.html");
    }
}
