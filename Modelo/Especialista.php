<?php

/**
 * Created by PhpStorm.
 * User: CAPACITACION-PC
 * Date: 16/2/2017
 * Time: 22:07
 */
require_once('db_abstract_class.php');

class especialista extends db_abstract_class
{

    private $idEspecialista;
    private $Tipo;
    private $Nombres;
    private $Apellidos;
    private $Documento;
    private $TipoDocumento;
    private $Direccion;
    private $Email;
    private $Genero;
    private $Telefono;
    private $Estado;

    public function __construct($odontologos_data=array())
    {
        parent::__construct();
        if(count($odontologos_data)>1){
            foreach ($odontologos_data as $campo => $valor){
                $this->$campo = $valor;
            }
        }else {
            $this->idEspecialista = "";
            $this->Tipo = "";
            $this->Nombres = "";
            $this->Apellidos = "";
            $this->Documento = "";
            $this->TipoDocumento = "";
            $this->Direccion = "";
            $this->Email = "";
            $this->Genero = "";
            $this->Telefono = "";
            $this->Estado="";

        }
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct() {
        $this->Disconnect();
        unset($this);
    }

    /**
     * @return mixed
     */
    public function getidEspecialista()
    {
        return $this->idEspecialista;
    }

    /**
     * @param mixed $idEspecialista
     */
    public function setidEspecialista($idEspecialista)
    {
        $this->idEspecialista = $idEspecialista;
    }



    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->Tipo;
    }

    /**
     * @param mixed $idEspecialista
     */
    public function setTipo($Tipo)
    {
        $this->Tipo = $Tipo;
    }
    /**
     * @return mixed
     */
    public function getNombres()
    {
        return $this->Nombres;
    }

    /**
     * @param mixed $Nombres
     */
    public function setNombres($Nombres)
    {
        $this->Nombres = $Nombres;
    }

    /**
     * @return mixed
     */
    public function getApellidos()
    {
        return $this->Apellidos;
    }

    /**
     * @param mixed $Apellidos
     */
    public function setApellidos($Apellidos)
    {
        $this->Apellidos = $Apellidos;
    }

    /**
     * @return mixed
     */
    public function getDocumento()
    {
        return $this->Documento;
    }

    /**
     * @param mixed $Documento
     */
    public function setDocumento($Documento)
    {
        $this->Documento = $Documento;
    }

    /**
     * @return mixed
     */
    public function getTipoDocumento()
    {
        return $this->TipoDocumento;
    }

    /**
     * @param mixed $TipoDocumento
     */
    public function setTipoDocumento($TipoDocumento)
    {
        $this->TipoDocumento = $TipoDocumento;
    }

    /**
     * @return mixed
     */


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
    }
    public function getDireccion()
    {
        return $this->Direccion;
    }

    /**
     * @param mixed $Direccion
     */
    public function setDireccion($Direccion)
    {
        $this->Direccion = $Direccion;
    }

    /**
     * @return mixed
     */
    public function getGenero()
    {
        return $this->Genero;
    }

    /**
     * @param mixed $Genero
     */
    public function setGenero($Genero)
    {
        $this->Genero = $Genero;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->Telefono;
    }

    /**
     * @param mixed $$this->Telefono
     */
    public function setTelefono($Telefono)
    {
        $this->Telefono = $Telefono;
    }
    public function getEstado()
    {
        return $this->Estado;
    }

    /**
     * @param mixed $$this->Telefono
     */
    public function setEstado($Estado)
    {
        $this->Estado= $Estado;
    }

    public static function buscarForId($id)
    {
        $Espec = new especialista();
        if ($id > 0){
            $getrow = $Espec->getRow("SELECT * FROM odontologos.especialista WHERE idEspecialista =?", array($id));
            $Espec->idEspecialista = $getrow['idEspecialista'];
            $Espec->Tipo = $getrow['Tipo'];
            $Espec->Nombres = $getrow['Nombre'];
            $Espec->Apellidos = $getrow['Apellido'];
            $Espec->Documento = $getrow['Documento'];
            $Espec->TipoDocumento = $getrow['TipoDocumento'];
            $Espec->Email = $getrow['Email'];
            $Espec->Direccion = $getrow['Direccion'];
            $Espec->Genero = $getrow['Genero'];
            $Espec->Telefono= $getrow['Telefono'];
            $Espec->Estado= $getrow['Estado'];
            $Espec->Disconnect();
            return $Espec;
        }else{
            return NULL;
        }
    }

    public static function buscar($query)
    {
        $arrEspecialistas = array();
        $tmp = new especialista();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Espec = new especialista();
            $Espec->idEspecialista = $valor['idEspecialista'];
            $Espec->Tipo = $valor['Tipo'];
            $Espec->Nombres = $valor['Nombre'];
            $Espec->Apellidos = $valor['Apellido'];
            $Espec->Documento = $valor['Documento'];
            $Espec->TipoDocumento = $valor['TipoDocumento'];

            $Espec->Email = $valor['Email'];
            $Espec->Direccion = $valor['Direccion'];
            $Espec->Genero = $valor['Genero'];
            $Espec->Telefono = $valor['Telefono'];
            $Espec->Estado = $valor['Estado'];
            array_push($arrEspecialistas, $Espec);
        }
        $tmp->Disconnect();
        return $arrEspecialistas;
    }

    public static function getAll()
    {
        return especialista::buscar("SELECT * FROM odontologos.especialista");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO odontologos.especialista VALUES ('NULL' , ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", array(
                $this->Tipo,
                $this->Nombres,
                $this->Apellidos,
                $this->Documento,
                $this->TipoDocumento,

                $this->Email,
                $this->Direccion,
                $this->Genero,
                $this->Telefono,
                $this->Estado
            )
        );
        $this->Disconnect();
    }

    public function editar()
    {

        $arrUser = (array) $this;
        $this->updateRow("UPDATE odontologos.especialista SET Tipo=?, Nombre = ?, Apellido = ?, Documento = ?, TipoDocumento = ?, Email = ?, Direccion = ?, Genero = ?, Telefono=?, Estado = ? WHERE idEspecialista = ?", array(

            $this->Tipo,
            $this->Nombres,
            $this->Apellidos,
            $this->Documento,
            $this->TipoDocumento,
            $this->Email,
            $this->Direccion,
            $this->Genero,
            $this->Telefono,
            $this->Estado,
            $this->idEspecialista
        ));
        $this->Disconnect();





    }

    function getCitas(){

        $arrCitas = "Select * From odontologos.cita WHEN idEspecialista = ".$this->idEspecialista;


    }

    protected function eliminar($id)
    {
        if ($id > 0){
            return $this->deleteRow("DELETE FROM odontologos.especialista WHERE id = ?", array($id));
        }else{
            return false;
        }
    }





}