<?php

namespace Sirimangalo\MeditationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/renderChats.html", name="render_chats")
     * @Template()
     */
    public function renderChatsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $chats = $em->getRepository('SirimangaloMeditationBundle:Chat')->findAll();

        return array(
            'chats' => $chats
        );
    }

}
