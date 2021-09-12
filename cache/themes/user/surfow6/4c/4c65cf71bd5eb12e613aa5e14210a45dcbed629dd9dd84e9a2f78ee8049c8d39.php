<?php

/* footer_content.html */
class __TwigTemplate_8fdfcbe85d10361ee9a5d6c61fa992395eaf2accbe7e1c6e21e6b0d27dfe3f0c extends Twig_Template
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
              <li class=\"list-inline-item\"><a  href=\"";
        // line 15
        echo twig_escape_filter($this->env, router("contact"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, l("contact"), "html", null, true);
        echo "</a></li>
              <li class=\"list-inline-item\"><a  href=\"";
        // line 16
        echo twig_escape_filter($this->env, router("page", "{\"name\":\"about-us\"}"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, l("about_us"), "html", null, true);
        echo "</a></li>
              <li class=\"list-inline-item\"><a  href=\"";
        // line 17
        echo twig_escape_filter($this->env, router("page", "{\"name\":\"tos\"}"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, l("tos"), "html", null, true);
        echo "</a></li>
              <li class=\"list-inline-item\"><a  href=\"";
        // line 18
        echo twig_escape_filter($this->env, router("page", "{\"name\":\"privacy\"}"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, l("privacy"), "html", null, true);
        echo "</a></li>
          </ul>
      </div>
      <!-- Surfow V6.0.0 -->
      <div class=\"col-lg-6 text-left\">
          © ";
        // line 23
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, ($context["now"] ?? null), "Y"), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, s("generale/name"), "html", null, true);
        echo ", ";
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
        return array (  66 => 23,  56 => 18,  50 => 17,  44 => 16,  38 => 15,  25 => 5,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "footer_content.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\footer_content.html");
    }
}
