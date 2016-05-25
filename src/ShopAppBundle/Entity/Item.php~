<?php

namespace ShopAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Items
 *
 * @ORM\Table(name="items")
 * @ORM\Entity(repositoryClass="ShopAppBundle\Entity\ItemRepository")
 */
class Item
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    /**
     * @var string
     * @ORM\OneToMany (targetEntity="Photo", mappedBy="item")
     * 
     */
    private $photos;
    /**
     * @var string
     * @ORM\ManyToMany (targetEntity="ShopOrder", inversedBy="items")
     * @ORM\JoinTable (name="orders_items")
     */
    private $shopOrders;
    
    public function __construct() {
        $this->shopOrders = new ArrayCollection();
        $this->photos = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Item
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Item
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Item
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Add photos
     *
     * @param \ShopAppBundle\Entity\Photo $photos
     * @return Item
     */
    public function addPhoto(\ShopAppBundle\Entity\Photo $photos)
    {
        $this->photos[] = $photos;

        return $this;
    }

    /**
     * Remove photos
     *
     * @param \ShopAppBundle\Entity\Photo $photos
     */
    public function removePhoto(\ShopAppBundle\Entity\Photo $photos)
    {
        $this->photos->removeElement($photos);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add shopOrders
     *
     * @param \ShopAppBundle\Entity\ShopOrder $shopOrders
     * @return Item
     */
    public function addShopOrder(\ShopAppBundle\Entity\ShopOrder $shopOrders)
    {
        $this->shopOrders[] = $shopOrders;

        return $this;
    }

    /**
     * Remove shopOrders
     *
     * @param \ShopAppBundle\Entity\ShopOrder $shopOrders
     */
    public function removeShopOrder(\ShopAppBundle\Entity\ShopOrder $shopOrders)
    {
        $this->shopOrders->removeElement($shopOrders);
    }

    /**
     * Get shopOrders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShopOrders()
    {
        return $this->shopOrders;
    }
}
