<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inventario
 *
 * @ORM\Table(name="inventario", uniqueConstraints={@ORM\UniqueConstraint(name="inventario_pk", columns={"id_inventario"})})
 * @ORM\Entity
 */
class Inventario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_inventario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="inventario_id_inventario_seq", allocationSize=1, initialValue=1)
     */
    private $idInventario;

    /**
     * @var string
     *
     * @ORM\Column(name="id_compra", type="string", length=30, nullable=true)
     */
    private $idCompra;

    /**
     * @var string
     *
     * @ORM\Column(name="id_producto", type="string", length=30, nullable=true)
     */
    private $idProducto;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad_inicial", type="string", length=30, nullable=true)
     */
    private $cantidadInicial;

    /**
     * @var string
     *
     * @ORM\Column(name="cantidad_disponible", type="string", length=30, nullable=true)
     */
    private $cantidadDisponible;



    /**
     * Get idInventario
     *
     * @return integer 
     */
    public function getIdInventario()
    {
        return $this->idInventario;
    }

    /**
     * Set idCompra
     *
     * @param string $idCompra
     * @return Inventario
     */
    public function setIdCompra($idCompra)
    {
        $this->idCompra = $idCompra;

        return $this;
    }

    /**
     * Get idCompra
     *
     * @return string 
     */
    public function getIdCompra()
    {
        return $this->idCompra;
    }

    /**
     * Set idProducto
     *
     * @param string $idProducto
     * @return Inventario
     */
    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get idProducto
     *
     * @return string 
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set cantidadInicial
     *
     * @param string $cantidadInicial
     * @return Inventario
     */
    public function setCantidadInicial($cantidadInicial)
    {
        $this->cantidadInicial = $cantidadInicial;

        return $this;
    }

    /**
     * Get cantidadInicial
     *
     * @return string 
     */
    public function getCantidadInicial()
    {
        return $this->cantidadInicial;
    }

    /**
     * Set cantidadDisponible
     *
     * @param string $cantidadDisponible
     * @return Inventario
     */
    public function setCantidadDisponible($cantidadDisponible)
    {
        $this->cantidadDisponible = $cantidadDisponible;

        return $this;
    }

    /**
     * Get cantidadDisponible
     *
     * @return string 
     */
    public function getCantidadDisponible()
    {
        return $this->cantidadDisponible;
    }
}
