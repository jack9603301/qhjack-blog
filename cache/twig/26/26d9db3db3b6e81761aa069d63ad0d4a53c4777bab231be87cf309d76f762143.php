<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* login.json.twig */
class __TwigTemplate_edb4366c99b831e7e39ed598ef37c77e0b1d456c586dd526fdfc80d02fb40084 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        if ( !$this->getAttribute($this->getAttribute(($context["grav"] ?? null), "user", []), "authenticated", [])) {
            // line 2
            echo "{\"code\":401,\"status\":\"unauthenticated\",\"error\":{\"message\":\"Authentication required\",\"login\":";
            echo twig_escape_filter($this->env, twig_jsonencode_filter(twig_trim_filter(twig_include($this->env, $context, "partials/login-form.html.twig"))), "html", null, true);
            echo "}}";
        } else {
            // line 4
            echo "{\"code\":200,\"status\":\"authenticated\",\"message\":\"You have been authenticated\"}";
        }
    }

    public function getTemplateName()
    {
        return "login.json.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 4,  32 => 2,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{%- if not grav.user.authenticated -%}
{\"code\":401,\"status\":\"unauthenticated\",\"error\":{\"message\":\"Authentication required\",\"login\":{{ include('partials/login-form.html.twig')|trim|json_encode }}}}
{%- else -%}
{\"code\":200,\"status\":\"authenticated\",\"message\":\"You have been authenticated\"}
{%- endif -%}", "login.json.twig", "/var/www/qhjack/user/plugins/login/templates/login.json.twig");
    }
}
