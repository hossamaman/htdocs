<?php

/* social_login.html */
class __TwigTemplate_35ede7996b6a4d3cf177a6e127fd70f0665a319889aa220da95da4ceed18f276 extends Twig_Template
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
        echo "<div class=\"btn-list\">
    ";
        // line 2
        if (((twig_length_filter($this->env, s("socialauth/facebook/id")) > 5) && (twig_length_filter($this->env, s("socialauth/facebook/secret")) > 5))) {
            // line 3
            echo "    <a style=\"cursor:pointer;\" class=\"btn btn-facebook btn-icon btn-pill text-white loading-onclick\" onclick=\"window.location = '";
            echo twig_escape_filter($this->env, router("social_connect", array("provider" => "facebook")), "html", null, true);
            echo "';\" >
        <i class=\"fa fa-facebook\"></i>
    </a>
    ";
        }
        // line 7
        echo "    ";
        if (((twig_length_filter($this->env, s("socialauth/twitter/key")) > 5) && (twig_length_filter($this->env, s("socialauth/twitter/secret")) > 5))) {
            // line 8
            echo "    <a style=\"cursor:pointer;\" class=\"btn btn-twitter btn-icon btn-pill text-white loading-onclick\" onclick=\"window.location = '";
            echo twig_escape_filter($this->env, router("social_connect", array("provider" => "twitter")), "html", null, true);
            echo "';\" >
        <i class=\"fa fa-twitter\"></i>
    </a>
    ";
        }
        // line 12
        echo "    ";
        if (((twig_length_filter($this->env, s("socialauth/google/id")) > 5) && (twig_length_filter($this->env, s("socialauth/google/secret")) > 5))) {
            // line 13
            echo "    <a style=\"cursor:pointer;\" class=\"btn btn-google btn-icon btn-pill text-white loading-onclick\" onclick=\"window.location = '";
            echo twig_escape_filter($this->env, router("social_connect", array("provider" => "google")), "html", null, true);
            echo "';\" >
        <i class=\"fa fa-google-plus\"></i>
    </a>
    ";
        }
        // line 17
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "social_login.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 17,  46 => 13,  43 => 12,  35 => 8,  32 => 7,  24 => 3,  22 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "social_login.html", "C:\\xamppa\\htdocs\\themes\\user\\surfow6\\social_login.html");
    }
}
