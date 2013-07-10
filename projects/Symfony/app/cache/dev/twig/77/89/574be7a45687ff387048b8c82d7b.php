<?php

/* GitGuiBundle:Default:base.html.twig */
class __TwigTemplate_7789574be7a45687ff387048b8c82d7b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'body' => array($this, 'block_body'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
  <head>
    <title>Git Gui</title>
    <!-- Bootstrap -->
    <link href=\"http://twitter.github.com/bootstrap/assets/css/bootstrap.css\" rel=\"stylesheet\">
    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js\"></script>
    <script>window.jQuery || document.write('<script src=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/js/jquery.js"), "html", null, true);
        echo "\"><\\/script>')</script>
    <script src=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bootstrap/js/bootstrap.js"), "html", null, true);
        echo "\"></script>

  </head>
  <body>

    
\t\t\t\t<div class=\"navbar\">
\t\t\t\t\t<div class=\"navbar-inner\">
\t\t\t\t\t\t
\t\t\t\t\t\t<ul class=\"nav\">
\t\t\t\t\t\t\t<li><a href=\"login\">Home</a></li>
\t\t\t\t\t\t\t<li><a href=\"#\">About</a></li>
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<li class=\"dropdown\">
\t\t\t\t\t\t\t\t<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
\t\t\t\t\t\t\t\t\tUsers <b class=\"caret\"></b>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu\">
\t\t\t\t\t\t\t\t<li><a href=\"user\">Show All Users</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"create\">Create Users</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"#\">link</a></li>
\t\t\t\t\t\t\t\t\t<li><a href=\"#\">link</a></li>
\t\t\t\t\t\t\t\t</ul>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t
\t\t\t\t\t\t\t<li class=\"dropdown\">
\t\t\t\t\t\t\t\t<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
\t\t\t\t\t\t\t\t\tGroups <b class=\"caret\"></b>
\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t
\t\t\t\t\t\t\t\t<ul class=\"dropdown-menu\">
                     <li><a href=\"group\">Manage Groups</a></li>
                  </ul>
\t\t\t\t\t\t  <li class=\"dropdown\">
                  <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\">
                  Repos <b class=\"caret\"></b>
                  </a>
                  <ul class=\"dropdown-menu\">
                     <li><a href=\"repo\">Manage Repositories</a></li>
                     <li><a href=\"../../../../../../../gitlist/index.php\">View Repositories</a></li>
                  </ul>
               </li>\t\t
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t\t
\t\t\t\t\t\t</ul>
\t\t\t\t\t\t
\t\t\t\t\t</div>
\t\t\t\t</div>
\t";
        // line 59
        $this->displayBlock('body', $context, $blocks);
        // line 62
        echo "\t\t
\t\t

</body>
</html>


";
    }

    // line 59
    public function block_body($context, array $blocks = array())
    {
        // line 60
        echo "\t\t
\t\t";
    }

    public function getTemplateName()
    {
        return "GitGuiBundle:Default:base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  102 => 60,  99 => 59,  88 => 62,  86 => 59,  33 => 9,  29 => 8,  20 => 1,  31 => 4,  28 => 3,);
    }
}
