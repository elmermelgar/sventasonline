<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Devolucion
 *
 * @ORM\Table(name="devolucion", indexes={@ORM\Index(name="sobre_fk", columns={"id_venta"})})
 * @ORM\Entity
 */
class Devolucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_devolucion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="devolucion_id_devolucion_seq", allocationSize=1, initialValue=1)
     */
    private $idDevolucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_dev", type="date", nullable=true)
     */
    private $fechaDev;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_dev", type="string", length=200, nullable=true)
     */
    private $descripcionDev;

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
     * Get idDevolucion
     *
     * @return integer 
     */
    public function getIdDevolucion()
    {
        return $this->idDevolucion;
    }

    /**
     * Set fechaDev
     *
     * @param \DateTime $fechaDev
     * @return Devolucion
     */
    public function setFechaDev($fechaDev)
    {
        $this->fechaDev = $fechaDev;

        return $this;
    }

    /**
     * Get fechaDev
     *
     * @return \DateTime 
     */
    public function getFechaDev()
    {
        return $this->fechaDev;
    }

    /**
     * Set descripcionDev
     *
     * @param string $descripcionDev
     * @return Devolucion
     */
    public function setDescripcionDev($descripcionDev)
    {
        $this->descripcionDev = $descripcionDev;

        return $this;
    }

    /**
     * Get descripcionDev
     *
     * @return string 
     */
    public function getDescripcionDev()
    {
        return $this->descripcionDev;
    }

    /**
     * Set idVenta
     *
     * @param \too\sistemadeventasBundle\Entity\Venta $idVenta
     * @return Devolucion
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
