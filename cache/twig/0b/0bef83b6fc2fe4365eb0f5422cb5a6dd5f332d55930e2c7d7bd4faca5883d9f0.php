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

/* partials/post-copyright.twig */
class __TwigTemplate_46aebd1b56ec192049ad9723d2f2b267c216248ed4783b239da15a70ca7dd8fd extends \Twig\Template
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
        echo "<div class=\"post-copyright\">
\t<ul>
\t\t<li class=\"post-copyright-author\">
\t\t\t";
        // line 4
        if ($this->getAttribute($this->getAttribute(($context["page"] ?? null), "taxonomy", []), "author", [])) {
            // line 5
            echo "\t\t\t<strong>原作者:</strong>
\t\t\t";
            // line 6
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(($context["page"] ?? null), "taxonomy", []), "author", []), 0, [], "array"), "html", null, true);
            echo "
\t\t\t";
        } else {
            // line 8
            echo "\t\t\t<strong>原作者:</strong>
\t\t\tChunhui Ouyang
\t\t\t";
        }
        // line 11
        echo "\t\t</li>
\t\t<li class=\"post-copyright-link\">
\t\t\t";
        // line 13
        if ($this->getAttribute($this->getAttribute(($context["page"] ?? null), "header", []), "copyright_origin_url", [])) {
            // line 14
            echo "\t\t\t<strong>原文链接：</strong>
\t\t\t<a href=\"";
            // line 15
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute(($context["page"] ?? null), "header", []), "copyright_origin_url", []), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["page"] ?? null), "title", []), "html", null, true);
            echo "</a>
\t\t\t";
        } else {
            // line 17
            echo "\t\t\t<strong>原文链接：</strong>
\t\t\t<a href=\"";
            // line 18
            echo twig_escape_filter($this->env, $this->getAttribute(($context["page"] ?? null), "url", [0 => true], "method"));
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute(($context["page"] ?? null), "title", []), "html", null, true);
            echo "</a>
\t\t\t";
        }
        // line 20
        echo "\t\t</li>
\t\t<li class=\"post-copyright-license\">
\t\t\t";
        // line 22
        if ($this->getAttribute($this->getAttribute(($context["page"] ?? null), "header", []), "copyright_reprint", [])) {
            // line 23
            echo "\t\t\t<strong>版权声明:</strong>
            本文章为转载文章，已获转载许可。转载请注明出处！
\t\t\t";
        } else {
            // line 26
            echo "\t\t\t<strong>版权声明:</strong>
\t\t\t本博客所有文章除特别声明外，均采用 <a href=\"https://creativecommons.org/licenses/by-nc-sa/4.0/zh\" rel=\"noopener\" target=\"_blank\"><i class=\"fab fa-fw fa-creative-commons\"></i>BY-NC-SA</a> 许可协议。转载
    请注明出处！
            ";
        }
        // line 30
        echo "\t\t</li>
\t</ul>
</div>
";
    }

    public function getTemplateName()
    {
        return "partials/post-copyright.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 30,  87 => 26,  82 => 23,  80 => 22,  76 => 20,  69 => 18,  66 => 17,  59 => 15,  56 => 14,  54 => 13,  50 => 11,  45 => 8,  40 => 6,  37 => 5,  35 => 4,  30 => 1,);
    }

    /** @deprecated since 1.27 (to be removed in 2.0). Use getSourceContext() instead */
    public function getSource()
    {
        @trigger_error('The '.__METHOD__.' method is deprecated since version 1.27 and will be removed in 2.0. Use getSourceContext() instead.', E_USER_DEPRECATED);

        return $this->getSourceContext()->getCode();
    }

    public function getSourceContext()
    {
        return new Source("<div class=\"post-copyright\">
\t<ul>
\t\t<li class=\"post-copyright-author\">
\t\t\t{% if page.taxonomy.author %}
\t\t\t<strong>原作者:</strong>
\t\t\t{{ page.taxonomy.author[0] }}
\t\t\t{% else %}
\t\t\t<strong>原作者:</strong>
\t\t\tChunhui Ouyang
\t\t\t{% endif %}
\t\t</li>
\t\t<li class=\"post-copyright-link\">
\t\t\t{% if page.header.copyright_origin_url %}
\t\t\t<strong>原文链接：</strong>
\t\t\t<a href=\"{{ page.header.copyright_origin_url }}\">{{ page.title }}</a>
\t\t\t{% else %}
\t\t\t<strong>原文链接：</strong>
\t\t\t<a href=\"{{ page.url(true)|e }}\">{{ page.title }}</a>
\t\t\t{% endif %}
\t\t</li>
\t\t<li class=\"post-copyright-license\">
\t\t\t{% if page.header.copyright_reprint %}
\t\t\t<strong>版权声明:</strong>
            本文章为转载文章，已获转载许可。转载请注明出处！
\t\t\t{% else %}
\t\t\t<strong>版权声明:</strong>
\t\t\t本博客所有文章除特别声明外，均采用 <a href=\"https://creativecommons.org/licenses/by-nc-sa/4.0/zh\" rel=\"noopener\" target=\"_blank\"><i class=\"fab fa-fw fa-creative-commons\"></i>BY-NC-SA</a> 许可协议。转载
    请注明出处！
            {% endif %}
\t\t</li>
\t</ul>
</div>
", "partials/post-copyright.twig", "/var/www/qhjack/user/themes/quark-child/templates/partials/post-copyright.twig");
    }
}
