<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente", uniqueConstraints={@ORM\UniqueConstraint(name="cliente_pk", columns={"id_cliente"})}, indexes={@ORM\Index(name="relationship_10_fk", columns={"id_usuario"})})
 * @ORM\Entity
 */
class Cliente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cliente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="cliente_id_cliente_seq", allocationSize=1, initialValue=1)
     */
    private $idCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="cuenta", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $cuenta;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono_cli", type="string", length=10, nullable=true)
     */
    private $telefonoCli;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=30, nullable=true)
     */
    private $pais;

    /**
     * @var integer
     *
     * @ORM\Column(name="codigo_postal", type="integer", nullable=true)
     */
    private $codigoPostal;

    /**
     * @var \Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_usuario", referencedColumnName="id_usuario")
     * })
     */
    private $idUsuario;



    /**
     * Get idCliente
     *
     * @return integer 
     */
    public function getIdCliente()
    {
        return $this->idCliente;
    }

    /**
     * Set cuenta
     *
     * @param string $cuenta
     * @return Cliente
     */
    public function setCuenta($cuenta)
    {
        $this->cuenta = $cuenta;

        return $this;
    }

    /**
     * Get cuenta
     *
     * @return string 
     */
    public function getCuenta()
    {
        return $this->cuenta;
    }

    /**
     * Set telefonoCli
     *
     * @param string $telefonoCli
     * @return Cliente
     */
    public function setTelefonoCli($telefonoCli)
    {
        $this->telefonoCli = $telefonoCli;

        return $this;
    }

    /**
     * Get telefonoCli
     *
     * @return string 
     */
    public function getTelefonoCli()
    {
        return $this->telefonoCli;
    }

    /**
     * Set pais
     *
     * @param string $pais
     * @return Cliente
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set codigoPostal
     *
     * @param integer $codigoPostal
     * @return Cliente
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get codigoPostal
     *
     * @return integer 
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set idUsuario
     *
     * @param \too\sistemadeventasBundle\Entity\Usuario $idUsuario
     * @return Cliente
     */
    public function setIdUsuario(\too\sistemadeventasBundle\Entity\Usuario $idUsuario = null)
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return \too\sistemadeventasBundle\Entity\Usuario 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }
}
