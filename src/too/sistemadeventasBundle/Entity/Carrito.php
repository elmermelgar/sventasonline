<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Carrito
 *
 * @ORM\Table(name="carrito", uniqueConstraints={@ORM\UniqueConstraint(name="carrito_pk", columns={"id_carrito"})})
 * @ORM\Entity
 */
class Carrito
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_carrito", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="carrito_id_carrito_seq", allocationSize=1, initialValue=1)
     */
    private $idCarrito;

    /**
     * @var string
     *
     * @ORM\Column(name="id_usu", type="string", length=50, nullable=true)
     */
    private $idUsu;

    /**
     * @var string
     *
     * @ORM\Column(name="id_product", type="string", length=50, nullable=true)
     */
    private $idProduct;

    /**
     * @var string
     *
     * @ORM\Column(name="producto", type="string", length=50, nullable=true)
     */
    private $producto;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $precio;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=true)
     */
    private $cantidad;

    /**
     * @var string
     *
     * @ORM\Column(name="total", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $total;



    /**
     * Get idCarrito
     *
     * @return integer 
     */
    public function getIdCarrito()
    {
        return $this->idCarrito;
    }

    /**
     * Set idUsu
     *
     * @param string $idUsu
     * @return Carrito
     */
    public function setIdUsu($idUsu)
    {
        $this->idUsu = $idUsu;

        return $this;
    }

    /**
     * Get idUsu
     *
     * @return string 
     */
    public function getIdUsu()
    {
        return $this->idUsu;
    }

    /**
     * Set idProduct
     *
     * @param string $idProduct
     * @return Carrito
     */
    public function setIdProduct($idProduct)
    {
        $this->idProduct = $idProduct;

        return $this;
    }

    /**
     * Get idProduct
     *
     * @return string 
     */
    public function getIdProduct()
    {
        return $this->idProduct;
    }

    /**
     * Set producto
     *
     * @param string $producto
     * @return Carrito
     */
    public function setProducto($producto)
    {
        $this->producto = $producto;

        return $this;
    }

    /**
     * Get producto
     *
     * @return string 
     */
    public function getProducto()
    {
        return $this->producto;
    }

    /**
     * Set precio
     *
     * @param string $precio
     * @return Carrito
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Carrito
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set total
     *
     * @param string $total
     * @return Carrito
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return string 
     */
    public function getTotal()
    {
        return $this->total;
    }
}
