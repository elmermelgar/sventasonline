<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario", uniqueConstraints={@ORM\UniqueConstraint(name="usuario_pk", columns={"id_usuario"})})
 * @ORM\Entity
 */
/**
 * @ORM\Entity(repositoryClass="too\sistemadeventasBundle\Entity\UsuarioRepository")
 */

class Usuario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_usuario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="usuario_id_usuario_seq", allocationSize=1, initialValue=1)
     */
    private $idUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_usu", type="string", length=50, nullable=true)
     */
    private $nombreUsu;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_usu", type="string", length=50, nullable=true)
     */
    private $apellidoUsu;

    /**
     * @var integer
     *
     * @ORM\Column(name="rol", type="integer", nullable=true)
     */
    private $rol;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=30, nullable=true)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=300, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=30, nullable=true)
     */
    private $correo;

    /**
     * @var string
     *
     * @ORM\Column(name="saldo", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $saldo;



    /**
     * Get idUsuario
     *
     * @return integer 
     */
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    /**
     * Set nombreUsu
     *
     * @param string $nombreUsu
     * @return Usuario
     */
    public function setNombreUsu($nombreUsu)
    {
        $this->nombreUsu = $nombreUsu;

        return $this;
    }

    /**
     * Get nombreUsu
     *
     * @return string 
     */
    public function getNombreUsu()
    {
        return $this->nombreUsu;
    }

    /**
     * Set apellidoUsu
     *
     * @param string $apellidoUsu
     * @return Usuario
     */
    public function setApellidoUsu($apellidoUsu)
    {
        $this->apellidoUsu = $apellidoUsu;

        return $this;
    }

    /**
     * Get apellidoUsu
     *
     * @return string 
     */
    public function getApellidoUsu()
    {
        return $this->apellidoUsu;
    }

    /**
     * Set rol
     *
     * @param integer $rol
     * @return Usuario
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return integer 
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set usuario
     *
     * @param string $usuario
     * @return Usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string 
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set correo
     *
     * @param string $correo
     * @return Usuario
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Set saldo
     *
     * @param string $saldo
     * @return Usuario
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

        return $this;
    }

    /**
     * Get saldo
     *
     * @return string 
     */
    public function getSaldo()
    {
        return $this->saldo;
    }
}
