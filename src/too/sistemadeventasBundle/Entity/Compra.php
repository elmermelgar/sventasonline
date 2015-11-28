<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compra
 *
 * @ORM\Table(name="compra", indexes={@ORM\Index(name="contiene_fk", columns={"id_proveedor"})})
 * @ORM\Entity
 */
class Compra
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_compra", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="compra_id_compra_seq", allocationSize=1, initialValue=1)
     */
    private $idCompra;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_comp", type="date", nullable=true)
     */
    private $fechaComp;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_factura_compra", type="integer", nullable=true)
     */
    private $numeroFacturaCompra;

    /**
     * @var \Proveedor
     *
     * @ORM\ManyToOne(targetEntity="Proveedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proveedor", referencedColumnName="id_proveedor")
     * })
     */
    private $idProveedor;



    /**
     * Get idCompra
     *
     * @return integer 
     */
    public function getIdCompra()
    {
        return $this->idCompra;
    }

    /**
     * Set fechaComp
     *
     * @param \DateTime $fechaComp
     * @return Compra
     */
    public function setFechaComp($fechaComp)
    {
        $this->fechaComp = $fechaComp;

        return $this;
    }

    /**
     * Get fechaComp
     *
     * @return \DateTime 
     */
    public function getFechaComp()
    {
        return $this->fechaComp;
    }

    /**
     * Set numeroFacturaCompra
     *
     * @param integer $numeroFacturaCompra
     * @return Compra
     */
    public function setNumeroFacturaCompra($numeroFacturaCompra)
    {
        $this->numeroFacturaCompra = $numeroFacturaCompra;

        return $this;
    }

    /**
     * Get numeroFacturaCompra
     *
     * @return integer 
     */
    public function getNumeroFacturaCompra()
    {
        return $this->numeroFacturaCompra;
    }

    /**
     * Set idProveedor
     *
     * @param \too\sistemadeventasBundle\Entity\Proveedor $idProveedor
     * @return Compra
     */
    public function setIdProveedor(\too\sistemadeventasBundle\Entity\Proveedor $idProveedor = null)
    {
        $this->idProveedor = $idProveedor;

        return $this;
    }

    /**
     * Get idProveedor
     *
     * @return \too\sistemadeventasBundle\Entity\Proveedor 
     */
    public function getIdProveedor()
    {
        return $this->idProveedor;
    }
}
