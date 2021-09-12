<?php

/* login.html */
class __TwigTemplate_d6ac589a7e1334eac84c2c742d9169aa3d429b631985fa7d08deadf1919df754 extends Twig_Template
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
      <div class=\"page-single\">
        <div class=\"container\">
          <div class=\"row\">
            <div class=\"col col-login mx-auto\">
              <div class=\"text-center mb-6\">
                <a href=\"";
        // line 8
        echo twig_escape_filter($this->env, router("admin"), "html", null, true);
        echo "\" >
                    <img src=\"";
        // line 9
        echo twig_escape_filter($this->env, storage("data/surfow.png"), "html", null, true);
        echo "\" class=\"h-8\" alt=\"\">
                </a>
              </div>
              <form class=\"card surfow_ajaxform\"
              data-redirect=\"";
        // line 13
        echo twig_escape_filter($this->env, router("admin_home"), "html", null, true);
        echo "\"
              data-method=\"post\"
              data-action=\"login\"
              data-type=\"guest\" >
              ";
        // line 17
        echo twig_escape_filter($this->env, put_session_key(), "html", null, true);
        echo "
                <div class=\"card-body p-6\">
                  <div class=\"surfow_alert\" ></div>
                  <div class=\"card-title\">";
        // line 20
        echo twig_escape_filter($this->env, l("login"), "html", null, true);
        echo "</div>
                  <div class=\"form-group\">
                    <label class=\"form-label\">";
        // line 22
        echo twig_escape_filter($this->env, l("username_or_email"), "html", null, true);
        echo "</label>
                    <div class=\"input-icon\">
                      <span class=\"input-icon-addon\">
                          <i class=\"fe fe-user\"></i>
                      </span>
                      <input type=\"text\" name=\"username\" class=\"form-control\" placeholder=\"";
        // line 27
        echo twig_escape_filter($this->env, l("username_or_email"), "html", null, true);
        echo "\">
                    </div>
                  </div>
                  <div class=\"form-group\">
                    <label class=\"form-label\">";
        // line 31
        echo twig_escape_filter($this->env, l("password"), "html", null, true);
        echo "
                        <a href=\"";
        // line 32
        echo twig_escape_filter($this->env, router("admin_rest"), "html", null, true);
        echo "\" class=\"float-right small\">";
        echo twig_escape_filter($this->env, l("restpass"), "html", null, true);
        echo "</a>
                    </label>
                    <div class=\"input-icon\">
                      <span class=\"input-icon-addon\">
                          <i class=\"fe fe-lock\"></i>
                      </span>
                      <input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"";
        // line 38
        echo twig_escape_filter($this->env, l("password"), "html", null, true);
        echo "\">
                    </div>
                  </div>

                  <div class=\"form-footer\">
                    <button type=\"submit\" class=\"surfow_submit btn btn-indigo btn-pill btn-block\"><i class=\"fe fe-power mr-2\"></i> ";
        // line 43
        echo twig_escape_filter($this->env, l("login"), "html", null, true);
        echo "</button>
                  </div>
                </div>
              </form>

              <div class=\"text-center text-muted\">
                <br><br>";
        // line 49
        echo twig_escape_filter($this->env, do_action("template", "language_tags"), "html", null, true);
        echo "
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
";
        // line 56
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "login.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  116 => 56,  106 => 49,  97 => 43,  89 => 38,  78 => 32,  74 => 31,  67 => 27,  59 => 22,  54 => 20,  48 => 17,  41 => 13,  34 => 9,  30 => 8,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "login.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\login.html");
    }
}
