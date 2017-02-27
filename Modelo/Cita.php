<?php

/**
 * Created by PhpStorm.
 * User: turbo core
 * Date: 21/02/2017
 * Time: 3:03 PM
 */
require_once('db_abstract_class.php');

class Cita extends db_abstract_class
{

    private $idCita;
    private $Fecha;
    private $Codigo;
    private $Estado;
    private $Valor;
    private $NConsultorio;
    private $Observaciones;
    private $Motivo;
    private $idPaciente;
    private $idEspecialista;



    public function __construct($odontologos_data = array())
    {
        var_dump($odontologos_data);
        parent::__construct();
        if (count($odontologos_data) > 1) {
            foreach ($odontologos_data as $campo => $valor) {
                $this->$campo = $valor;
            }
        } else {
            $this->idCita = "";
            $this->Fecha = "";
            $this->Codigo = "";
            $this->Estado = "";
            $this->Valor = "";
            $this->NConsultorio = "";
            $this->Observaciones = "";
            $this->Motivo = "";
            $this->idPaciente="";
            $this->idEspecialista="";


        }
    }

    /* Metodo destructor cierra la conexion. */
    function __destruct()
    {
        $this->Disconnect();
        unset($this);
    }

    /**
     * @return mixed
     */
    public function getidCita()
    {
        return $this->idCita;
    }

    /**
     * @param mixed $idCita
     */
    public function setidCita($idCita)
    {
        $this->idCita = $idCita;
    }


    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->Fecha;
    }

    /**
     * @param mixed $idCita
     */
    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->Codigo;
    }

    /**
     * @param mixed $Codigo
     */
    public function setCodigo($Codigo)
    {
        $this->Codigo = $Codigo;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->Estado;
    }

    /**
     * @param mixed $Estado
     */
    public function setEstado($Estado)
    {
        $this->Estado = $Estado;
    }

    /**
     * @return mixed
     */
    public function getValor()
    {
        return $this->Valor;
    }

    /**
     * @param mixed $Valor
     */
    public function setValor($Valor)
    {
        $this->Valor = $Valor;
    }

    /**
     * @return mixed
     */
    public function getNConsultorio()
    {
        return $this->NConsultorio;
    }

    /**
     * @param mixed $NConsultorio
     */
    public function setNConsultorio($NConsultorio)
    {
        $this->NConsultorio = $NConsultorio;
    }

    /**
     * @return mixed
     */
    public function getObservaciones()
    {
        return $this->Observaciones;
    }

    /**
     * @param mixed $Observaciones
     */
    public function setObservaciones($Observaciones)
    {
        $this->Observaciones = $Observaciones;
    }

    /**
     * @return mixed
     */
    public function getMotivo()
    {
        return $this->Motivo;
    }

    /**
     * @param mixed $Motivo
     */
    public function setMotivo($Motivo)
    {
        $this->Motivo = $Motivo;
    }
    public function getidPaciente()
    {
        return $this->idPaciente;
    }

    /**
     * @param mixed $idCita
     */
    public function setidPaciente($idPaciente)
    {
        $this->idPaciente = $idPaciente;
    }

    public function getidEspecialista()
    {
        return $this->idEspecialista;
    }

    /**
     * @param mixed $idCita
     */
    public function setidEspecialista($idEspecialista)
    {
        $this->idEspecialista = $idEspecialista;
    }
    /**
     * @return mixed
     */


    protected static function buscarForId($id)
    {
        $Cit = new cita();
        if ($id > 0) {
            $getrow = $Cit->getRow("SELECT * FROM odontologos.cita WHERE idCita =?", array($id));
            $Cit->idCita = $getrow['idCita'];
            $Cit->Fecha = $getrow['Fecha'];
            $Cit->Codigo = $getrow['Codigo'];
            $Cit->Estado = $getrow['Estado'];
            $Cit->Valor = $getrow['Valor'];
            $Cit->NConsultorio = $getrow['NConsultorio'];
            $Cit->Observaciones = $getrow['Observaciones'];
            $Cit->Motivo = $getrow['Motivo'];

            $Cit->Disconnect();
            return $Cit;
        } else {
            return NULL;
        }
    }

    protected static function buscar($query)
    {
        $arrcitas = array();
        $tmp = new cita();
        $getrows = $tmp->getRows($query);

        foreach ($getrows as $valor) {
            $Cit = new cita();
            $Cit->idCita = $valor['idCita'];
            $Cit->Fecha = $valor['Fecha'];
            $Cit->Codigo = $valor['Codigo'];
            $Cit->Estado = $valor['Estado'];
            $Cit->Valor = $valor['Valor'];
            $Cit->NConsultorio = $valor['NConsultorio'];
            $Cit->Observaciones = $valor['Observaciones'];
            $Cit->Motivo = $valor['Motivo'];

            array_push($arrcitas, $Cit);
        }
        $tmp->Disconnect();
        return $arrcitas;
    }

    protected static function getAll()
    {
        return cita::buscar("SELECT * FROM odontologos.cita");
    }

    public function insertar()
    {
        $this->insertRow("INSERT INTO odontologos.cita VALUES ('NULL' , ?, ?, ?, ?, ?, ?,?,?,?)", array(
                $this->Fecha,
                $this->Codigo,
                $this->Estado,
                $this->Valor,
                $this->NConsultorio,
                $this->Observaciones,
                $this->Motivo,
                $this->idPaciente,
                $this->idEspecialista

            )
        );
        $this->Disconnect();
    }

    protected function editar()
    {

        $arrUser = (array)$this;
        $this->updateRow("UPDATE odontologos.cita SET Nombre = ?, Estado = ?, Valor = ?, NConsultorio = ?, Observaciones = ?, Motivo = ?, Genero = ?, $this->Telefono = ? WHERE idCita = ?", array(
            $this->idCita,
            $this->Fecha,
            $this->Codigo,
            $this->Estado,
            $this->Valor,
            $this->NConsultorio,
            $this->Observaciones,
            $this->Motivo

        ));
        $this->Disconnect();

    }
        public function getObjectPaciente(){

         return Paciente::buscarForId($this->idPaciente);
        }
    public function getObjectEspecialista(){

        return especialista::buscarForId($this->idEspecialista);
    }

    protected function eliminar($id)
    {
        if ($id > 0) {
            return $this->deleteRow("DELETE FROM odontologos.cita WHERE id = ?", array($id));
        } else {
            return false;
        }
    }


}