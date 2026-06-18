<?php

class Producto {
    private $ID;
    private $Nombre;
    private $Descripcion;
    private $Precio;
    private $Stock;


    public function __construct($ID, $Nombre, $Descripcion, $Precio, $Stock) {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
        $this->Stock = $Stock;
        
    }

    // Getters
    public function getID() {
        return $this->ID;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function getPrecio() {
        return $this->Precio;
    }

    public function getStock() {
        return $this->Stock;
    }

    

}
?>
