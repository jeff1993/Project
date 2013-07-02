<?php

/* GitGuiBundle:Default:create.html.twig */
class __TwigTemplate_c0eda2b9baa06eba28a4cc1b98769215 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("GitGuiBundle:Default:base.html.twig");

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "GitGuiBundle:Default:base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_body($context, array $blocks = array())
    {
        // line 4
        echo "
<br/>
<br/>


<div class=\"row-fluid\">
  <div class=\"span4\">

\t<UL>
\t\t<h3> Create a New User </h3>
\t\t";
        // line 14
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'form');
        echo "
\t</UL>

  </div>
  
  <div class=\"span4\">
  
  \t<h3> Create a New Group </h3>
 \t ";
        // line 22
        echo         $this->env->getExtension('form')->renderer->renderBlock((isset($context["form2"]) ? $context["form2"] : $this->getContext($context, "form2")), 'form');
        echo "
 \t 
  </div>
  
</div>




";
    }

    public function getTemplateName()
    {
        return "GitGuiBundle:Default:create.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  54 => 22,  43 => 14,  31 => 4,  28 => 3,);
    }
}
