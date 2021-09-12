<?php

/* ads_col2.html */
class __TwigTemplate_6528188965074c6bbf2c60c1d2a319ecda2d694b5d9c3e327ccc82ac8339897c extends Twig_Template
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
        echo "            ";
        if (s("ads/show_line_ads")) {
            // line 2
            echo "                ";
            echo twig_escape_filter($this->env, _s("ads/bottom"), "html", null, true);
            echo "
            ";
        }
        // line 4
        echo "            ";
        if ( !s("ads/show_sidebar_ads")) {
            // line 5
            echo "            </div>
            <div class=\"col-lg-2 col-md-12\"></div>
            ";
        } else {
            // line 8
            echo "            </div>
            <div class=\"col-lg-3 col-md-12\">
                ";
            // line 10
            echo twig_include($this->env, $context, "sidebar.html");
            echo "
            </div>
            ";
        }
        // line 13
        echo "        </div>
    </div>
</div>
";
    }

    public function getTemplateName()
    {
        return "ads_col2.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 13,  40 => 10,  36 => 8,  31 => 5,  28 => 4,  22 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "ads_col2.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\ads_col2.html");
    }
}
