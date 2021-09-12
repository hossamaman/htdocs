<?php

/* header.html */
class __TwigTemplate_92374c6551bab7a3b8ce617018632023dc2981d389ebf4b736001889fe5d5641 extends Twig_Template
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
        echo "<!DOCTYPE html>
<html lang=\"";
        // line 2
        echo twig_escape_filter($this->env, current_language(), "html", null, true);
        echo "\" dir=\"";
        echo twig_escape_filter($this->env, direction(), "html", null, true);
        echo "\">
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    ";
        // line 7
        echo twig_escape_filter($this->env, do_action("template", "meta_header"), "html", null, true);
        echo "
    <!-- surfow V6.0.0 ADMIN PANEL -->
    ";
        // line 9
        ob_start();
        // line 10
        echo "    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css\">
    <link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext\">
    <script src=\"";
        // line 12
        echo twig_escape_filter($this->env, turl(), "html", null, true);
        echo "/assets/js/require.min.js\"></script>
    <script>requirejs.config({baseUrl:'";
        // line 13
        echo twig_escape_filter($this->env, turl(), "html", null, true);
        echo "'});</script>
    <link  href=\"";
        // line 14
        echo twig_escape_filter($this->env, turl(), "html", null, true);
        echo "/assets/css/dashboard.";
        echo twig_escape_filter($this->env, direction(), "html", null, true);
        echo ".css\" rel=\"stylesheet\" />
    <script src=\"";
        // line 15
        echo twig_escape_filter($this->env, turl(), "html", null, true);
        echo "/assets/js/dashboard.js\"></script>
    <link  href=\"";
        // line 16
        echo twig_escape_filter($this->env, turl(), "html", null, true);
        echo "/assets/plugins/charts-c3/plugin.";
        echo twig_escape_filter($this->env, direction(), "html", null, true);
        echo ".css\" rel=\"stylesheet\" />
    <script src=\"";
        // line 17
        echo twig_escape_filter($this->env, turl(), "html", null, true);
        echo "/assets/plugins/charts-c3/plugin.js\"></script>
    <script src=\"";
        // line 18
        echo twig_escape_filter($this->env, turl(), "html", null, true);
        echo "/assets/plugins/input-mask/plugin.js\"></script>
    <link  href=\"";
        // line 19
        echo twig_escape_filter($this->env, turl(), "html", null, true);
        echo "/assets/css/style.css\" rel=\"stylesheet\">
    <link  href=\"";
        // line 20
        echo twig_escape_filter($this->env, turl(), "html", null, true);
        echo "/assets/css/slider.css\" rel=\"stylesheet\">
    <link  href=\"";
        // line 21
        echo twig_escape_filter($this->env, turl(), "html", null, true);
        echo "/assets/css/slider.html5.css\" rel=\"stylesheet\">
    <link  href=\"";
        // line 22
        echo twig_escape_filter($this->env, turl(), "html", null, true);
        echo "/assets/css/trumbowyg.min.css\" rel=\"stylesheet\">
    ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        // line 24
        echo "</head>
<body>
";
    }

    public function getTemplateName()
    {
        return "header.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 24,  87 => 22,  83 => 21,  79 => 20,  75 => 19,  71 => 18,  67 => 17,  61 => 16,  57 => 15,  51 => 14,  47 => 13,  43 => 12,  39 => 10,  37 => 9,  32 => 7,  22 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "header.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\header.html");
    }
}
