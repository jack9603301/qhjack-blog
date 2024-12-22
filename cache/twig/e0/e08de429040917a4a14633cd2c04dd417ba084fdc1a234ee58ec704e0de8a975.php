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

/* partials/base.html.twig */
class __TwigTemplate_f69a0a5a1a42f891d0cf5b1ad48143319c4e3d0ee6c241a9da94e2ae29fe90c5 extends \Twig\Template
{
    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $_trait_0 = $this->loadTemplate("blocks/base.html.twig", "partials/base.html.twig", 4);
        // line 4
        if (!$_trait_0->isTraitable()) {
            throw new RuntimeError('Template "'."blocks/base.html.twig".'" cannot be used as a trait.', 4, $this->getSourceContext());
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            [
                'head' => [$this, 'block_head'],
                'stylesheets' => [$this, 'block_stylesheets'],
                'javascripts' => [$this, 'block_javascripts'],
                'assets' => [$this, 'block_assets'],
                'body_classes' => [$this, 'block_body_classes'],
                'header' => [$this, 'block_header'],
                'header_navigation' => [$this, 'block_header_navigation'],
                'hero' => [$this, 'block_hero'],
                'body' => [$this, 'block_body'],
                'messages' => [$this, 'block_messages'],
                'footer' => [$this, 'block_footer'],
                'mobile' => [$this, 'block_mobile'],
                'bottom' => [$this, 'block_bottom'],
            ]
        );
        $this->deferred = $this->env->getExtension('Twig\DeferredExtension\DeferredExtension');
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        // line 1
        $context["body_classes"] = $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->bodyClassFunc($context, [0 => "header-fixed", 1 => "header-animated", 2 => "header-dark", 3 => "header-transparent", 4 => "sticky-footer"]);
        // line 2
        $context["grid_size"] = $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->themeVarFunc($context, "grid-size");
        // line 3
        $context["compress"] = (($this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->themeVarFunc($context, "production-mode")) ? (".min.css") : (".css"));
        // line 5
        echo "<!DOCTYPE html>
<html lang=\"";
        // line 6
        echo twig_escape_filter($this->env, (($this->getAttribute($this->getAttribute(($context["grav"] ?? null), "language", []), "getActive", [])) ? ($this->getAttribute($this->getAttribute(($context["grav"] ?? null), "language", []), "getActive", [])) : ($this->getAttribute($this->getAttribute($this->getAttribute(($context["grav"] ?? null), "config", []), "site", []), "default_lang", []))), "html", null, true);
        echo "\">
<head>
";
        // line 8
        $this->displayBlock('head', $context, $blocks);
        // line 21
        echo "
";
        // line 22
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 30
        echo "
";
        // line 31
        $this->displayBlock('javascripts', $context, $blocks);
        // line 36
        echo "
";
        // line 37
        $this->displayBlock('assets', $context, $blocks);
        // line 41
        echo "</head>
<body id=\"top\" class=\"";
        // line 42
        $this->displayBlock('body_classes', $context, $blocks);
        echo "\">
    <div id=\"page-wrapper\">
    ";
        // line 44
        $this->displayBlock('header', $context, $blocks);
        // line 75
        echo "
    ";
        // line 76
        $this->displayBlock('hero', $context, $blocks);
        // line 77
        echo "
        <section id=\"start\">
        ";
        // line 79
        $this->displayBlock('body', $context, $blocks);
        // line 89
        echo "        </section>

    </div>

    ";
        // line 93
        $this->displayBlock('footer', $context, $blocks);
        // line 96
        echo "
    ";
        // line 97
        $this->displayBlock('mobile', $context, $blocks);
        // line 109
        echo "
";
        // line 110
        $this->displayBlock('bottom', $context, $blocks);
        // line 113
        echo "
</body>
</html>
";
        $this->deferred->resolve($this, $context, $blocks);
    }

    public function block_head($context, array $blocks = [])
    {
        $this->deferred->defer($this, 'head');
    }

    // line 8
    public function block_head_deferred($context, array $blocks = [])
    {
        // line 9
        echo "    <meta charset=\"utf-8\" />
    <title>";
        // line 10
        if ($this->getAttribute(($context["page"] ?? null), "title", [])) {
            echo twig_escape_filter($this->env, $this->getAttribute(($context["page"] ?? null), "title", []), "html");
            echo " | ";
        }
        echo twig_escape_filter($this->env, $this->getAttribute(($context["site"] ?? null), "title", []), "html");
        echo "</title>

    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    ";
        // line 14
        $this->loadTemplate("partials/metadata.html.twig", "partials/base.html.twig", 14)->display($context);
        // line 15
        echo "
    <script src='//unpkg.com/@waline/client@v2/dist/waline.js'></script>
    <link rel=\"stylesheet\" href=\"https://unpkg.com/@waline/client@v2/dist/waline.css\" />
    <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->urlFunc("theme://images/favicon.png"), "html", null, true);
        echo "\" />
    <link rel=\"canonical\" href=\"";
        // line 19
        echo twig_escape_filter($this->env, $this->getAttribute(($context["page"] ?? null), "url", [0 => true, 1 => true], "method"), "html", null, true);
        echo "\" />
";
        $this->deferred->resolve($this, $context, $blocks);
    }

    // line 22
    public function block_stylesheets($context, array $blocks = [])
    {
        // line 23
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => ("theme://css-compiled/spectre" . ($context["compress"] ?? null))], "method");
        // line 24
        echo "    ";
        if ($this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->themeVarFunc($context, "spectre.exp")) {
            $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => ("theme://css-compiled/spectre-exp" . ($context["compress"] ?? null))], "method");
        }
        // line 25
        echo "    ";
        if ($this->env->getExtension('Grav\Common\Twig\Extension\GravExtension')->themeVarFunc($context, "spectre.icons")) {
            $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => ("theme://css-compiled/spectre-icons" . ($context["compress"] ?? null))], "method");
        }
        // line 26
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => ("theme://css-compiled/theme" . ($context["compress"] ?? null))], "method");
        // line 27
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => "theme://css/custom.css"], "method");
        // line 28
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addCss", [0 => "theme://css/line-awesome.min.css"], "method");
    }

    // line 31
    public function block_javascripts($context, array $blocks = [])
    {
        // line 32
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addJs", [0 => "jquery", 1 => 101], "method");
        // line 33
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addJs", [0 => "theme://js/jquery.treemenu.js", 1 => ["group" => "bottom"]], "method");
        // line 34
        echo "    ";
        $this->getAttribute(($context["assets"] ?? null), "addJs", [0 => "theme://js/site.js", 1 => ["group" => "bottom"]], "method");
    }

    public function block_assets($context, array $blocks = [])
    {
        $this->deferred->defer($this, 'assets');
    }

    // line 37
    public function block_assets_deferred($context, array $blocks = [])
    {
        // line 38
        echo "    ";
        echo $this->getAttribute(($context["assets"] ?? null), "css", [], "method");
        echo "
    ";
        // line 39
        echo $this->getAttribute(($context["assets"] ?? null), "js", [], "method");
        echo "
";
        $this->deferred->resolve($this, $context, $blocks);
    }

    // line 42
    public function block_body_classes($context, array $blocks = [])
    {
        echo twig_escape_filter($this->env, ($context["body_classes"] ?? null), "html", null, true);
    }

    // line 44
    public function block_header($context, array $blocks = [])
    {
        // line 45
        echo "        <section id=\"header\" class=\"section\">
            <section class=\"container ";
        // line 46
        echo twig_escape_filter($this->env, ($context["grid_size"] ?? null), "html", null, true);
        echo "\">
                <nav class=\"navbar\">
                    <section class=\"navbar-section logo\">
                        ";
        // line 49
        $this->loadTemplate("partials/logo.html.twig", "partials/base.html.twig", 49)->display($context);
        // line 50
        echo "                    </section>
                    <section class=\"navbar-section desktop-menu\">

                        <nav class=\"dropmenu animated\">
                        ";
        // line 54
        $this->displayBlock('header_navigation', $context, $blocks);
        // line 57
        echo "                        </nav>

                        ";
        // line 59
        if (($this->getAttribute($this->getAttribute($this->getAttribute(($context["config"] ?? null), "plugins", []), "login", []), "enabled", []) && $this->getAttribute($this->getAttribute(($context["grav"] ?? null), "user", []), "username", []))) {
            // line 60
            echo "                            <span class=\"login-status-wrapper\"><i class=\"fa fa-user\"></i> ";
            $this->loadTemplate("partials/login-status.html.twig", "partials/base.html.twig", 60)->display($context);
            echo "</span>
                        ";
        }
        // line 62
        echo "
                    </section>
                </nav>
            </section>
        </section>
        <div class=\"mobile-menu\">
            <div class=\"button_container\" id=\"toggle\">
                <span class=\"top\"></span>
                <span class=\"middle\"></span>
                <span class=\"bottom\"></span>
            </div>
        </div>
    ";
    }

    // line 54
    public function block_header_navigation($context, array $blocks = [])
    {
        // line 55
        echo "                            ";
        $this->loadTemplate("partials/navigation.html.twig", "partials/base.html.twig", 55)->display($context);
        // line 56
        echo "                        ";
    }

    // line 76
    public function block_hero($context, array $blocks = [])
    {
    }

    // line 79
    public function block_body($context, array $blocks = [])
    {
        // line 80
        echo "            <section id=\"body-wrapper\" class=\"section\">
                <section class=\"container ";
        // line 81
        echo twig_escape_filter($this->env, ($context["grid_size"] ?? null), "html", null, true);
        echo "\">
                    ";
        // line 82
        $this->displayBlock('messages', $context, $blocks);
        // line 85
        echo "                    ";
        $this->displayBlock("content_surround", $context, $blocks);
        echo "
                </section>
            </section>
        ";
    }

    // line 82
    public function block_messages($context, array $blocks = [])
    {
        // line 83
        echo "                        ";
        $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 = null;
        try {
            $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4 =             $this->loadTemplate("partials/messages.html.twig", "partials/base.html.twig", 83);
        } catch (LoaderError $e) {
            // ignore missing template
        }
        if ($__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4) {
            $__internal_f607aeef2c31a95a7bf963452dff024ffaeb6aafbe4603f9ca3bec57be8633f4->display($context);
        }
        // line 84
        echo "                    ";
    }

    // line 93
    public function block_footer($context, array $blocks = [])
    {
        // line 94
        echo "        ";
        $this->loadTemplate("partials/footer.html.twig", "partials/base.html.twig", 94)->display($context);
        // line 95
        echo "    ";
    }

    // line 97
    public function block_mobile($context, array $blocks = [])
    {
        // line 98
        echo "    <div class=\"mobile-container\">
        <div class=\"overlay\" id=\"overlay\">
            <div class=\"mobile-logo\">
                ";
        // line 101
        $this->loadTemplate("partials/logo.html.twig", "partials/base.html.twig", 101)->display(twig_array_merge($context, ["mobile" => true]));
        // line 102
        echo "            </div>
            <nav class=\"overlay-menu\">
                ";
        // line 104
        $this->loadTemplate("partials/navigation.html.twig", "partials/base.html.twig", 104)->display(twig_array_merge($context, ["tree" => true]));
        // line 105
        echo "            </nav>
        </div>
    </div>
    ";
    }

    // line 110
    public function block_bottom($context, array $blocks = [])
    {
        // line 111
        echo "    ";
        echo $this->getAttribute(($context["assets"] ?? null), "js", [0 => "bottom"], "method");
        echo "
";
    }

    public function getTemplateName()
    {
        return "partials/base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  381 => 111,  378 => 110,  371 => 105,  369 => 104,  365 => 102,  363 => 101,  358 => 98,  355 => 97,  351 => 95,  348 => 94,  345 => 93,  341 => 84,  330 => 83,  327 => 82,  318 => 85,  316 => 82,  312 => 81,  309 => 80,  306 => 79,  301 => 76,  297 => 56,  294 => 55,  291 => 54,  275 => 62,  269 => 60,  267 => 59,  263 => 57,  261 => 54,  255 => 50,  253 => 49,  247 => 46,  244 => 45,  241 => 44,  235 => 42,  228 => 39,  223 => 38,  220 => 37,  210 => 34,  207 => 33,  204 => 32,  201 => 31,  196 => 28,  193 => 27,  190 => 26,  185 => 25,  180 => 24,  177 => 23,  174 => 22,  167 => 19,  163 => 18,  158 => 15,  156 => 14,  145 => 10,  142 => 9,  139 => 8,  126 => 113,  124 => 110,  121 => 109,  119 => 97,  116 => 96,  114 => 93,  108 => 89,  106 => 79,  102 => 77,  100 => 76,  97 => 75,  95 => 44,  90 => 42,  87 => 41,  85 => 37,  82 => 36,  80 => 31,  77 => 30,  75 => 22,  72 => 21,  70 => 8,  65 => 6,  62 => 5,  60 => 3,  58 => 2,  56 => 1,  25 => 4,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("{% set body_classes = body_class(['header-fixed', 'header-animated', 'header-dark', 'header-transparent', 'sticky-footer']) %}
{% set grid_size = theme_var('grid-size') %}
{% set compress = theme_var('production-mode') ? '.min.css' : '.css' %}
{% use 'blocks/base.html.twig' %}
<!DOCTYPE html>
<html lang=\"{{ grav.language.getActive ?: grav.config.site.default_lang }}\">
<head>
{% block head deferred %}
    <meta charset=\"utf-8\" />
    <title>{% if page.title %}{{ page.title|e('html') }} | {% endif %}{{ site.title|e('html') }}</title>

    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    {% include 'partials/metadata.html.twig' %}

    <script src='//unpkg.com/@waline/client@v2/dist/waline.js'></script>
    <link rel=\"stylesheet\" href=\"https://unpkg.com/@waline/client@v2/dist/waline.css\" />
    <link rel=\"icon\" type=\"image/png\" href=\"{{ url('theme://images/favicon.png') }}\" />
    <link rel=\"canonical\" href=\"{{ page.url(true, true) }}\" />
{% endblock head %}

{% block stylesheets %}
    {% do assets.addCss('theme://css-compiled/spectre'~compress) %}
    {% if theme_var('spectre.exp') %}{% do assets.addCss('theme://css-compiled/spectre-exp'~compress)  %}{% endif %}
    {% if theme_var('spectre.icons') %}{%  do assets.addCss('theme://css-compiled/spectre-icons'~compress) %}{% endif %}
    {% do assets.addCss('theme://css-compiled/theme'~compress) %}
    {% do assets.addCss('theme://css/custom.css') %}
    {% do assets.addCss('theme://css/line-awesome.min.css') %}
{% endblock %}

{% block javascripts %}
    {% do assets.addJs('jquery', 101) %}
    {% do assets.addJs('theme://js/jquery.treemenu.js', {group:'bottom'}) %}
    {% do assets.addJs('theme://js/site.js', {group:'bottom'}) %}
{% endblock %}

{% block assets deferred %}
    {{ assets.css()|raw }}
    {{ assets.js()|raw }}
{% endblock %}
</head>
<body id=\"top\" class=\"{% block body_classes %}{{ body_classes }}{% endblock %}\">
    <div id=\"page-wrapper\">
    {% block header %}
        <section id=\"header\" class=\"section\">
            <section class=\"container {{ grid_size }}\">
                <nav class=\"navbar\">
                    <section class=\"navbar-section logo\">
                        {% include 'partials/logo.html.twig' %}
                    </section>
                    <section class=\"navbar-section desktop-menu\">

                        <nav class=\"dropmenu animated\">
                        {% block header_navigation %}
                            {% include 'partials/navigation.html.twig' %}
                        {% endblock %}
                        </nav>

                        {% if config.plugins.login.enabled and grav.user.username %}
                            <span class=\"login-status-wrapper\"><i class=\"fa fa-user\"></i> {% include 'partials/login-status.html.twig' %}</span>
                        {% endif %}

                    </section>
                </nav>
            </section>
        </section>
        <div class=\"mobile-menu\">
            <div class=\"button_container\" id=\"toggle\">
                <span class=\"top\"></span>
                <span class=\"middle\"></span>
                <span class=\"bottom\"></span>
            </div>
        </div>
    {% endblock %}

    {% block hero %}{% endblock %}

        <section id=\"start\">
        {% block body %}
            <section id=\"body-wrapper\" class=\"section\">
                <section class=\"container {{ grid_size }}\">
                    {% block messages %}
                        {% include 'partials/messages.html.twig' ignore missing %}
                    {% endblock %}
                    {{ block('content_surround') }}
                </section>
            </section>
        {% endblock %}
        </section>

    </div>

    {% block footer %}
        {% include 'partials/footer.html.twig' %}
    {% endblock %}

    {% block mobile %}
    <div class=\"mobile-container\">
        <div class=\"overlay\" id=\"overlay\">
            <div class=\"mobile-logo\">
                {% include 'partials/logo.html.twig' with {mobile: true} %}
            </div>
            <nav class=\"overlay-menu\">
                {% include 'partials/navigation.html.twig' with {tree: true} %}
            </nav>
        </div>
    </div>
    {% endblock %}

{% block bottom %}
    {{ assets.js('bottom')|raw }}
{% endblock %}

</body>
</html>
", "partials/base.html.twig", "/var/www/qhjack/user/themes/quark-child/templates/partials/base.html.twig");
    }
    private $deferred;
}
