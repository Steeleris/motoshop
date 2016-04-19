<?php

namespace MotoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cart
 *
 * @ORM\Table(name="carts")
 * @ORM\Entity(repositoryClass="MotoBundle\Repository\CartRepository")
 */
class Cart
{
    /**
     * @ORM\ManyToMany(targetEntity="Product", inversedBy="carts")
     * @ORM\JoinTable(name="carts_products")
     */
    protected $product;

    /**
     * @ORM\OneToMany(targetEntity="UserBundle\Entity\User", mappedBy="carts")
     **/
    protected $user;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->product = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Add product
     *
     * @param \MotoBundle\Entity\Product $product
     *
     * @return Cart
     */
    public function addProduct(\MotoBundle\Entity\Product $product)
    {
        $this->product[] = $product;

        return $this;
    }

    /**
     * Remove product
     *
     * @param \MotoBundle\Entity\Product $product
     */
    public function removeProduct(\MotoBundle\Entity\Product $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Add user
     *
     * @param \MotoBundle\Entity\User $user
     *
     * @return Cart
     */
    public function addUser(\MotoBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \MotoBundle\Entity\User $user
     */
    public function removeUser(\MotoBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }
}
