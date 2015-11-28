<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria", uniqueConstraints={@ORM\UniqueConstraint(name="categoria_pk", columns={"id_categoria"})})
 * @ORM\Entity
 */
class Categoria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_categoria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="categoria_id_categoria_seq", allocationSize=1, initialValue=1)
     */
    private $idCategoria;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_cat", type="string", length=30, nullable=true)
     */
    private $nombreCat;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_cat", type="string", length=200, nullable=true)
     */
    private $descripcionCat;



    /**
     * Get idCategoria
     *
     * @return integer 
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set nombreCat
     *
     * @param string $nombreCat
     * @return Categoria
     */
    public function setNombreCat($nombreCat)
    {
        $this->nombreCat = $nombreCat;

        return $this;
    }

    /**
     * Get nombreCat
     *
     * @return string 
     */
    public function getNombreCat()
    {
        return $this->nombreCat;
    }

    /**
     * Set descripcionCat
     *
     * @param string $descripcionCat
     * @return Categoria
     */
    public function setDescripcionCat($descripcionCat)
    {
        $this->descripcionCat = $descripcionCat;

        return $this;
    }

    /**
     * Get descripcionCat
     *
     * @return string 
     */
    public function getDescripcionCat()
    {
        return $this->descripcionCat;
    }
}
