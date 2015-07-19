<?php

namespace App\HomeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\HomeBundle\Entity\Auto;
use App\HomeBundle\Form\AutoType;

/**
 * Auto controller.
 *
 */
class AutoController extends Controller
{

    /**
     * Lists all Auto entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HomeBundle:Auto')->findAll();

        return $this->render('HomeBundle:Auto:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Auto entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Auto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->container->get('security.context')->getToken()->getUser();
           $entity->setUser($user);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('auto_show', array('id' => $entity->getId())));
        }

        return $this->render('HomeBundle:Auto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Auto entity.
     *
     * @param Auto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Auto $entity)
    {
        $form = $this->createForm(new AutoType(), $entity, array(
            'action' => $this->generateUrl('auto_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Auto entity.
     *
     */
    public function newAction()
    {
        $entity = new Auto();
        $form   = $this->createCreateForm($entity);

        return $this->render('HomeBundle:Auto:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Auto entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HomeBundle:Auto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('HomeBundle:Auto:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Auto entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HomeBundle:Auto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auto entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('HomeBundle:Auto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Auto entity.
    *
    * @param Auto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Auto $entity)
    {
        $form = $this->createForm(new AutoType(), $entity, array(
            'action' => $this->generateUrl('auto_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Auto entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HomeBundle:Auto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Auto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('auto_edit', array('id' => $id)));
        }

        return $this->render('HomeBundle:Auto:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Auto entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HomeBundle:Auto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Auto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('auto'));
    }

    /**
     * Creates a form to delete a Auto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('auto_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
