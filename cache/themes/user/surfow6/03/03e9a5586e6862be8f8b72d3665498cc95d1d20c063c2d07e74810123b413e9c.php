<?php

/* thank_you.html */
class __TwigTemplate_0fc20232558dc1d920d705f66fdbbc5a51b5f7e21664884186f9207e4753b90f extends Twig_Template
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
      <div class=\"page-main\">
          ";
        // line 4
        echo twig_include($this->env, $context, "head_menu.html");
        echo "
          ";
        // line 5
        echo twig_include($this->env, $context, "main_menu.html");
        echo "

          <div class=\"m-8\">
            <div class=\"container text-center\">
              <div class=\"display-1 text-indigo mb-5\"><i class=\"fe fe-check-circle\" ></i></div>
              <h1 style=\"font-weight: 300;\" class=\"h4 mb-3\">";
        // line 10
        echo twig_escape_filter($this->env, l("thank_you_note"), "html", null, true);
        echo "</h1>
              <a class=\"mt-4 btn btn-indigo btn-pill btn-lg\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, router("dashboard"), "html", null, true);
        echo "\">
                <i class=\"fe fe-activity mr-2\"></i> ";
        // line 12
        echo twig_escape_filter($this->env, l("continue"), "html", null, true);
        echo "
              </a>
            </div>
          </div>

      </div>
      ";
        // line 18
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
    </div>
";
        // line 20
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "thank_you.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  60 => 20,  55 => 18,  46 => 12,  42 => 11,  38 => 10,  30 => 5,  26 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "thank_you.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\thank_you.html");
    }
}
