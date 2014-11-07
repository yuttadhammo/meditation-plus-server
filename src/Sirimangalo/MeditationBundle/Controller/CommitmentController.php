<?php

namespace Sirimangalo\MeditationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sirimangalo\MeditationBundle\Entity\Commitment;
use Sirimangalo\MeditationBundle\Entity\UserCommitment;
use Sirimangalo\MeditationBundle\Form\CommitmentType;
use JMS\SecurityExtraBundle\Annotation\Secure;

/**
 * Commitment controller.
 *
 * @Route("/commitment")
 */
class CommitmentController extends Controller
{

    /**
     * Lists all Commitment entities.
     *
     * @Route("/", name="commitment")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em     = $this->getDoctrine()->getManager();
        $repo   = $em->getRepository('SirimangaloMeditationBundle:Commitment');
        $mine   = $repo->findMine($this->getUser()->getId());
        $others = $repo->findOthers($this->getUser()->getId());

        $commitmentToken = $this->get('form.csrf_provider')->generateCsrfToken('commit');

        return array(
            'mine'            => $mine,
            'others'          => $others,
            'commitmentToken' => $commitmentToken
         );
    }

    /**
     * @Route("/{id}/commit", name="commitment_commit")
     * @Method("POST")
     * @Template()
     */
    public function commitAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirimangaloMeditationBundle:Commitment')->find($id);

        if (!$this->get('form.csrf_provider')->isCsrfTokenValid('commit', $request->get('token')) or
            !$entity) {
            throw $this->createNotFoundException('Unable to find Commitment entity.');
        }

        // Check if user is already committed
        $usrCommitment = $em->getRepository('SirimangaloMeditationBundle:UserCommitment')->findBy(
            array(
                'user' => $this->getUser()->getId(),
                'commitment' => $id
            )
        );

        if (count($usrCommitment) > 0) {
            // TODO: already committed msg
            return $this->redirect($this->generateUrl('commitment'));
        }

        // commit user
        $usrCommitment = new UserCommitment();
        $usrCommitment->setUser($this->getUser());
        $usrCommitment->setCommitment($entity);

        $em->persist($usrCommitment);
        $em->flush();

        // TODO: msg you've committed
        return $this->redirect($this->generateUrl('commitment'));
    }

    /**
     * @Route("/{id}/uncommit", name="commitment_uncommit")
     * @Method("POST")
     * @Template()
     */
    public function uncommitAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirimangaloMeditationBundle:Commitment')->find($id);

        if (!$this->get('form.csrf_provider')->isCsrfTokenValid('commit', $request->get('token')) or
            !$entity) {
            throw $this->createNotFoundException('Unable to find Commitment entity.');
        }

        // Check if user is already committed
        $usrCommitment = $em->getRepository('SirimangaloMeditationBundle:UserCommitment')->findBy(
            array(
                'user' => $this->getUser()->getId(),
                'commitment' => $id
            )
        );

        if (count($usrCommitment) === 0) {
            // TODO: not committed msg
            return $this->redirect($this->generateUrl('commitment'));
        }

        // commit user
        $usrCommitment = $usrCommitment[0];
        $em->remove($usrCommitment);
        $em->flush();

        // TODO: msg you've committed
        return $this->redirect($this->generateUrl('commitment'));
    }

    /**
     * Creates a new Commitment entity.
     *
     * @Route("/", name="commitment_create")
     * @Method("POST")
     * @Template("SirimangaloMeditationBundle:Commitment:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Commitment();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('commitment_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Commitment entity.
     *
     * @param Commitment $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Commitment $entity)
    {
        $form = $this->createForm(new CommitmentType(), $entity, array(
            'action' => $this->generateUrl('commitment_create'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Commitment entity.
     *
     * @Route("/new", name="commitment_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Commitment();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Commitment entity.
     *
     * @Route("/{id}", name="commitment_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirimangaloMeditationBundle:Commitment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commitment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Commitment entity.
     *
     * @Route("/{id}/edit", name="commitment_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirimangaloMeditationBundle:Commitment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commitment entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Commitment entity.
    *
    * @param Commitment $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Commitment $entity)
    {
        $form = $this->createForm(new CommitmentType(), $entity, array(
            'action' => $this->generateUrl('commitment_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        return $form;
    }
    /**
     * Edits an existing Commitment entity.
     *
     * @Route("/{id}", name="commitment_update")
     * @Method("PUT")
     * @Template("SirimangaloMeditationBundle:Commitment:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SirimangaloMeditationBundle:Commitment')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Commitment entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('commitment_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Commitment entity.
     *
     * @Route("/{id}", name="commitment_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SirimangaloMeditationBundle:Commitment')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Commitment entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('commitment'));
    }

    /**
     * Creates a form to delete a Commitment entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('commitment_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
