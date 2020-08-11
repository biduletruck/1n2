<?php


namespace App\Controller;

use App\Entity\Users;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * @Route("/players")
 */
class AddPlayersController extends AbstractController
{

    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    private $players = [5203878,5203252,5203583,5203756,5203249,5203543,5203752,5203842,5203839,5203491,5203852,5203868,5203854,5203596,5203590,5203857,5203851,5203553,5203749,5203872,5203855,5203511,5203246,5203831,5203496,5203551,5180260,5203609,5174065,5200936,5185146,5200951,5200962,5201061,5201089,5201052,5201046,5201090,5201088,5201074,5200950,5200939,5201012,5200917,5200964,5201054,5200943,5200929,5201086,5200967,5200918,5201058,5172006,5200652,5200640,5200636,5200639,5200644,5174066,5198698,5168767,5198699,5139306,30029376,5185148,5198849,5199364,5198858,5199363,5198706,5198856,5198694,5198853,5198705,5198671,30029899,5198842,5185500,5193134,5187343,5187345,5187342,5187341,5187344,5183173,5174067,5182649,5183164,5183149,5183156,5182659,5182640,5183166,5178498,5175719,5175667,5176076,5175672,5172011,30029605,5174724,5174738,5174746,5174779,5174593,5174447,5174451,5174396,5174450,5174448];
    private $password = [2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2020,2019,2019,2019,2019,2019,2019];
    private $players2 = [5172895,5172894,5171920,5171959,5171953,5171923,5170449,5170202,5169993,5170114,5169996,5170198,5169960,5170109,5159427,5154687,5121513,5121515,5121508,5143258,5143246,5139961,5139738,5138552,5135136,5127627,5127624,5127690,5127623,5125645,30030118,5121473,60275,2445,4495,30028031,2965,30026896,30028105,2544,30028106,30028717,30028712,3919,30028465,30028446,30027992,30027870,30027957,30025840,30027829,30027833,30027815,3091,30027657,30027743,30027633,30027639,30027629,30027604,30027622,30027614,30027606,2619,30027597,30027587,4845,30027576,30027491,30027582,30027480,30027465,30027456,30027200,30027177,30027185,30027072,30027056,30027048,30027025,30027013,30027024,30027031,30026870,30026791,30026652,30026660,30026629,30026341,30026334,30026326,4304,30025902,30025886,30025857,4877,2755,4851,4855,4790,4757,4745,4741,4753,4740,4755,4726,4716,4635,4711];
    private $password2 = [2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2019,2018,2013,2013,2013,2013,2013,2013,2013,2013,2013,2013,2012,2012,2012,2012,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2011,2010,2010,2010,2010,2010,2010,2010,2010,2010,2010,2010,2010,2009,2009,2009,2009,2009,2009,2009,2009,2009,2009,2009,2009,2009,2009,2009];
    private $players3 = [4592,4251,4649,4641,4627,4604,4609,4581,4536,4513,3923,4491,4464,3960,4183,4289,4278,2624,4340,90386,4090,4000,3876,3874,3856,3374,3813,3787,3530,3800,3810,3780,3779,3775,3757,2604,3718,3028,2859,3119,2696,3554,3546,3621,3624,3625,2699,3526,3492,3411,3321,3315,3317,3319,3279,3278,3273,3194,3196,3190,5003157,2339,3002,2974,2910,2906,2790,2787,2782,2760,2730,2711,2670,602,2617,5002606,2610,2599,2584,2576,2581,2561,2527,2520,2504,2484,2483,2464,2475,2442,2394,2413,2283,2398,1856,2380,2254,1858,5001066,762,490,1716,1713,1035,1034,1036,486,44,948,5000949,947,787,576,600,14,1537,1520,1532,955,843,844,839,1364,1370,1371];
    private $password3 = [2009,2009,2009,2009,2008,2008,2008,2008,2008,2008,2008,2008,2008,2008,2008,2008,2007,2007,2007,2006,2006,2006,2006,2006,2006,2006,2005,2005,2005,2005,2005,2005,2005,2005,2005,2005,2005,2005,2005,2005,2005,2005,2005,2005,2005,2005,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2004,2003,2003,2003,2003,2003,2003,2003,2003,2003,2003,2003,2003,2003,2003,2003,2003,2003,2003,2002,2001,2001,2001,2001,2001,2001,2001,2001,2001,2001,2001,2001,2001,2001,2001,2001,2001,2000,2000,2000,2000,2000,2000,2000,2000,2000,2000];



    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @Route("/1", name="players_index1", methods={"GET"})
     * @param UsersRepository $usersRepository
     * @return Response
     */
    public function new1(UsersRepository $usersRepository): Response
    {
        $i = 0;
        $entityManager = $this->getDoctrine()->getManager();
        for($i=0; $i < count($this->players); $i++)
        {
            $user = new Users();
            $user->setUsername($this->players[$i]);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->encoder->encodePassword($user, $this->password[$i]));
            $entityManager->persist($user);

        }

        $entityManager->flush();
        return $this->render('users/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/2", name="players_index2", methods={"GET"})
     * @param UsersRepository $usersRepository
     * @return Response
     */
    public function new2(UsersRepository $usersRepository): Response
    {
        $i = 0;
        $entityManager = $this->getDoctrine()->getManager();
        for($i=0; $i < count($this->players2); $i++)
        {
            $user = new Users();
            $user->setUsername($this->players2[$i]);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->encoder->encodePassword($user, $this->password2[$i]));
            $entityManager->persist($user);

        }

        $entityManager->flush();
        return $this->render('users/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }

    /**
     * @Route("/3", name="players_index3", methods={"GET"})
     * @param UsersRepository $usersRepository
     * @return Response
     */
    public function new3(UsersRepository $usersRepository): Response
    {
        $i = 0;
        $entityManager = $this->getDoctrine()->getManager();
        for($i=0; $i < count($this->players3); $i++)
        {
            $user = new Users();
            $user->setUsername($this->players3[$i]);
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->encoder->encodePassword($user, $this->password3[$i]));
            $entityManager->persist($user);

        }

        $entityManager->flush();
        return $this->render('users/index.html.twig', [
            'users' => $usersRepository->findAll(),
        ]);
    }
}