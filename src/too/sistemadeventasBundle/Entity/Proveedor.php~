<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proveedor
 *
 * @ORM\Table(name="proveedor", uniqueConstraints={@ORM\UniqueConstraint(name="proveedor_pk", columns={"id_proveedor"})})
 * @ORM\Entity
 */
class Proveedor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_proveedor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="proveedor_id_proveedor_seq", allocationSize=1, initialValue=1)
     */
    private $idProveedor;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_prov", type="string", length=30, nullable=true)
     */
    private $nombreProv;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=80, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_prov", type="string", length=10, nullable=true)
     */
    private $telefonoProv;



    /**
     * Get idProveedor
     *
     * @return integer 
     */
    public function getIdProveedor()
    {
        return $this->idProveedor;
    }

    /**
     * Set nombreProv
     *
     * @param string $nombreProv
     * @return Proveedor
     */
    public function setNombreProv($nombreProv)
    {
        $this->nombreProv = $nombreProv;

        return $this;
    }

    /**
     * Get nombreProv
     *
     * @return string 
     */
    public function getNombreProv()
    {
        return $this->nombreProv;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Proveedor
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefonoProv
     *
     * @param string $telefonoProv
     * @return Proveedor
     */
    public function setTelefonoProv($telefonoProv)
    {
        $this->telefonoProv = $telefonoProv;

        return $this;
    }

    /**
     * Get telefonoProv
     *
     * @return string 
     */
    public function getTelefonoProv()
    {
        return $this->telefonoProv;
    }
}
