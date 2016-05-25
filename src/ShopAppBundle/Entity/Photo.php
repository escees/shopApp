<?php

namespace ShopAppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photo
 *
 * @ORM\Table(name="photos")
 * @ORM\Entity(repositoryClass="ShopAppBundle\Entity\PhotoRepository")
 */
class Photo
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
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;
    /**
     *
     * @var type 
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="photos")
     * @ORM\JoinColumn(name="items_id", referencedColumnName="id")
     */
    private $item;


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
     * Set path
     *
     * @param string $path
     * @return Photo
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set item
     *
     * @param \ShopAppBundle\Entity\Item $item
     * @return Photo
     */
    public function setItem(\ShopAppBundle\Entity\Item $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \ShopAppBundle\Entity\Item 
     */
    public function getItem()
    {
        return $this->item;
    }
}
