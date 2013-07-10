<?php

/* GitGuiBundle:Default:submitted.html.twig */
class __TwigTemplate_9743bd89e1bdb79dba4191797f413cc0 extends Twig_Template
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
        // line 1
        echo "<?php
 \$view->extend('GitGuiBundle:Default:base.html.php');
    \$view['slots']->start('title');
    

echo \"<h3> Successfully Altered Database</h3>
<a href='create'>Go Back</a>\"

print \$_SESSION['name'];

\$view['slots']->stop();

?>";
    }

    public function getTemplateName()
    {
        return "GitGuiBundle:Default:submitted.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
