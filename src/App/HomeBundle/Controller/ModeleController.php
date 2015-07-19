<?php

namespace App\HomeBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\HomeBundle\Entity\Modele;
use App\HomeBundle\Form\ModeleType;

/**
 * Modele controller.
 *
 */
class ModeleController extends Controller
{

    /**
     * Lists all Modele entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('HomeBundle:Modele')->findAll();

        return $this->render('HomeBundle:Modele:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Modele entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Modele();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('modele_show', array('id' => $entity->getId())));
        }

        return $this->render('HomeBundle:Modele:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Modele entity.
     *
     * @param Modele $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Modele $entity)
    {
        $form = $this->createForm(new ModeleType(), $entity, array(
            'action' => $this->generateUrl('modele_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Modele entity.
     *
     */
    public function newAction()
    {
        $entity = new Modele();
        $form   = $this->createCreateForm($entity);

        return $this->render('HomeBundle:Modele:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Modele entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HomeBundle:Modele')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modele entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('HomeBundle:Modele:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Modele entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HomeBundle:Modele')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modele entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('HomeBundle:Modele:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Modele entity.
    *
    * @param Modele $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Modele $entity)
    {
        $form = $this->createForm(new ModeleType(), $entity, array(
            'action' => $this->generateUrl('modele_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Modele entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('HomeBundle:Modele')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Modele entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('modele_edit', array('id' => $id)));
        }

        return $this->render('HomeBundle:Modele:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Modele entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('HomeBundle:Modele')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Modele entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('modele'));
    }

    /**
     * Creates a form to delete a Modele entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('modele_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
    
    public function option_marqueAction()
    {

        $em = $this->container->get('doctrine')->getEntityManager();

        $request = $this->container->get('request');

     $marque = $em->getConnection()

            ->prepare("select * from modele   where marques_id =".$request->request->get('id')."");

            $marque->execute();

            $marques = $marque->fetchAll();

        return $this->render('HomeBundle:Modele:marque_option.html.twig', array(
      'marques' => $marques
    ));

    }
}
