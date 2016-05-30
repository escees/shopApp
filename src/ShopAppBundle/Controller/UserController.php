<?php

namespace ShopAppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use ShopAppBundle\Entity\User;
use ShopAppBundle\Form\UserType;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller{
    
    private function getUId(){
        return $this->getUser() ? $this->getUser()->getId() : 0;
    }
    /**
     * Lists all User entities.
     *
     * @Route("/", name="user")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ShopAppBundle:User')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new User entity.
     *
     * @Route("/", name="user_create")
     * @Method("POST")
     * @Template("ShopAppBundle:User:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new User();
        $entity->setEnabled(true);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a User entity.
     *
     * @param User $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Utwórz użytkownika'));

        return $form;
    }

    /**
     * Displays a form to create a new User entity.
     *
     * @Route("/new", name="user_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new User();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a User entity.
     *
     * @Route("/show", name="user_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(){
        
        $id = $this->getUId();
        
        if ($id == 0){
            return $this->redirectToRoute('index');
        }
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ShopAppBundle:User')->find($id);
        
//        $loggedUser = $this->getUser();
//        if(!$loggedUser){
//            return new Response ('Nie jesteś zalogowany.');
//        }
//        if (!$entity) {
//            throw $this->createNotFoundException('Taki użytkownik nie istnieje!');
//        }
        
        $deleteForm = $this->createDeleteForm($id);
        
        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     * @Route("/edit", name="user_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction()
    {
        $id = $this->getUId();
        
        if ($id == 0){
            return $this->redirectToRoute('index');
        }
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ShopAppBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
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
    * Creates a form to edit a User entity.
    *
    * @param User $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(User $entity)
    {
        $form = $this->createForm(new UserType(), $entity, array(
            'action' => $this->generateUrl('user_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Zapisz'));

        return $form;
    }
    /**
     * Edits an existing User entity.
     *
     * @Route("/", name="user_update")
     * @Method("PUT")
     * @Template("ShopAppBundle:User:edit.html.twig")
     */
    public function updateAction(Request $request)
    {
        $id = $this->getUId();
        
        if ($id == 0){
            return $this->redirectToRoute('index');
        }
        
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ShopAppBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Nie znaleziono użytkownika');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('user_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a User entity.
     *
     * @Route("/", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request)
    {
        $id = $this->getUId();
        
        if ($id == 0){
            return $this->redirectToRoute('index');
        }
        
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ShopAppBundle:User')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find User entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user'));
    }

    /**
     * Creates a form to delete a User entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('user_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Usuń użytkownika'))
            ->getForm()
        ;
    }
    
    /**
     * @Route("/new/admin")
     * @Method("GET")
     * @Template()
     */
    public function newAdminAction() {

        return [];
    }

    /**
     * @Route("/new/admin")
     * @Method ("POST")
     * @Template("ShopAppBundle:User:newAdmin.html.twig")
     */
    public function createAdminAction(Request $req) {
        $userManager = $this->get('fos_user.user_manager');
        $admin = $userManager->createUser();

        $code = $this->getParameter('admin_create_access_code');
        $userCode = $req->request->get('code');
        $username = $req->request->get('login');
        $password = $req->request->get('pass');
        $email = $req->request->get('mail');


        if ($userCode != $code) {
            return new Response('Access denied!');
        }
        if ($userManager->findUserByUsername($username)){
            return new Response('This username already exists');
        }
        if ($userManager->findUserByEmail($email)){
            return new Response('This email already exists');
        }
            
        $admin->setUsername($username);
        $admin->setEmail($email);
        $admin->setPlainPassword($password);
        $admin->setEnabled(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($admin);
        $em->flush();


        return [
            'admin' => $admin
        ];
    }
}
