<?php

/* @WebProfiler/Collector/router.html.twig */
class __TwigTemplate_c725cb65758c66444578b208a51474684d6c4ea525d03c7904683c5de1e5df57 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@WebProfiler/Profiler/layout.html.twig", "@WebProfiler/Collector/router.html.twig", 1);
        $this->blocks = array(
            'toolbar' => array($this, 'block_toolbar'),
            'menu' => array($this, 'block_menu'),
            'panel' => array($this, 'block_panel'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@WebProfiler/Profiler/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_1b81f193c576583902e856905e9206441cea79b23acfe5c845c64bf5c570f2cf = $this->env->getExtension("native_profiler");
        $__internal_1b81f193c576583902e856905e9206441cea79b23acfe5c845c64bf5c570f2cf->enter($__internal_1b81f193c576583902e856905e9206441cea79b23acfe5c845c64bf5c570f2cf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@WebProfiler/Collector/router.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_1b81f193c576583902e856905e9206441cea79b23acfe5c845c64bf5c570f2cf->leave($__internal_1b81f193c576583902e856905e9206441cea79b23acfe5c845c64bf5c570f2cf_prof);

    }

    // line 3
    public function block_toolbar($context, array $blocks = array())
    {
        $__internal_cd17b5575608e872b10d615b6d337dd1b0226535fb7976269dd587268e2ed7c3 = $this->env->getExtension("native_profiler");
        $__internal_cd17b5575608e872b10d615b6d337dd1b0226535fb7976269dd587268e2ed7c3->enter($__internal_cd17b5575608e872b10d615b6d337dd1b0226535fb7976269dd587268e2ed7c3_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "toolbar"));

        
        $__internal_cd17b5575608e872b10d615b6d337dd1b0226535fb7976269dd587268e2ed7c3->leave($__internal_cd17b5575608e872b10d615b6d337dd1b0226535fb7976269dd587268e2ed7c3_prof);

    }

    // line 5
    public function block_menu($context, array $blocks = array())
    {
        $__internal_441b577811eccc5cb88701d82dfea9604bdeb94be3733e2a9144740e553f56cf = $this->env->getExtension("native_profiler");
        $__internal_441b577811eccc5cb88701d82dfea9604bdeb94be3733e2a9144740e553f56cf->enter($__internal_441b577811eccc5cb88701d82dfea9604bdeb94be3733e2a9144740e553f56cf_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "menu"));

        // line 6
        echo "<span class=\"label\">
    <span class=\"icon\">";
        // line 7
        echo twig_include($this->env, $context, "@WebProfiler/Icon/router.svg");
        echo "</span>
    <strong>Routing</strong>
</span>
";
        
        $__internal_441b577811eccc5cb88701d82dfea9604bdeb94be3733e2a9144740e553f56cf->leave($__internal_441b577811eccc5cb88701d82dfea9604bdeb94be3733e2a9144740e553f56cf_prof);

    }

    // line 12
    public function block_panel($context, array $blocks = array())
    {
        $__internal_eff3f9bbee4cfd81cb3e051447d801ac40605f03c9e9400aa20e8b78571ad419 = $this->env->getExtension("native_profiler");
        $__internal_eff3f9bbee4cfd81cb3e051447d801ac40605f03c9e9400aa20e8b78571ad419->enter($__internal_eff3f9bbee4cfd81cb3e051447d801ac40605f03c9e9400aa20e8b78571ad419_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "panel"));

        // line 13
        echo "    ";
        echo $this->env->getExtension('http_kernel')->renderFragment($this->env->getExtension('routing')->getPath("_profiler_router", array("token" => (isset($context["token"]) ? $context["token"] : $this->getContext($context, "token")))));
        echo "
";
        
        $__internal_eff3f9bbee4cfd81cb3e051447d801ac40605f03c9e9400aa20e8b78571ad419->leave($__internal_eff3f9bbee4cfd81cb3e051447d801ac40605f03c9e9400aa20e8b78571ad419_prof);

    }

    public function getTemplateName()
    {
        return "@WebProfiler/Collector/router.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  73 => 13,  67 => 12,  56 => 7,  53 => 6,  47 => 5,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@WebProfiler/Profiler/layout.html.twig' %}*/
/* */
/* {% block toolbar %}{% endblock %}*/
/* */
/* {% block menu %}*/
/* <span class="label">*/
/*     <span class="icon">{{ include('@WebProfiler/Icon/router.svg') }}</span>*/
/*     <strong>Routing</strong>*/
/* </span>*/
/* {% endblock %}*/
/* */
/* {% block panel %}*/
/*     {{ render(path('_profiler_router', { token: token })) }}*/
/* {% endblock %}*/
/* */
