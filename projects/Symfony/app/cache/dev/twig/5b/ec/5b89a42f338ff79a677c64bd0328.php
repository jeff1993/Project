<?php

/* BcBootstrapBundle:Pagination:pagination.html.twig */
class __TwigTemplate_5bec5b89a42f338ff79a677c64bd0328 extends Twig_Template
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
        // line 2
        echo "
";
        // line 3
        if ((!array_key_exists("style", $context))) {
            // line 4
            echo "    ";
            $context["style"] = "pagination";
        }
        // line 6
        echo "
";
        // line 7
        if ((!array_key_exists("prev_label", $context))) {
            // line 8
            echo "    ";
            $context["prev_label"] = "Previous";
        }
        // line 10
        if ((!array_key_exists("next_label", $context))) {
            // line 11
            echo "    ";
            $context["next_label"] = "Next";
        }
        // line 13
        if ((!array_key_exists("first_label", $context))) {
            // line 14
            echo "    ";
            $context["first_label"] = "First";
        }
        // line 16
        if ((!array_key_exists("last_label", $context))) {
            // line 17
            echo "    ";
            $context["last_label"] = "Last";
        }
        // line 19
        echo "

";
        // line 21
        if (((isset($context["pageCount"]) ? $context["pageCount"] : $this->getContext($context, "pageCount")) > 1)) {
            // line 22
            echo "    ";
            if (((isset($context["style"]) ? $context["style"] : $this->getContext($context, "style")) == "pagination")) {
                // line 23
                echo "        ";
                $context["orientation_class"] = "";
                // line 24
                echo "        ";
                if (array_key_exists("alignment", $context)) {
                    // line 25
                    echo "            ";
                    if (((isset($context["alignment"]) ? $context["alignment"] : $this->getContext($context, "alignment")) == "center")) {
                        // line 26
                        echo "                ";
                        $context["orientation_class"] = " pagination-centered";
                        // line 27
                        echo "            ";
                    } elseif (((isset($context["alignment"]) ? $context["alignment"] : $this->getContext($context, "alignment")) == "right")) {
                        // line 28
                        echo "                ";
                        $context["orientation_class"] = " pagination-right";
                        // line 29
                        echo "            ";
                    }
                    // line 30
                    echo "        ";
                }
                // line 31
                echo "
        <div class=\"pagination";
                // line 32
                echo twig_escape_filter($this->env, (isset($context["orientation_class"]) ? $context["orientation_class"] : $this->getContext($context, "orientation_class")), "html", null, true);
                echo "\">
            <ul>
            ";
                // line 34
                if ((array_key_exists("first", $context) && ((isset($context["current"]) ? $context["current"] : $this->getContext($context, "current")) != (isset($context["first"]) ? $context["first"] : $this->getContext($context, "first"))))) {
                    // line 35
                    echo "                <li><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["route"]) ? $context["route"] : $this->getContext($context, "route")), twig_array_merge((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), array((isset($context["pageParameterName"]) ? $context["pageParameterName"] : $this->getContext($context, "pageParameterName")) => (isset($context["first"]) ? $context["first"] : $this->getContext($context, "first"))))), "html", null, true);
                    echo "\">";
                    echo (isset($context["first_label"]) ? $context["first_label"] : $this->getContext($context, "first_label"));
                    echo "</a></li>
            ";
                }
                // line 37
                echo "
            ";
                // line 38
                if (array_key_exists("previous", $context)) {
                    // line 39
                    echo "                <li><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["route"]) ? $context["route"] : $this->getContext($context, "route")), twig_array_merge((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), array((isset($context["pageParameterName"]) ? $context["pageParameterName"] : $this->getContext($context, "pageParameterName")) => (isset($context["previous"]) ? $context["previous"] : $this->getContext($context, "previous"))))), "html", null, true);
                    echo "\">";
                    echo (isset($context["prev_label"]) ? $context["prev_label"] : $this->getContext($context, "prev_label"));
                    echo "</a></li>
            ";
                }
                // line 41
                echo "
            ";
                // line 42
                $context['_parent'] = (array) $context;
                $context['_seq'] = twig_ensure_traversable((isset($context["pagesInRange"]) ? $context["pagesInRange"] : $this->getContext($context, "pagesInRange")));
                foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                    // line 43
                    echo "                ";
                    if (((isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")) != (isset($context["current"]) ? $context["current"] : $this->getContext($context, "current")))) {
                        // line 44
                        echo "                    <li><a href=\"";
                        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["route"]) ? $context["route"] : $this->getContext($context, "route")), twig_array_merge((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), array((isset($context["pageParameterName"]) ? $context["pageParameterName"] : $this->getContext($context, "pageParameterName")) => (isset($context["page"]) ? $context["page"] : $this->getContext($context, "page"))))), "html", null, true);
                        echo "\">";
                        echo twig_escape_filter($this->env, (isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "html", null, true);
                        echo "</a></li>
                ";
                    } else {
                        // line 46
                        echo "                    <li class=\"active\"><span>";
                        echo twig_escape_filter($this->env, (isset($context["page"]) ? $context["page"] : $this->getContext($context, "page")), "html", null, true);
                        echo "</span></li>
                ";
                    }
                    // line 48
                    echo "
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 50
                echo "
            ";
                // line 51
                if (array_key_exists("next", $context)) {
                    // line 52
                    echo "                <li><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["route"]) ? $context["route"] : $this->getContext($context, "route")), twig_array_merge((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), array((isset($context["pageParameterName"]) ? $context["pageParameterName"] : $this->getContext($context, "pageParameterName")) => (isset($context["next"]) ? $context["next"] : $this->getContext($context, "next"))))), "html", null, true);
                    echo "\">";
                    echo (isset($context["next_label"]) ? $context["next_label"] : $this->getContext($context, "next_label"));
                    echo "</a></li>
            ";
                }
                // line 54
                echo "
            ";
                // line 55
                if ((array_key_exists("last", $context) && ((isset($context["current"]) ? $context["current"] : $this->getContext($context, "current")) != (isset($context["last"]) ? $context["last"] : $this->getContext($context, "last"))))) {
                    // line 56
                    echo "                <li><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["route"]) ? $context["route"] : $this->getContext($context, "route")), twig_array_merge((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), array((isset($context["pageParameterName"]) ? $context["pageParameterName"] : $this->getContext($context, "pageParameterName")) => (isset($context["last"]) ? $context["last"] : $this->getContext($context, "last"))))), "html", null, true);
                    echo "\">";
                    echo (isset($context["last_label"]) ? $context["last_label"] : $this->getContext($context, "last_label"));
                    echo "</a></li>
            ";
                }
                // line 58
                echo "            </ul>
        </div>
    ";
            } else {
                // line 61
                echo "        ";
                if ((!array_key_exists("aligned", $context))) {
                    // line 62
                    echo "            ";
                    $context["aligned"] = false;
                    // line 63
                    echo "        ";
                }
                // line 64
                echo "        <ul class=\"pager\">
            ";
                // line 65
                if (array_key_exists("previous", $context)) {
                    // line 66
                    echo "                <li";
                    if ((isset($context["aligned"]) ? $context["aligned"] : $this->getContext($context, "aligned"))) {
                        echo " class=\"previous\"";
                    }
                    echo "><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["route"]) ? $context["route"] : $this->getContext($context, "route")), twig_array_merge((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), array((isset($context["pageParameterName"]) ? $context["pageParameterName"] : $this->getContext($context, "pageParameterName")) => (isset($context["previous"]) ? $context["previous"] : $this->getContext($context, "previous"))))), "html", null, true);
                    echo "\">";
                    echo (isset($context["prev_label"]) ? $context["prev_label"] : $this->getContext($context, "prev_label"));
                    echo "</a></li>
            ";
                } else {
                    // line 68
                    echo "                <li class=\"disabled";
                    if ((isset($context["aligned"]) ? $context["aligned"] : $this->getContext($context, "aligned"))) {
                        echo " previous";
                    }
                    echo "\"><span>";
                    echo (isset($context["prev_label"]) ? $context["prev_label"] : $this->getContext($context, "prev_label"));
                    echo "</span></li>
            ";
                }
                // line 70
                echo "            ";
                if (array_key_exists("next", $context)) {
                    // line 71
                    echo "                <li";
                    if ((isset($context["aligned"]) ? $context["aligned"] : $this->getContext($context, "aligned"))) {
                        echo " class=\"next\"";
                    }
                    echo "><a href=\"";
                    echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath((isset($context["route"]) ? $context["route"] : $this->getContext($context, "route")), twig_array_merge((isset($context["query"]) ? $context["query"] : $this->getContext($context, "query")), array((isset($context["pageParameterName"]) ? $context["pageParameterName"] : $this->getContext($context, "pageParameterName")) => (isset($context["next"]) ? $context["next"] : $this->getContext($context, "next"))))), "html", null, true);
                    echo "\">";
                    echo (isset($context["next_label"]) ? $context["next_label"] : $this->getContext($context, "next_label"));
                    echo "</a></li>
            ";
                } else {
                    // line 73
                    echo "                <li class=\"disabled";
                    if ((isset($context["aligned"]) ? $context["aligned"] : $this->getContext($context, "aligned"))) {
                        echo " next";
                    }
                    echo "\"><span>";
                    echo (isset($context["next_label"]) ? $context["next_label"] : $this->getContext($context, "next_label"));
                    echo "</span></li>
            ";
                }
                // line 75
                echo "        </ul>
    ";
            }
        }
    }

    public function getTemplateName()
    {
        return "BcBootstrapBundle:Pagination:pagination.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  242 => 75,  232 => 73,  155 => 52,  465 => 1,  455 => 173,  445 => 171,  424 => 161,  401 => 155,  391 => 149,  375 => 141,  359 => 132,  352 => 129,  349 => 126,  326 => 109,  324 => 108,  319 => 105,  304 => 96,  300 => 93,  262 => 87,  257 => 84,  219 => 64,  216 => 63,  211 => 61,  188 => 51,  185 => 50,  153 => 51,  150 => 50,  110 => 21,  59 => 21,  1819 => 553,  1813 => 552,  1807 => 551,  1801 => 550,  1795 => 549,  1789 => 548,  1783 => 547,  1777 => 546,  1771 => 545,  1755 => 539,  1748 => 538,  1746 => 537,  1743 => 536,  1720 => 532,  1695 => 531,  1693 => 530,  1690 => 529,  1678 => 524,  1674 => 523,  1671 => 522,  1668 => 521,  1665 => 520,  1662 => 519,  1659 => 518,  1657 => 517,  1654 => 516,  1645 => 509,  1642 => 508,  1640 => 507,  1637 => 506,  1628 => 501,  1625 => 500,  1623 => 499,  1620 => 498,  1603 => 494,  1597 => 492,  1594 => 491,  1576 => 490,  1574 => 489,  1571 => 488,  1563 => 482,  1556 => 480,  1553 => 476,  1549 => 475,  1545 => 473,  1540 => 470,  1538 => 466,  1535 => 465,  1532 => 464,  1530 => 463,  1527 => 462,  1520 => 457,  1513 => 455,  1510 => 451,  1506 => 450,  1503 => 449,  1499 => 447,  1496 => 443,  1493 => 442,  1491 => 441,  1488 => 440,  1480 => 436,  1478 => 435,  1475 => 434,  1468 => 429,  1465 => 428,  1458 => 424,  1453 => 423,  1451 => 422,  1448 => 421,  1439 => 415,  1435 => 414,  1431 => 412,  1429 => 411,  1426 => 410,  1418 => 405,  1413 => 404,  1407 => 402,  1404 => 401,  1402 => 397,  1400 => 396,  1397 => 395,  1388 => 389,  1384 => 388,  1379 => 386,  1368 => 385,  1366 => 384,  1363 => 383,  1356 => 380,  1353 => 379,  1345 => 374,  1341 => 373,  1336 => 372,  1330 => 370,  1324 => 368,  1321 => 367,  1319 => 366,  1316 => 365,  1308 => 361,  1306 => 357,  1304 => 356,  1301 => 355,  1276 => 347,  1272 => 345,  1269 => 344,  1266 => 343,  1263 => 342,  1260 => 341,  1257 => 340,  1254 => 339,  1251 => 338,  1248 => 337,  1242 => 335,  1239 => 334,  1236 => 333,  1234 => 332,  1206 => 326,  1202 => 324,  1199 => 323,  1193 => 321,  1190 => 320,  1187 => 319,  1178 => 316,  1175 => 315,  1172 => 314,  1169 => 313,  1166 => 312,  1164 => 311,  1140 => 306,  1134 => 304,  1131 => 303,  1128 => 302,  1125 => 301,  1122 => 300,  1119 => 299,  1116 => 298,  1113 => 297,  1110 => 296,  1107 => 295,  1104 => 294,  1088 => 285,  1086 => 284,  1083 => 283,  1072 => 278,  1059 => 272,  1056 => 271,  1054 => 270,  1051 => 269,  1038 => 263,  1035 => 262,  1027 => 258,  1024 => 257,  1021 => 256,  1019 => 255,  1016 => 254,  1003 => 248,  990 => 242,  987 => 241,  979 => 237,  976 => 236,  974 => 235,  956 => 227,  953 => 226,  938 => 220,  933 => 219,  909 => 207,  908 => 206,  907 => 205,  906 => 204,  901 => 203,  895 => 201,  892 => 200,  887 => 198,  878 => 192,  866 => 189,  855 => 186,  852 => 185,  850 => 184,  847 => 183,  831 => 179,  788 => 167,  767 => 161,  762 => 160,  759 => 159,  741 => 158,  739 => 157,  736 => 156,  727 => 151,  721 => 149,  715 => 147,  713 => 146,  705 => 144,  696 => 141,  686 => 139,  684 => 138,  681 => 137,  664 => 131,  661 => 130,  659 => 129,  647 => 123,  641 => 121,  638 => 120,  633 => 118,  623 => 114,  621 => 113,  618 => 112,  607 => 107,  604 => 106,  601 => 105,  599 => 104,  596 => 103,  588 => 98,  583 => 97,  577 => 95,  575 => 94,  570 => 93,  568 => 92,  565 => 91,  558 => 86,  552 => 84,  544 => 81,  538 => 79,  535 => 78,  533 => 77,  516 => 69,  514 => 68,  493 => 60,  491 => 59,  481 => 53,  475 => 51,  467 => 48,  458 => 45,  447 => 41,  441 => 39,  439 => 38,  418 => 159,  395 => 151,  389 => 21,  383 => 145,  357 => 8,  351 => 6,  348 => 5,  346 => 4,  343 => 3,  339 => 119,  333 => 550,  331 => 112,  327 => 547,  325 => 546,  320 => 544,  317 => 542,  315 => 536,  310 => 529,  307 => 97,  302 => 515,  297 => 506,  289 => 497,  284 => 487,  282 => 462,  279 => 461,  277 => 440,  274 => 439,  261 => 427,  259 => 85,  251 => 409,  249 => 395,  239 => 379,  234 => 365,  172 => 241,  167 => 234,  152 => 198,  137 => 46,  127 => 137,  77 => 3,  23 => 8,  20 => 1,  1357 => 388,  1348 => 387,  1346 => 386,  1343 => 385,  1327 => 381,  1320 => 380,  1318 => 379,  1315 => 378,  1292 => 348,  1267 => 373,  1265 => 372,  1262 => 371,  1250 => 366,  1245 => 336,  1243 => 364,  1240 => 363,  1231 => 331,  1225 => 355,  1222 => 327,  1217 => 353,  1215 => 352,  1212 => 351,  1205 => 346,  1196 => 322,  1192 => 343,  1189 => 342,  1186 => 341,  1184 => 318,  1181 => 317,  1171 => 334,  1168 => 333,  1162 => 329,  1156 => 327,  1153 => 326,  1151 => 325,  1148 => 324,  1139 => 319,  1137 => 305,  1114 => 317,  1111 => 316,  1108 => 315,  1105 => 314,  1102 => 293,  1099 => 292,  1096 => 311,  1094 => 310,  1091 => 286,  1084 => 305,  1080 => 304,  1075 => 279,  1073 => 302,  1070 => 277,  1063 => 296,  1060 => 295,  1052 => 290,  1049 => 289,  1047 => 288,  1044 => 287,  1036 => 282,  1032 => 281,  1028 => 280,  1023 => 278,  1020 => 277,  1010 => 269,  1008 => 250,  1000 => 247,  978 => 258,  975 => 257,  972 => 256,  969 => 255,  966 => 254,  963 => 230,  960 => 229,  957 => 251,  954 => 250,  951 => 249,  948 => 248,  943 => 246,  935 => 240,  932 => 239,  930 => 238,  927 => 217,  916 => 232,  914 => 231,  911 => 208,  899 => 226,  896 => 225,  893 => 224,  890 => 199,  877 => 217,  874 => 191,  872 => 215,  869 => 214,  861 => 188,  858 => 209,  856 => 208,  853 => 207,  845 => 203,  842 => 202,  840 => 201,  837 => 200,  829 => 178,  826 => 177,  824 => 194,  821 => 193,  813 => 189,  810 => 173,  808 => 172,  805 => 171,  797 => 182,  794 => 181,  792 => 180,  789 => 179,  781 => 175,  779 => 174,  776 => 165,  768 => 169,  765 => 168,  763 => 167,  760 => 166,  752 => 162,  749 => 161,  747 => 160,  735 => 153,  725 => 152,  720 => 151,  717 => 150,  711 => 148,  708 => 145,  706 => 146,  703 => 145,  695 => 139,  693 => 138,  692 => 137,  691 => 136,  690 => 135,  679 => 132,  676 => 131,  674 => 130,  671 => 129,  658 => 122,  654 => 121,  650 => 120,  645 => 119,  636 => 119,  634 => 115,  615 => 110,  610 => 108,  594 => 104,  589 => 102,  572 => 98,  560 => 96,  553 => 93,  551 => 92,  546 => 82,  543 => 90,  525 => 74,  511 => 67,  508 => 81,  505 => 65,  499 => 63,  492 => 76,  489 => 75,  486 => 74,  471 => 72,  459 => 69,  456 => 44,  442 => 62,  433 => 35,  428 => 59,  426 => 58,  414 => 52,  408 => 50,  403 => 48,  400 => 47,  390 => 43,  388 => 42,  385 => 41,  377 => 142,  371 => 138,  366 => 13,  363 => 134,  344 => 122,  335 => 551,  332 => 20,  313 => 101,  308 => 13,  299 => 513,  293 => 6,  288 => 4,  281 => 89,  276 => 378,  273 => 377,  271 => 371,  266 => 431,  263 => 362,  255 => 82,  253 => 81,  245 => 332,  243 => 324,  240 => 323,  230 => 300,  227 => 298,  225 => 295,  222 => 351,  217 => 70,  212 => 309,  207 => 68,  204 => 289,  194 => 275,  191 => 52,  186 => 236,  181 => 61,  113 => 33,  102 => 91,  100 => 28,  97 => 74,  34 => 9,  14 => 1,  1191 => 330,  1185 => 329,  1179 => 328,  1173 => 335,  1167 => 326,  1161 => 310,  1155 => 324,  1149 => 323,  1143 => 322,  1127 => 316,  1120 => 315,  1118 => 314,  1115 => 313,  1092 => 309,  1067 => 276,  1065 => 307,  1062 => 306,  1050 => 301,  1045 => 300,  1043 => 265,  1040 => 264,  1031 => 292,  1025 => 279,  1022 => 289,  1017 => 288,  1015 => 287,  1012 => 273,  1005 => 249,  996 => 279,  992 => 243,  989 => 277,  986 => 276,  984 => 275,  981 => 274,  973 => 270,  971 => 234,  968 => 268,  961 => 263,  958 => 228,  950 => 257,  946 => 221,  942 => 255,  939 => 254,  937 => 253,  934 => 252,  926 => 248,  924 => 216,  922 => 215,  919 => 214,  897 => 235,  894 => 234,  891 => 233,  888 => 222,  885 => 221,  882 => 230,  879 => 229,  876 => 228,  873 => 227,  870 => 190,  867 => 225,  865 => 224,  862 => 223,  854 => 217,  851 => 216,  849 => 215,  846 => 214,  838 => 210,  835 => 209,  833 => 208,  830 => 207,  822 => 203,  819 => 202,  817 => 201,  814 => 200,  806 => 196,  803 => 195,  801 => 194,  798 => 193,  790 => 189,  787 => 188,  785 => 187,  782 => 186,  774 => 182,  771 => 181,  769 => 162,  766 => 179,  758 => 175,  756 => 174,  753 => 173,  745 => 159,  742 => 158,  740 => 167,  737 => 166,  729 => 162,  726 => 161,  724 => 150,  722 => 159,  719 => 158,  712 => 153,  702 => 143,  697 => 151,  694 => 140,  688 => 148,  685 => 134,  683 => 146,  680 => 145,  672 => 139,  670 => 138,  669 => 132,  668 => 136,  667 => 135,  662 => 123,  656 => 128,  653 => 131,  651 => 130,  648 => 129,  639 => 117,  635 => 122,  631 => 114,  627 => 120,  622 => 119,  616 => 117,  613 => 109,  611 => 115,  608 => 114,  592 => 103,  590 => 109,  587 => 108,  571 => 104,  569 => 103,  566 => 102,  549 => 98,  537 => 96,  530 => 76,  528 => 75,  523 => 88,  520 => 87,  502 => 89,  500 => 88,  497 => 62,  488 => 58,  485 => 81,  482 => 4,  476 => 2,  466 => 75,  463 => 74,  450 => 64,  448 => 71,  438 => 69,  429 => 64,  421 => 160,  416 => 158,  412 => 26,  405 => 49,  382 => 48,  369 => 14,  367 => 136,  364 => 41,  356 => 130,  353 => 36,  350 => 26,  347 => 125,  345 => 33,  342 => 23,  334 => 114,  329 => 111,  323 => 545,  321 => 106,  316 => 103,  311 => 100,  295 => 16,  292 => 498,  290 => 5,  287 => 488,  272 => 434,  269 => 433,  267 => 4,  260 => 360,  256 => 420,  254 => 410,  250 => 79,  248 => 333,  244 => 383,  238 => 73,  236 => 72,  233 => 71,  231 => 364,  228 => 305,  226 => 354,  223 => 297,  218 => 286,  215 => 310,  213 => 62,  210 => 292,  205 => 267,  202 => 283,  200 => 55,  197 => 276,  195 => 66,  192 => 269,  190 => 64,  184 => 62,  179 => 48,  174 => 46,  161 => 199,  159 => 41,  146 => 178,  134 => 170,  129 => 44,  124 => 136,  104 => 102,  81 => 170,  76 => 27,  480 => 3,  474 => 77,  469 => 49,  461 => 46,  457 => 153,  453 => 43,  444 => 149,  440 => 167,  437 => 166,  435 => 36,  430 => 34,  427 => 162,  423 => 57,  413 => 157,  409 => 25,  407 => 59,  402 => 57,  398 => 129,  393 => 52,  387 => 147,  384 => 49,  381 => 144,  379 => 143,  374 => 16,  368 => 34,  365 => 111,  362 => 110,  360 => 109,  355 => 27,  341 => 120,  337 => 117,  322 => 101,  314 => 21,  312 => 535,  309 => 99,  305 => 516,  298 => 92,  294 => 505,  285 => 3,  283 => 88,  278 => 384,  268 => 370,  264 => 88,  258 => 351,  252 => 326,  247 => 78,  241 => 74,  235 => 308,  229 => 355,  224 => 65,  220 => 71,  214 => 69,  208 => 60,  169 => 240,  143 => 48,  140 => 55,  132 => 156,  128 => 30,  119 => 41,  107 => 103,  71 => 156,  177 => 247,  165 => 43,  160 => 61,  135 => 47,  126 => 43,  114 => 117,  84 => 171,  70 => 25,  67 => 24,  61 => 22,  38 => 4,  94 => 73,  89 => 173,  85 => 30,  75 => 23,  68 => 14,  56 => 78,  87 => 34,  21 => 1,  26 => 2,  93 => 9,  88 => 31,  78 => 21,  46 => 59,  27 => 4,  44 => 29,  31 => 7,  28 => 6,  201 => 92,  196 => 54,  183 => 70,  171 => 45,  166 => 55,  163 => 54,  158 => 67,  156 => 40,  151 => 185,  142 => 177,  138 => 34,  136 => 33,  121 => 26,  117 => 118,  105 => 15,  91 => 32,  62 => 23,  49 => 16,  24 => 4,  25 => 3,  19 => 2,  79 => 28,  72 => 16,  69 => 155,  47 => 27,  40 => 8,  37 => 10,  22 => 3,  246 => 394,  157 => 214,  145 => 46,  139 => 176,  131 => 157,  123 => 47,  120 => 37,  115 => 43,  111 => 39,  108 => 20,  101 => 86,  98 => 35,  96 => 34,  83 => 25,  74 => 157,  66 => 154,  55 => 19,  52 => 21,  50 => 10,  43 => 13,  41 => 28,  35 => 3,  32 => 2,  29 => 3,  209 => 82,  203 => 78,  199 => 282,  193 => 65,  189 => 268,  187 => 63,  182 => 49,  176 => 58,  173 => 74,  168 => 56,  164 => 233,  162 => 42,  154 => 213,  149 => 197,  147 => 37,  144 => 36,  141 => 35,  133 => 32,  130 => 31,  125 => 29,  122 => 42,  116 => 24,  112 => 22,  109 => 38,  106 => 37,  103 => 37,  99 => 90,  95 => 34,  92 => 58,  86 => 172,  82 => 29,  80 => 19,  73 => 26,  64 => 23,  60 => 14,  57 => 13,  54 => 71,  51 => 17,  48 => 13,  45 => 14,  42 => 17,  39 => 11,  36 => 14,  33 => 8,  30 => 1,);
    }
}
