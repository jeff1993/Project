<?php

/* WebProfilerBundle:Profiler:toolbar.css.twig */
class __TwigTemplate_c08a92021551e2661796b4edad89c4cc extends Twig_Template
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
        echo ".sf-minitoolbar {
    display: none;

    position: fixed;
    bottom: 0;
    right: 0;

    padding: 5px 5px 0;

    background-color: #f7f7f7;
    background-image: -moz-linear-gradient(top, #e4e4e4, #ffffff);
    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#e4e4e4), to(#ffffff));
    background-image: -o-linear-gradient(top, #e4e4e4, #ffffff);
    background: linear-gradient(top, #e4e4e4, #ffffff);

    border-radius: 16px 0 0 0;

    z-index: 6000000;
}

.sf-toolbarreset {
    position: fixed;
    background-color: #f7f7f7;
    left: 0;
    right: 0;
    height: 38px;
    margin: 0;
    padding: 0 40px 0 0;
    z-index: 6000000;
    font: 11px Verdana, Arial, sans-serif;
    text-align: left;
    color: #2f2f2f;

    background-image: -moz-linear-gradient(top, #e4e4e4, #ffffff);
    background-image: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#e4e4e4), to(#ffffff));
    background-image: -o-linear-gradient(top, #e4e4e4, #ffffff);
    background: linear-gradient(top, #e4e4e4, #ffffff);

    bottom: 0;
    border-top: 1px solid #bbb;
}
.sf-toolbarreset abbr {
    border-bottom: 1px dotted #000000;
    cursor: help;
}
.sf-toolbarreset span,
.sf-toolbarreset div {
    font-size: 11px;
}
.sf-toolbarreset img {
    width: auto;
    display: inline;
}

.sf-toolbarreset .hide-button {
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    width: 40px;
    height: 40px;
    cursor: pointer;
    background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAMAAAAMCGV4AAAAllBMVEXDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PDw8PExMTPz8/Q0NDR0dHT09Pb29vc3Nzf39/h4eHi4uLj4+P6+vr7+/v8/Pz9/f3///+Nh2QuAAAAIXRSTlMABgwPGBswMzk8QktRV4SKjZOWmaKlq7TAxszb3urt+fy1vNEpAAAAiklEQVQIHUXBBxKCQBREwRFzDqjoGh+C2YV//8u5Sll2S0E/dof1tKdKM6GyqCto7PjZRJIS/mbSELgXOSd/BzpKIH1ZefVWpDDTHsi8mZVnwImPi5ndCLbaAZk3M58Bay0h9VbeSvMpjDUAHj4jL55AW1rxN5fU2PLjIgVRzNdxVFOlGzvnJi0Fb1XNGBHA9uQOAAAAAElFTkSuQmCC');
    background-repeat: no-repeat;
    background-position: 13px 11px;
}

.sf-toolbar-block {
    white-space: nowrap;
    color: #2f2f2f;
    display: block;
    min-height: 28px;
    border-right: 1px solid #e4e4e4;
    padding: 0;
    float: left;
    cursor: default;
}

.sf-toolbar-block span {
    display: inline-block;
}

.sf-toolbar-block .sf-toolbar-info-piece {
    line-height: 19px;
    margin-bottom: 5px;
}

.sf-toolbar-block .sf-toolbar-info-piece .sf-toolbar-status {
    padding: 0px 5px;
    border-radius: 5px;
    margin-bottom: 0px;
    vertical-align: top;
}

.sf-toolbar-block .sf-toolbar-info-piece:last-child {
    margin-bottom: 0;
}

.sf-toolbar-block .sf-toolbar-info-piece a,
.sf-toolbar-block .sf-toolbar-info-piece abbr {
    color: #2f2f2f;
}

.sf-toolbar-block .sf-toolbar-info-piece b {
    display: inline-block;
    width: 110px;
    vertical-align: top;
}

.sf-toolbar-block .sf-toolbar-info-with-next-pointer:after {
    content: ' :: ';
    color: #999;
}

.sf-toolbar-block .sf-toolbar-info-with-delimiter {
    border-right: 1px solid #999;
    padding-right: 5px;
    margin-right: 5px;
}

.sf-toolbar-block .sf-toolbar-info {
    display: none;
    position: absolute;
    background-color: #fff;
    border: 1px solid #bbb;
    padding: 9px 0;
    margin-left: -1px;

    bottom: 38px;
    border-bottom-width: 0;
    border-bottom: 1px solid #bbb;
    border-radius: 4px 4px 0 0;
}

.sf-toolbarreset > div:last-of-type .sf-toolbar-info {
    right: -1px;
}

.sf-toolbar-block .sf-toolbar-info:empty {
    visibility: hidden;
}

.sf-toolbar-block .sf-toolbar-status {
    display: inline-block;
    color: #fff;
    background-color: #666;
    padding: 3px 6px;
    border-radius: 3px;
    margin-bottom: 2px;
    vertical-align: middle;
    min-width: 6px;
    min-height: 13px;
}

.sf-toolbar-block .sf-toolbar-status abbr {
    color: #fff;
    border-bottom: 1px dotted black;
}

.sf-toolbar-block .sf-toolbar-status-green {
    background-color: #759e1a;
}

.sf-toolbar-block .sf-toolbar-status-red {
    background-color: #a33;
}

.sf-toolbar-block .sf-toolbar-status-yellow {
    background-color: #ffcc00;
    color: #000;
}

.sf-toolbar-block .sf-toolbar-status-black {
    background-color: #000;
}

.sf-toolbar-block .sf-toolbar-icon {
    display: block;
}

.sf-toolbar-block .sf-toolbar-icon > a,
.sf-toolbar-block .sf-toolbar-icon > span {
    display: block;
    text-decoration: none;
    margin: 0;
    padding: 5px 8px;
    min-width: 20px;
    text-align: center;
    vertical-align: middle;
}

.sf-toolbar-block .sf-toolbar-icon > a,
.sf-toolbar-block .sf-toolbar-icon > a:link
.sf-toolbar-block .sf-toolbar-icon > a:hover {
    color: black !important;
}

.sf-toolbar-block .sf-toolbar-icon img {
    border-width: 0;
    vertical-align: middle;
}

.sf-toolbar-block .sf-toolbar-icon img + span {
    margin-left: 5px;
    margin-top: 2px;
}

.sf-toolbar-block .sf-toolbar-icon .sf-toolbar-status {
    border-radius: 12px;
    border-bottom-left-radius: 0;
    margin-top: 0;
}

.sf-toolbar-block .sf-toolbar-info-method {
    border-bottom: 1px dashed #ccc;
    cursor: help;
}

.sf-toolbar-block .sf-toolbar-info-method[onclick=\"\"] {
    border-bottom: none;
    cursor: inherit;
}

.sf-toolbar-info-php {}
.sf-toolbar-info-php-ext {}

.sf-toolbar-info-php-ext .sf-toolbar-status {
    margin-left: 2px;
}

.sf-toolbar-info-php-ext .sf-toolbar-status:first-child {
    margin-left: 0;
}

.sf-toolbar-block a .sf-toolbar-info-piece-additional,
.sf-toolbar-block a .sf-toolbar-info-piece-additional-detail {
    display: inline-block;
}

.sf-toolbar-block a .sf-toolbar-info-piece-additional:empty,
.sf-toolbar-block a .sf-toolbar-info-piece-additional-detail:empty {
    display: none;
}

.sf-toolbarreset:hover {
    box-shadow: rgba(0, 0, 0, 0.3) 0 0 50px;
}

.sf-toolbar-block:hover {
    box-shadow: rgba(0, 0, 0, 0.35) 0 0 5px;
    border-right: none;
    margin-right: 1px;
    position: relative;
}

.sf-toolbar-block:hover .sf-toolbar-icon {
    background-color: #fff;
    border-top: 1px dotted #DDD;
    position: relative;
    margin-top: -1px;
    z-index: 10002;
}

.sf-toolbar-block:hover .sf-toolbar-info {
    display: block;
    min-width: -webkit-calc(100% + 2px);
    min-width: calc(100% + 2px);
    z-index: 10001;
    box-sizing: border-box;
    padding: 9px;
    line-height: 19px;
}

/***** Override the setting when the toolbar is on the top *****/
";
        // line 275
        if (((isset($context["position"]) ? $context["position"] : $this->getContext($context, "position")) == "top")) {
            // line 276
            echo "    .sf-minitoolbar {
        top: 0;
        bottom: auto;
        right: 0;

        background-color: #f7f7f7;

        background-image: -moz-linear-gradient(225deg, #e4e4e4, #ffffff);
        background-image: -webkit-gradient(linear, 100% 0%, 0% 0%, from(#e4e4e4), to(#ffffff));
        background-image: -o-linear-gradient(135deg, #e4e4e4, #ffffff);
        background: linear-gradient(225deg, #e4e4e4, #ffffff);

        border-radius: 0 0 0 16px;
    }

    .sf-toolbarreset {
        background-image: -moz-linear-gradient(225deg, #e4e4e4, #ffffff);
        background-image: -webkit-gradient(linear, 100% 0%, 0% 0%, from(#e4e4e4), to(#ffffff));
        background-image: -o-linear-gradient(135deg, #e4e4e4, #ffffff);
        background: linear-gradient(225deg, #e4e4e4, #ffffff);

        top: 0;
        bottom: auto;
        border-bottom: 1px solid #bbb;
    }

    .sf-toolbar-block .sf-toolbar-info {
        top: 39px;
        bottom: auto;
        border-top-width: 0;
        border-radius: 0 0 4px 4px;
    }

    .sf-toolbar-block:hover .sf-toolbar-icon {
        border-top: none;
        border-bottom: 1px dotted #DDD;
        margin-top: 0;
        margin-bottom: -1px;
    }
";
        }
        // line 316
        echo "
";
        // line 317
        if ((!(isset($context["floatable"]) ? $context["floatable"] : $this->getContext($context, "floatable")))) {
            // line 318
            echo "    .sf-toolbarreset {
        position: static;
        background: #cbcbcb;

        background-image: -moz-linear-gradient(90deg, #cbcbcb, #e8e8e8); !important;
        background-image: -webkit-gradient(linear, 0% 0%, 100% 0%, from(#cbcbcb), to(#e8e8e8)); !important;
        background-image: -o-linear-gradient(180deg, #cbcbcb, #e8e8e8); !important;
        background: linear-gradient(90deg, #cbcbcb, #e8e8e8); !important;
    }
";
        }
        // line 328
        echo "
/***** Media query *****/
@media screen and (max-width: 779px) {
    .sf-toolbar-block .sf-toolbar-icon > * > :first-child ~ * {
        display: none;
    }

    .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional,
    .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional-detail {
        display: none !important;
    }
}

@media screen and (min-width: 880px) {
    .sf-toolbar-block .sf-toolbar-icon a[href\$=\"config\"] .sf-toolbar-info-piece-additional {
        display: inline-block;
    }
}

@media screen and (min-width: 980px) {
    .sf-toolbar-block .sf-toolbar-icon a[href\$=\"security\"] .sf-toolbar-info-piece-additional {
        display: inline-block;
    }
}

@media screen and (max-width: 1179px) {
    .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional {
        display: none;
    }
}

@media screen and (max-width: 1439px) {
    .sf-toolbar-block .sf-toolbar-icon > * > .sf-toolbar-info-piece-additional-detail {
        display: none;
    }
}
";
    }

    public function getTemplateName()
    {
        return "WebProfilerBundle:Profiler:toolbar.css.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 11,  784 => 482,  723 => 473,  698 => 469,  682 => 465,  678 => 464,  675 => 463,  673 => 462,  630 => 455,  625 => 453,  602 => 449,  547 => 411,  527 => 409,  515 => 404,  386 => 159,  378 => 157,  358 => 151,  340 => 145,  328 => 139,  296 => 121,  170 => 84,  318 => 111,  306 => 107,  291 => 102,  265 => 105,  58 => 18,  63 => 21,  175 => 58,  118 => 49,  462 => 202,  449 => 198,  446 => 197,  431 => 189,  422 => 184,  415 => 180,  394 => 168,  380 => 158,  373 => 156,  361 => 152,  338 => 135,  303 => 106,  286 => 112,  275 => 105,  270 => 102,  178 => 59,  90 => 42,  53 => 15,  242 => 75,  232 => 88,  155 => 47,  465 => 1,  455 => 173,  445 => 171,  424 => 161,  401 => 172,  391 => 149,  375 => 141,  359 => 132,  352 => 129,  349 => 126,  326 => 138,  324 => 113,  319 => 105,  304 => 96,  300 => 105,  262 => 98,  257 => 84,  219 => 64,  216 => 79,  211 => 61,  188 => 90,  185 => 74,  153 => 77,  150 => 55,  110 => 21,  59 => 16,  1819 => 553,  1813 => 552,  1807 => 551,  1801 => 550,  1795 => 549,  1789 => 548,  1783 => 547,  1777 => 546,  1771 => 545,  1755 => 539,  1748 => 538,  1746 => 537,  1743 => 536,  1720 => 532,  1695 => 531,  1693 => 530,  1690 => 529,  1678 => 524,  1674 => 523,  1671 => 522,  1668 => 521,  1665 => 520,  1662 => 519,  1659 => 518,  1657 => 517,  1654 => 516,  1645 => 509,  1642 => 508,  1640 => 507,  1637 => 506,  1628 => 501,  1625 => 500,  1623 => 499,  1620 => 498,  1603 => 494,  1597 => 492,  1594 => 491,  1576 => 490,  1574 => 489,  1571 => 488,  1563 => 482,  1556 => 480,  1553 => 476,  1549 => 475,  1545 => 473,  1540 => 470,  1538 => 466,  1535 => 465,  1532 => 464,  1530 => 463,  1527 => 462,  1520 => 457,  1513 => 455,  1510 => 451,  1506 => 450,  1503 => 449,  1499 => 447,  1496 => 443,  1493 => 442,  1491 => 441,  1488 => 440,  1480 => 436,  1478 => 435,  1475 => 434,  1468 => 429,  1465 => 428,  1458 => 424,  1453 => 423,  1451 => 422,  1448 => 421,  1439 => 415,  1435 => 414,  1431 => 412,  1429 => 411,  1426 => 410,  1418 => 405,  1413 => 404,  1407 => 402,  1404 => 401,  1402 => 397,  1400 => 396,  1397 => 395,  1388 => 389,  1384 => 388,  1379 => 386,  1368 => 385,  1366 => 384,  1363 => 383,  1356 => 380,  1353 => 379,  1345 => 374,  1341 => 373,  1336 => 372,  1330 => 370,  1324 => 368,  1321 => 367,  1319 => 366,  1316 => 365,  1308 => 361,  1306 => 357,  1304 => 356,  1301 => 355,  1276 => 347,  1272 => 345,  1269 => 344,  1266 => 343,  1263 => 342,  1260 => 341,  1257 => 340,  1254 => 339,  1251 => 338,  1248 => 337,  1242 => 335,  1239 => 334,  1236 => 333,  1234 => 332,  1206 => 326,  1202 => 324,  1199 => 323,  1193 => 321,  1190 => 320,  1187 => 319,  1178 => 316,  1175 => 315,  1172 => 314,  1169 => 313,  1166 => 312,  1164 => 311,  1140 => 306,  1134 => 304,  1131 => 303,  1128 => 302,  1125 => 301,  1122 => 300,  1119 => 299,  1116 => 298,  1113 => 297,  1110 => 296,  1107 => 295,  1104 => 294,  1088 => 285,  1086 => 284,  1083 => 283,  1072 => 278,  1059 => 272,  1056 => 271,  1054 => 270,  1051 => 269,  1038 => 263,  1035 => 262,  1027 => 258,  1024 => 257,  1021 => 256,  1019 => 255,  1016 => 254,  1003 => 248,  990 => 242,  987 => 241,  979 => 237,  976 => 236,  974 => 235,  956 => 227,  953 => 226,  938 => 220,  933 => 219,  909 => 207,  908 => 206,  907 => 205,  906 => 204,  901 => 203,  895 => 201,  892 => 200,  887 => 198,  878 => 192,  866 => 189,  855 => 186,  852 => 185,  850 => 184,  847 => 183,  831 => 179,  788 => 484,  767 => 161,  762 => 160,  759 => 159,  741 => 158,  739 => 157,  736 => 156,  727 => 151,  721 => 149,  715 => 147,  713 => 146,  705 => 144,  696 => 141,  686 => 466,  684 => 138,  681 => 137,  664 => 131,  661 => 130,  659 => 129,  647 => 123,  641 => 121,  638 => 120,  633 => 118,  623 => 114,  621 => 452,  618 => 451,  607 => 107,  604 => 106,  601 => 105,  599 => 104,  596 => 103,  588 => 98,  583 => 97,  577 => 95,  575 => 94,  570 => 93,  568 => 92,  565 => 414,  558 => 86,  552 => 84,  544 => 81,  538 => 79,  535 => 78,  533 => 77,  516 => 69,  514 => 68,  493 => 60,  491 => 59,  481 => 53,  475 => 51,  467 => 48,  458 => 45,  447 => 41,  441 => 196,  439 => 195,  418 => 159,  395 => 151,  389 => 160,  383 => 145,  357 => 123,  351 => 120,  348 => 140,  346 => 4,  343 => 146,  339 => 316,  333 => 550,  331 => 140,  327 => 114,  325 => 129,  320 => 127,  317 => 542,  315 => 131,  310 => 529,  307 => 128,  302 => 125,  297 => 276,  289 => 113,  284 => 487,  282 => 462,  279 => 461,  277 => 440,  274 => 110,  261 => 427,  259 => 103,  251 => 409,  249 => 395,  239 => 379,  234 => 365,  172 => 57,  167 => 234,  152 => 46,  137 => 46,  127 => 35,  77 => 3,  23 => 8,  20 => 1,  1357 => 388,  1348 => 387,  1346 => 386,  1343 => 385,  1327 => 381,  1320 => 380,  1318 => 379,  1315 => 378,  1292 => 348,  1267 => 373,  1265 => 372,  1262 => 371,  1250 => 366,  1245 => 336,  1243 => 364,  1240 => 363,  1231 => 331,  1225 => 355,  1222 => 327,  1217 => 353,  1215 => 352,  1212 => 351,  1205 => 346,  1196 => 322,  1192 => 343,  1189 => 342,  1186 => 341,  1184 => 318,  1181 => 317,  1171 => 334,  1168 => 333,  1162 => 329,  1156 => 327,  1153 => 326,  1151 => 325,  1148 => 324,  1139 => 319,  1137 => 305,  1114 => 317,  1111 => 316,  1108 => 315,  1105 => 314,  1102 => 293,  1099 => 292,  1096 => 311,  1094 => 310,  1091 => 286,  1084 => 305,  1080 => 304,  1075 => 279,  1073 => 302,  1070 => 277,  1063 => 296,  1060 => 295,  1052 => 290,  1049 => 289,  1047 => 288,  1044 => 287,  1036 => 282,  1032 => 281,  1028 => 280,  1023 => 278,  1020 => 277,  1010 => 269,  1008 => 250,  1000 => 247,  978 => 258,  975 => 257,  972 => 256,  969 => 255,  966 => 254,  963 => 230,  960 => 229,  957 => 251,  954 => 250,  951 => 249,  948 => 248,  943 => 246,  935 => 240,  932 => 239,  930 => 238,  927 => 217,  916 => 232,  914 => 231,  911 => 208,  899 => 226,  896 => 225,  893 => 224,  890 => 199,  877 => 217,  874 => 191,  872 => 215,  869 => 214,  861 => 188,  858 => 209,  856 => 208,  853 => 207,  845 => 203,  842 => 202,  840 => 201,  837 => 200,  829 => 178,  826 => 177,  824 => 194,  821 => 193,  813 => 189,  810 => 173,  808 => 172,  805 => 171,  797 => 182,  794 => 181,  792 => 485,  789 => 179,  781 => 175,  779 => 174,  776 => 165,  768 => 169,  765 => 168,  763 => 167,  760 => 166,  752 => 162,  749 => 161,  747 => 160,  735 => 153,  725 => 152,  720 => 151,  717 => 150,  711 => 148,  708 => 145,  706 => 472,  703 => 145,  695 => 139,  693 => 138,  692 => 137,  691 => 136,  690 => 467,  679 => 132,  676 => 131,  674 => 130,  671 => 129,  658 => 122,  654 => 121,  650 => 120,  645 => 460,  636 => 119,  634 => 115,  615 => 110,  610 => 108,  594 => 104,  589 => 102,  572 => 98,  560 => 96,  553 => 93,  551 => 92,  546 => 82,  543 => 90,  525 => 408,  511 => 67,  508 => 81,  505 => 65,  499 => 63,  492 => 76,  489 => 75,  486 => 74,  471 => 72,  459 => 69,  456 => 44,  442 => 62,  433 => 35,  428 => 59,  426 => 58,  414 => 52,  408 => 176,  403 => 48,  400 => 47,  390 => 43,  388 => 42,  385 => 41,  377 => 142,  371 => 156,  366 => 13,  363 => 153,  344 => 318,  335 => 134,  332 => 116,  313 => 101,  308 => 13,  299 => 513,  293 => 120,  288 => 118,  281 => 114,  276 => 111,  273 => 377,  271 => 371,  266 => 431,  263 => 95,  255 => 101,  253 => 100,  245 => 332,  243 => 92,  240 => 323,  230 => 300,  227 => 86,  225 => 295,  222 => 83,  217 => 70,  212 => 78,  207 => 75,  204 => 289,  194 => 68,  191 => 67,  186 => 236,  181 => 65,  113 => 48,  102 => 33,  100 => 39,  97 => 74,  34 => 5,  14 => 1,  1191 => 330,  1185 => 329,  1179 => 328,  1173 => 335,  1167 => 326,  1161 => 310,  1155 => 324,  1149 => 323,  1143 => 322,  1127 => 316,  1120 => 315,  1118 => 314,  1115 => 313,  1092 => 309,  1067 => 276,  1065 => 307,  1062 => 306,  1050 => 301,  1045 => 300,  1043 => 265,  1040 => 264,  1031 => 292,  1025 => 279,  1022 => 289,  1017 => 288,  1015 => 287,  1012 => 273,  1005 => 249,  996 => 279,  992 => 243,  989 => 277,  986 => 276,  984 => 275,  981 => 274,  973 => 270,  971 => 234,  968 => 268,  961 => 263,  958 => 228,  950 => 257,  946 => 221,  942 => 255,  939 => 254,  937 => 253,  934 => 252,  926 => 248,  924 => 216,  922 => 215,  919 => 214,  897 => 235,  894 => 234,  891 => 233,  888 => 222,  885 => 221,  882 => 230,  879 => 229,  876 => 228,  873 => 227,  870 => 190,  867 => 225,  865 => 224,  862 => 223,  854 => 217,  851 => 216,  849 => 215,  846 => 214,  838 => 210,  835 => 209,  833 => 208,  830 => 207,  822 => 203,  819 => 202,  817 => 201,  814 => 200,  806 => 488,  803 => 487,  801 => 194,  798 => 193,  790 => 189,  787 => 188,  785 => 187,  782 => 186,  774 => 182,  771 => 481,  769 => 162,  766 => 179,  758 => 175,  756 => 174,  753 => 173,  745 => 476,  742 => 475,  740 => 167,  737 => 166,  729 => 162,  726 => 161,  724 => 150,  722 => 159,  719 => 158,  712 => 153,  702 => 470,  697 => 151,  694 => 468,  688 => 148,  685 => 134,  683 => 146,  680 => 145,  672 => 139,  670 => 138,  669 => 132,  668 => 136,  667 => 135,  662 => 123,  656 => 461,  653 => 131,  651 => 130,  648 => 129,  639 => 117,  635 => 122,  631 => 114,  627 => 120,  622 => 119,  616 => 450,  613 => 109,  611 => 115,  608 => 114,  592 => 103,  590 => 109,  587 => 108,  571 => 104,  569 => 103,  566 => 102,  549 => 98,  537 => 96,  530 => 410,  528 => 75,  523 => 88,  520 => 406,  502 => 89,  500 => 88,  497 => 62,  488 => 58,  485 => 81,  482 => 4,  476 => 2,  466 => 75,  463 => 74,  450 => 64,  448 => 71,  438 => 69,  429 => 188,  421 => 160,  416 => 158,  412 => 26,  405 => 49,  382 => 48,  369 => 14,  367 => 155,  364 => 41,  356 => 328,  353 => 149,  350 => 26,  347 => 125,  345 => 147,  342 => 317,  334 => 141,  329 => 131,  323 => 128,  321 => 135,  316 => 103,  311 => 100,  295 => 275,  292 => 498,  290 => 119,  287 => 488,  272 => 434,  269 => 107,  267 => 101,  260 => 360,  256 => 96,  254 => 410,  250 => 79,  248 => 97,  244 => 136,  238 => 73,  236 => 72,  233 => 87,  231 => 83,  228 => 305,  226 => 84,  223 => 297,  218 => 286,  215 => 310,  213 => 78,  210 => 77,  205 => 267,  202 => 77,  200 => 72,  197 => 69,  195 => 66,  192 => 269,  190 => 76,  184 => 63,  179 => 48,  174 => 65,  161 => 63,  159 => 41,  146 => 178,  134 => 39,  129 => 44,  124 => 136,  104 => 32,  81 => 23,  76 => 27,  480 => 3,  474 => 77,  469 => 49,  461 => 46,  457 => 153,  453 => 199,  444 => 149,  440 => 167,  437 => 166,  435 => 36,  430 => 34,  427 => 162,  423 => 57,  413 => 157,  409 => 25,  407 => 59,  402 => 57,  398 => 129,  393 => 52,  387 => 164,  384 => 49,  381 => 144,  379 => 143,  374 => 16,  368 => 34,  365 => 111,  362 => 110,  360 => 109,  355 => 150,  341 => 118,  337 => 117,  322 => 101,  314 => 21,  312 => 130,  309 => 129,  305 => 516,  298 => 120,  294 => 505,  285 => 3,  283 => 115,  278 => 98,  268 => 370,  264 => 88,  258 => 94,  252 => 326,  247 => 78,  241 => 93,  235 => 89,  229 => 87,  224 => 81,  220 => 81,  214 => 69,  208 => 76,  169 => 240,  143 => 51,  140 => 58,  132 => 156,  128 => 30,  119 => 40,  107 => 103,  71 => 23,  177 => 247,  165 => 83,  160 => 61,  135 => 47,  126 => 43,  114 => 117,  84 => 27,  70 => 24,  67 => 22,  61 => 12,  38 => 12,  94 => 21,  89 => 30,  85 => 23,  75 => 24,  68 => 12,  56 => 16,  87 => 32,  21 => 1,  26 => 6,  93 => 9,  88 => 25,  78 => 18,  46 => 13,  27 => 7,  44 => 11,  31 => 8,  28 => 3,  201 => 92,  196 => 92,  183 => 70,  171 => 45,  166 => 54,  163 => 82,  158 => 80,  156 => 62,  151 => 59,  142 => 177,  138 => 34,  136 => 71,  121 => 50,  117 => 39,  105 => 25,  91 => 33,  62 => 27,  49 => 14,  24 => 4,  25 => 3,  19 => 1,  79 => 18,  72 => 18,  69 => 17,  47 => 21,  40 => 8,  37 => 7,  22 => 3,  246 => 96,  157 => 214,  145 => 74,  139 => 49,  131 => 45,  123 => 61,  120 => 31,  115 => 43,  111 => 47,  108 => 20,  101 => 31,  98 => 34,  96 => 30,  83 => 31,  74 => 157,  66 => 154,  55 => 38,  52 => 12,  50 => 18,  43 => 12,  41 => 19,  35 => 9,  32 => 4,  29 => 3,  209 => 82,  203 => 73,  199 => 93,  193 => 65,  189 => 66,  187 => 75,  182 => 87,  176 => 86,  173 => 85,  168 => 61,  164 => 233,  162 => 59,  154 => 60,  149 => 197,  147 => 75,  144 => 42,  141 => 73,  133 => 32,  130 => 46,  125 => 42,  122 => 41,  116 => 57,  112 => 36,  109 => 52,  106 => 51,  103 => 37,  99 => 23,  95 => 34,  92 => 28,  86 => 172,  82 => 19,  80 => 27,  73 => 33,  64 => 21,  60 => 14,  57 => 20,  54 => 19,  51 => 37,  48 => 16,  45 => 9,  42 => 11,  39 => 10,  36 => 10,  33 => 9,  30 => 5,);
    }
}
