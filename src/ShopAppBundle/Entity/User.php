<?php

namespace ShopAppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="ShopAppBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=100)
     */
    private $surname;


    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100)
     */
    private $address;
    
    /**
     * @var string
     * @ORM\OneToMany (targetEntity="ShopOrder", mappedBy="user")
     * 
     */
    private $shopOrders;

    
    public function __construct() {
        parent::__construct();
        $this->shopOrders = new ArrayCollection();
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
     * @return User
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
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }


    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add shopOrders
     *
     * @param \ShopAppBundle\Entity\ShopOrder $shopOrders
     * @return User
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
