<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* carrito.html.twig */
class __TwigTemplate_88b0b423b9b2b9305481beddec542e14 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'title' => [$this, 'block_title'],
            'body' => [$this, 'block_body'],
        ];
    }

    protected function doGetParent(array $context): bool|string|Template|TemplateWrapper
    {
        // line 1
        return "base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "carrito.html.twig"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "template", "carrito.html.twig"));

        $this->parent = $this->loadTemplate("base.html.twig", "carrito.html.twig", 1);
        yield from $this->parent->unwrap()->yield($context, array_merge($this->blocks, $blocks));
        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

    }

    // line 3
    public function block_title($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "title"));

        yield "Carrito";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        return; yield '';
    }

    // line 5
    public function block_body($context, array $blocks = [])
    {
        $macros = $this->macros;
        $__internal_5a27a8ba21ca79b61932376b2fa922d2 = $this->extensions["Symfony\\Bundle\\WebProfilerBundle\\Twig\\WebProfilerExtension"];
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->enter($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        $__internal_6f47bbe9983af81f1e7450e9a3e3768f = $this->extensions["Symfony\\Bridge\\Twig\\Extension\\ProfilerExtension"];
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->enter($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof = new \Twig\Profiler\Profile($this->getTemplateName(), "block", "body"));

        // line 6
        yield "
    ";
        // line 7
        yield Twig\Extension\CoreExtension::include($this->env, $context, "comun/header.html.twig");
        yield "
    <section class=\"h-100 mt-5\">
        <div class=\"container py-5 mt-5\">
            <div class=\"row d-flex justify-content-center my-4\">
                <div class=\"col-md-8 border-0\">
                    <div class=\"card mb-4 border-0\">
                        <div class=\"table-responsive\">
                            <table class=\"table\">
                                <thead>
                                    <tr>
                                        <th scope=\"col\" class=\"h5\">Carrito Compra</th>
                                        <th scope=\"col\">ID</th>
                                        <th scope=\"col\">Unidades</th>
                                        <th scope=\"col\">Precio</th>
                                        <th scope=\"col\">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ";
        // line 25
        $context["total"] = 0;
        // line 26
        yield "                                    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 26, $this->source); })()), "session", [], "any", false, false, false, 26), "get", ["carrito"], "method", false, false, false, 26));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["producto"]) {
            // line 27
            yield "
                                    <tr id=\"\">
                                        <th scope=\"row\">
                                            <div class=\"d-flex align-items-center\">
                                                <img src=\"";
            // line 31
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->env->getRuntime('Vich\UploaderBundle\Twig\Extension\UploaderExtensionRuntime')->asset(CoreExtension::getAttribute($this->env, $this->source, $context["producto"], "producto", [], "array", false, false, false, 31), "imageFile"), "html", null, true);
            yield "\"
                                                    alt=\"";
            // line 32
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["producto"], "producto", [], "array", false, false, false, 32), "imageName", [], "any", false, false, false, 32), "html", null, true);
            yield "\" width=\"80px\"
                                                    class=\"img-fluid rounded-3\">
                                                <div class=\"flex-column ms-4\">
                                                    <p class=\"mb-2\" id=\"nombre_producto\">";
            // line 35
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["producto"], "producto", [], "array", false, false, false, 35), "marca", [], "any", false, false, false, 35), "html", null, true);
            yield "
                                                    </p>
                                                </div>
                                            </div>
                                        </th>
                                        <td class=\"align-middle\">
                                            <p class=\"mb-0\" id=\"id_producto\" style=\"font-weight: 500\">";
            // line 41
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 42
$context["producto"], "producto", [], "array", false, false, false, 42), "id", [], "any", false, false, false, 42), "html", null, true);
            yield "</p>
                                        </td>
                                        <td class=\"align-middle\">
                                            <div class=\"d-flex flex-row\">
                                                <input id=\"form1\" min=\"1\" max=\"20\" name=\"quantity\"
                                                    value=\"";
            // line 47
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, $context["producto"], "cantidad", [], "array", false, false, false, 47), "html", null, true);
            yield "\" type=\"number\" readonly
                                                    class=\"form-control form-control-sm\" style=\"width: 50px\" />
                                            </div>
                                        </td>
                                        <td class=\"align-middle\">
                                            <p class=\"mb-0\" id=\"precio_producto\" style=\"font-weight: 500\">";
            // line 52
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source,             // line 53
$context["producto"], "producto", [], "array", false, false, false, 53), "precio", [], "any", false, false, false, 53), "html", null, true);
            yield "</p>
                                        </td>
                                        <td class=\"align-middle\">
                                            <a class=\"prueba\"
                                                href=\"";
            // line 57
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_carrito_eliminarProducto", ["id" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["producto"], "producto", [], "array", false, false, false, 57), "id", [], "any", false, false, false, 57), "cat" => CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["producto"], "producto", [], "array", false, false, false, 57), "categoria", [], "any", false, false, false, 57)]), "html", null, true);
            yield " \">
                                                <button type=\"button\" class=\"btn btn-primary\">
                                                    Eliminar
                                                </button>
                                            </a>
                                        </td>
                                    </tr>

                                    ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 66
            yield "                                    <tr>
                                        <td colspan=\"9\" class=\"text-center py-4 fst-italic\">No hay productos en el
                                            carrito</td>
                                    </tr>
                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['producto'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 71
        yield "                                    ";
        $context["total"] = 0;
        // line 72
        yield "                                    ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, (isset($context["app"]) || array_key_exists("app", $context) ? $context["app"] : (function () { throw new RuntimeError('Variable "app" does not exist.', 72, $this->source); })()), "session", [], "any", false, false, false, 72), "get", ["carrito"], "method", false, false, false, 72));
        foreach ($context['_seq'] as $context["_key"] => $context["producto"]) {
            // line 73
            yield "                                    ";
            $context["total"] = ((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 73, $this->source); })()) + CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, $context["producto"], "producto", [], "array", false, false, false, 73), "precio", [], "any", false, false, false, 73));
            // line 74
            yield "                                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['producto'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        yield "
                                    <tr>
                                        <td colspan=\"3\">
                                            <p class=\"h3\" id=\"total\">Total</p>
                                        </td>
                                        <td>
                                            ";
        // line 81
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape($this->extensions['Twig\Extension\CoreExtension']->formatNumber((isset($context["total"]) || array_key_exists("total", $context) ? $context["total"] : (function () { throw new RuntimeError('Variable "total" does not exist.', 81, $this->source); })()), 2, ".", ","), "html", null, true);
        yield "
                                        </td>
                                        <td>
                                             <a class=\"prueba\"
                                                href=\"";
        // line 85
        yield $this->extensions['Symfony\Bridge\Twig\Extension\RoutingExtension']->getPath("app_compra");
        yield " \">
                                                <button type=\"button\" class=\"btn btn-primary\">
                                                    Comprar
                                                </button>
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        </div>
        </div>
    </section>
";
        
        $__internal_6f47bbe9983af81f1e7450e9a3e3768f->leave($__internal_6f47bbe9983af81f1e7450e9a3e3768f_prof);

        
        $__internal_5a27a8ba21ca79b61932376b2fa922d2->leave($__internal_5a27a8ba21ca79b61932376b2fa922d2_prof);

        return; yield '';
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "carrito.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  232 => 85,  225 => 81,  217 => 75,  211 => 74,  208 => 73,  203 => 72,  200 => 71,  190 => 66,  176 => 57,  169 => 53,  168 => 52,  160 => 47,  152 => 42,  151 => 41,  142 => 35,  136 => 32,  132 => 31,  126 => 27,  120 => 26,  118 => 25,  97 => 7,  94 => 6,  84 => 5,  64 => 3,  41 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{% extends 'base.html.twig' %}

{% block title %}Carrito{% endblock %}

{% block body %}

    {{include('comun/header.html.twig')}}
    <section class=\"h-100 mt-5\">
        <div class=\"container py-5 mt-5\">
            <div class=\"row d-flex justify-content-center my-4\">
                <div class=\"col-md-8 border-0\">
                    <div class=\"card mb-4 border-0\">
                        <div class=\"table-responsive\">
                            <table class=\"table\">
                                <thead>
                                    <tr>
                                        <th scope=\"col\" class=\"h5\">Carrito Compra</th>
                                        <th scope=\"col\">ID</th>
                                        <th scope=\"col\">Unidades</th>
                                        <th scope=\"col\">Precio</th>
                                        <th scope=\"col\">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {% set total = 0 %}
                                    {% for producto in app.session.get('carrito') %}

                                    <tr id=\"\">
                                        <th scope=\"row\">
                                            <div class=\"d-flex align-items-center\">
                                                <img src=\"{{ vich_uploader_asset(producto['producto'], 'imageFile') }}\"
                                                    alt=\"{{ producto['producto'].imageName }}\" width=\"80px\"
                                                    class=\"img-fluid rounded-3\">
                                                <div class=\"flex-column ms-4\">
                                                    <p class=\"mb-2\" id=\"nombre_producto\">{{producto['producto'].marca}}
                                                    </p>
                                                </div>
                                            </div>
                                        </th>
                                        <td class=\"align-middle\">
                                            <p class=\"mb-0\" id=\"id_producto\" style=\"font-weight: 500\">{{
                                                producto['producto'].id }}</p>
                                        </td>
                                        <td class=\"align-middle\">
                                            <div class=\"d-flex flex-row\">
                                                <input id=\"form1\" min=\"1\" max=\"20\" name=\"quantity\"
                                                    value=\"{{ producto['cantidad'] }}\" type=\"number\" readonly
                                                    class=\"form-control form-control-sm\" style=\"width: 50px\" />
                                            </div>
                                        </td>
                                        <td class=\"align-middle\">
                                            <p class=\"mb-0\" id=\"precio_producto\" style=\"font-weight: 500\">{{
                                                producto['producto'].precio }}</p>
                                        </td>
                                        <td class=\"align-middle\">
                                            <a class=\"prueba\"
                                                href=\"{{ path('app_carrito_eliminarProducto',{'id':producto['producto'].id,'cat':producto['producto'].categoria}) }} \">
                                                <button type=\"button\" class=\"btn btn-primary\">
                                                    Eliminar
                                                </button>
                                            </a>
                                        </td>
                                    </tr>

                                    {% else %}
                                    <tr>
                                        <td colspan=\"9\" class=\"text-center py-4 fst-italic\">No hay productos en el
                                            carrito</td>
                                    </tr>
                                    {% endfor %}
                                    {% set total = 0%}
                                    {% for producto in app.session.get('carrito') %}
                                    {% set total = total+producto['producto'].precio%}
                                    {% endfor %}

                                    <tr>
                                        <td colspan=\"3\">
                                            <p class=\"h3\" id=\"total\">Total</p>
                                        </td>
                                        <td>
                                            {{total|number_format(2, '.', ',') }}
                                        </td>
                                        <td>
                                             <a class=\"prueba\"
                                                href=\"{{ path('app_compra') }} \">
                                                <button type=\"button\" class=\"btn btn-primary\">
                                                    Comprar
                                                </button>
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
        </div>
        </div>
    </section>
{% endblock %}

", "carrito.html.twig", "C:\\Users\\stark\\Desktop\\optica\\kraken\\proyecto\\templates\\carrito.html.twig");
    }
}
