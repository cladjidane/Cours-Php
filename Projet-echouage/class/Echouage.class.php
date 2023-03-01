<?php

class Echouage {
    //attributs
    private $id;
    private $date;
    private $espece;
    private $zone;
    private $nombre;

    //methodes
    public  function GetId() {
        return $this->id;
    }

    public  function GetEspece() {
        return $this->espece;
    }

    public  function GetDate() {
        return $this->date;
    }

    public  function GetZone() {
        return $this->zone;
    }

    public  function GetNombre() {
        return $this->nombre;
    }

    public  function SetEspece($varId) {
        $this->id = $varId;
    }

    public  function SetZone($zone) {
        $this->zone = $zone;
    }

    public  function SetDate($date) {
        $this->date = $date;
    }

    public  function SetNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function __toString() {
        return $this->espece;
    }
}
