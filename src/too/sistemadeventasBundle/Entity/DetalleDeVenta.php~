<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DetalleDeVenta
 *
 * @ORM\Table(name="detalle_de_venta", indexes={@ORM\Index(name="posee_fk", columns={"id_venta"})})
 * @ORM\Entity
 */
class DetalleDeVenta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_detalle", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="detalle_de_venta_id_detalle_seq", allocationSize=1, initialValue=1)
     */
    private $idDetalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_detalle", type="integer", nullable=true)
     */
    private $cantidadDetalle;

    /**
     * @var string
     *
     * @ORM\Column(name="importe", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $importe;

    /**
     * @var \Venta
     *
     * @ORM\ManyToOne(targetEntity="Venta")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_venta", referencedColumnName="id_venta")
     * })
     */
    private $idVenta;



    /**
     * Get idDetalle
     *
     * @return integer 
     */
    public function getIdDetalle()
    {
        return $this->idDetalle;
    }

    /**
     * Set cantidadDetalle
     *
     * @param integer $cantidadDetalle
     * @return DetalleDeVenta
     */
    public function setCantidadDetalle($cantidadDetalle)
    {
        $this->cantidadDetalle = $cantidadDetalle;

        return $this;
    }

    /**
     * Get cantidadDetalle
     *
     * @return integer 
     */
    public function getCantidadDetalle()
    {
        return $this->cantidadDetalle;
    }

    /**
     * Set importe
     *
     * @param string $importe
     * @return DetalleDeVenta
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }

    /**
     * Get importe
     *
     * @return string 
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set idVenta
     *
     * @param \too\sistemadeventasBundle\Entity\Venta $idVenta
     * @return DetalleDeVenta
     */
    public function setIdVenta(\too\sistemadeventasBundle\Entity\Venta $idVenta = null)
    {
        $this->idVenta = $idVenta;

        return $this;
    }

    /**
     * Get idVenta
     *
     * @return \too\sistemadeventasBundle\Entity\Venta 
     */
    public function getIdVenta()
    {
        return $this->idVenta;
    }
}
