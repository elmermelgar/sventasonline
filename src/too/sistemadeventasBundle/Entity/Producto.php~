<?php

namespace too\sistemadeventasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Producto
 *
 * @ORM\Table(name="producto", indexes={@ORM\Index(name="compuesto_fk", columns={"id_categoria"})})
 * @ORM\Entity
 */

class Producto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_producto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="producto_id_producto_seq", allocationSize=1, initialValue=1)
     */
    private $idProducto;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=200, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_prod", type="string", length=50, nullable=true)
     */
    private $nombreProd;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_prod", type="string", length=200, nullable=true)
     */
    private $descripcionProd;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_prod", type="integer", nullable=true)
     */
    private $cantidadProd;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_unitario", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $precioUnitario;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado;

    /**
     * @var \Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_categoria", referencedColumnName="id_categoria")
     * })
     */
    private $idCategoria;



    /**
     * Get idProducto
     *
     * @return integer 
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Producto
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set nombreProd
     *
     * @param string $nombreProd
     * @return Producto
     */
    public function setNombreProd($nombreProd)
    {
        $this->nombreProd = $nombreProd;

        return $this;
    }

    /**
     * Get nombreProd
     *
     * @return string 
     */
    public function getNombreProd()
    {
        return $this->nombreProd;
    }

    /**
     * Set descripcionProd
     *
     * @param string $descripcionProd
     * @return Producto
     */
    public function setDescripcionProd($descripcionProd)
    {
        $this->descripcionProd = $descripcionProd;

        return $this;
    }

    /**
     * Get descripcionProd
     *
     * @return string 
     */
    public function getDescripcionProd()
    {
        return $this->descripcionProd;
    }

    /**
     * Set cantidadProd
     *
     * @param integer $cantidadProd
     * @return Producto
     */
    public function setCantidadProd($cantidadProd)
    {
        $this->cantidadProd = $cantidadProd;

        return $this;
    }

    /**
     * Get cantidadProd
     *
     * @return integer 
     */
    public function getCantidadProd()
    {
        return $this->cantidadProd;
    }

    /**
     * Set precioUnitario
     *
     * @param string $precioUnitario
     * @return Producto
     */
    public function setPrecioUnitario($precioUnitario)
    {
        $this->precioUnitario = $precioUnitario;

        return $this;
    }

    /**
     * Get precioUnitario
     *
     * @return string 
     */
    public function getPrecioUnitario()
    {
        return $this->precioUnitario;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     * @return Producto
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set idCategoria
     *
     * @param \too\sistemadeventasBundle\Entity\Categoria $idCategoria
     * @return Producto
     */
    public function setIdCategoria(\too\sistemadeventasBundle\Entity\Categoria $idCategoria = null)
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }

    /**
     * Get idCategoria
     *
     * @return \too\sistemadeventasBundle\Entity\Categoria 
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    //SUBIDAS
    public function getAbsolutePath() {
        return null === $this->image ? null : $this->getUploadRootDir() . '/' . $this->image;
    }

    public function getWebPath() {
        return null === $this->image ? null : $this->getUploadDir() . '/' . $this->image;
    }

    public function getUploadRootDir() {
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir() {
        return 'uploads';
    }

    public function upload() {

        if (null === $this->getImagen()) {
            return;
        }

        $this->getImagen()->move(
            $this->getUploadRootDir(), $this->getImagen()->getClientOriginalName()
        );

        $this->imagen = $this->getImagen()->getClientOriginalName();

        $this->file = null;
    }

    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
}
