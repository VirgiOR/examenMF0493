<?php
require_once(__DIR__ . '/../../config/Database.php');
class Producto {
    private $id;
    private $nombreProducto;
    private $descripcion;
    private $precio;
    private $stock;
    private $imagenURL;
    private $idCategoria;
    private $bd;

    public function __construct($nombreProducto, $descripcion, $precio, $stock,
     $imagenURL, $idCategoria, $bd, $id=0)
    {
        $this->nombreProducto=$nombreProducto;
        $this->descripcion=$descripcion;
        $this->precio=$precio;
        $this->stock=$stock;
        $this->imagenURL=$imagenURL;
        $this->idCategoria=$idCategoria;
        $this->bd=$bd;
        $this->id=$id; 
    }



    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nombreProducto
     */
    public function getNombreProducto()
    {
        return $this->nombreProducto;
    }

    /**
     * Set the value of nombreProducto
     */
    public function setNombreProducto($nombreProducto): self
    {
        $this->nombreProducto = $nombreProducto;

        return $this;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     */
    public function setDescripcion($descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get the value of precio
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set the value of precio
     */
    public function setPrecio($precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get the value of stock
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set the value of stock
     */
    public function setStock($stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get the value of imagenURL
     */
    public function getImagenURL()
    {
        return $this->imagenURL;
    }

    /**
     * Set the value of imagenURL
     */
    public function setImagenURL($imagenURL): self
    {
        $this->imagenURL = $imagenURL;

        return $this;
    }

    /**
     * Get the value of idCategoria
     */
    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    /**
     * Set the value of idCategoria
     */
    public function setIdCategoria($idCategoria): self
    {
        $this->idCategoria = $idCategoria;

        return $this;
    }


    

    
    public static function getProductoPorNombre($nombreProducto, $bd){
        $stmt = $bd->prepare("SELECT * FROM producto WHERE nombre_producto= ?");
        $stmt->execute([$nombreProducto]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila) {
            $producto  = new Producto(
                $fila['nombre_producto'],
                $fila['descripcion'],
                $fila['precio'],
                $fila['id'], 
                $fila['id_categoria'],
                $bd);
        }
        if (isset($producto)) return $producto;
    }

    public  static function getListaProductos($bd) {
        $stmt = $bd->query("SELECT * FROM productos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 

    public function guardar() {
        if ($this->id==0) {
            //  insertar
            $stmt = $this->bd->prepare("INSERT INTO productos(nombre_producto, descripcion, precio, stock, imagen_url, idCategoria) VALUES(?,?,?,?,?,?)");
            $resultado= $stmt->execute([$this->nombreProducto, $this->descripcion, $this->precio, $this->stock, $this->imagenURL, $this->idCategoria]);
            if ($resultado) {
                $this->id=$this->bd->lastInsertId();
            }
        } else {
            //actualizar
            $stmt = $this->bd->prepare("UPDATE productos SET nombre_producto=?, descripcion=?, precio=?, stock=?, imagenURL=?, idCategoria=? WHERE id=?");
            $resultado=$stmt->execute([$this->nombreProducto,$this->descripcion,$this->precio,$this->stock,$this->imagenURL,$this->idCategoria, $this->id]);
        }
        return $resultado;
    }
}  
    
?>




