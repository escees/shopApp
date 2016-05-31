<?php

namespace ShopAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ShopOrders
 *
 * @ORM\Table(name="shop_orders")
 * @ORM\Entity(repositoryClass="ShopAppBundle\Entity\ShopOrderRepository")
 */
class ShopOrder
{
    
    const STATUS_BASKET = 1;
    const STATUS_ACCEPTED = 2;
    const STATUS_PAID = 3;
    const STATUS_SENT = 4;
    const STATUS_COMPLETED = 5;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="smallint")
     */
    private $status;

    /**
     *
     * @var type 
     * @ORM\ManyToOne(targetEntity="User", inversedBy="shopOrders")
     * @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     */
    private $user;
    /**
     * @var string
     * @ORM\ManyToMany (targetEntity="Item", mappedBy="shopOrders")
     * 
     */
    private $items;
    
    public function __construct() {
        $this->items = new ArrayCollection();
    }
    public function __toString() {
        return $this->id = '';
    }
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return ShopOrder
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    
    /**
     * Set user
     *
     * @param \ShopAppBundle\Entity\User $user
     * @return ShopOrder
     */
    public function setUser(\ShopAppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \ShopAppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add items
     *
     * @param \ShopAppBundle\Entity\Item $items
     * @return ShopOrder
     */
    public function addItem(\ShopAppBundle\Entity\Item $items)
    {
        $this->items[] = $items;

        return $this;
    }

    /**
     * Remove items
     *
     * @param \ShopAppBundle\Entity\Item $items
     */
    public function removeItem(\ShopAppBundle\Entity\Item $items)
    {
        $this->items->removeElement($items);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }
}
