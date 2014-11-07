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

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     * @Template()
     */
    public function indexAction()
    {
        $postMessageToken = $this->get('form.csrf_provider')->generateCsrfToken('postMessage');
        $postSessionToken = $this->get('form.csrf_provider')->generateCsrfToken('postSession');

        $hours = $this->getHoursList();

        return array(
            'postMessageToken' => $postMessageToken,
            'postSessionToken' => $postSessionToken,
            'meditationHours'  => $hours
        );
    }

    protected function getHoursList()
    {
        $hours = [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0];

        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('SirimangaloMeditationBundle:Session');
        $monthAgo = $repo->findMonthAgo();

        foreach ($monthAgo as $session) {
            $hStart = $session->getStart()->format('G');
            $hEnd = $session->getEnd()->format('G');

            if ($hStart == $hEnd) {
                $time = $session->getWalking() + $session->getSitting();
                $hours[$hStart] += $time;
            } else {
                $ho = $hStart + 1;
                $time = 60 - $session->getStart()->format('i');
                $hours[$hStart] += $time;
                while ($ho < $hEnd) {
                    $hours[$ho++] += 60;
                }
                $time = $session->getEnd()->format('i');
                $hours[$hEnd] += $time;
            }
        }

        return $hours;
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
     * @Route("/renderSessions.html", name="render_sessions")
     * @Template()
     */
    public function renderSessionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('SirimangaloMeditationBundle:Session');
        $sessions = $repo->findRecent();

        // end older sessions
        $oldSessions = $repo->findMineRunning($this->getUser()->getId());

        foreach ($oldSessions as $session) {
            $medMinutes = $session->getSitting() + $session->getWalking();

            // add total meditation minutes to start to get end
            $end = strtotime(
                '+' . $medMinutes . ' minutes',
                $session->getStart()->getTimestamp()
            );

            // already done?
            if ($end <= time()) {
                $session->setEnd(new \DateTime(date('c', $end)));
                $em->persist($session);
            }
        }

        $em->flush();

        return array(
            'sessions' => $sessions
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

            if (isset($formData['text']) && trim($formData['text']) !== '') {
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

    /**
     * @Secure(roles="ROLE_USER")
     * @Route("/postSession", name="post_session")
     * @Method("POST")
     */
    public function postSessionAction(Request $request)
    {
        $formData = $request->get('session');

        // verify the csrf token and xhr
        if (isset($formData['token']) &&
            $this->get('form.csrf_provider')->isCsrfTokenValid(
                'postSession',
                $formData['token']
            ) &&
            $request->isXmlHttpRequest()
        ) {
            if ((isset($formData['walking']) && (int) $formData['walking'] > 0) or
                (isset($formData['sitting']) && (int) $formData['sitting'] > 0)) {

                $em = $this->getDoctrine()->getManager();

                $oldSessions = $em->getRepository('SirimangaloMeditationBundle:Session')
                    ->findMineRunning($this->getUser()->getId());

                if (count($oldSessions) === 0) {

                    $session = new Session();
                    $session->setStart(new \DateTime());
                    $session->setUser($this->getUser());

                    if (isset($formData['walking'])) {
                        $session->setWalking($formData['walking']);
                    }

                    if (isset($formData['sitting'])) {
                        $session->setSitting($formData['sitting']);
                    }

                    $em->persist($session);
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
                            'error' => 'still_meditating'
                        ))
                    );
                }
            } else {
                $response = new Response(
                    json_encode(array(
                        'status' => 'error',
                        'error' => 'missing_meditation_data'
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
