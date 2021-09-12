<?php

/* account_settings.html */
class __TwigTemplate_55fc0762f2003f7170bee691bfe5359a245cb29f4c28fb3e2b77ff5d4f8f07a0 extends Twig_Template
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
            ";
        // line 6
        echo twig_include($this->env, $context, "ads_col1.html");
        echo "

                    <div class=\"page-header\">
                      <h1 class=\"page-title\">
                         ";
        // line 10
        echo twig_escape_filter($this->env, l("settings"), "html", null, true);
        echo "
                      </h1>
                    </div>

                    <div class=\"row\">
                      <div class=\"";
        // line 15
        if ((s("defaults/withdrawal_status") == "yes")) {
            echo "col-lg-4";
        } else {
            echo "col-lg-6";
        }
        echo "\">
                        <div class=\"card\">
                            <div class=\"card-status bg-indigo\"></div>
                          <div class=\"card-body text-center\">
                            <div class=\"card-category\">";
        // line 19
        echo twig_escape_filter($this->env, l("affiliate_settings"), "html", null, true);
        echo "</div>
                            <div class=\"text-center mt-6\">
                              <a href=\"";
        // line 21
        echo twig_escape_filter($this->env, router("affiliate"), "html", null, true);
        echo "\" class=\"btn btn-pill btn-icon text-indigo btn-secondary btn-block\"><i class=\"fe fe-settings\" ></i> ";
        echo twig_escape_filter($this->env, l("edit"), "html", null, true);
        echo "</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class=\"";
        // line 27
        if ((s("defaults/withdrawal_status") == "yes")) {
            echo "col-lg-4";
        } else {
            echo "col-lg-6";
        }
        echo "\">
                        <div class=\"card\">
                            <div class=\"card-status bg-indigo\"></div>
                          <div class=\"card-body text-center\">
                            <div class=\"card-category\">";
        // line 31
        echo twig_escape_filter($this->env, l("billing_addresses"), "html", null, true);
        echo "</div>
                            <div class=\"text-center mt-6\">
                              <a href=\"";
        // line 33
        echo twig_escape_filter($this->env, router("billing"), "html", null, true);
        echo "\" class=\"btn btn-pill btn-icon text-indigo btn-secondary btn-block\"><i class=\"fe fe-settings\" ></i> ";
        echo twig_escape_filter($this->env, l("edit"), "html", null, true);
        echo "</a>
                            </div>
                          </div>
                        </div>
                      </div>

                      ";
        // line 39
        if ((s("defaults/withdrawal_status") == "yes")) {
            // line 40
            echo "                      <div class=\"col-lg-4\">
                        <div class=\"card\">
                            <div class=\"card-status bg-indigo\"></div>
                          <div class=\"card-body text-center\">
                            <div class=\"card-category\">";
            // line 44
            echo twig_escape_filter($this->env, l("saved_cards"), "html", null, true);
            echo "</div>
                            <div class=\"text-center mt-6\">
                              <a href=\"";
            // line 46
            echo twig_escape_filter($this->env, router("cards"), "html", null, true);
            echo "\" class=\"btn btn-pill btn-icon text-indigo btn-secondary btn-block\"><i class=\"fe fe-settings\" ></i> ";
            echo twig_escape_filter($this->env, l("edit"), "html", null, true);
            echo "</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      ";
        }
        // line 52
        echo "                  </div>

                    ";
        // line 54
        echo twig_escape_filter($this->env, put_session_key(), "html", null, true);
        echo "

                    <form class=\"surfow_ajaxform\"
                    data-redirect=\"\"
                    data-method=\"post\"
                    data-action=\"update-username\"
                    data-type=\"user\" >
                        <div class=\"surfow_alert mb-1 mt-1\" ></div>
                        <div class=\"card\">
                          <div class=\"card-status card-status-left bg-indigo\"></div>
                          <div class=\"card-body\">
                              <div class=\"form-group\">
                                  <label class=\"form-label\">";
        // line 66
        echo twig_escape_filter($this->env, l("username"), "html", null, true);
        echo "</label>
                                  <div class=\"input-icon\">
                                      <span class=\"input-icon-addon\">
                                          <i class=\"fe fe-user\"></i>
                                      </span>
                                      <input class=\"form-control\" placeholder=\"";
        // line 71
        echo twig_escape_filter($this->env, l("username"), "html", null, true);
        echo "\" value=\"";
        echo twig_escape_filter($this->env, u("username"));
        echo "\" name=\"username\" type=\"text\">
                                  </div>
                              </div>
                              <div class=\"mt-2 mb-2 btn-list\">
                                  <button type=\"submit\" class=\"surfow_submit btn btn-lg btn-indigo btn-pill mb-1\">";
        // line 75
        echo twig_escape_filter($this->env, l("update"), "html", null, true);
        echo " <i class=\"fe fe-check-circle\"></i></button>
                              </div>
                          </div>
                        </div>
                    </form>

                    <form class=\"surfow_ajaxform\"
                    data-redirect=\"\"
                    data-method=\"post\"
                    data-action=\"update-email\"
                    data-type=\"user\" >
                        <div class=\"surfow_alert mb-1 mt-1\" ></div>
                        <div class=\"card\">
                          <div class=\"card-status card-status-left bg-indigo\"></div>
                          <div class=\"card-body\">
                              <div class=\"form-group\">
                                  <label class=\"form-label\">";
        // line 91
        echo twig_escape_filter($this->env, l("email"), "html", null, true);
        echo "</label>
                                  <div class=\"input-icon\">
                                      <span class=\"input-icon-addon\">
                                          <i class=\"fe fe-mail\"></i>
                                      </span>
                                      <input class=\"form-control\" placeholder=\"";
        // line 96
        echo twig_escape_filter($this->env, l("email"), "html", null, true);
        echo "\" value=\"";
        echo twig_escape_filter($this->env, u("email"));
        echo "\" name=\"email\" type=\"text\">
                                  </div>
                              </div>
                              <div class=\"mt-2 mb-2 btn-list\">
                                  <button type=\"submit\" class=\"surfow_submit btn btn-lg btn-indigo btn-pill mb-1\">";
        // line 100
        echo twig_escape_filter($this->env, l("update"), "html", null, true);
        echo " <i class=\"fe fe-check-circle\"></i></button>
                              </div>
                          </div>
                        </div>
                    </form>

                    <form class=\"surfow_ajaxform\"
                    data-redirect=\"\"
                    data-method=\"post\"
                    data-action=\"update-password\"
                    data-type=\"user\" >
                        <div class=\"surfow_alert mb-1 mt-1\" ></div>
                        <div class=\"card\">
                          <div class=\"card-status card-status-left bg-indigo\"></div>
                          <div class=\"card-body\">
                              <div class=\"form-group\">
                                  <label class=\"form-label\">";
        // line 116
        echo twig_escape_filter($this->env, l("current_password"), "html", null, true);
        echo "</label>
                                  <div class=\"input-icon\">
                                      <span class=\"input-icon-addon\">
                                          <i class=\"fe fe-lock\"></i>
                                      </span>
                                      <input class=\"form-control\" placeholder=\"";
        // line 121
        echo twig_escape_filter($this->env, l("current_password"), "html", null, true);
        echo "\" name=\"old_password\" type=\"password\">
                                  </div>
                              </div><hr>
                              <div class=\"form-group\">
                                  <label class=\"form-label\">";
        // line 125
        echo twig_escape_filter($this->env, l("new_password"), "html", null, true);
        echo "</label>
                                  <div class=\"input-icon\">
                                      <span class=\"input-icon-addon\">
                                          <i class=\"fe fe-lock\"></i>
                                      </span>
                                      <input class=\"form-control\" placeholder=\"";
        // line 130
        echo twig_escape_filter($this->env, l("new_password"), "html", null, true);
        echo "\" name=\"password\" type=\"password\">
                                  </div>
                              </div>
                              <div class=\"form-group\">
                                  <label class=\"form-label\">";
        // line 134
        echo twig_escape_filter($this->env, l("repeat_new_password"), "html", null, true);
        echo "</label>
                                  <div class=\"input-icon\">
                                      <span class=\"input-icon-addon\">
                                          <i class=\"fe fe-lock\"></i>
                                      </span>
                                      <input class=\"form-control\" placeholder=\"";
        // line 139
        echo twig_escape_filter($this->env, l("repeat_new_password"), "html", null, true);
        echo "\" name=\"password2\" type=\"password\">
                                  </div>
                              </div>
                              <div class=\"mt-2 mb-2 btn-list\">
                                  <button type=\"submit\" class=\"surfow_submit btn btn-lg btn-indigo btn-pill mb-1\">";
        // line 143
        echo twig_escape_filter($this->env, l("update"), "html", null, true);
        echo " <i class=\"fe fe-check-circle\"></i></button>
                              </div>
                          </div>
                        </div>
                    </form>






        ";
        // line 154
        echo twig_include($this->env, $context, "ads_col2.html");
        echo "
      </div>
      ";
        // line 156
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
    </div>
";
        // line 158
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "account_settings.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  287 => 158,  282 => 156,  277 => 154,  263 => 143,  256 => 139,  248 => 134,  241 => 130,  233 => 125,  226 => 121,  218 => 116,  199 => 100,  190 => 96,  182 => 91,  163 => 75,  154 => 71,  146 => 66,  131 => 54,  127 => 52,  116 => 46,  111 => 44,  105 => 40,  103 => 39,  92 => 33,  87 => 31,  76 => 27,  65 => 21,  60 => 19,  49 => 15,  41 => 10,  34 => 6,  30 => 5,  26 => 4,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "account_settings.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\account_settings.html");
    }
}
