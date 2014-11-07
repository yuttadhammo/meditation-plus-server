<?php

namespace Sirimangalo\MeditationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sirimangalo\MeditationBundle\Entity\Chat;
use Sirimangalo\MeditationBundle\Entity\Session;
use JMS\SecurityExtraBundle\Annotation\Secure;

class ProfileController extends Controller
{
    /**
     * @Route("/profile/{username}")
     * @Template()
     */
    public function showProfileAction($username)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('SirimangaloMeditationBundle:User')->findBy(array(
            'username' => $username
        ));

        if (!$user) {
            throw $this->createNotFoundException('The user does not exist');
        }
        $sessionRepo = $em->getRepository('SirimangaloMeditationBundle:Session');

        $days   = $sessionRepo->findRecentDaysByUser($user->getId());
        $weeks  = $sessionRepo->findRecentWeeksByUser($user->getId());
        $months = $sessionRepo->findRecentWeeksByUser($user->getId());

        return array(
            'user' => $user,
            'days' => $days,
            'weeks' => $weeks,
            'months' => $months
         );
    }
}
