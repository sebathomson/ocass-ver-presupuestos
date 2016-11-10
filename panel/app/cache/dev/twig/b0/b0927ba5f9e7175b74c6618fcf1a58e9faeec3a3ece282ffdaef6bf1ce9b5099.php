<?php

/* AppBundle:Default:_head.html.twig */
class __TwigTemplate_59a72ebfd7892f0e9fbdec7897b71ec0436f50d7fcfbaeb1ab2d6ebc11a3264b extends Twig_Template
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
        $__internal_053f24da9a6afb3bf035875637683d49a394658e34bb4a0ec6bf71f50a27c65a = $this->env->getExtension("native_profiler");
        $__internal_053f24da9a6afb3bf035875637683d49a394658e34bb4a0ec6bf71f50a27c65a->enter($__internal_053f24da9a6afb3bf035875637683d49a394658e34bb4a0ec6bf71f50a27c65a_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "AppBundle:Default:_head.html.twig"));

        // line 1
        echo "<meta charset=\"UTF-8\">
<meta name=\"author\" content=\"Sebastián Thomson\">
<meta name=\"contact\" content=\"seba.thomson@gmail.com\">

<title>OCASS Panel</title>

<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">

<link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/css/bootstrap.min.css"), "html", null, true);
        echo "\">
<link rel=\"stylesheet\" href=\"";
        // line 10
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/css/bootstrap-datepicker3.min.css"), "html", null, true);
        echo "\">
<link rel=\"stylesheet\" href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/css/font-awesome.min.css"), "html", null, true);
        echo "\">
<link rel=\"stylesheet\" href=\"";
        // line 12
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/css/app.min.css"), "html", null, true);
        echo "\">

<style>
    .huincha-verde-arriba {
        background-image: url('";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/images/huincha_verde_1.png"), "html", null, true);
        echo "');
        height: 52px;
    }
    .huincha-verde-abajo {
        background-image: url('";
        // line 20
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/images/huincha_verde_2.png"), "html", null, true);
        echo "');
        height: 52px;
    }
    body {
\tzoom: 0.75!important;
    }
</style>

<script src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/js/jquery.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/js/bootstrap.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 30
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/js/bootbox.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/js/bootstrap-datepicker.min.js"), "html", null, true);
        echo "\"></script>
<script src=\"";
        // line 32
        echo twig_escape_filter($this->env, $this->env->getExtension('asset')->getAssetUrl("bundles/app/js/bootstrap-datepicker.es.min.js"), "html", null, true);
        echo "\"></script>
    
";
        
        $__internal_053f24da9a6afb3bf035875637683d49a394658e34bb4a0ec6bf71f50a27c65a->leave($__internal_053f24da9a6afb3bf035875637683d49a394658e34bb4a0ec6bf71f50a27c65a_prof);

    }

    public function getTemplateName()
    {
        return "AppBundle:Default:_head.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  85 => 32,  81 => 31,  77 => 30,  73 => 29,  69 => 28,  58 => 20,  51 => 16,  44 => 12,  40 => 11,  36 => 10,  32 => 9,  22 => 1,);
    }
}
/* <meta charset="UTF-8">*/
/* <meta name="author" content="Sebastián Thomson">*/
/* <meta name="contact" content="seba.thomson@gmail.com">*/
/* */
/* <title>OCASS Panel</title>*/
/* */
/* <meta name="viewport" content="width=device-width, initial-scale=1">*/
/* */
/* <link rel="stylesheet" href="{{ asset('bundles/app/css/bootstrap.min.css') }}">*/
/* <link rel="stylesheet" href="{{ asset('bundles/app/css/bootstrap-datepicker3.min.css') }}">*/
/* <link rel="stylesheet" href="{{ asset('bundles/app/css/font-awesome.min.css') }}">*/
/* <link rel="stylesheet" href="{{ asset('bundles/app/css/app.min.css') }}">*/
/* */
/* <style>*/
/*     .huincha-verde-arriba {*/
/*         background-image: url('{{ asset('bundles/app/images/huincha_verde_1.png') }}');*/
/*         height: 52px;*/
/*     }*/
/*     .huincha-verde-abajo {*/
/*         background-image: url('{{ asset('bundles/app/images/huincha_verde_2.png') }}');*/
/*         height: 52px;*/
/*     }*/
/*     body {*/
/* 	zoom: 0.75!important;*/
/*     }*/
/* </style>*/
/* */
/* <script src="{{ asset('bundles/app/js/jquery.min.js') }}"></script>*/
/* <script src="{{ asset('bundles/app/js/bootstrap.min.js') }}"></script>*/
/* <script src="{{ asset('bundles/app/js/bootbox.min.js') }}"></script>*/
/* <script src="{{ asset('bundles/app/js/bootstrap-datepicker.min.js') }}"></script>*/
/* <script src="{{ asset('bundles/app/js/bootstrap-datepicker.es.min.js') }}"></script>*/
/*     */
/* */
