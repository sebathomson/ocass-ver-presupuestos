<?php

/* AppBundle:Default:index.html.twig */
class __TwigTemplate_6a5f7dc13c190a34c9a5a2d0094422e702f0bed9e531c9f95d2d6cb6c1028feb extends Twig_Template
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
        $__internal_0b0fa89fa89bb13491677add7fc3e328b17f454ca31ffdb7fe3c02cb765a259f = $this->env->getExtension("native_profiler");
        $__internal_0b0fa89fa89bb13491677add7fc3e328b17f454ca31ffdb7fe3c02cb765a259f->enter($__internal_0b0fa89fa89bb13491677add7fc3e328b17f454ca31ffdb7fe3c02cb765a259f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Default:index.html.twig"));

        // line 1
        echo "<!DOCTYPE html>
<html lang=\"es\">
<head>
    ";
        // line 4
        echo twig_include($this->env, $context, "AppBundle:Default:_head.html.twig");
        echo "
</head>
<body>
    <div style=\"position: fixed;margin-top: -66px;background-color: #fff;width: 100%;z-index: 100;\">
        <img id=\"img-flecha-dia-actual\" src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/images/flecha.png"), "html", null, true);
        echo "\" width=\"30px\">
        <div id=\"div-linea-dia-actual\" style=\"border-left: solid 1px green;\"></div>
    </div>
    <div class=\"table-responsive\">
        <table class=\"table table-bordered\">
            <thead>
                <tr>
                    <th id=\"th-costado-izquierdo\" class=\"sin-borde-inferior\"></th>
                    <th id=\"th-cursos-no-terminados\">Cursos vigentes aún no terminados</th>
                    ";
        // line 17
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["meses"]) ? $context["meses"] : $this->getContext($context, "meses")));
        foreach ($context['_seq'] as $context["_key"] => $context["mes"]) {
            if (($this->getAttribute($context["mes"], "esPasado", array()) == false)) {
                // line 18
                echo "                        <th id=\"mes-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["mes"], "anio", array()), "html", null, true);
                echo twig_escape_filter($this->env, $this->getAttribute($context["mes"], "mes", array()), "html", null, true);
                echo "\" class=\"th-mes\">";
                echo twig_escape_filter($this->env, twig_upper_filter($this->env, $this->getAttribute($context["mes"], "nombre", array())), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($context["mes"], "anio", array()), "html", null, true);
                echo "</th>
                    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mes'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "                </tr>
            </thead>
            <tbody>
                ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["sucursales"]) ? $context["sucursales"] : $this->getContext($context, "sucursales")));
        $context['loop'] = array(
          'parent' => $context['_parent'],
          'index0' => 0,
          'index'  => 1,
          'first'  => true,
        );
        if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
            $length = count($context['_seq']);
            $context['loop']['revindex0'] = $length - 1;
            $context['loop']['revindex'] = $length;
            $context['loop']['length'] = $length;
            $context['loop']['last'] = 1 === $length;
        }
        foreach ($context['_seq'] as $context["_key"] => $context["sucursal"]) {
            // line 24
            echo "                    ";
            $context["primer_row"] = $this->getAttribute($context["loop"], "first", array());
            // line 25
            echo "                    <tr>
                        <td ";
            // line 26
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo "class=\"td-logo\"";
            }
            echo ">
                            ";
            // line 27
            if ($this->getAttribute($context["loop"], "first", array())) {
                // line 28
                echo "                                <img id=\"img-logo\" src=\"";
                echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/images/logo.png"), "html", null, true);
                echo "\" alt=\"Logo\" width=\"25px\">
                            ";
            }
            // line 30
            echo "                        </td>
                        <td ";
            // line 31
            if ($this->getAttribute($context["loop"], "first", array())) {
                echo "class=\"td-nombre-empresa\"";
            }
            echo ">
                            <strong>EMPRESA:</strong> ";
            // line 32
            echo twig_escape_filter($this->env, $this->getAttribute($context["sucursal"], "nombreEmpresa", array()), "html", null, true);
            echo " / <strong>SEDE</strong>: ";
            echo twig_escape_filter($this->env, $this->getAttribute($context["sucursal"], "nombreSucursal", array()), "html", null, true);
            echo "
                        </td>
                        ";
            // line 34
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["meses"]) ? $context["meses"] : $this->getContext($context, "meses")));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            foreach ($context['_seq'] as $context["_key"] => $context["mes"]) {
                if (($this->getAttribute($context["mes"], "esPasado", array()) == false)) {
                    // line 35
                    echo "                            <td id=\"mes-";
                    echo twig_escape_filter($this->env, $this->getAttribute($context["mes"], "anio", array()), "html", null, true);
                    echo twig_escape_filter($this->env, $this->getAttribute($context["mes"], "mes", array()), "html", null, true);
                    echo "-base\">
                                ";
                    // line 36
                    if ($this->getAttribute($context["loop"], "first", array())) {
                        // line 37
                        echo "                                    <span id=\"span-dia-actual\">";
                        echo twig_escape_filter($this->env, (isset($context["diaActual"]) ? $context["diaActual"] : $this->getContext($context, "diaActual")), "html", null, true);
                        echo "</span>
                                ";
                    }
                    // line 39
                    echo "                            </td>
                        ";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mes'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 41
            echo "                    </tr>
                    <tr>
                        <td class=\"text-center\">
                            <strong>CURSOS</strong><br><strong>CLASE</strong>
                        </td>
                        <td class=\"huincha-verde-arriba\"></td>
                        ";
            // line 47
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["meses"]) ? $context["meses"] : $this->getContext($context, "meses")));
            foreach ($context['_seq'] as $context["_key"] => $context["mes"]) {
                if (($this->getAttribute($context["mes"], "esPasado", array()) == false)) {
                    // line 48
                    echo "                            <td class=\"huincha-verde-arriba\"></td>
                        ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mes'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 50
            echo "                    </tr>
                    ";
            // line 51
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable($this->getAttribute($context["sucursal"], "tiposCurso", array()));
            $context['loop'] = array(
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            );
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["key"] => $context["tipos"]) {
                // line 52
                echo "                        ";
                $context["isLast"] = $this->getAttribute($context["loop"], "last", array());
                // line 53
                echo "                        <tr>
                            <td class=\"text-center\">
                                <strong>";
                // line 55
                echo twig_escape_filter($this->env, twig_replace_filter($context["key"], array("_" => " ")), "html", null, true);
                echo "</strong>
                            </td>
                            <td class=\"calle\">
                            ";
                // line 58
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["meses"]) ? $context["meses"] : $this->getContext($context, "meses")));
                foreach ($context['_seq'] as $context["mesanio"] => $context["mes"]) {
                    if (($this->getAttribute($context["mes"], "esPasado", array()) == true)) {
                        // line 59
                        echo "                                ";
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["cursos"]) ? $context["cursos"] : $this->getContext($context, "cursos")));
                        foreach ($context['_seq'] as $context["_key"] => $context["curso"]) {
                            if ((((($this->getAttribute(                            // line 60
$context["curso"], "inicio_mes_anio", array()) == $context["mesanio"]) && ($this->getAttribute(                            // line 61
$context["curso"], "Tipo_Curso", array()) == $context["key"])) && ($this->getAttribute(                            // line 62
$context["curso"], "Cod_sucursal", array()) == $this->getAttribute($context["sucursal"], "idSucursal", array()))) && ($this->getAttribute(                            // line 63
$context["curso"], "Cod_empresa", array()) == $this->getAttribute($context["sucursal"], "idEmpresa", array())))) {
                                // line 64
                                echo "                                    <div class=\"img-vehiculo\" data-code=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_ot", array()), "html", null, true);
                                echo "-";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_sucursal", array()), "html", null, true);
                                echo "-";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_empresa", array()), "html", null, true);
                                echo "\">
                                        <img src=\"";
                                // line 65
                                echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl(("bundles/app/images/" . $this->getAttribute($context["curso"], "imagen_curso", array()))), "html", null, true);
                                echo "\" alt=\"Curso ";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_ot", array()), "html", null, true);
                                echo "\" style=\"background-color: #";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "color_vehiculo", array()), "html", null, true);
                                echo "\" class=\"data-curso ";
                                echo "\">
                                        <span class=\"numeroCurso-";
                                // line 66
                                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                                echo "\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_ot", array()), "html", null, true);
                                echo "</span>
                                    </div>
                                ";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['curso'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 69
                        echo "                            ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['mesanio'], $context['mes'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 70
                echo "                            </td>
                            ";
                // line 71
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["meses"]) ? $context["meses"] : $this->getContext($context, "meses")));
                foreach ($context['_seq'] as $context["mesanio"] => $context["mes"]) {
                    if (($this->getAttribute($context["mes"], "esPasado", array()) == false)) {
                        // line 72
                        echo "                                <td class=\"calle calle-meses ultimo-mes\">
                                    ";
                        // line 73
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable((isset($context["cursos"]) ? $context["cursos"] : $this->getContext($context, "cursos")));
                        foreach ($context['_seq'] as $context["_key"] => $context["curso"]) {
                            if ((((($this->getAttribute(                            // line 74
$context["curso"], "inicio_mes_anio", array()) == $context["mesanio"]) && ($this->getAttribute(                            // line 75
$context["curso"], "Tipo_Curso", array()) == $context["key"])) && ($this->getAttribute(                            // line 76
$context["curso"], "Cod_sucursal", array()) == $this->getAttribute($context["sucursal"], "idSucursal", array()))) && ($this->getAttribute(                            // line 77
$context["curso"], "Cod_empresa", array()) == $this->getAttribute($context["sucursal"], "idEmpresa", array())))) {
                                // line 78
                                echo "                                    <div class=\"img-vehiculo\" data-code=\"";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_ot", array()), "html", null, true);
                                echo "-";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_sucursal", array()), "html", null, true);
                                echo "-";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_empresa", array()), "html", null, true);
                                echo "\" data-numerodia=\"";
                                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["curso"], "o_Fecha_Inicio", array()), "d"), "html", null, true);
                                echo "\" data-cantidaddiasmes=\"";
                                echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["curso"], "o_Fecha_Inicio", array()), "t"), "html", null, true);
                                echo "\">
                                        <img src=\"";
                                // line 79
                                echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl(("bundles/app/images/" . $this->getAttribute($context["curso"], "imagen_curso", array()))), "html", null, true);
                                echo "\" alt=\"Curso ";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_ot", array()), "html", null, true);
                                echo "\" style=\"background-color: #";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "color_vehiculo", array()), "html", null, true);
                                echo "\" class=\"data-curso ";
                                echo "\">
                                        <span class=\"numeroCurso-";
                                // line 80
                                echo twig_escape_filter($this->env, $context["key"], "html", null, true);
                                echo "\">";
                                echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_ot", array()), "html", null, true);
                                echo "</span>
                                    </div>
                                ";
                            }
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['curso'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 83
                        echo "                                </td>
                            ";
                    }
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['mesanio'], $context['mes'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 85
                echo "                        </tr>
                    ";
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
            unset($context['_seq'], $context['_iterated'], $context['key'], $context['tipos'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 87
            echo "                    <tr>
                        <td class=\"sin-borde-inferior\"></td>
                        <td class=\"huincha-verde-abajo\"></td>
                        ";
            // line 90
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["meses"]) ? $context["meses"] : $this->getContext($context, "meses")));
            foreach ($context['_seq'] as $context["_key"] => $context["mes"]) {
                if (($this->getAttribute($context["mes"], "esPasado", array()) == false)) {
                    // line 91
                    echo "                            <td class=\"huincha-verde-abajo\"></td>
                        ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mes'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 93
            echo "                    </tr>
                ";
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
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['sucursal'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 95
        echo "            </tbody>
        </table>
    </div>
    <script>
        ";
        // line 99
        echo twig_include($this->env, $context, "AppBundle:Default:_script.html.twig");
        echo "
    </script>
</body>
</html>
";
        
        $__internal_0b0fa89fa89bb13491677add7fc3e328b17f454ca31ffdb7fe3c02cb765a259f->leave($__internal_0b0fa89fa89bb13491677add7fc3e328b17f454ca31ffdb7fe3c02cb765a259f_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Default:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  382 => 99,  376 => 95,  361 => 93,  353 => 91,  348 => 90,  343 => 87,  328 => 85,  320 => 83,  308 => 80,  299 => 79,  286 => 78,  284 => 77,  283 => 76,  282 => 75,  281 => 74,  277 => 73,  274 => 72,  269 => 71,  266 => 70,  259 => 69,  247 => 66,  238 => 65,  229 => 64,  227 => 63,  226 => 62,  225 => 61,  224 => 60,  219 => 59,  214 => 58,  208 => 55,  204 => 53,  201 => 52,  184 => 51,  181 => 50,  173 => 48,  168 => 47,  160 => 41,  149 => 39,  143 => 37,  141 => 36,  135 => 35,  124 => 34,  117 => 32,  111 => 31,  108 => 30,  102 => 28,  100 => 27,  94 => 26,  91 => 25,  88 => 24,  71 => 23,  66 => 20,  51 => 18,  46 => 17,  34 => 8,  27 => 4,  22 => 1,);
    }
}
/* <!DOCTYPE html>*/
/* <html lang="es">*/
/* <head>*/
/*     {{ include('AppBundle:Default:_head.html.twig') }}*/
/* </head>*/
/* <body>*/
/*     <div style="position: fixed;margin-top: -66px;background-color: #fff;width: 100%;z-index: 100;">*/
/*         <img id="img-flecha-dia-actual" src="{{ asset('bundles/app/images/flecha.png') }}" width="30px">*/
/*         <div id="div-linea-dia-actual" style="border-left: solid 1px green;"></div>*/
/*     </div>*/
/*     <div class="table-responsive">*/
/*         <table class="table table-bordered">*/
/*             <thead>*/
/*                 <tr>*/
/*                     <th id="th-costado-izquierdo" class="sin-borde-inferior"></th>*/
/*                     <th id="th-cursos-no-terminados">Cursos vigentes aún no terminados</th>*/
/*                     {% for mes in meses if mes.esPasado == false %}*/
/*                         <th id="mes-{{ mes.anio }}{{ mes.mes }}" class="th-mes">{{ mes.nombre | upper }} {{ mes.anio }}</th>*/
/*                     {% endfor %}*/
/*                 </tr>*/
/*             </thead>*/
/*             <tbody>*/
/*                 {% for sucursal in sucursales %}*/
/*                     {% set primer_row = loop.first %}*/
/*                     <tr>*/
/*                         <td {% if loop.first %}class="td-logo"{% endif %}>*/
/*                             {% if loop.first %}*/
/*                                 <img id="img-logo" src="{{ asset('bundles/app/images/logo.png') }}" alt="Logo" width="25px">*/
/*                             {% endif %}*/
/*                         </td>*/
/*                         <td {% if loop.first %}class="td-nombre-empresa"{% endif %}>*/
/*                             <strong>EMPRESA:</strong> {{ sucursal.nombreEmpresa }} / <strong>SEDE</strong>: {{ sucursal.nombreSucursal }}*/
/*                         </td>*/
/*                         {% for mes in meses if mes.esPasado == false %}*/
/*                             <td id="mes-{{ mes.anio }}{{ mes.mes }}-base">*/
/*                                 {% if loop.first %}*/
/*                                     <span id="span-dia-actual">{{ diaActual }}</span>*/
/*                                 {% endif %}*/
/*                             </td>*/
/*                         {% endfor %}*/
/*                     </tr>*/
/*                     <tr>*/
/*                         <td class="text-center">*/
/*                             <strong>CURSOS</strong><br><strong>CLASE</strong>*/
/*                         </td>*/
/*                         <td class="huincha-verde-arriba"></td>*/
/*                         {% for mes in meses if mes.esPasado == false %}*/
/*                             <td class="huincha-verde-arriba"></td>*/
/*                         {% endfor %}*/
/*                     </tr>*/
/*                     {% for key, tipos in sucursal.tiposCurso %}*/
/*                         {% set isLast = loop.last %}*/
/*                         <tr>*/
/*                             <td class="text-center">*/
/*                                 <strong>{{ key | replace({'_': ' '}) }}</strong>*/
/*                             </td>*/
/*                             <td class="calle">*/
/*                             {% for mesanio, mes in meses if mes.esPasado == true %}*/
/*                                 {% for curso in cursos */
/*                                     if curso.inicio_mes_anio == mesanio and */
/*                                     curso.Tipo_Curso == key and */
/*                                     curso.Cod_sucursal == sucursal.idSucursal and */
/*                                     curso.Cod_empresa == sucursal.idEmpresa %}*/
/*                                     <div class="img-vehiculo" data-code="{{ curso.Cod_ot }}-{{ curso.Cod_sucursal }}-{{ curso.Cod_empresa }}">*/
/*                                         <img src="{{ asset('bundles/app/images/' ~ curso.imagen_curso) }}" alt="Curso {{ curso.Cod_ot }}" style="background-color: #{{ curso.color_vehiculo }}" class="data-curso {# img-vehiculo-{{ key }} #}">*/
/*                                         <span class="numeroCurso-{{ key }}">{{ curso.Cod_ot }}</span>*/
/*                                     </div>*/
/*                                 {% endfor %}*/
/*                             {% endfor %}*/
/*                             </td>*/
/*                             {% for mesanio, mes in meses if mes.esPasado == false %}*/
/*                                 <td class="calle calle-meses ultimo-mes">*/
/*                                     {% for curso in cursos */
/*                                     if curso.inicio_mes_anio == mesanio and */
/*                                     curso.Tipo_Curso == key and */
/*                                     curso.Cod_sucursal == sucursal.idSucursal and */
/*                                     curso.Cod_empresa == sucursal.idEmpresa %}*/
/*                                     <div class="img-vehiculo" data-code="{{ curso.Cod_ot }}-{{ curso.Cod_sucursal }}-{{ curso.Cod_empresa }}" data-numerodia="{{ curso.o_Fecha_Inicio | date('d') }}" data-cantidaddiasmes="{{ curso.o_Fecha_Inicio | date('t') }}">*/
/*                                         <img src="{{ asset('bundles/app/images/' ~ curso.imagen_curso) }}" alt="Curso {{ curso.Cod_ot }}" style="background-color: #{{ curso.color_vehiculo }}" class="data-curso {# img-vehiculo-{{ key }} #}">*/
/*                                         <span class="numeroCurso-{{ key }}">{{ curso.Cod_ot }}</span>*/
/*                                     </div>*/
/*                                 {% endfor %}*/
/*                                 </td>*/
/*                             {% endfor %}*/
/*                         </tr>*/
/*                     {% endfor %}*/
/*                     <tr>*/
/*                         <td class="sin-borde-inferior"></td>*/
/*                         <td class="huincha-verde-abajo"></td>*/
/*                         {% for mes in meses if mes.esPasado == false %}*/
/*                             <td class="huincha-verde-abajo"></td>*/
/*                         {% endfor %}*/
/*                     </tr>*/
/*                 {% endfor %}*/
/*             </tbody>*/
/*         </table>*/
/*     </div>*/
/*     <script>*/
/*         {{ include('AppBundle:Default:_script.html.twig') }}*/
/*     </script>*/
/* </body>*/
/* </html>*/
/* */
