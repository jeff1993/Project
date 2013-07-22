<?php

/* GitGuiBundle:gitlist/vendor/symfony/twig-bridge/Symfony/Bridge/Twig/Resources/views/Form:form_table_layout.html.twig */
class __TwigTemplate_b4aa1822ae0bf90d0db7d464d362f3fe extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $_trait_0 = $this->env->loadTemplate("form_div_layout.html.twig");
        // line 1
        if (!$_trait_0->isTraitable()) {
            throw new Twig_Error_Runtime('Template "'."form_div_layout.html.twig".'" cannot be used as a trait.');
        }
        $_trait_0_blocks = $_trait_0->getBlocks();

        $this->traits = $_trait_0_blocks;

        $this->blocks = array_merge(
            $this->traits,
            array(
                'form_row' => array($this, 'block_form_row'),
                'hidden_row' => array($this, 'block_hidden_row'),
                'form_widget_compound' => array($this, 'block_form_widget_compound'),
            )
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 2
        echo "
";
        // line 3
        $this->displayBlock('form_row', $context, $blocks);
        // line 16
        echo "
";
        // line 17
        $this->displayBlock('hidden_row', $context, $blocks);
        // line 26
        echo "
";
        // line 27
        $this->displayBlock('form_widget_compound', $context, $blocks);
    }

    // line 3
    public function block_form_row($context, array $blocks = array())
    {
        // line 4
        ob_start();
        // line 5
        echo "    <tr>
        <td>
            ";
        // line 7
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'label');
        echo "
        </td>
        <td>
            ";
        // line 10
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
        echo "
            ";
        // line 11
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
        </td>
    </tr>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 17
    public function block_hidden_row($context, array $blocks = array())
    {
        // line 18
        ob_start();
        // line 19
        echo "    <tr style=\"display: none\">
        <td colspan=\"2\">
            ";
        // line 21
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'widget');
        echo "
        </td>
    </tr>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    // line 27
    public function block_form_widget_compound($context, array $blocks = array())
    {
        // line 28
        ob_start();
        // line 29
        echo "    <table ";
        $this->displayBlock("widget_container_attributes", $context, $blocks);
        echo ">
        ";
        // line 30
        if ((twig_test_empty($this->getAttribute((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), "parent")) && (twig_length_filter($this->env, (isset($context["errors"]) ? $context["errors"] : $this->getContext($context, "errors"))) > 0))) {
            // line 31
            echo "        <tr>
            <td colspan=\"2\">
                ";
            // line 33
            echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'errors');
            echo "
            </td>
        </tr>
        ";
        }
        // line 37
        echo "        ";
        $this->displayBlock("form_rows", $context, $blocks);
        echo "
        ";
        // line 38
        echo $this->env->getExtension('form')->renderer->searchAndRenderBlock((isset($context["form"]) ? $context["form"] : $this->getContext($context, "form")), 'rest');
        echo "
    </table>
";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
    }

    public function getTemplateName()
    {
        return "GitGuiBundle:gitlist/vendor/symfony/twig-bridge/Symfony/Bridge/Twig/Resources/views/Form:form_table_layout.html.twig";
    }

    public function getDebugInfo()
    {
        return array (  113 => 33,  102 => 29,  100 => 28,  97 => 27,  34 => 2,  14 => 1,  1191 => 330,  1185 => 329,  1179 => 328,  1173 => 327,  1167 => 326,  1161 => 325,  1155 => 324,  1149 => 323,  1143 => 322,  1127 => 316,  1120 => 315,  1118 => 314,  1115 => 313,  1092 => 309,  1067 => 308,  1065 => 307,  1062 => 306,  1050 => 301,  1045 => 300,  1043 => 299,  1040 => 298,  1031 => 292,  1025 => 290,  1022 => 289,  1017 => 288,  1015 => 287,  1012 => 286,  1005 => 281,  996 => 279,  992 => 278,  989 => 277,  986 => 276,  984 => 275,  981 => 274,  973 => 270,  971 => 269,  968 => 268,  961 => 263,  958 => 262,  950 => 257,  946 => 256,  942 => 255,  939 => 254,  937 => 253,  934 => 252,  926 => 248,  924 => 244,  922 => 243,  919 => 242,  897 => 235,  894 => 234,  891 => 233,  888 => 232,  885 => 231,  882 => 230,  879 => 229,  876 => 228,  873 => 227,  870 => 226,  867 => 225,  865 => 224,  862 => 223,  854 => 217,  851 => 216,  849 => 215,  846 => 214,  838 => 210,  835 => 209,  833 => 208,  830 => 207,  822 => 203,  819 => 202,  817 => 201,  814 => 200,  806 => 196,  803 => 195,  801 => 194,  798 => 193,  790 => 189,  787 => 188,  785 => 187,  782 => 186,  774 => 182,  771 => 181,  769 => 180,  766 => 179,  758 => 175,  756 => 174,  753 => 173,  745 => 169,  742 => 168,  740 => 167,  737 => 166,  729 => 162,  726 => 161,  724 => 160,  722 => 159,  719 => 158,  712 => 153,  702 => 152,  697 => 151,  694 => 150,  688 => 148,  685 => 147,  683 => 146,  680 => 145,  672 => 139,  670 => 138,  669 => 137,  668 => 136,  667 => 135,  662 => 134,  656 => 132,  653 => 131,  651 => 130,  648 => 129,  639 => 123,  635 => 122,  631 => 121,  627 => 120,  622 => 119,  616 => 117,  613 => 116,  611 => 115,  608 => 114,  592 => 110,  590 => 109,  587 => 108,  571 => 104,  569 => 103,  566 => 102,  549 => 98,  537 => 96,  530 => 93,  528 => 92,  523 => 91,  520 => 90,  502 => 89,  500 => 88,  497 => 87,  488 => 82,  485 => 81,  482 => 80,  476 => 78,  466 => 75,  463 => 74,  450 => 72,  448 => 71,  438 => 69,  429 => 64,  421 => 62,  416 => 61,  412 => 60,  405 => 58,  382 => 48,  369 => 43,  367 => 42,  364 => 41,  356 => 37,  353 => 36,  350 => 35,  347 => 34,  345 => 33,  342 => 32,  334 => 27,  329 => 26,  323 => 24,  321 => 23,  316 => 22,  311 => 20,  295 => 16,  292 => 15,  290 => 14,  287 => 13,  272 => 6,  269 => 5,  267 => 4,  260 => 330,  256 => 328,  254 => 327,  250 => 325,  248 => 324,  244 => 322,  238 => 319,  236 => 313,  233 => 312,  231 => 306,  228 => 305,  226 => 298,  223 => 297,  218 => 286,  215 => 285,  213 => 274,  210 => 273,  205 => 267,  202 => 265,  200 => 262,  197 => 261,  195 => 252,  192 => 251,  190 => 242,  184 => 239,  179 => 222,  174 => 214,  161 => 199,  159 => 193,  146 => 178,  134 => 158,  129 => 145,  124 => 129,  104 => 87,  81 => 40,  76 => 31,  480 => 162,  474 => 77,  469 => 76,  461 => 155,  457 => 153,  453 => 151,  444 => 149,  440 => 70,  437 => 147,  435 => 68,  430 => 144,  427 => 143,  423 => 142,  413 => 134,  409 => 132,  407 => 59,  402 => 57,  398 => 129,  393 => 52,  387 => 50,  384 => 49,  381 => 120,  379 => 47,  374 => 116,  368 => 112,  365 => 111,  362 => 110,  360 => 109,  355 => 106,  341 => 105,  337 => 103,  322 => 101,  314 => 21,  312 => 98,  309 => 97,  305 => 95,  298 => 91,  294 => 90,  285 => 89,  283 => 88,  278 => 8,  268 => 85,  264 => 3,  258 => 329,  252 => 326,  247 => 78,  241 => 321,  235 => 74,  229 => 73,  224 => 71,  220 => 295,  214 => 69,  208 => 268,  169 => 207,  143 => 56,  140 => 55,  132 => 51,  128 => 49,  119 => 114,  107 => 30,  71 => 19,  177 => 65,  165 => 64,  160 => 61,  135 => 47,  126 => 144,  114 => 108,  84 => 19,  70 => 11,  67 => 15,  61 => 2,  38 => 6,  94 => 57,  89 => 47,  85 => 25,  75 => 23,  68 => 14,  56 => 5,  87 => 20,  21 => 2,  26 => 6,  93 => 28,  88 => 21,  78 => 21,  46 => 7,  27 => 4,  44 => 26,  31 => 5,  28 => 3,  201 => 92,  196 => 90,  183 => 70,  171 => 213,  166 => 206,  163 => 70,  158 => 67,  156 => 192,  151 => 185,  142 => 59,  138 => 57,  136 => 165,  121 => 128,  117 => 44,  105 => 40,  91 => 56,  62 => 23,  49 => 19,  24 => 4,  25 => 3,  19 => 1,  79 => 17,  72 => 16,  69 => 13,  47 => 27,  40 => 8,  37 => 3,  22 => 2,  246 => 323,  157 => 56,  145 => 46,  139 => 166,  131 => 157,  123 => 47,  120 => 37,  115 => 43,  111 => 107,  108 => 37,  101 => 86,  98 => 31,  96 => 67,  83 => 25,  74 => 20,  66 => 10,  55 => 15,  52 => 21,  50 => 10,  43 => 8,  41 => 7,  35 => 5,  32 => 4,  29 => 3,  209 => 82,  203 => 78,  199 => 67,  193 => 73,  189 => 71,  187 => 241,  182 => 223,  176 => 220,  173 => 74,  168 => 66,  164 => 200,  162 => 62,  154 => 186,  149 => 179,  147 => 58,  144 => 173,  141 => 172,  133 => 55,  130 => 41,  125 => 38,  122 => 43,  116 => 113,  112 => 42,  109 => 31,  106 => 101,  103 => 37,  99 => 68,  95 => 34,  92 => 33,  86 => 46,  82 => 18,  80 => 19,  73 => 19,  64 => 3,  60 => 7,  57 => 11,  54 => 4,  51 => 3,  48 => 13,  45 => 17,  42 => 17,  39 => 16,  36 => 5,  33 => 4,  30 => 7,);
    }
}
