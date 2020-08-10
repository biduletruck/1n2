<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/users")
 */
class UsersController extends AbstractController
{

    private $players = array (
        0 =>
            array (
                'Ident;Password' => '5203878;2020',
            ),
        1 =>
            array (
                'Ident;Password' => '5203252;2020',
            ),
        2 =>
            array (
                'Ident;Password' => '5203583;2020',
            ),
        3 =>
            array (
                'Ident;Password' => '5203756;2020',
            ),
        4 =>
            array (
                'Ident;Password' => '5203249;2020',
            ),
        5 =>
            array (
                'Ident;Password' => '5203543;2020',
            ),
        6 =>
            array (
                'Ident;Password' => '5203752;2020',
            ),
        7 =>
            array (
                'Ident;Password' => '5203842;2020',
            ),
        8 =>
            array (
                'Ident;Password' => '5203839;2020',
            ),
        9 =>
            array (
                'Ident;Password' => '5203491;2020',
            ),
        10 =>
            array (
                'Ident;Password' => '5203852;2020',
            ),
        11 =>
            array (
                'Ident;Password' => '5203868;2020',
            ),
        12 =>
            array (
                'Ident;Password' => '5203854;2020',
            ),
        13 =>
            array (
                'Ident;Password' => '5203596;2020',
            ),
        14 =>
            array (
                'Ident;Password' => '5203590;2020',
            ),
        15 =>
            array (
                'Ident;Password' => '5203857;2020',
            ),
        16 =>
            array (
                'Ident;Password' => '5203851;2020',
            ),
        17 =>
            array (
                'Ident;Password' => '5203553;2020',
            ),
        18 =>
            array (
                'Ident;Password' => '5203749;2020',
            ),
        19 =>
            array (
                'Ident;Password' => '5203872;2020',
            ),
        20 =>
            array (
                'Ident;Password' => '5203855;2020',
            ),
        21 =>
            array (
                'Ident;Password' => '5203511;2020',
            ),
        22 =>
            array (
                'Ident;Password' => '5203246;2020',
            ),
        23 =>
            array (
                'Ident;Password' => '5203831;2020',
            ),
        24 =>
            array (
                'Ident;Password' => '5203496;2020',
            ),
        25 =>
            array (
                'Ident;Password' => '5203551;2020',
            ),
        26 =>
            array (
                'Ident;Password' => '5180260;2020',
            ),
        27 =>
            array (
                'Ident;Password' => '5203609;2020',
            ),
        28 =>
            array (
                'Ident;Password' => '5174065;2020',
            ),
        29 =>
            array (
                'Ident;Password' => '5200936;2020',
            ),
        30 =>
            array (
                'Ident;Password' => '5185146;2020',
            ),
        31 =>
            array (
                'Ident;Password' => '5200951;2020',
            ),
        32 =>
            array (
                'Ident;Password' => '5200962;2020',
            ),
        33 =>
            array (
                'Ident;Password' => '5201061;2020',
            ),
        34 =>
            array (
                'Ident;Password' => '5201089;2020',
            ),
        35 =>
            array (
                'Ident;Password' => '5201052;2020',
            ),
        36 =>
            array (
                'Ident;Password' => '5201046;2020',
            ),
        37 =>
            array (
                'Ident;Password' => '5201090;2020',
            ),
        38 =>
            array (
                'Ident;Password' => '5201088;2020',
            ),
        39 =>
            array (
                'Ident;Password' => '5201074;2020',
            ),
        40 =>
            array (
                'Ident;Password' => '5200950;2020',
            ),
        41 =>
            array (
                'Ident;Password' => '5200939;2020',
            ),
        42 =>
            array (
                'Ident;Password' => '5201012;2020',
            ),
        43 =>
            array (
                'Ident;Password' => '5200917;2020',
            ),
        44 =>
            array (
                'Ident;Password' => '5200964;2020',
            ),
        45 =>
            array (
                'Ident;Password' => '5201054;2020',
            ),
        46 =>
            array (
                'Ident;Password' => '5200943;2020',
            ),
        47 =>
            array (
                'Ident;Password' => '5200929;2020',
            ),
        48 =>
            array (
                'Ident;Password' => '5201086;2020',
            ),
        49 =>
            array (
                'Ident;Password' => '5200967;2020',
            ),
        50 =>
            array (
                'Ident;Password' => '5200918;2020',
            ),
        51 =>
            array (
                'Ident;Password' => '5201058;2020',
            ),
        52 =>
            array (
                'Ident;Password' => '5172006;2020',
            ),
        53 =>
            array (
                'Ident;Password' => '5200652;2020',
            ),
        54 =>
            array (
                'Ident;Password' => '5200640;2020',
            ),
        55 =>
            array (
                'Ident;Password' => '5200636;2020',
            ),
        56 =>
            array (
                'Ident;Password' => '5200639;2020',
            ),
        57 =>
            array (
                'Ident;Password' => '5200644;2020',
            ),
        58 =>
            array (
                'Ident;Password' => '5174066;2020',
            ),
        59 =>
            array (
                'Ident;Password' => '5198698;2020',
            ),
        60 =>
            array (
                'Ident;Password' => '5168767;2020',
            ),
        61 =>
            array (
                'Ident;Password' => '5198699;2020',
            ),
        62 =>
            array (
                'Ident;Password' => '5139306;2020',
            ),
        63 =>
            array (
                'Ident;Password' => '30029376;2020',
            ),
        64 =>
            array (
                'Ident;Password' => '5185148;2020',
            ),
        65 =>
            array (
                'Ident;Password' => '5198849;2020',
            ),
        66 =>
            array (
                'Ident;Password' => '5199364;2020',
            ),
        67 =>
            array (
                'Ident;Password' => '5198858;2020',
            ),
        68 =>
            array (
                'Ident;Password' => '5199363;2020',
            ),
        69 =>
            array (
                'Ident;Password' => '5198706;2020',
            ),
        70 =>
            array (
                'Ident;Password' => '5198856;2020',
            ),
        71 =>
            array (
                'Ident;Password' => '5198694;2020',
            ),
        72 =>
            array (
                'Ident;Password' => '5198853;2020',
            ),
        73 =>
            array (
                'Ident;Password' => '5198705;2020',
            ),
        74 =>
            array (
                'Ident;Password' => '5198671;2020',
            ),
        75 =>
            array (
                'Ident;Password' => '30029899;2020',
            ),
        76 =>
            array (
                'Ident;Password' => '5198842;2020',
            ),
        77 =>
            array (
                'Ident;Password' => '5185500;2020',
            ),
        78 =>
            array (
                'Ident;Password' => '5193134;2020',
            ),
        79 =>
            array (
                'Ident;Password' => '5187343;2020',
            ),
        80 =>
            array (
                'Ident;Password' => '5187345;2020',
            ),
        81 =>
            array (
                'Ident;Password' => '5187342;2020',
            ),
        82 =>
            array (
                'Ident;Password' => '5187341;2020',
            ),
        83 =>
            array (
                'Ident;Password' => '5187344;2020',
            ),
        84 =>
            array (
                'Ident;Password' => '5183173;2020',
            ),
        85 =>
            array (
                'Ident;Password' => '5174067;2020',
            ),
        86 =>
            array (
                'Ident;Password' => '5182649;2020',
            ),
        87 =>
            array (
                'Ident;Password' => '5183164;2020',
            ),
        88 =>
            array (
                'Ident;Password' => '5183149;2020',
            ),
        89 =>
            array (
                'Ident;Password' => '5183156;2020',
            ),
        90 =>
            array (
                'Ident;Password' => '5182659;2020',
            ),
        91 =>
            array (
                'Ident;Password' => '5182640;2020',
            ),
        92 =>
            array (
                'Ident;Password' => '5183166;2020',
            ),
        93 =>
            array (
                'Ident;Password' => '5178498;2020',
            ),
        94 =>
            array (
                'Ident;Password' => '5175719;2020',
            ),
        95 =>
            array (
                'Ident;Password' => '5175667;2020',
            ),
        96 =>
            array (
                'Ident;Password' => '5176076;2020',
            ),
        97 =>
            array (
                'Ident;Password' => '5175672;2020',
            ),
        98 =>
            array (
                'Ident;Password' => '5172011;2020',
            ),
        99 =>
            array (
                'Ident;Password' => '30029605;2020',
            ),
        100 =>
            array (
                'Ident;Password' => '5174724;2020',
            ),
        101 =>
            array (
                'Ident;Password' => '5174738;2020',
            ),
        102 =>
            array (
                'Ident;Password' => '5174746;2020',
            ),
        103 =>
            array (
                'Ident;Password' => '5174779;2020',
            ),
        104 =>
            array (
                'Ident;Password' => '5174593;2019',
            ),
        105 =>
            array (
                'Ident;Password' => '5174447;2019',
            ),
        106 =>
            array (
                'Ident;Password' => '5174451;2019',
            ),
        107 =>
            array (
                'Ident;Password' => '5174396;2019',
            ),
        108 =>
            array (
                'Ident;Password' => '5174450;2019',
            ),
        109 =>
            array (
                'Ident;Password' => '5174448;2019',
            ),
        110 =>
            array (
                'Ident;Password' => '5172895;2019',
            ),
        111 =>
            array (
                'Ident;Password' => '5172894;2019',
            ),
        112 =>
            array (
                'Ident;Password' => '5171920;2019',
            ),
        113 =>
            array (
                'Ident;Password' => '5171959;2019',
            ),
        114 =>
            array (
                'Ident;Password' => '5171953;2019',
            ),
        115 =>
            array (
                'Ident;Password' => '5171923;2019',
            ),
        116 =>
            array (
                'Ident;Password' => '5170449;2019',
            ),
        117 =>
            array (
                'Ident;Password' => '5170202;2019',
            ),
        118 =>
            array (
                'Ident;Password' => '5169993;2019',
            ),
        119 =>
            array (
                'Ident;Password' => '5170114;2019',
            ),
        120 =>
            array (
                'Ident;Password' => '5169996;2019',
            ),
        121 =>
            array (
                'Ident;Password' => '5170198;2019',
            ),
        122 =>
            array (
                'Ident;Password' => '5169960;2019',
            ),
        123 =>
            array (
                'Ident;Password' => '5170109;2019',
            ),
        124 =>
            array (
                'Ident;Password' => '5159427;2019',
            ),
        125 =>
            array (
                'Ident;Password' => '5154687;2019',
            ),
        126 =>
            array (
                'Ident;Password' => '5121513;2019',
            ),
        127 =>
            array (
                'Ident;Password' => '5121515;2019',
            ),
        128 =>
            array (
                'Ident;Password' => '5121508;2019',
            ),
        129 =>
            array (
                'Ident;Password' => '5143258;2019',
            ),
        130 =>
            array (
                'Ident;Password' => '5143246;2019',
            ),
        131 =>
            array (
                'Ident;Password' => '5139961;2019',
            ),
        132 =>
            array (
                'Ident;Password' => '5139738;2019',
            ),
        133 =>
            array (
                'Ident;Password' => '5138552;2019',
            ),
        134 =>
            array (
                'Ident;Password' => '5135136;2019',
            ),
        135 =>
            array (
                'Ident;Password' => '5127627;2019',
            ),
        136 =>
            array (
                'Ident;Password' => '5127624;2019',
            ),
        137 =>
            array (
                'Ident;Password' => '5127690;2019',
            ),
        138 =>
            array (
                'Ident;Password' => '5127623;2019',
            ),
        139 =>
            array (
                'Ident;Password' => '5125645;2019',
            ),
        140 =>
            array (
                'Ident;Password' => '30030118;2019',
            ),
        141 =>
            array (
                'Ident;Password' => '5121473;2019',
            ),
        142 =>
            array (
                'Ident;Password' => '60275;2018',
            ),
        143 =>
            array (
                'Ident;Password' => '2445;2013',
            ),
        144 =>
            array (
                'Ident;Password' => '4495;2013',
            ),
        145 =>
            array (
                'Ident;Password' => '30028031;2013',
            ),
        146 =>
            array (
                'Ident;Password' => '2965;2013',
            ),
        147 =>
            array (
                'Ident;Password' => '30026896;2013',
            ),
        148 =>
            array (
                'Ident;Password' => '30028105;2013',
            ),
        149 =>
            array (
                'Ident;Password' => '2544;2013',
            ),
        150 =>
            array (
                'Ident;Password' => '30028106;2013',
            ),
        151 =>
            array (
                'Ident;Password' => '30028717;2013',
            ),
        152 =>
            array (
                'Ident;Password' => '30028712;2013',
            ),
        153 =>
            array (
                'Ident;Password' => '3919;2012',
            ),
        154 =>
            array (
                'Ident;Password' => '30028465;2012',
            ),
        155 =>
            array (
                'Ident;Password' => '30028446;2012',
            ),
        156 =>
            array (
                'Ident;Password' => '30027992;2012',
            ),
        157 =>
            array (
                'Ident;Password' => '30027870;2011',
            ),
        158 =>
            array (
                'Ident;Password' => '30027957;2011',
            ),
        159 =>
            array (
                'Ident;Password' => '30025840;2011',
            ),
        160 =>
            array (
                'Ident;Password' => '30027829;2011',
            ),
        161 =>
            array (
                'Ident;Password' => '30027833;2011',
            ),
        162 =>
            array (
                'Ident;Password' => '30027815;2011',
            ),
        163 =>
            array (
                'Ident;Password' => '3091;2011',
            ),
        164 =>
            array (
                'Ident;Password' => '30027657;2011',
            ),
        165 =>
            array (
                'Ident;Password' => '30027743;2011',
            ),
        166 =>
            array (
                'Ident;Password' => '30027633;2011',
            ),
        167 =>
            array (
                'Ident;Password' => '30027639;2011',
            ),
        168 =>
            array (
                'Ident;Password' => '30027629;2011',
            ),
        169 =>
            array (
                'Ident;Password' => '30027604;2011',
            ),
        170 =>
            array (
                'Ident;Password' => '30027622;2011',
            ),
        171 =>
            array (
                'Ident;Password' => '30027614;2011',
            ),
        172 =>
            array (
                'Ident;Password' => '30027606;2011',
            ),
        173 =>
            array (
                'Ident;Password' => '2619;2011',
            ),
        174 =>
            array (
                'Ident;Password' => '30027597;2011',
            ),
        175 =>
            array (
                'Ident;Password' => '30027587;2011',
            ),
        176 =>
            array (
                'Ident;Password' => '4845;2011',
            ),
        177 =>
            array (
                'Ident;Password' => '30027576;2011',
            ),
        178 =>
            array (
                'Ident;Password' => '30027491;2011',
            ),
        179 =>
            array (
                'Ident;Password' => '30027582;2011',
            ),
        180 =>
            array (
                'Ident;Password' => '30027480;2011',
            ),
        181 =>
            array (
                'Ident;Password' => '30027465;2011',
            ),
        182 =>
            array (
                'Ident;Password' => '30027456;2011',
            ),
        183 =>
            array (
                'Ident;Password' => '30027200;2011',
            ),
        184 =>
            array (
                'Ident;Password' => '30027177;2011',
            ),
        185 =>
            array (
                'Ident;Password' => '30027185;2011',
            ),
        186 =>
            array (
                'Ident;Password' => '30027072;2011',
            ),
        187 =>
            array (
                'Ident;Password' => '30027056;2011',
            ),
        188 =>
            array (
                'Ident;Password' => '30027048;2011',
            ),
        189 =>
            array (
                'Ident;Password' => '30027025;2011',
            ),
        190 =>
            array (
                'Ident;Password' => '30027013;2011',
            ),
        191 =>
            array (
                'Ident;Password' => '30027024;2011',
            ),
        192 =>
            array (
                'Ident;Password' => '30027031;2011',
            ),
        193 =>
            array (
                'Ident;Password' => '30026870;2010',
            ),
        194 =>
            array (
                'Ident;Password' => '30026791;2010',
            ),
        195 =>
            array (
                'Ident;Password' => '30026652;2010',
            ),
        196 =>
            array (
                'Ident;Password' => '30026660;2010',
            ),
        197 =>
            array (
                'Ident;Password' => '30026629;2010',
            ),
        198 =>
            array (
                'Ident;Password' => '30026341;2010',
            ),
        199 =>
            array (
                'Ident;Password' => '30026334;2010',
            ),
        200 =>
            array (
                'Ident;Password' => '30026326;2010',
            ),
        201 =>
            array (
                'Ident;Password' => '4304;2010',
            ),
        202 =>
            array (
                'Ident;Password' => '30025902;2010',
            ),
        203 =>
            array (
                'Ident;Password' => '30025886;2010',
            ),
        204 =>
            array (
                'Ident;Password' => '30025857;2010',
            ),
        205 =>
            array (
                'Ident;Password' => '4877;2009',
            ),
        206 =>
            array (
                'Ident;Password' => '2755;2009',
            ),
        207 =>
            array (
                'Ident;Password' => '4851;2009',
            ),
        208 =>
            array (
                'Ident;Password' => '4855;2009',
            ),
        209 =>
            array (
                'Ident;Password' => '4790;2009',
            ),
        210 =>
            array (
                'Ident;Password' => '4757;2009',
            ),
        211 =>
            array (
                'Ident;Password' => '4745;2009',
            ),
        212 =>
            array (
                'Ident;Password' => '4741;2009',
            ),
        213 =>
            array (
                'Ident;Password' => '4753;2009',
            ),
        214 =>
            array (
                'Ident;Password' => '4740;2009',
            ),
        215 =>
            array (
                'Ident;Password' => '4755;2009',
            ),
        216 =>
            array (
                'Ident;Password' => '4726;2009',
            ),
        217 =>
            array (
                'Ident;Password' => '4716;2009',
            ),
        218 =>
            array (
                'Ident;Password' => '4635;2009',
            ),
        219 =>
            array (
                'Ident;Password' => '4711;2009',
            ),
        220 =>
            array (
                'Ident;Password' => '4592;2009',
            ),
        221 =>
            array (
                'Ident;Password' => '4251;2009',
            ),
        222 =>
            array (
                'Ident;Password' => '4649;2009',
            ),
        223 =>
            array (
                'Ident;Password' => '4641;2009',
            ),
        224 =>
            array (
                'Ident;Password' => '4627;2008',
            ),
        225 =>
            array (
                'Ident;Password' => '4604;2008',
            ),
        226 =>
            array (
                'Ident;Password' => '4609;2008',
            ),
        227 =>
            array (
                'Ident;Password' => '4581;2008',
            ),
        228 =>
            array (
                'Ident;Password' => '4536;2008',
            ),
        229 =>
            array (
                'Ident;Password' => '4513;2008',
            ),
        230 =>
            array (
                'Ident;Password' => '3923;2008',
            ),
        231 =>
            array (
                'Ident;Password' => '4491;2008',
            ),
        232 =>
            array (
                'Ident;Password' => '4464;2008',
            ),
        233 =>
            array (
                'Ident;Password' => '3960;2008',
            ),
        234 =>
            array (
                'Ident;Password' => '4183;2008',
            ),
        235 =>
            array (
                'Ident;Password' => '4289;2008',
            ),
        236 =>
            array (
                'Ident;Password' => '4278;2007',
            ),
        237 =>
            array (
                'Ident;Password' => '2624;2007',
            ),
        238 =>
            array (
                'Ident;Password' => '4340;2007',
            ),
        239 =>
            array (
                'Ident;Password' => '90386;2006',
            ),
        240 =>
            array (
                'Ident;Password' => '4090;2006',
            ),
        241 =>
            array (
                'Ident;Password' => '4000;2006',
            ),
        242 =>
            array (
                'Ident;Password' => '3876;2006',
            ),
        243 =>
            array (
                'Ident;Password' => '3874;2006',
            ),
        244 =>
            array (
                'Ident;Password' => '3856;2006',
            ),
        245 =>
            array (
                'Ident;Password' => '3374;2006',
            ),
        246 =>
            array (
                'Ident;Password' => '3813;2005',
            ),
        247 =>
            array (
                'Ident;Password' => '3787;2005',
            ),
        248 =>
            array (
                'Ident;Password' => '3530;2005',
            ),
        249 =>
            array (
                'Ident;Password' => '3800;2005',
            ),
        250 =>
            array (
                'Ident;Password' => '3810;2005',
            ),
        251 =>
            array (
                'Ident;Password' => '3780;2005',
            ),
        252 =>
            array (
                'Ident;Password' => '3779;2005',
            ),
        253 =>
            array (
                'Ident;Password' => '3775;2005',
            ),
        254 =>
            array (
                'Ident;Password' => '3757;2005',
            ),
        255 =>
            array (
                'Ident;Password' => '2604;2005',
            ),
        256 =>
            array (
                'Ident;Password' => '3718;2005',
            ),
        257 =>
            array (
                'Ident;Password' => '3028;2005',
            ),
        258 =>
            array (
                'Ident;Password' => '2859;2005',
            ),
        259 =>
            array (
                'Ident;Password' => '3119;2005',
            ),
        260 =>
            array (
                'Ident;Password' => '2696;2005',
            ),
        261 =>
            array (
                'Ident;Password' => '3554;2005',
            ),
        262 =>
            array (
                'Ident;Password' => '3546;2005',
            ),
        263 =>
            array (
                'Ident;Password' => '3621;2005',
            ),
        264 =>
            array (
                'Ident;Password' => '3624;2005',
            ),
        265 =>
            array (
                'Ident;Password' => '3625;2005',
            ),
        266 =>
            array (
                'Ident;Password' => '2699;2004',
            ),
        267 =>
            array (
                'Ident;Password' => '3526;2004',
            ),
        268 =>
            array (
                'Ident;Password' => '3492;2004',
            ),
        269 =>
            array (
                'Ident;Password' => '3411;2004',
            ),
        270 =>
            array (
                'Ident;Password' => '3321;2004',
            ),
        271 =>
            array (
                'Ident;Password' => '3315;2004',
            ),
        272 =>
            array (
                'Ident;Password' => '3317;2004',
            ),
        273 =>
            array (
                'Ident;Password' => '3319;2004',
            ),
        274 =>
            array (
                'Ident;Password' => '3279;2004',
            ),
        275 =>
            array (
                'Ident;Password' => '3278;2004',
            ),
        276 =>
            array (
                'Ident;Password' => '3273;2004',
            ),
        277 =>
            array (
                'Ident;Password' => '3194;2004',
            ),
        278 =>
            array (
                'Ident;Password' => '3196;2004',
            ),
        279 =>
            array (
                'Ident;Password' => '3190;2004',
            ),
        280 =>
            array (
                'Ident;Password' => '5003157;2004',
            ),
        281 =>
            array (
                'Ident;Password' => '2339;2004',
            ),
        282 =>
            array (
                'Ident;Password' => '3002;2004',
            ),
        283 =>
            array (
                'Ident;Password' => '2974;2004',
            ),
        284 =>
            array (
                'Ident;Password' => '2910;2004',
            ),
        285 =>
            array (
                'Ident;Password' => '2906;2004',
            ),
        286 =>
            array (
                'Ident;Password' => '2790;2004',
            ),
        287 =>
            array (
                'Ident;Password' => '2787;2004',
            ),
        288 =>
            array (
                'Ident;Password' => '2782;2004',
            ),
        289 =>
            array (
                'Ident;Password' => '2760;2004',
            ),
        290 =>
            array (
                'Ident;Password' => '2730;2004',
            ),
        291 =>
            array (
                'Ident;Password' => '2711;2004',
            ),
        292 =>
            array (
                'Ident;Password' => '2670;2004',
            ),
        293 =>
            array (
                'Ident;Password' => '602;2004',
            ),
        294 =>
            array (
                'Ident;Password' => '2617;2004',
            ),
        295 =>
            array (
                'Ident;Password' => '5002606;2004',
            ),
        296 =>
            array (
                'Ident;Password' => '2610;2004',
            ),
        297 =>
            array (
                'Ident;Password' => '2599;2004',
            ),
        298 =>
            array (
                'Ident;Password' => '2584;2004',
            ),
        299 =>
            array (
                'Ident;Password' => '2576;2003',
            ),
        300 =>
            array (
                'Ident;Password' => '2581;2003',
            ),
        301 =>
            array (
                'Ident;Password' => '2561;2003',
            ),
        302 =>
            array (
                'Ident;Password' => '2527;2003',
            ),
        303 =>
            array (
                'Ident;Password' => '2520;2003',
            ),
        304 =>
            array (
                'Ident;Password' => '2504;2003',
            ),
        305 =>
            array (
                'Ident;Password' => '2484;2003',
            ),
        306 =>
            array (
                'Ident;Password' => '2483;2003',
            ),
        307 =>
            array (
                'Ident;Password' => '2464;2003',
            ),
        308 =>
            array (
                'Ident;Password' => '2475;2003',
            ),
        309 =>
            array (
                'Ident;Password' => '2442;2003',
            ),
        310 =>
            array (
                'Ident;Password' => '2394;2003',
            ),
        311 =>
            array (
                'Ident;Password' => '2413;2003',
            ),
        312 =>
            array (
                'Ident;Password' => '2283;2003',
            ),
        313 =>
            array (
                'Ident;Password' => '2398;2003',
            ),
        314 =>
            array (
                'Ident;Password' => '1856;2003',
            ),
        315 =>
            array (
                'Ident;Password' => '2380;2003',
            ),
        316 =>
            array (
                'Ident;Password' => '2254;2003',
            ),
        317 =>
            array (
                'Ident;Password' => '1858;2002',
            ),
        318 =>
            array (
                'Ident;Password' => '5001066;2001',
            ),
        319 =>
            array (
                'Ident;Password' => '762;2001',
            ),
        320 =>
            array (
                'Ident;Password' => '490;2001',
            ),
        321 =>
            array (
                'Ident;Password' => '1716;2001',
            ),
        322 =>
            array (
                'Ident;Password' => '1713;2001',
            ),
        323 =>
            array (
                'Ident;Password' => '1035;2001',
            ),
        324 =>
            array (
                'Ident;Password' => '1034;2001',
            ),
        325 =>
            array (
                'Ident;Password' => '1036;2001',
            ),
        326 =>
            array (
                'Ident;Password' => '486;2001',
            ),
        327 =>
            array (
                'Ident;Password' => '44;2001',
            ),
        328 =>
            array (
                'Ident;Password' => '948;2001',
            ),
        329 =>
            array (
                'Ident;Password' => '5000949;2001',
            ),
        330 =>
            array (
                'Ident;Password' => '947;2001',
            ),
        331 =>
            array (
                'Ident;Password' => '787;2001',
            ),
        332 =>
            array (
                'Ident;Password' => '576;2001',
            ),
        333 =>
            array (
                'Ident;Password' => '600;2001',
            ),
        334 =>
            array (
                'Ident;Password' => '14;2001',
            ),
        335 =>
            array (
                'Ident;Password' => '1537;2000',
            ),
        336 =>
            array (
                'Ident;Password' => '1520;2000',
            ),
        337 =>
            array (
                'Ident;Password' => '1532;2000',
            ),
        338 =>
            array (
                'Ident;Password' => '955;2000',
            ),
        339 =>
            array (
                'Ident;Password' => '843;2000',
            ),
        340 =>
            array (
                'Ident;Password' => '844;2000',
            ),
        341 =>
            array (
                'Ident;Password' => '839;2000',
            ),
        342 =>
            array (
                'Ident;Password' => '1364;2000',
            ),
        343 =>
            array (
                'Ident;Password' => '1370;2000',
            ),
        344 =>
            array (
                'Ident;Password' => '1371;2000',
            ),
        345 =>
            array (
                'Ident;Password' => '',
            ),
    );

    /**
     * @Route("/", name="users_index", methods={"GET"})
     * @param UsersRepository $usersRepository
     * @return Response
     */
    public function index(UsersRepository $usersRepository): Response
    {
        return $this->render('users/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="users_new", methods={"GET","POST"})
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Users();
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('users_index');
        }

        return $this->render('users/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="users_show", methods={"GET"})
     * @param Users $user
     * @return Response
     */
    public function show(Users $user): Response
    {
        return $this->render('users/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="users_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Users $user
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function edit(Request $request, Users $user, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $form = $this->createForm(UsersType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('users_index');
        }

        return $this->render('users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="users_delete", methods={"DELETE"})
     * @param Request $request
     * @param Users $user
     * @return Response
     */
    public function delete(Request $request, Users $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('users_index');
    }
}
