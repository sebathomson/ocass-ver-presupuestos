<?php

/* AppBundle:Default:_script.html.twig */
class __TwigTemplate_c7f9481a1239f2e448adacae1683e42f40c21fbe16406339451ba5cab21968a7 extends Twig_Template
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
        $__internal_750651fad4cce718e738798bb2ed97e7419f38e112a7e73afc1d69f193aec5f2 = $this->env->getExtension("native_profiler");
        $__internal_750651fad4cce718e738798bb2ed97e7419f38e112a7e73afc1d69f193aec5f2->enter($__internal_750651fad4cce718e738798bb2ed97e7419f38e112a7e73afc1d69f193aec5f2_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Default:_script.html.twig"));

        // line 1
        echo "var windowWidth = \$(window).width();
var cursos      = [];

";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["cursos"]) ? $context["cursos"] : $this->getContext($context, "cursos")));
        foreach ($context['_seq'] as $context["_key"] => $context["curso"]) {
            // line 5
            echo "cursos['";
            echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_ot", array()), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_sucursal", array()), "html", null, true);
            echo "-";
            echo twig_escape_filter($this->env, $this->getAttribute($context["curso"], "Cod_empresa", array()), "html", null, true);
            echo "'] = ";
            echo twig_jsonencode_filter($context["curso"]);
            echo ";
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['curso'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "
function generarPopovers() {
    \$('.data-curso').each( function() {
        code  = \$(this).closest('.img-vehiculo').data('code');
        curso = cursos[code];

        html  = '';
        html += '<table class=\"table table-bordered table-striped table-condensed\">';
        html += '<tbody>';

        html += '<tr>';
        html += '<th>Fecha Inicio</th>';
        html += '<td class=\"text-right\">'+curso.fecha_inicio_tooltip+'</td>';
        html += '<th>N° OTE</th>';
        html += '<td class=\"text-right\">'+curso.Cod_ot+'</td>';
        html += '</tr>';

        html += '<tr>';
        html += '<th>Alumnos Inicio</th>';
        html += '<td class=\"text-right\">'+curso.Num_Alumnos_inicio+'</td>';
        html += '<th>Alumnos al día hoy</th>';
        html += '<td class=\"text-right\">'+curso.Num_Alumnos_Actual+'</td>';
        html += '</tr>';

        html += '<tr>';
        html += '<th>Capacidad Alumnos</th>';
        html += '<td class=\"text-right\">'+curso.Capacidad_Alumnos+'</td>';
        html += '<th>% de Alumnos</th>';
        html += '<td class=\"text-right\">'+curso.Porcentaje_Cap_Alumnos+'</td>';
        html += '</tr>';

        html += '<tr>';
        html += '<th>Fecha Término</th>';
        html += '<td class=\"text-right\">'+curso.fecha_termino_tooltip+'</td>';
        html += '<th>Relator hoy</th>';
        html += '<td class=\"text-center\">'+curso.Relator_Actual+'</td>';
        html += '</tr>';                                

        html += '<tr>';
        html += '<th>Total facturado \$</th>';
        html += '<td class=\"text-right\">'+curso.Monto_Facturado+'</td>';
        html += '<th>Total recibido \$</th>';
        html += '<td class=\"text-right\">'+curso.Monto_Pagado+'</td>';
        html += '</tr>';    

        html += '<tr>';
        html += '<th>Costo devengado</th>';
        html += '<td class=\"text-right\">'+curso.Costo_OT_devengado+'</td>';
        html += '<th>Costo real \$</th>';
        html += '<td class=\"text-right\">'+curso.Costo_OT_real+'</td>';
        html += '</tr>';                    

        html += '<tr>';
        html += '<th>Utilidad Nominal \$</th>';
        html += '<td class=\"text-right\">'+curso.Utilidad_ot_nominal+'</td>';
        html += '<th>% Utilidad Nominal</th>';
        html += '<td class=\"text-right\">'+curso.Porcentaje_Utilidad_nominal+'</td>';
        html += '</tr>';

        html += '<tr>';
        html += '<th>Utilidad Real \$</th>';
        html += '<td class=\"text-right\">'+curso.Utilidad_ot_real+'</td>';
        html += '<th>% Utilidad Real</th>';
        html += '<td class=\"text-right\">'+curso.Porcentaje_Utilidad_real+'</td>';
        html += '</tr>';

        html += '<tr>';
        html += '<th>Tipo Curso</th>';
        html += '<td class=\"text-center\">'+curso.Tipo_Curso.replace('_', ' ')+'</td>';
        html += '<th>Rentabilidad</th>';
        html += '<td class=\"text-right\" style=\"background-color: #'+curso.color_vehiculo+'\">'+curso.rentabilidad+'%</td>';
        html += '</tr>';

        html += '</tbody>';
        html += '</table>';

        placement = 'left';

        if (curso.bloque == 1 || curso.bloque == 2) {
            placement = 'right';                
        }

        \$(this).popover({
            'content': html,
            'html': true,
            'placement': placement,
            'title': \"Información Curso <b>\"+curso.Cod_ot+\"</b>\"
        });     
    });
}

function posicionarVehiculos() {
    \$('.calle-meses').each(function(index, el) {
        if (\$(this).find('.img-vehiculo').size() > 0) {
            width_calle                = \$(this).width() - 25;
            width_dia                  = width_calle / parseInt( \$(this).find('.img-vehiculo').data('cantidaddiasmes') );
            width_dia                  = parseInt( width_dia );
            width_vehiculo             = \$(this).find('.img-vehiculo').find('img').width();
            cantidad_vehiculos_previos = 0;
            dia_anterior               = null;
            margen_acumulado           = null;
            elemento_anterior          = null;

            \$(this).find('.img-vehiculo').each(function(index, el) {
                margin_base = width_dia * \$(this).data('numerodia');

                if ( dia_anterior != null ) {

                    // Si este auto y el anterior, poseen el mismo día, hay salto.
                    if (\$(this).data('numerodia') == dia_anterior) {

                        cantidad_vehiculos_previos = 0;
                        margen_acumulado           = 0;

                    } else if (\$(this).data('numerodia') < dia_anterior) {

                        cantidad_vehiculos_previos = 0;
                        margen_acumulado           = 0;

                    } else if (\$(this).data('numerodia') > dia_anterior) {
                        tamanio_veniculos_anteriores = cantidad_vehiculos_previos * (width_vehiculo);

                        if ( (tamanio_veniculos_anteriores + margen_acumulado) > margin_base) {

                            cantidad_vehiculos_previos = 0;
                            margen_acumulado           = 0;

                        } else {
                            margin_menos = tamanio_veniculos_anteriores + (margen_acumulado);
                            margin_base  = margin_base - margin_menos;
                            \$(this).css('float', 'left');
                            elemento_anterior.css('float', 'left');
                            \$(this).after('<div class=\"clearfix\"></div>');
                        }
                    }
                }

                cantidad_vehiculos_previos = cantidad_vehiculos_previos + 1;
                margen_acumulado           = margen_acumulado + margin_base;
                dia_anterior               = \$(this).data('numerodia');
                elemento_anterior          = \$(this);
                \$(this).css('margin-left', margin_base);
                \$(this).width(width_vehiculo);
            });             
        }
    });
}

\$(document).on('ready', function() {
    generarPopovers();

    setTimeout(function () {
        posicionarVehiculos();

        ancho_costado_izquierdo    = \$('.td-logo').width();
        ancho_cursos_no_terminados = \$('.td-nombre-empresa').width();
        ancho_equivalente_dia      = \$('#mes-";
        // line 163
        echo twig_escape_filter($this->env, (isset($context["iniciomesanio"]) ? $context["iniciomesanio"] : $this->getContext($context, "iniciomesanio")), "html", null, true);
        echo "-base').width() / ";
        echo twig_escape_filter($this->env, (isset($context["diasmesactual"]) ? $context["diasmesactual"] : $this->getContext($context, "diasmesactual")), "html", null, true);
        echo ";

        console.log('ancho_costado_izquierdo: ' + \$('.td-logo').width());

        margin = ancho_costado_izquierdo + ancho_cursos_no_terminados - 15;
        margin = margin + (ancho_equivalente_dia * ";
        // line 168
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d"), "html", null, true);
        echo ") + 16";
        echo " + 12";
        echo ";

        \$('#img-flecha-dia-actual').css('margin-left', margin);
        \$('#div-linea-dia-actual').css('margin-left', margin + 15);
        \$('#div-linea-dia-actual').css('height', \$('.table-responsiveeee').height());
        \$('#span-dia-actual').css('margin-left', (ancho_equivalente_dia * ";
        // line 173
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, "now", "d"), "html", null, true);
        echo "));


        \$('#th-costado-izquierdo').width( \$('.td-logo').width() );
        \$('#th-cursos-no-terminados').width( \$('.td-nombre-empresa').width() );

        ";
        // line 179
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["meses"]) ? $context["meses"] : $this->getContext($context, "meses")));
        foreach ($context['_seq'] as $context["_key"] => $context["mes"]) {
            if (($this->getAttribute($context["mes"], "esPasado", array()) == false)) {
                // line 180
                echo "        \$('#mes-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["mes"], "anio", array()), "html", null, true);
                echo twig_escape_filter($this->env, $this->getAttribute($context["mes"], "mes", array()), "html", null, true);
                echo "').width( \$('#mes-";
                echo twig_escape_filter($this->env, $this->getAttribute($context["mes"], "anio", array()), "html", null, true);
                echo twig_escape_filter($this->env, $this->getAttribute($context["mes"], "mes", array()), "html", null, true);
                echo "-base').width() );
        ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mes'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 182
        echo "    }, 2000);

    console.log('document: ready');

    \$('#img-logo').on('click', function() {
        console.log('img-logo: click');

        \$.post(\"";
        // line 189
        echo $this->env->getExtension('routing')->getPath("obtenerSelectSucursales");
        echo "\", null, function(data) {
            console.log('obtenerSelectSucursales: ajax-post');
            bootbox.dialog({
                message: data,
                title: \"Seleccionar Empresa / Sede\",
                buttons: {
                    volver: {
                        label: \"<span class='fa fa-arrow-left'></span> Volver\",
                        className: \"btn-default\",
                        callback: function() {
                            console.log('seleccionar-empresa-volver: click');
                        }
                    },
                    seleccionar: {
                        label: \"<span class='fa fa-check'></span> Seleccionar\",
                        className: \"btn-success\",
                        callback: function() {
                            console.log('seleccionar-empresa-seleccionar: click');
                            \$('#form-select-sucursales').submit();
                        }
                    }
                }
            });
        });
    });

    \$('#img-flecha-dia-actual').on('click', function() {
        console.log('img-flecha-dia-actual: click');

        \$.post(\"";
        // line 218
        echo $this->env->getExtension('routing')->getPath("obtenerVistaReporte");
        echo "\", null, function(data) {
            console.log('obtenerVistaReporte: ajax-post');
            bootbox.dialog({
                message: data,
                closeButton: false, 
                title: \"Reporte <div class='pull-right'><a id='btn-filtros-reporte' class='btn btn-info'><span class='fa fa-filter'></span> Filtros</a></div>\",
                buttons: {
                    ok: {
                        label: \"<span class='fa fa-check'></span> OK\",
                        className: \"btn-info\",
                        callback: function() {
                        }
                    }
                }
            });
        });
    });

    \$(window).resize(function() {
        if(windowWidth != \$(window).width()){
            \$('body').html('<center>Renderizando panel...</center>');
            location.reload();
            return;
        }
    });
});
";
        
        $__internal_750651fad4cce718e738798bb2ed97e7419f38e112a7e73afc1d69f193aec5f2->leave($__internal_750651fad4cce718e738798bb2ed97e7419f38e112a7e73afc1d69f193aec5f2_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Default:_script.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  293 => 218,  261 => 189,  252 => 182,  238 => 180,  233 => 179,  224 => 173,  214 => 168,  204 => 163,  46 => 7,  31 => 5,  27 => 4,  22 => 1,);
    }
}
/* var windowWidth = $(window).width();*/
/* var cursos      = [];*/
/* */
/* {% for curso in cursos %}*/
/* cursos['{{ curso.Cod_ot }}-{{ curso.Cod_sucursal }}-{{ curso.Cod_empresa }}'] = {{ curso | json_encode() | raw() }};*/
/* {% endfor %}*/
/* */
/* function generarPopovers() {*/
/*     $('.data-curso').each( function() {*/
/*         code  = $(this).closest('.img-vehiculo').data('code');*/
/*         curso = cursos[code];*/
/* */
/*         html  = '';*/
/*         html += '<table class="table table-bordered table-striped table-condensed">';*/
/*         html += '<tbody>';*/
/* */
/*         html += '<tr>';*/
/*         html += '<th>Fecha Inicio</th>';*/
/*         html += '<td class="text-right">'+curso.fecha_inicio_tooltip+'</td>';*/
/*         html += '<th>N° OTE</th>';*/
/*         html += '<td class="text-right">'+curso.Cod_ot+'</td>';*/
/*         html += '</tr>';*/
/* */
/*         html += '<tr>';*/
/*         html += '<th>Alumnos Inicio</th>';*/
/*         html += '<td class="text-right">'+curso.Num_Alumnos_inicio+'</td>';*/
/*         html += '<th>Alumnos al día hoy</th>';*/
/*         html += '<td class="text-right">'+curso.Num_Alumnos_Actual+'</td>';*/
/*         html += '</tr>';*/
/* */
/*         html += '<tr>';*/
/*         html += '<th>Capacidad Alumnos</th>';*/
/*         html += '<td class="text-right">'+curso.Capacidad_Alumnos+'</td>';*/
/*         html += '<th>% de Alumnos</th>';*/
/*         html += '<td class="text-right">'+curso.Porcentaje_Cap_Alumnos+'</td>';*/
/*         html += '</tr>';*/
/* */
/*         html += '<tr>';*/
/*         html += '<th>Fecha Término</th>';*/
/*         html += '<td class="text-right">'+curso.fecha_termino_tooltip+'</td>';*/
/*         html += '<th>Relator hoy</th>';*/
/*         html += '<td class="text-center">'+curso.Relator_Actual+'</td>';*/
/*         html += '</tr>';                                */
/* */
/*         html += '<tr>';*/
/*         html += '<th>Total facturado $</th>';*/
/*         html += '<td class="text-right">'+curso.Monto_Facturado+'</td>';*/
/*         html += '<th>Total recibido $</th>';*/
/*         html += '<td class="text-right">'+curso.Monto_Pagado+'</td>';*/
/*         html += '</tr>';    */
/* */
/*         html += '<tr>';*/
/*         html += '<th>Costo devengado</th>';*/
/*         html += '<td class="text-right">'+curso.Costo_OT_devengado+'</td>';*/
/*         html += '<th>Costo real $</th>';*/
/*         html += '<td class="text-right">'+curso.Costo_OT_real+'</td>';*/
/*         html += '</tr>';                    */
/* */
/*         html += '<tr>';*/
/*         html += '<th>Utilidad Nominal $</th>';*/
/*         html += '<td class="text-right">'+curso.Utilidad_ot_nominal+'</td>';*/
/*         html += '<th>% Utilidad Nominal</th>';*/
/*         html += '<td class="text-right">'+curso.Porcentaje_Utilidad_nominal+'</td>';*/
/*         html += '</tr>';*/
/* */
/*         html += '<tr>';*/
/*         html += '<th>Utilidad Real $</th>';*/
/*         html += '<td class="text-right">'+curso.Utilidad_ot_real+'</td>';*/
/*         html += '<th>% Utilidad Real</th>';*/
/*         html += '<td class="text-right">'+curso.Porcentaje_Utilidad_real+'</td>';*/
/*         html += '</tr>';*/
/* */
/*         html += '<tr>';*/
/*         html += '<th>Tipo Curso</th>';*/
/*         html += '<td class="text-center">'+curso.Tipo_Curso.replace('_', ' ')+'</td>';*/
/*         html += '<th>Rentabilidad</th>';*/
/*         html += '<td class="text-right" style="background-color: #'+curso.color_vehiculo+'">'+curso.rentabilidad+'%</td>';*/
/*         html += '</tr>';*/
/* */
/*         html += '</tbody>';*/
/*         html += '</table>';*/
/* */
/*         placement = 'left';*/
/* */
/*         if (curso.bloque == 1 || curso.bloque == 2) {*/
/*             placement = 'right';                */
/*         }*/
/* */
/*         $(this).popover({*/
/*             'content': html,*/
/*             'html': true,*/
/*             'placement': placement,*/
/*             'title': "Información Curso <b>"+curso.Cod_ot+"</b>"*/
/*         });     */
/*     });*/
/* }*/
/* */
/* function posicionarVehiculos() {*/
/*     $('.calle-meses').each(function(index, el) {*/
/*         if ($(this).find('.img-vehiculo').size() > 0) {*/
/*             width_calle                = $(this).width() - 25;*/
/*             width_dia                  = width_calle / parseInt( $(this).find('.img-vehiculo').data('cantidaddiasmes') );*/
/*             width_dia                  = parseInt( width_dia );*/
/*             width_vehiculo             = $(this).find('.img-vehiculo').find('img').width();*/
/*             cantidad_vehiculos_previos = 0;*/
/*             dia_anterior               = null;*/
/*             margen_acumulado           = null;*/
/*             elemento_anterior          = null;*/
/* */
/*             $(this).find('.img-vehiculo').each(function(index, el) {*/
/*                 margin_base = width_dia * $(this).data('numerodia');*/
/* */
/*                 if ( dia_anterior != null ) {*/
/* */
/*                     // Si este auto y el anterior, poseen el mismo día, hay salto.*/
/*                     if ($(this).data('numerodia') == dia_anterior) {*/
/* */
/*                         cantidad_vehiculos_previos = 0;*/
/*                         margen_acumulado           = 0;*/
/* */
/*                     } else if ($(this).data('numerodia') < dia_anterior) {*/
/* */
/*                         cantidad_vehiculos_previos = 0;*/
/*                         margen_acumulado           = 0;*/
/* */
/*                     } else if ($(this).data('numerodia') > dia_anterior) {*/
/*                         tamanio_veniculos_anteriores = cantidad_vehiculos_previos * (width_vehiculo);*/
/* */
/*                         if ( (tamanio_veniculos_anteriores + margen_acumulado) > margin_base) {*/
/* */
/*                             cantidad_vehiculos_previos = 0;*/
/*                             margen_acumulado           = 0;*/
/* */
/*                         } else {*/
/*                             margin_menos = tamanio_veniculos_anteriores + (margen_acumulado);*/
/*                             margin_base  = margin_base - margin_menos;*/
/*                             $(this).css('float', 'left');*/
/*                             elemento_anterior.css('float', 'left');*/
/*                             $(this).after('<div class="clearfix"></div>');*/
/*                         }*/
/*                     }*/
/*                 }*/
/* */
/*                 cantidad_vehiculos_previos = cantidad_vehiculos_previos + 1;*/
/*                 margen_acumulado           = margen_acumulado + margin_base;*/
/*                 dia_anterior               = $(this).data('numerodia');*/
/*                 elemento_anterior          = $(this);*/
/*                 $(this).css('margin-left', margin_base);*/
/*                 $(this).width(width_vehiculo);*/
/*             });             */
/*         }*/
/*     });*/
/* }*/
/* */
/* $(document).on('ready', function() {*/
/*     generarPopovers();*/
/* */
/*     setTimeout(function () {*/
/*         posicionarVehiculos();*/
/* */
/*         ancho_costado_izquierdo    = $('.td-logo').width();*/
/*         ancho_cursos_no_terminados = $('.td-nombre-empresa').width();*/
/*         ancho_equivalente_dia      = $('#mes-{{ iniciomesanio }}-base').width() / {{ diasmesactual }};*/
/* */
/*         console.log('ancho_costado_izquierdo: ' + $('.td-logo').width());*/
/* */
/*         margin = ancho_costado_izquierdo + ancho_cursos_no_terminados - 15;*/
/*         margin = margin + (ancho_equivalente_dia * {{ 'now' | date('d') }}) + 16{# padding #} + 12{# bording #};*/
/* */
/*         $('#img-flecha-dia-actual').css('margin-left', margin);*/
/*         $('#div-linea-dia-actual').css('margin-left', margin + 15);*/
/*         $('#div-linea-dia-actual').css('height', $('.table-responsiveeee').height());*/
/*         $('#span-dia-actual').css('margin-left', (ancho_equivalente_dia * {{ 'now' | date('d') }}));*/
/* */
/* */
/*         $('#th-costado-izquierdo').width( $('.td-logo').width() );*/
/*         $('#th-cursos-no-terminados').width( $('.td-nombre-empresa').width() );*/
/* */
/*         {% for mes in meses if mes.esPasado == false %}*/
/*         $('#mes-{{ mes.anio }}{{ mes.mes }}').width( $('#mes-{{ mes.anio }}{{ mes.mes }}-base').width() );*/
/*         {% endfor %}*/
/*     }, 2000);*/
/* */
/*     console.log('document: ready');*/
/* */
/*     $('#img-logo').on('click', function() {*/
/*         console.log('img-logo: click');*/
/* */
/*         $.post("{{ path('obtenerSelectSucursales') }}", null, function(data) {*/
/*             console.log('obtenerSelectSucursales: ajax-post');*/
/*             bootbox.dialog({*/
/*                 message: data,*/
/*                 title: "Seleccionar Empresa / Sede",*/
/*                 buttons: {*/
/*                     volver: {*/
/*                         label: "<span class='fa fa-arrow-left'></span> Volver",*/
/*                         className: "btn-default",*/
/*                         callback: function() {*/
/*                             console.log('seleccionar-empresa-volver: click');*/
/*                         }*/
/*                     },*/
/*                     seleccionar: {*/
/*                         label: "<span class='fa fa-check'></span> Seleccionar",*/
/*                         className: "btn-success",*/
/*                         callback: function() {*/
/*                             console.log('seleccionar-empresa-seleccionar: click');*/
/*                             $('#form-select-sucursales').submit();*/
/*                         }*/
/*                     }*/
/*                 }*/
/*             });*/
/*         });*/
/*     });*/
/* */
/*     $('#img-flecha-dia-actual').on('click', function() {*/
/*         console.log('img-flecha-dia-actual: click');*/
/* */
/*         $.post("{{ path('obtenerVistaReporte') }}", null, function(data) {*/
/*             console.log('obtenerVistaReporte: ajax-post');*/
/*             bootbox.dialog({*/
/*                 message: data,*/
/*                 closeButton: false, */
/*                 title: "Reporte <div class='pull-right'><a id='btn-filtros-reporte' class='btn btn-info'><span class='fa fa-filter'></span> Filtros</a></div>",*/
/*                 buttons: {*/
/*                     ok: {*/
/*                         label: "<span class='fa fa-check'></span> OK",*/
/*                         className: "btn-info",*/
/*                         callback: function() {*/
/*                         }*/
/*                     }*/
/*                 }*/
/*             });*/
/*         });*/
/*     });*/
/* */
/*     $(window).resize(function() {*/
/*         if(windowWidth != $(window).width()){*/
/*             $('body').html('<center>Renderizando panel...</center>');*/
/*             location.reload();*/
/*             return;*/
/*         }*/
/*     });*/
/* });*/
/* */
