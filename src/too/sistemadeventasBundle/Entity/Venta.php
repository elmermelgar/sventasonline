<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Venta
 *
 * @ORM\Table(name="venta", uniqueConstraints={@ORM\UniqueConstraint(name="venta_pk", columns={"id_venta"})}, indexes={@ORM\Index(name="registra_fk", columns={"id_producto"}), @ORM\Index(name="aplica_fk", columns={"id_promocion"}), @ORM\Index(name="involucra_fk", columns={"id_cliente"})})
 * @ORM\Entity
 */
class Venta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_venta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="venta_id_venta_seq", allocationSize=1, initialValue=1)
     */
    private $idVenta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ven", type="date", nullable=true)
     */
    private $fechaVen;

    /**
     * @var string
     *
     * @ORM\Column(name="total", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $total;

    /**
     * @var \Promocion
     *
     * @ORM\ManyToOne(targetEntity="Promocion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_promocion", referencedColumnName="id_promocion")
     * })
     */
    private $idPromocion;

    /**
     * @var \Cliente
     *
     * @ORM\ManyToOne(targetEntity="Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cliente", referencedColumnName="id_cliente")
     * })
     */
    private $idCliente;

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
     * Get idVenta
     *
     * @return integer 
     */
    public function getIdVenta()
    {
        return $this->idVenta;
    }

    /**
     * Set fechaVen
     *
     * @param \DateTime $fechaVen
     * @return Venta
     */
    public function setFechaVen($fechaVen)
    {
        $this->fechaVen = $fechaVen;

        return $this;
    }

    /**
     * Get fechaVen
     *
     * @return \DateTime 
     */
    public function getFechaVen()
    {
        return $this->fechaVen;
    }

    /**
     * Set total
     *
     * @param string $total
     * @return Venta
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

    /**
     * Set idPromocion
     *
     * @param \too\sistemadeventasBundle\Entity\Promocion $idPromocion
     * @return Venta
     */
    public function setIdPromocion(\too\sistemadeventasBundle\Entity\Promocion $idPromocion = null)
    {
        $this->idPromocion = $idPromocion;

        return $this;
    }

    /**
     * Get idPromocion
     *
     * @return \too\sistemadeventasBundle\Entity\Promocion 
     */
    public function getIdPromocion()
    {
        return $this->idPromocion;
    }

    /**
     * Set idCliente
     *
     * @param \too\sistemadeventasBundle\Entity\Cliente $idCliente
     * @return Venta
     */
    public function setIdCliente(\too\sistemadeventasBundle\Entity\Cliente $idCliente = null)
    {
        $this->idCliente = $idCliente;

        return $this;
    }

    /**
     * Get idCliente
     *
     * @return \too\sistemadeventasBundle\Entity\Cliente 
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Set idProducto
     *
     * @param \too\sistemadeventasBundle\Entity\Producto $idProducto
     * @return Venta
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
