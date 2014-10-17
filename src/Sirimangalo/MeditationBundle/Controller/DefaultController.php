<?php

namespace Sirimangalo\MeditationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sirimangalo\MeditationBundle\Entity\Chat;
use JMS\SecurityExtraBundle\Annotation\Secure;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        $postMessageToken = $this->get('form.csrf_provider')->generateCsrfToken('postMessage');

        return array(
            'postMessageToken' => $postMessageToken
        );
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

    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/postMessage", name="post_message")
     * @Method("POST")
     */
    public function postMessageAction(Request $request)
    {
        $formData = $request->get('message');

        // verify the csrf token and xhr
        if (isset($formData['token']) &&
            $this->get('form.csrf_provider')->isCsrfTokenValid('postMessage', $formData['token']) &&
            $request->isXmlHttpRequest()) {

            if (isset($formData['text']) && $formData['text'] !== '') {
                $chat = new Chat();
                $chat->setTime(new \DateTime());
                $chat->setUser($this->getUser());
                $chat->setMessage($formData['text']);

                $em = $this->getDoctrine()->getManager();
                $em->persist($chat);
                $em->flush();

                $response = new Response(
                    json_encode(array(
                        'status' => 'ok'
                    ))
                );
            } else {
                $response = new Response(
                    json_encode(array(
                        'status' => 'error',
                        'error' => 'missing_text'
                    ))
                );
            }

        } else {
            $response = new Response(
                json_encode(array(
                    'status' => 'error',
                    'error' => 'access_denied'
                ))
            );
        }

        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
