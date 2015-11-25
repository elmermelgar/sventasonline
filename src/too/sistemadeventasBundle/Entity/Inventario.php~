<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inventario
 *
 * @ORM\Table(name="inventario", uniqueConstraints={@ORM\UniqueConstraint(name="inventario_pk", columns={"id_inventario"})}, indexes={@ORM\Index(name="tiene_fk", columns={"id_producto"}), @ORM\Index(name="descarga_fk", columns={"id_compra"})})
 * @ORM\Entity
 */
/**
 * @ORM\Entity(repositoryClass="too\sistemadeventasBundle\Entity\InventarioRepository")
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
     * @var integer
     *
     * @ORM\Column(name="cantidad_inicial", type="integer", nullable=true)
     */
    private $cantidadInicial;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_disponible", type="integer", nullable=true)
     */
    private $cantidadDisponible;

    /**
     * @var string
     *
     * @ORM\Column(name="costo_promedio", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $costoPromedio;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_maxima", type="integer", nullable=true)
     */
    private $cantidadMaxima;

    /**
     * @var \Compra
     *
     * @ORM\ManyToOne(targetEntity="Compra")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_compra", referencedColumnName="id_compra")
     * })
     */
    private $idCompra;

    /**
     * @var \Producto
     *
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_producto", referencedColumnName="id_producto")
     * })
     */
    private $idProducto;



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
     * Set cantidadInicial
     *
     * @param integer $cantidadInicial
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
     * @return integer 
     */
    public function getCantidadInicial()
    {
        return $this->cantidadInicial;
    }

    /**
     * Set cantidadDisponible
     *
     * @param integer $cantidadDisponible
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
     * @return integer 
     */
    public function getCantidadDisponible()
    {
        return $this->cantidadDisponible;
    }

    /**
     * Set costoPromedio
     *
     * @param string $costoPromedio
     * @return Inventario
     */
    public function setCostoPromedio($costoPromedio)
    {
        $this->costoPromedio = $costoPromedio;

        return $this;
    }

    /**
     * Get costoPromedio
     *
     * @return string 
     */
    public function getCostoPromedio()
    {
        return $this->costoPromedio;
    }

    /**
     * Set cantidadMaxima
     *
     * @param integer $cantidadMaxima
     * @return Inventario
     */
    public function setCantidadMaxima($cantidadMaxima)
    {
        $this->cantidadMaxima = $cantidadMaxima;

        return $this;
    }

    /**
     * Get cantidadMaxima
     *
     * @return integer 
     */
    public function getCantidadMaxima()
    {
        return $this->cantidadMaxima;
    }

    /**
     * Set idCompra
     *
     * @param \too\sistemadeventasBundle\Entity\Compra $idCompra
     * @return Inventario
     */
    public function setIdCompra(\too\sistemadeventasBundle\Entity\Compra $idCompra = null)
    {
        $this->idCompra = $idCompra;

        return $this;
    }

    /**
     * Get idCompra
     *
     * @return \too\sistemadeventasBundle\Entity\Compra 
     */
    public function getIdCompra()
    {
        return $this->idCompra;
    }

    /**
     * Set idProducto
     *
     * @param \too\sistemadeventasBundle\Entity\Producto $idProducto
     * @return Inventario
     */
    public function setIdProducto(\too\sistemadeventasBundle\Entity\Producto $idProducto = null)
    {
        $this->idProducto = $idProducto;

        return $this;
    }

    /**
     * Get idProducto
     *
     * @return \too\sistemadeventasBundle\Entity\Producto 
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }
}
