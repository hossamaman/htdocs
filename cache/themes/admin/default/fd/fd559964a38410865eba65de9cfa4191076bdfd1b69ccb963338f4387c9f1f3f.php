<?php

/* profile_menu.html */
class __TwigTemplate_05654697c0265ce5ac82ab3bbc340cca29f8b5fdeae17329ff45a6c40caa61d3 extends Twig_Template
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
        $context["user"] = get("user");
        // line 2
        echo "
<div class=\"card\">
    <div class=\"card-status card-status-left bg-indigo\"></div>
    <div class=\"card-body\">
      <div class=\"media\">
        <span class=\"avatar avatar mr-2\" style=\"background-image: url('";
        // line 7
        echo twig_escape_filter($this->env, gravatar(twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "email", array())), "html", null, true);
        echo "')\"></span>
        <div class=\"media-body\">
          <h4 class=\"m-0\">@";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "username", array()));
        echo "</h4>
          <p class=\"text-muted mb-0\">";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "email", array()));
        echo "</p>
        </div>
      </div>
    </div>
</div>
<div>
  <div class=\"list-group list-group-transparent mb-0\">

      <a href=\"";
        // line 18
        echo twig_escape_filter($this->env, router("admin_edit_user", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" class=\"";
        if (is_routed("admin_edit_user")) {
            echo "active ";
        }
        echo "list-group-item list-group-item-action d-flex align-items-center\">
        <span class=\"icon mr-3\">
            <i><img class=\"setting_icon\" src=\"";
        // line 20
        echo twig_escape_filter($this->env, storage("data/user_account.svg"), "html", null, true);
        echo "\"></img></i>
        </span>
        ";
        // line 22
        echo twig_escape_filter($this->env, l("account"), "html", null, true);
        echo "
      </a>

      <a href=\"";
        // line 25
        echo twig_escape_filter($this->env, router("admin_user_profile", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" class=\"";
        if (is_routed("admin_user_profile")) {
            echo "active ";
        }
        echo "list-group-item list-group-item-action d-flex align-items-center\">
        <span class=\"icon mr-3\">
            <i><img class=\"setting_icon\" src=\"";
        // line 27
        echo twig_escape_filter($this->env, storage("data/overview.svg"), "html", null, true);
        echo "\"></img></i>
        </span>
        ";
        // line 29
        echo twig_escape_filter($this->env, l("overview"), "html", null, true);
        echo "
      </a>

      <a href=\"";
        // line 32
        echo twig_escape_filter($this->env, router("admin_user_websites", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" class=\"";
        if (((is_routed("admin_user_websites") || is_routed("admin_add_website")) || is_routed("admin_edit_website"))) {
            echo "active ";
        }
        echo "list-group-item list-group-item-action d-flex align-items-center\">
        <span class=\"icon mr-3\">
            <i><img class=\"setting_icon\" src=\"";
        // line 34
        echo twig_escape_filter($this->env, storage("data/user_websites.svg"), "html", null, true);
        echo "\"></img></i>
        </span>
        ";
        // line 36
        echo twig_escape_filter($this->env, l("websites"), "html", null, true);
        echo "
      </a>

      <a href=\"";
        // line 39
        echo twig_escape_filter($this->env, router("admin_user_sessions", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" class=\"";
        if (is_routed("admin_user_sessions")) {
            echo "active ";
        }
        echo "list-group-item list-group-item-action d-flex align-items-center\">
        <span class=\"icon mr-3\">
            <i><img class=\"setting_icon\" src=\"";
        // line 41
        echo twig_escape_filter($this->env, storage("data/user_sessions.svg"), "html", null, true);
        echo "\"></img></i>
        </span>
        ";
        // line 43
        echo twig_escape_filter($this->env, l("sessions"), "html", null, true);
        echo "
      </a>

      <a href=\"";
        // line 46
        echo twig_escape_filter($this->env, router("admin_user_payments", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" class=\"";
        if (is_routed("admin_user_payments")) {
            echo "active ";
        }
        echo "list-group-item list-group-item-action d-flex align-items-center\">
        <span class=\"icon mr-3\">
            <i><img class=\"setting_icon\" src=\"";
        // line 48
        echo twig_escape_filter($this->env, storage("data/user_payments.svg"), "html", null, true);
        echo "\"></img></i>
        </span>
        ";
        // line 50
        echo twig_escape_filter($this->env, l("payments"), "html", null, true);
        echo "
      </a>

      <a href=\"";
        // line 53
        echo twig_escape_filter($this->env, router("admin_user_purchases", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" class=\"";
        if (is_routed("admin_user_purchases")) {
            echo "active ";
        }
        echo "list-group-item list-group-item-action d-flex align-items-center\">
        <span class=\"icon mr-3\">
            <i><img class=\"setting_icon\" src=\"";
        // line 55
        echo twig_escape_filter($this->env, storage("data/user_purchases.svg"), "html", null, true);
        echo "\"></img></i>
        </span>
        ";
        // line 57
        echo twig_escape_filter($this->env, l("purchases"), "html", null, true);
        echo "
      </a>

      <a href=\"";
        // line 60
        echo twig_escape_filter($this->env, router("admin_user_wallet", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" class=\"";
        if (is_routed("admin_user_wallet")) {
            echo "active ";
        }
        echo "list-group-item list-group-item-action d-flex align-items-center\">
        <span class=\"icon mr-3\">
            <i><img class=\"setting_icon\" src=\"";
        // line 62
        echo twig_escape_filter($this->env, storage("data/user_wallet.svg"), "html", null, true);
        echo "\"></img></i>
        </span>
        ";
        // line 64
        echo twig_escape_filter($this->env, l("wallet"), "html", null, true);
        echo "
      </a>

      <a href=\"";
        // line 67
        echo twig_escape_filter($this->env, router("admin_user_withdrawals", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" class=\"";
        if (is_routed("admin_user_withdrawals")) {
            echo "active ";
        }
        echo "list-group-item list-group-item-action d-flex align-items-center\">
        <span class=\"icon mr-3\">
            <i><img class=\"setting_icon\" src=\"";
        // line 69
        echo twig_escape_filter($this->env, storage("data/user_withdrawals.svg"), "html", null, true);
        echo "\"></img></i>
        </span>
        ";
        // line 71
        echo twig_escape_filter($this->env, l("withdrawals"), "html", null, true);
        echo "
      </a>

      <a href=\"";
        // line 74
        echo twig_escape_filter($this->env, router("admin_user_referrals", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" class=\"";
        if (is_routed("admin_user_referrals")) {
            echo "active ";
        }
        echo "list-group-item list-group-item-action d-flex align-items-center\">
        <span class=\"icon mr-3\">
            <i><img class=\"setting_icon\" src=\"";
        // line 76
        echo twig_escape_filter($this->env, storage("data/user_referrals.svg"), "html", null, true);
        echo "\"></img></i>
        </span>
        ";
        // line 78
        echo twig_escape_filter($this->env, l("referrals"), "html", null, true);
        echo "
      </a>

      <a href=\"";
        // line 81
        echo twig_escape_filter($this->env, router("admin_user_billing_addresses", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" class=\"";
        if (is_routed("admin_user_billing_addresses")) {
            echo "active ";
        }
        echo "list-group-item list-group-item-action d-flex align-items-center\">
        <span class=\"icon mr-3\">
            <i><img class=\"setting_icon\" src=\"";
        // line 83
        echo twig_escape_filter($this->env, storage("data/user_billing_addresses.svg"), "html", null, true);
        echo "\"></img></i>
        </span>
        ";
        // line 85
        echo twig_escape_filter($this->env, l("billing_addresses"), "html", null, true);
        echo "
      </a>

      <a href=\"";
        // line 88
        echo twig_escape_filter($this->env, router("admin_user_saved_cards", array("uid" => twig_get_attribute($this->env, $this->getSourceContext(), ($context["user"] ?? null), "id", array()))), "html", null, true);
        echo "\" class=\"";
        if (is_routed("admin_user_saved_cards")) {
            echo "active ";
        }
        echo "list-group-item list-group-item-action d-flex align-items-center\">
        <span class=\"icon mr-3\">
            <i><img class=\"setting_icon\" src=\"";
        // line 90
        echo twig_escape_filter($this->env, storage("data/user_saved_cards.svg"), "html", null, true);
        echo "\"></img></i>
        </span>
        ";
        // line 92
        echo twig_escape_filter($this->env, l("saved_cards"), "html", null, true);
        echo "
      </a>

  </div><br>
</div>
";
    }

    public function getTemplateName()
    {
        return "profile_menu.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  262 => 92,  257 => 90,  248 => 88,  242 => 85,  237 => 83,  228 => 81,  222 => 78,  217 => 76,  208 => 74,  202 => 71,  197 => 69,  188 => 67,  182 => 64,  177 => 62,  168 => 60,  162 => 57,  157 => 55,  148 => 53,  142 => 50,  137 => 48,  128 => 46,  122 => 43,  117 => 41,  108 => 39,  102 => 36,  97 => 34,  88 => 32,  82 => 29,  77 => 27,  68 => 25,  62 => 22,  57 => 20,  48 => 18,  37 => 10,  33 => 9,  28 => 7,  21 => 2,  19 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "profile_menu.html", "C:\\xamppa\\htdocs\\themes\\admin\\default\\profile_menu.html");
    }
}
