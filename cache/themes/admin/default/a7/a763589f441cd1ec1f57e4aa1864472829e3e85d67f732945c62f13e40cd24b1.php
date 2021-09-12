<?php

/* user_wallet.html */
class __TwigTemplate_de36e236ba10aae9840c0ac3e07d26be3b3aa1342b475b0f8eae13e7753b2c78 extends Twig_Template
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
";
        // line 2
        $context["user"] = get("user");
        // line 3
        $context["info"] = get("wallet");
        // line 4
        echo "    <div class=\"page\">
        <div class=\"page-main\">
          ";
        // line 6
        echo twig_include($this->env, $context, "head_menu.html");
        echo "
          ";
        // line 7
        echo twig_include($this->env, $context, "main_menu.html");
        echo "
          <div class=\"my-3 my-md-5\">
              <div class=\"container\">
                <div class=\"page-header\">
                  <h1 class=\"page-title\">
                    ";
        // line 12
        echo twig_escape_filter($this->env, _get("title2"), "html", null, true);
        echo "
                  </h1>
                </div>
                <div class=\"row\">
                    <div class=\"col-lg-3 col-md-12\">
                        ";
        // line 17
        echo twig_include($this->env, $context, "profile_menu.html");
        echo "
                    </div>
                    <div class=\"col-lg-9 col-md-12\">
                        <div class=\"card\">

                          <div class=\"card-body\">

                              <form class=\"row surfow_ajaxform\"
                              data-redirect=\"\"
                              data-method=\"post\"
                              data-action=\"manage-wallet\"
                              data-type=\"user\" >
                              <input type=\"hidden\" name=\"id\" value=\"";
        // line 29
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["info"] ?? null), "id", array()), "html", null, true);
        echo "\" />
                              <input type=\"hidden\" name=\"section\" value=\"pending\" />
                              ";
        // line 31
        echo twig_escape_filter($this->env, put_session_key(), "html", null, true);
        echo "
                                    <div class=\"col-lg-12\"><div class=\"surfow_alert\" ></div></div>
                                    <div class=\"col-lg-5\">
                                      <div class=\"card\">
                                        <div class=\"card-status card-status-left bg-red\"></div>
                                        <div class=\"card-body text-center\">
                                          <div class=\"card-category\">";
        // line 37
        echo twig_escape_filter($this->env, l("pending"), "html", null, true);
        echo "</div>
                                          <div class=\"display-4 my-4\">\$";
        // line 38
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["info"] ?? null), "pending", array(), "array"), 2, ".", ","), "html", null, true);
        echo "</div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class=\"col-lg-7\">
                                      <div class=\"card border-0\">
                                        <div class=\"card-body\">
                                          <div class=\"card-category text-left\">";
        // line 46
        echo twig_escape_filter($this->env, l("edit"), "html", null, true);
        echo "</div>
                                          <div class=\"display-4 my-4\">
                                              <div class=\"form-group\">
                                                  <div class=\"input-group\">
                                                    <input type=\"text\" name=\"value\" value=\"";
        // line 50
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["info"] ?? null), "pending", array(), "array"));
        echo "\" class=\"form-control\" placeholder=\"0.00 USD\">
                                                    <span class=\"input-group-append\">
                                                      <button class=\"surfow_submit btn btn-danger\" type=\"submit\"><i class=\"fe fe-save\"></i> ";
        // line 52
        echo twig_escape_filter($this->env, l("save"), "html", null, true);
        echo "</button>
                                                    </span>
                                                  </div>
                                              </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                </form>

                                <form class=\"row surfow_ajaxform\"
                                data-redirect=\"\"
                                data-method=\"post\"
                                data-action=\"manage-wallet\"
                                data-type=\"user\" >
                                <input type=\"hidden\" name=\"id\" value=\"";
        // line 67
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["info"] ?? null), "id", array()), "html", null, true);
        echo "\" />
                                <input type=\"hidden\" name=\"section\" value=\"confirmed\" />
                                ";
        // line 69
        echo twig_escape_filter($this->env, put_session_key(), "html", null, true);
        echo "
                                      <div class=\"col-lg-12\"><div class=\"surfow_alert\" ></div></div>
                                      <div class=\"col-lg-5\">
                                        <div class=\"card\">
                                          <div class=\"card-status card-status-left bg-green\"></div>
                                          <div class=\"card-body text-center\">
                                            <div class=\"card-category\">";
        // line 75
        echo twig_escape_filter($this->env, l("confirmed"), "html", null, true);
        echo "</div>
                                            <div class=\"display-4 my-4\">\$";
        // line 76
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["info"] ?? null), "confirmed", array(), "array"), 2, ".", ","), "html", null, true);
        echo "</div>
                                          </div>
                                        </div>
                                      </div>

                                      <div class=\"col-lg-7\">
                                        <div class=\"card border-0\">
                                          <div class=\"card-body\">
                                            <div class=\"card-category text-left\">";
        // line 84
        echo twig_escape_filter($this->env, l("edit"), "html", null, true);
        echo "</div>
                                            <div class=\"display-4 my-4\">
                                                <div class=\"form-group\">
                                                    <div class=\"input-group\">
                                                      <input type=\"text\" name=\"value\" value=\"";
        // line 88
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["info"] ?? null), "confirmed", array(), "array"));
        echo "\" class=\"form-control\" placeholder=\"0.00 USD\">
                                                      <span class=\"input-group-append\">
                                                        <button class=\"surfow_submit btn btn-success\" type=\"submit\"><i class=\"fe fe-save\"></i> ";
        // line 90
        echo twig_escape_filter($this->env, l("save"), "html", null, true);
        echo "</button>
                                                      </span>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  </form>

                                  <form class=\"row surfow_ajaxform\"
                                  data-redirect=\"\"
                                  data-method=\"post\"
                                  data-action=\"manage-wallet\"
                                  data-type=\"user\" >
                                  <input type=\"hidden\" name=\"id\" value=\"";
        // line 105
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["info"] ?? null), "id", array()), "html", null, true);
        echo "\" />
                                  <input type=\"hidden\" name=\"section\" value=\"withdrawal\" />
                                  ";
        // line 107
        echo twig_escape_filter($this->env, put_session_key(), "html", null, true);
        echo "
                                        <div class=\"col-lg-12\"><div class=\"surfow_alert\" ></div></div>
                                        <div class=\"col-lg-5\">
                                          <div class=\"card\">
                                            <div class=\"card-status card-status-left bg-indigo\"></div>
                                            <div class=\"card-body text-center\">
                                              <div class=\"card-category\">";
        // line 113
        echo twig_escape_filter($this->env, l("withdrawal"), "html", null, true);
        echo "</div>
                                              <div class=\"display-4 my-4\">\$";
        // line 114
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["info"] ?? null), "withdrawal", array(), "array"), 2, "."), "html", null, true);
        echo "</div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class=\"col-lg-7\">
                                          <div class=\"card border-0\">
                                            <div class=\"card-body\">
                                              <div class=\"card-category text-left\">";
        // line 122
        echo twig_escape_filter($this->env, l("edit"), "html", null, true);
        echo "</div>
                                              <div class=\"display-4 my-4\">
                                                  <div class=\"form-group\">
                                                      <div class=\"input-group\">
                                                        <input type=\"text\" name=\"value\" value=\"";
        // line 126
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["info"] ?? null), "withdrawal", array(), "array"));
        echo "\" class=\"form-control\" placeholder=\"0.00 USD\">
                                                        <span class=\"input-group-append\">
                                                          <button class=\"surfow_submit btn btn-indigo\" type=\"submit\"><i class=\"fe fe-save\"></i> ";
        // line 128
        echo twig_escape_filter($this->env, l("save"), "html", null, true);
        echo "</button>
                                                        </span>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </form>

                        </div>
                    </div>
                </div>
              </div>
          </div>
        </div>
        ";
        // line 144
        echo twig_include($this->env, $context, "footer_content.html");
        echo "
    </div>
";
        // line 146
        echo twig_include($this->env, $context, "footer.html");
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "user_wallet.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  250 => 146,  245 => 144,  226 => 128,  221 => 126,  214 => 122,  203 => 114,  199 => 113,  190 => 107,  185 => 105,  167 => 90,  162 => 88,  155 => 84,  144 => 76,  140 => 75,  131 => 69,  126 => 67,  108 => 52,  103 => 50,  96 => 46,  85 => 38,  81 => 37,  72 => 31,  67 => 29,  52 => 17,  44 => 12,  36 => 7,  32 => 6,  28 => 4,  26 => 3,  24 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "user_wallet.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\user_wallet.html");
    }
}
