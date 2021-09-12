<?php

/* footer_content.html */
class __TwigTemplate_b44c2d2602ada827822c8a157c71e5bfef3de1b27bf408e6b718992fe5c567f3 extends Twig_Template
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
        echo "<div class=\"footer\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-lg-12 text-center\">
          ";
        // line 5
        echo twig_escape_filter($this->env, do_action("template", "language_tags"), "html", null, true);
        echo "
        </div>
      </div>
    </div>
</div>
<footer class=\"footer\">
  <div class=\"container\">
    <div class=\"row align-items-auto flex-row-reverse\">
      <div class=\"col-lg-6 text-right\">
          <ul class=\"list-inline list-inline-dots mb-0 text-right\">
              <li class=\"list-inline-item\"><a href=\"https://support.surfow.info\">";
        // line 15
        echo twig_escape_filter($this->env, l("support"), "html", null, true);
        echo "</a></li>
              <li class=\"list-inline-item\"><a href=\"mailto:devknown@gmail.com\">";
        // line 16
        echo twig_escape_filter($this->env, l("contact_developer"), "html", null, true);
        echo "</a></li>
              <li class=\"list-inline-item\"><a href=\"https://support.surfow.info/new-project\">Need a custom project?</a></li>
              <li class=\"list-inline-item\"><span class=\"text-muted\">V";
        // line 18
        echo twig_escape_filter($this->env, get("surfow_version"), "html", null, true);
        echo "</span></li>
          </ul>
      </div>
      <!-- Surfow V6.0.0 ADMIN PANEL -->
      <div class=\"col-lg-6 text-left\">
          © ";
        // line 23
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["now"] ?? null), "Y"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, l("all_rights_reserved"), "html", null, true);
        echo "  &mdash; ";
        echo twig_escape_filter($this->env, l("developed_by"), "html", null, true);
        echo " <a href=\"http://codecanyon.net/user/hassanazy\" target=\"_blank\">Hassan Azzi</a>
      </div>
    </div>
  </div>
</footer>
";
    }

    public function getTemplateName()
    {
        return "footer_content.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  55 => 23,  47 => 18,  42 => 16,  38 => 15,  25 => 5,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "footer_content.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\footer_content.html");
    }
}
