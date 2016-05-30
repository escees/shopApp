<?php

namespace ShopAppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ShopAppBundle\Entity\ShopOrder;
use ShopAppBundle\Form\ShopOrderType;
use ShopAppBundle\Entity\User;



/**
 * ShopOrder controller.
 *
 * @Route("/shoporder")
 */
class ShopOrderController extends Controller
{
    
    private function getUId(){
        return $this->getUser() ? $this->getUser()->getId() : 0;
    }
    
    /**
     * Lists all ShopOrder entities.
     *
     * @Route("/", name="shoporder")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ShopAppBundle:ShopOrder')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ShopOrder entity.
     *
     * @Route("/", name="shoporder_create")
     * @Method("POST")
     * @Template("ShopAppBundle:ShopOrder:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ShopOrder();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('shoporder_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a ShopOrder entity.
     *
     * @param ShopOrder $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ShopOrder $entity)
    {
        $form = $this->createForm(new ShopOrderType(), $entity, array(
            'action' => $this->generateUrl('shoporder_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ShopOrder entity.
     *
     * @Route("/new", name="shoporder_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ShopOrder();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ShopOrder entity.
     *
     * @Route("/show", name="shoporder_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction()
    {
        
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ShopAppBundle:ShopOrder')->findByUser($this->getUser());

        $deleteForm = $this->createDeleteForm($this->getUser());

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ShopOrder entity.
     *
     * @Route("/{id}/edit", name="shoporder_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ShopAppBundle:ShopOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ShopOrder entity.');
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
    * Creates a form to edit a ShopOrder entity.
    *
    * @param ShopOrder $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ShopOrder $entity)
    {
        $form = $this->createForm(new ShopOrderType(), $entity, array(
            'action' => $this->generateUrl('shoporder_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ShopOrder entity.
     *
     * @Route("/{id}", name="shoporder_update")
     * @Method("PUT")
     * @Template("ShopAppBundle:ShopOrder:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ShopAppBundle:ShopOrder')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ShopOrder entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('shoporder_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ShopOrder entity.
     *
     * @Route("/{id}", name="shoporder_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ShopAppBundle:ShopOrder')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ShopOrder entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('shoporder'));
    }

    /**
     * Creates a form to delete a ShopOrder entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('shoporder_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
