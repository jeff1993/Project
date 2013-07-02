<?php

/* GitGuiBundle:Default:login.html.twig */
class __TwigTemplate_7f0ed7736f6a98451dfdeb908b1ec74a extends Twig_Template
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

<div class=\"span12 pagination-centered\">

 <form action=\"authorize\" method=\"POST\">
<fieldset >
<legend>Login</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
 
<label for='username' >UserName*:</label>
<input type='text' name='username' id='username'  maxlength=\"50\" />
 
<label for='password' >Password*:</label>
<input type='password' name='password' id='password' maxlength=\"50\" />

<br/>
 
<input type='submit' name='Submit' value='Submit' />
 
</fieldset>
</form>
   
</div>


";
    }

    public function getTemplateName()
    {
        return "GitGuiBundle:Default:login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 4,  28 => 3,);
    }
}
