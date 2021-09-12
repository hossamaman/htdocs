<?php

/* signup.html */
class __TwigTemplate_f4602da19b0dbf83a3b8eb89edc3e6b3c7701b11bbb71c37ffe974a46790532a extends Twig_Template
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
        echo twig_escape_filter($this->env, router("home"), "html", null, true);
        echo "\" >
                    <img src=\"";
        // line 9
        echo twig_escape_filter($this->env, s("generale/logo"), "html", null, true);
        echo "\" class=\"h-8\" alt=\"\">
                </a>
              </div>
              <form class=\"card surfow_ajaxform\"
              data-redirect=\"";
        // line 13
        echo twig_escape_filter($this->env, router("dashboard"), "html", null, true);
        echo "\"
              data-method=\"post\"
              data-action=\"signup\"
              data-type=\"guest\" >
              ";
        // line 17
        echo twig_escape_filter($this->env, put_session_key(), "html", null, true);
        echo "
                <div class=\"card-body p-6\">
                  <div class=\"surfow_alert\" ></div>
                  <div class=\"card-title\">";
        // line 20
        echo twig_escape_filter($this->env, l("signup_hint"), "html", null, true);
        echo "</div>
                  <div class=\"form-group\">
                    <label class=\"form-label\">";
        // line 22
        echo twig_escape_filter($this->env, l("username"), "html", null, true);
        echo "</label>
                    <div class=\"input-icon\">
                      <span class=\"input-icon-addon\">
                          <i class=\"fe fe-user\"></i>
                      </span>
                      <input type=\"text\" name=\"username\" class=\"form-control\" placeholder=\"";
        // line 27
        echo twig_escape_filter($this->env, l("username"), "html", null, true);
        echo "\">
                    </div>
                  </div>
                  <div class=\"form-group\">
                    <label class=\"form-label\">";
        // line 31
        echo twig_escape_filter($this->env, l("email"), "html", null, true);
        echo "</label>
                    <div class=\"input-icon\">
                      <span class=\"input-icon-addon\">
                          <i class=\"fe fe-mail\"></i>
                      </span>
                      <input type=\"email\" name=\"email\" class=\"form-control\" placeholder=\"";
        // line 36
        echo twig_escape_filter($this->env, l("email"), "html", null, true);
        echo "\">
                    </div>
                  </div>
                  <div class=\"form-group\">
                    <label class=\"form-label\">";
        // line 40
        echo twig_escape_filter($this->env, l("password"), "html", null, true);
        echo "</label>
                    <div class=\"input-icon\">
                      <span class=\"input-icon-addon\">
                          <i class=\"fe fe-lock\"></i>
                      </span>
                      <input type=\"password\" name=\"password\" class=\"form-control\" placeholder=\"";
        // line 45
        echo twig_escape_filter($this->env, l("password"), "html", null, true);
        echo "\">
                    </div>
                  </div>
                  <div class=\"form-group\">
                    <label class=\"form-label\">";
        // line 49
        echo twig_escape_filter($this->env, l("password2"), "html", null, true);
        echo "</label>
                    <div class=\"input-icon\">
                      <span class=\"input-icon-addon\">
                          <i class=\"fe fe-lock\"></i>
                      </span>
                      <input type=\"password\" name=\"password2\" class=\"form-control\" placeholder=\"";
        // line 54
        echo twig_escape_filter($this->env, l("password"), "html", null, true);
        echo "\">
                    </div>
                  </div>
                  <div class=\"form-group\">
                    <label class=\"custom-control custom-checkbox\">
                      <input type=\"checkbox\" checked=\"\"  name=\"agree\" class=\"custom-control-input\" />
                      <span class=\"custom-control-label\">";
        // line 60
        echo twig_escape_filter($this->env, l("i_agree"), "html", null, true);
        echo " <a href=\"";
        echo twig_escape_filter($this->env, router("page", "{\"name\":\"tos\"}"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, l("tos"), "html", null, true);
        echo "</a></span>
                    </label>
                  </div>

                  <div class=\"form-footer\">
                    <button type=\"submit\" class=\"surfow_submit btn btn-indigo btn-pill btn-block\"><i class=\"fe fe-user-plus mr-2\"></i> ";
        // line 65
        echo twig_escape_filter($this->env, l("signup"), "html", null, true);
        echo "</button>
                  </div>

                  <div class=\"text-center text-muted\">
                    <br>";
        // line 69
        echo twig_escape_filter($this->env, l("ask_resend"), "html", null, true);
        echo " <a href=\"";
        echo twig_escape_filter($this->env, router("resend"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, l("resend"), "html", null, true);
        echo "</a>
                  </div>
                  <hr>
                  <center>";
        // line 72
        echo twig_include($this->env, $context, "social_login.html");
        echo "</center>
                </div>
              </form>
              <div class=\"text-center text-muted\">
                ";
        // line 76
        echo twig_escape_filter($this->env, l("already_user"), "html", null, true);
        echo " <a href=\"";
        echo twig_escape_filter($this->env, router("login"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, l("login"), "html", null, true);
        echo "</a>
                <br><br>";
        // line 77
        echo twig_escape_filter($this->env, do_action("template", "language_tags"), "html", null, true);
        echo "
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
";
        // line 84
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "signup.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  175 => 84,  165 => 77,  157 => 76,  150 => 72,  140 => 69,  133 => 65,  121 => 60,  112 => 54,  104 => 49,  97 => 45,  89 => 40,  82 => 36,  74 => 31,  67 => 27,  59 => 22,  54 => 20,  48 => 17,  41 => 13,  34 => 9,  30 => 8,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "signup.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\signup.html");
    }
}
