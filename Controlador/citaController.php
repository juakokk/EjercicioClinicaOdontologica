
<?php

require_once (__DIR__.'/../Modelo/Cita.php');

if(!empty($_GET['action'])){
    CitaController::main($_GET['action']);
}else{
    echo "No se encontro ninguna accion...";
}

class CitaController{

    static function main($action){
        if ($action == "crear"){
            CitaController::crear();
        }/*else if ($action == "editar"){
            citaController::editar();
        }else if ($action == "buscarID"){
            citaController::buscarID(1);
        }*/
    }

    static public function crear (){
        try {
            $arraycita = array();
            $arraycita['Fecha'] = $_POST['Fecha'];
            $arraycita['Codigo'] = $_POST['Codigo'];
            $arraycita['Estado'] = $_POST['Estado'];
            $arraycita['Valor'] = $_POST['Valor'];
            $arraycita['NConsultorio'] = $_POST['NConsultorio'];
            $arraycita['Observaciones'] = $_POST['Observaciones'];
            $arraycita['Motivo'] = $_POST['Motivo'];
            $arraycita['idPaciente'] = $_POST['idPaciente'];
            $arraycita['idEspecialista'] = $_POST['idEspecialista'];

            $cita = new cita ($arraycita);
            $cita->insertar();
            header("Location: ../Vista/pages/Citas.php?respuesta=correcto");
        } catch (Exception $e) {
            header("Location: ../Vista/pages/Citas.php?respuesta=error");
            //var_dump($e);
        }
    }
    /*
    static public function editar (){
        try {
            $arrayOdonto = array();
            $arrayOdonto['nombres'] = $_POST['nombres'];
            $arrayOdonto['apellidos'] = $_POST['apellidos'];
            $arrayOdonto['especialidad'] = $_POST['especialidad'];
            $arrayOdonto['direccion'] = $_POST['direccion'];
            $arrayOdonto['celular'] = $_POST['celular'];
            $arrayOdonto['user'] = $_POST['user'];
            $arrayOdonto['pass'] = $_POST['pass'];
            $arrayOdonto['Telefono'] = $_POST['Telefono'];
            $arrayOdonto['idodontologos'] = $_POST['idodontologos'];
            $odonto = new Odontologos ($arrayOdonto);
            $odonto->editar();
            header("Location: ../registrocita.php?respuesta=correcto");
        } catch (Exception $e) {
            header("Location: ../registrocita.php?respuesta=error");
        }
    }*/

    /*
    static public function buscarID ($id){
        try {
            return Odontologos::buscarForId($id);
        } catch (Exception $e) {
            header("Location: ../buscarOdontologos.php?respuesta=error");
        }
    }

    public function buscarAll (){
        try {
            return Odontologos::getAll();
        } catch (Exception $e) {
            header("Location: ../buscarOdontologos.php?respuesta=error");
        }
    }

    public function buscar ($campo, $parametro){
        try {
            return Odontologos::getAll();
        } catch (Exception $e) {
            header("Location: ../buscarOdontologos.php?respuesta=error");
        }
    }*/

}
?>