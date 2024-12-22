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

/* partials/login-form.html.twig */
class __TwigTemplate_251371046e92bf1b2a81c22daffb536d46db83e627ef463f19b8aae8892495ba extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = [
            'field' => [$this, 'block_field'],
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $context["layout"] = (($context["layout"]) ?? (((($this->getAttribute(($context["form"] ?? null), "layout", [], "any", true, true) &&  !(null === $this->getAttribute(($context["form"] ?? null), "layout", [])))) ? ($this->getAttribute(($context["form"] ?? null), "layout", [])) : ("default"))));
        // line 2
        $context["field_layout"] = ($context["layout"] ?? null);
        // line 3
        echo "
";
        // line 4
        $context["client_side_validation"] = (( !(null === $this->getAttribute(($context["form"] ?? null), "client_side_validation", []))) ? ($this->getAttribute(($context["form"] ?? null), "client_side_validation", [])) : ((($this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", [], "any", false, true), "form", [], "any", false, true), "client_side_validation", [], "any", true, true)) ? (_twig_default_filter($this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", [], "any", false, true), "form", [], "any", false, true), "client_side_validation", []), true)) : (true))));
        // line 5
        $context["inline_errors"] = (( !(null === $this->getAttribute(($context["form"] ?? null), "inline_errors", []))) ? ($this->getAttribute(($context["form"] ?? null), "inline_errors", [])) : ($this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "form", []), "inline_errors", [0 => false], "method")));
        // line 6
        echo "
<section id=\"grav-login\">

    ";
        // line 9
        if ((($this->getAttribute(($context["page"] ?? null), "template", []) == "login") || ($context["show_login_form"] ?? null))) {
            // line 10
            echo "        ";
            $context["user"] = $this->getAttribute(($context["grav"] ?? null), "user", []);
            // line 11
            echo "        ";
            if (($this->getAttribute(($context["user"] ?? null), "authenticated", []) && $this->getAttribute(($context["user"] ?? null), "authorized", []))) {
                // line 12
                echo "            <h4>";
                echo twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->translate($this->env, "PLUGIN_LOGIN.WELCOME"), "html", null, true);
                echo " <strong>";
                echo twig_escape_filter($this->env, (($this->getAttribute(($context["user"] ?? null), "fullname", [])) ? ($this->getAttribute(($context["user"] ?? null), "fullname", [])) : ($this->getAttribute(($context["user"] ?? null), "username", []))), "html", null, true);
                echo "</strong></h4>
            <hr>
            <a class=\"button logout\" href=\"";
                // line 14
                echo twig_escape_filter($this->env, $this->getAttribute(($context["uri"] ?? null), "addNonce", [0 => ((((($context["base_url_relative"] ?? null) . $this->getAttribute(($context["uri"] ?? null), "path", [])) . "/task") . $this->getAttribute($this->getAttribute(($context["config"] ?? null), "system", []), "param_sep", [])) . "login.logout"), 1 => "logout-form", 2 => "logout-nonce"], "method"));
                echo "\">";
                echo twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->translate($this->env, "PLUGIN_LOGIN.BTN_LOGOUT"), "html", null, true);
                echo "</a>

        ";
            } elseif (($this->getAttribute(            // line 16
($context["user"] ?? null), "authenticated", []) && $this->getAttribute(($context["user"] ?? null), "twofa_enabled", []))) {
                // line 17
                echo "            ";
                $this->loadTemplate("partials/login-twofa.html.twig", "partials/login-form.html.twig", 17)->display($context);
                // line 18
                echo "
        ";
            } else {
                // line 20
                echo "            ";
                echo ($context["content"] ?? null);
                echo "

            ";
                // line 23
                echo "            ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["grav"] ?? null), "login", []), "getProviderLoginTemplates", []));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["template"]) {
                    // line 24
                    echo "                ";
                    $this->loadTemplate($context["template"], "partials/login-form.html.twig", 24)->display($context);
                    // line 25
                    echo "            ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['template'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 26
                echo "
            <form method=\"post\" action=\"";
                // line 27
                echo twig_escape_filter($this->env, (($context["base_url_relative"] ?? null) . $this->getAttribute(($context["uri"] ?? null), "path", [])));
                echo "\" class=\"";
                echo twig_escape_filter($this->env, ($context["form_outer_classes"] ?? null), "html", null, true);
                echo " login-form\">

                ";
                // line 30
                echo "                ";
                if ($this->getAttribute($this->getAttribute(($context["grav"] ?? null), "twig", []), "plugins_hooked_loginPage", [])) {
                    // line 31
                    echo "                    ";
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute(($context["grav"] ?? null), "twig", []), "plugins_hooked_loginPage", []));
                    $context['loop'] = [
                      'parent' => $context['_parent'],
                      'index0' => 0,
                      'index'  => 1,
                      'first'  => true,
                    ];
                    if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                        $length = count($context['_seq']);
                        $context['loop']['revindex0'] = $length - 1;
                        $context['loop']['revindex'] = $length;
                        $context['loop']['length'] = $length;
                        $context['loop']['last'] = 1 === $length;
                    }
                    foreach ($context['_seq'] as $context["_key"] => $context["label"]) {
                        // line 32
                        echo "                        ";
                        $this->loadTemplate($context["label"], "partials/login-form.html.twig", 32)->display($context);
                        // line 33
                        echo "                    ";
                        ++$context['loop']['index0'];
                        ++$context['loop']['index'];
                        $context['loop']['first'] = false;
                        if (isset($context['loop']['length'])) {
                            --$context['loop']['revindex0'];
                            --$context['loop']['revindex'];
                            $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                        }
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['label'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 34
                    echo "                ";
                }
                // line 35
                echo "
                ";
                // line 36
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($this->getAttribute(($context["form"] ?? null), "fields", []));
                $context['loop'] = [
                  'parent' => $context['_parent'],
                  'index0' => 0,
                  'index'  => 1,
                  'first'  => true,
                ];
                if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                    $length = count($context['_seq']);
                    $context['loop']['revindex0'] = $length - 1;
                    $context['loop']['revindex'] = $length;
                    $context['loop']['length'] = $length;
                    $context['loop']['last'] = 1 === $length;
                }
                foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
                    // line 37
                    echo "                    ";
                    $context["field"] = $this->env->getExtension('Grav\Plugin\Form\TwigExtension')->prepareFormField($context, $context["field"], ($context["field_name"] ?? null));
                    // line 38
                    echo "                    ";
                    if ($context["field"]) {
                        // line 39
                        echo "                      ";
                        $context["value"] = ((($this->getAttribute($context["field"], "name", []) == "username")) ? (($context["username"] ?? null)) : (""));
                        // line 40
                        echo "                      ";
                        // line 41
                        echo "                      ";
                        $context["field_templates"] = $this->env->getExtension('Grav\Plugin\Form\TwigExtension')->includeFormField($this->getAttribute($context["field"], "type", []), ($context["field_layout"] ?? null));
                        // line 42
                        echo "                      ";
                        $this->displayBlock('field', $context, $blocks);
                        // line 45
                        echo "                    ";
                    }
                    // line 46
                    echo "                ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                    if (isset($context['loop']['length'])) {
                        --$context['loop']['revindex0'];
                        --$context['loop']['revindex'];
                        $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 47
                echo "
                <div class=\"";
                // line 48
                ((($context["form_button_outer_classes"] ?? null)) ? (print (twig_escape_filter($this->env, ($context["form_button_outer_classes"] ?? null), "html", null, true))) : (print ("form-actions secondary-accent")));
                echo "\">
                    ";
                // line 49
                if (($this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "login", []), "rememberme", []), "enabled", []) && ((($this->getAttribute($this->getAttribute(($context["form"] ?? null), "login", [], "any", false, true), "rememberme", [], "any", true, true) &&  !(null === $this->getAttribute($this->getAttribute(($context["form"] ?? null), "login", [], "any", false, true), "rememberme", [])))) ? ($this->getAttribute($this->getAttribute(($context["form"] ?? null), "login", [], "any", false, true), "rememberme", [])) : (true)))) {
                    // line 50
                    echo "                        <div class=\"form-data rememberme\" data-grav-default=\"null\" data-grav-disabled=\"true\" data-grav-field=\"checkbox\">
                            <div class=\"form-input-wrapper\">
                                <input type=\"checkbox\" value=\"1\" name=\"rememberme\" id=\"#rememberme\">
                                <label class=\"inline\" for=\"#rememberme\" title=\"";
                    // line 53
                    echo twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->translate($this->env, "PLUGIN_LOGIN.REMEMBER_ME_HELP"), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->translate($this->env, "PLUGIN_LOGIN.REMEMBER_ME"), "html", null, true);
                    echo "</label>
                            </div>
                        </div>
                    ";
                }
                // line 57
                echo "
                    ";
                // line 58
                $context["forgot_button"] = ((($this->getAttribute($this->getAttribute(($context["form"] ?? null), "login", [], "any", false, true), "forgot_button", [], "any", true, true) &&  !(null === $this->getAttribute($this->getAttribute(($context["form"] ?? null), "login", [], "any", false, true), "forgot_button", [])))) ? ($this->getAttribute($this->getAttribute(($context["form"] ?? null), "login", [], "any", false, true), "forgot_button", [])) : (true));
                // line 59
                echo "                    ";
                $context["forgot_route"] = $this->getAttribute($this->getAttribute(($context["grav"] ?? null), "login", []), "getRoute", [0 => "forgot"], "method");
                // line 60
                echo "                    ";
                if ((($context["forgot_button"] ?? null) && ($context["forgot_route"] ?? null))) {
                    // line 61
                    echo "                    <a class=\"";
                    ((($context["form_button_classes"] ?? null)) ? (print (twig_escape_filter($this->env, ($context["form_button_classes"] ?? null), "html", null, true))) : (print ("button secondary")));
                    echo "\" href=\"";
                    echo twig_escape_filter($this->env, (($context["base_url_relative"] ?? null) . ($context["forgot_route"] ?? null)), "html", null, true);
                    echo "\"><i class=\"fa fa-exclamation-circle\"></i> ";
                    echo twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->translate($this->env, "PLUGIN_LOGIN.BTN_FORGOT"), "html", null, true);
                    echo "</a>
                    ";
                }
                // line 63
                echo "
                    <button class=\"";
                // line 64
                ((($context["form_button_classes"] ?? null)) ? (print (twig_escape_filter($this->env, ($context["form_button_classes"] ?? null), "html", null, true))) : (print ("button primary")));
                echo "\" type=\"submit\"  name=\"task\" value=\"login.login\"><i class=\"fa fa-sign-in\"></i> ";
                echo twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->translate($this->env, "PLUGIN_LOGIN.BTN_LOGIN"), "html", null, true);
                echo "</button>
                </div>

                ";
                // line 67
                echo $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->nonceFieldFunc("login-form", "login-form-nonce");
                echo "
            </form>

        ";
            }
            // line 71
            echo "
    ";
        }
        // line 73
        echo "
</section>
";
    }

    // line 42
    public function block_field($context, array $blocks = [])
    {
        // line 43
        echo "                        ";
        $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = null;
        try {
            $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 =             $this->loadTemplate(($context["field_templates"] ?? null), "partials/login-form.html.twig", 43);
        } catch (LoaderError $e) {
            // ignore missing template
        }
        if ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) {
            $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4->display($context);
        }
        // line 44
        echo "                      ";
    }

    public function getTemplateName()
    {
        return "partials/login-form.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  311 => 44,  300 => 43,  297 => 42,  291 => 73,  287 => 71,  280 => 67,  272 => 64,  269 => 63,  259 => 61,  256 => 60,  253 => 59,  251 => 58,  248 => 57,  239 => 53,  234 => 50,  232 => 49,  228 => 48,  225 => 47,  211 => 46,  208 => 45,  205 => 42,  202 => 41,  200 => 40,  197 => 39,  194 => 38,  191 => 37,  174 => 36,  171 => 35,  168 => 34,  154 => 33,  151 => 32,  133 => 31,  130 => 30,  123 => 27,  120 => 26,  106 => 25,  103 => 24,  85 => 23,  79 => 20,  75 => 18,  72 => 17,  70 => 16,  63 => 14,  55 => 12,  52 => 11,  49 => 10,  47 => 9,  42 => 6,  40 => 5,  38 => 4,  35 => 3,  33 => 2,  31 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% set layout = layout ?? form.layout ?? 'default' %}
{% set field_layout = layout %}

{% set client_side_validation = form.client_side_validation is not null ? form.client_side_validation : config.plugins.form.client_side_validation|default(true) %}
{% set inline_errors = form.inline_errors is not null ? form.inline_errors : config.plugins.form.inline_errors(false) %}

<section id=\"grav-login\">

    {% if page.template == 'login' or show_login_form %}
        {% set user = grav.user %}
        {% if user.authenticated and user.authorized %}
            <h4>{{ 'PLUGIN_LOGIN.WELCOME'|t }} <strong>{{ user.fullname ?: user.username }}</strong></h4>
            <hr>
            <a class=\"button logout\" href=\"{{ uri.addNonce(base_url_relative ~ uri.path ~ '/task' ~ config.system.param_sep ~ 'login.logout', 'logout-form', 'logout-nonce')|e }}\">{{ 'PLUGIN_LOGIN.BTN_LOGOUT'|t }}</a>

        {% elseif user.authenticated and user.twofa_enabled %}
            {% include 'partials/login-twofa.html.twig' %}

        {% else %}
            {{ content|raw }}

            {# NEW WAY OF INCLUDING 3RD PARTY LOGIN OPTIONS #}
            {% for template in grav.login.getProviderLoginTemplates %}
                {% include template %}
            {% endfor %}

            <form method=\"post\" action=\"{{ (base_url_relative ~ uri.path)|e }}\" class=\"{{ form_outer_classes }} login-form\">

                {# OLD WAY OF INCLUDING 3RD PARTY LOGIN OPTIONS #}
                {% if grav.twig.plugins_hooked_loginPage %}
                    {% for label in grav.twig.plugins_hooked_loginPage %}
                        {% include label %}
                    {% endfor %}
                {% endif %}

                {% for field in form.fields %}
                    {% set field = prepare_form_field(field, field_name) %}
                    {% if field %}
                      {% set value = field.name == 'username' ? username : '' %}
                      {# {% set value = form.value(field.name) %} #}
                      {% set field_templates = include_form_field(field.type, field_layout) %}
                      {% block field %}
                        {% include field_templates ignore missing %}
                      {% endblock %}
                    {% endif %}
                {% endfor %}

                <div class=\"{{ form_button_outer_classes ?: 'form-actions secondary-accent' }}\">
                    {% if config.plugins.login.rememberme.enabled and form.login.rememberme ?? true %}
                        <div class=\"form-data rememberme\" data-grav-default=\"null\" data-grav-disabled=\"true\" data-grav-field=\"checkbox\">
                            <div class=\"form-input-wrapper\">
                                <input type=\"checkbox\" value=\"1\" name=\"rememberme\" id=\"#rememberme\">
                                <label class=\"inline\" for=\"#rememberme\" title=\"{{ 'PLUGIN_LOGIN.REMEMBER_ME_HELP'|t }}\">{{ 'PLUGIN_LOGIN.REMEMBER_ME'|t }}</label>
                            </div>
                        </div>
                    {% endif %}

                    {% set forgot_button = form.login.forgot_button ?? true %}
                    {% set forgot_route = grav.login.getRoute('forgot') %}
                    {% if forgot_button and forgot_route %}
                    <a class=\"{{ form_button_classes ?: 'button secondary' }}\" href=\"{{ base_url_relative ~ forgot_route }}\"><i class=\"fa fa-exclamation-circle\"></i> {{ 'PLUGIN_LOGIN.BTN_FORGOT'|t }}</a>
                    {% endif %}

                    <button class=\"{{ form_button_classes ?: 'button primary' }}\" type=\"submit\"  name=\"task\" value=\"login.login\"><i class=\"fa fa-sign-in\"></i> {{ 'PLUGIN_LOGIN.BTN_LOGIN'|t }}</button>
                </div>

                {{ nonce_field('login-form', 'login-form-nonce')|raw }}
            </form>

        {% endif %}

    {% endif %}

</section>
", "partials/login-form.html.twig", "/var/www/qhjack/user/plugins/login/templates/partials/login-form.html.twig");
    }
}
