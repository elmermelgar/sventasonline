<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promocion
 *
 * @ORM\Table(name="promocion")
 * @ORM\Entity
 */
class Promocion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_promocion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="promocion_id_promocion_seq", allocationSize=1, initialValue=1)
     */
    private $idPromocion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=30, nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="descuento", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $descuento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=true)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     */
    private $fechaFin;



    /**
     * Get idPromocion
     *
     * @return integer 
     */
    public function getIdPromocion()
    {
        return $this->idPromocion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Promocion
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set descuento
     *
     * @param string $descuento
     * @return Promocion
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return string 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Promocion
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return Promocion
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }
}
