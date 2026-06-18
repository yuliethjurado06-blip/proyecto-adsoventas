<?php
class Usuario {
    private $ID;
    private $Nombre;
    private $Apellido;
    private $Email;
    private $Contrasena;

    // Constructor
    public function __construct($ID, $Nombre, $Apellido, $Email, $Contrasena) {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->Apellido = $Apellido;
        $this->Email = $Email;
        $this->Contrasena = $Contrasena;
    }

    // Getters y Setters
    public function getID() {
        return $this->ID;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function getApellido() {
        return $this->Apellido;
    }

    public function setApellido($Apellido) {
        $this->Apellido = $Apellido;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }

    public function getContrasena() {
        return $this->Contrasena;
    }

    public function setContrasena($Contrasena) {
        $this->Contrasena = $Contrasena;
    }
}
?>
