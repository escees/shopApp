<?php

namespace ShopAppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use ShopAppBundle\Entity\User;
use ShopAppBundle\Entity\ShopOrder;
use ShopAppBundle\Entity\Item;


class ShopController extends Controller {
    
    /**
     * @Route("/addToBasket/{id}", name="add_to_basket")
     * 
     */
    public function addToBasketAction($id) {
        $em = $this->getDoctrine()->getManager();
        
        $user= $this->getUser();        
        if (!$user) {
            return new Response('Zaloguj się');
        }
        
        $currentBasket = $user->getCurrentBasket();     //pobieramy koszyk 
        
        if (!$currentBasket) {                          //sprawdzamy czy istnieje
            $currentBasket = new ShopOrder();           //jezeli nie tworzymy nowe zamowienie
            $currentBasket->setStatus(ShopOrder::STATUS_BASKET);
            
            $user->setCurrentBasket($currentBasket);    //przypisujemy uzytkownikowi nowo utworzony koszyk
            $em->persist($currentBasket);
            $em->flush();
        }
        
        $repo = $this->getDoctrine()->getRepository('ShopAppBundle:Item');
        $item = $repo->find($id);
        
        if (!$item) {
            return new Response('Brak przedmiotu');
        }
        
        $currentBasket->addItem($item);             //dodajemy item do koszyka
        $item->addShopOrder($currentBasket);        //dodajemy item do koszyka

        $em->flush();
        
        return $this->redirectToRoute('item_show', array('id'=>$id));
        
    }
    
}
