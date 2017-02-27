<?php
session_start();
require_once (__DIR__.'/../Modelo/Paciente.php');

if(!empty($_GET['action'])){
    pacienteController::main($_GET['action']);
}else{
    echo "No se encontro ninguna accion...";
}


 class pacienteController{

   static  function main($action){
        if ($action == "crear"){
            pacienteController::crear();
        }else if ($action == "editar") {
            pacienteController::editar();

        }

        else if ($action == "selectPacientes"){
            pacienteController::selectPacientes();
        }else if ($action == "adminTablePacientes"){
            pacienteController::adminTablePacientes();
        }else if ($action == "InactivarPaciente"){
            pacienteController::CambiarEstado("Inactivo");
        }else if ($action == "ActivarPaciente"){
                pacienteController::CambiarEstado("Activo");
}

        /*else if ($action == "buscarID"){
            pacienteController::buscarID(1);
        }*/
    }

    static public function crear (){
        try {
            $arrayPaciente = array();
            $arrayPaciente['Nombres'] = $_POST['Nombres'];
            $arrayPaciente['Apellidos'] = $_POST['Apellidos'];
            $arrayPaciente['Direccion'] = $_POST['Direccion'];
            $arrayPaciente['TipoDocumento'] = $_POST['TipoDocumento'];
            $arrayPaciente['Documento'] = $_POST['Documento'];
            $arrayPaciente['Email'] = $_POST['Email'];
            $arrayPaciente['Genero'] = $_POST['Genero'];
            $arrayPaciente['Estado'] = "Activo";
            $paciente = new Paciente ($arrayPaciente);
            $paciente->insertar();
            header("Location: ../Vista/pages/registroPaciente.php?respuesta=correcto");
        } catch (Exception $e) {
            //var_dump($e);
            header("Location: ../Vista/pages/registroPaciente.php?respuesta=error");
        }
    }

    static public function selectPacientes ($isRequired=true, $id="idPaciente", $nombre="idPaciente", $class=""){
        $arrPacientes = Paciente::getAll(); /*  */
        $htmlSelect = "<select ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."'>";
        $htmlSelect .= "<option >Seleccione el Paciente </option>";
        if(count($arrPacientes) > 0){
            foreach ($arrPacientes as $paciente)
                $htmlSelect .= "<option value='".$paciente->getidPaciente()."'>".$paciente->getNombres()." ".$paciente->getApellidos()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }





    static public function adminTablePacientes (){
                $arrPacientes = Paciente::getAll(); /*  */
                $tmpPaciente = new Paciente();
        $arrColumnas = [/*"idPaciente",*/"Nombres","Apellidos",/*"TipoDocumento",*/"Documento","Direccion","Email","Genero","Estado"];
                $htmlTable = "<thead>";
                    $htmlTable .= "<tr>";
                        foreach ($arrColumnas as $NameColumna){
                            $htmlTable .= "<th>".$NameColumna."</th>";
                        }
        $htmlTable .= "<th>Acciones</th>";
            $htmlTable .= "</tr>";
        $htmlTable .= "</thead>";

        $htmlTable .= "<tbody>";
        foreach ($arrPacientes as $ObjPaciente){
                        $htmlTable .= "<tr>";
            //$htmlTable .= "<td>".$ObjPaciente->getIdPaciente()."</td>";
                            $htmlTable .= "<td>".$ObjPaciente->getNombres()."</td>";
                            $htmlTable .= "<td>".$ObjPaciente->getApellidos()."</td>";
                            //$htmlTable .= "<td>".$ObjPaciente->getTipoDocumento()."</td>";
                            $htmlTable .= "<td>".$ObjPaciente->getDocumento()."</td>";
                            $htmlTable .= "<td>".$ObjPaciente->getDireccion()."</td>";
                            $htmlTable .= "<td>".$ObjPaciente->getEmail()."</td>";
                            $htmlTable .= "<td>".$ObjPaciente->getGenero()."</td>";
                            $htmlTable .= "<td>".$ObjPaciente->getEstado()."</td>";

                            $icons = "";
                            if($ObjPaciente->getEstado() == "Activo"){
                                $icons .= "<a data-toggle='tooltip' title='Inactivar Usuario' data-placement='top' class='btn btn-social-icon btn-danger newTooltip' href='../../Controlador/pacienteController.php?action=InactivarPaciente&IdPaciente=".$ObjPaciente->getIdPaciente()."'><i class='fa fa-times'></i></a>";
                                }else{
                                $icons .= "<a data-toggle='tooltip' title='Activar Usuario' data-placement='top' class='btn btn-social-icon btn-success newTooltip' href='../../Controlador/pacienteController.php?action=ActivarPaciente&IdPaciente=".$ObjPaciente->getIdPaciente()."'><i class='fa fa-check'></i></a>";
                                }
                                $icons .= "<a data-toggle='tooltip' title='Actualizar Usuario' data-placement='top' class='btn btn-social-icon btn-primary newTooltip' href='actualizarPaciente.php?IdPaciente=".$ObjPaciente->getIdPaciente()."'><i class='fa fa-pencil'></i></a>";
                                $icons .= "<a data-toggle='tooltip' title='Ver Usuario' data-placement='top' class='btn btn-social-icon btn-warning newTooltip' href='../../Controlador/pacienteController.php?action=InactivarPaciente&IdPaciente=".$ObjPaciente->getIdPaciente()."'><i class='fa fa-eye'></i></a>";
                $htmlTable .= "<td>".$icons."</td>";
             $htmlTable .= "</tr>";
         }
                $htmlTable .= "</tbody>";




        return $htmlTable;
    }


    static public function editar (){
        try {
                $TmpObject = Paciente::buscarForId($_SESSION["IdPaciente"]);
                $Estado = $TmpObject->getEstado();
            $arrayPaciente = array();
            $arrayPaciente['Nombres'] = $_POST['Nombres'];
            $arrayPaciente['Apellidos'] = $_POST['Apellidos'];
            $arrayPaciente['Direccion'] = $_POST['Direccion'];
            $arrayPaciente['Email'] = $_POST['Email'];
            $arrayPaciente['Genero'] = $_POST['Genero'];
            $arrayPaciente['Estado'] = $Estado;
            $arrayPaciente['idPaciente'] = $_SESSION["IdPaciente"];
            $paciente = new Paciente ($arrayPaciente);
            var_dump($arrayPaciente);
            $paciente->editar();
            unset($_SESSION["IdPaciente"]);
            var_dump($paciente);
           header("Location: ../Vista/pages/actualizarPaciente.php?respuesta=correcto&IdPaciente=".$arrayPaciente['idPaciente']);

        } catch (Exception $e) {
            var_dump($e);
            $txtMensaje = $e->getMessage();
           header("Location: ../Vista/pages/actualizarPaciente.php?respuesta=error&Mensaje=".$txtMensaje);
        }
    }

    static public function CambiarEstado ($Estado){
                try {
                    $idPaciente = $_GET["IdPaciente"];
                    $ObjPaciente = Paciente::buscarForId($idPaciente);
                    $ObjPaciente->setEstado($Estado);
                    $ObjPaciente->editar();
                    header("Location: ../Vista/pages/adminPacientes.php?respuesta=correcto");
                }catch (Exception $e){
                    $txtMensaje = $e->getMessage();
                    header("Location: ../Vista/pages/adminPacientes.php?respuesta=error&Mensaje=".$txtMensaje);
        }
     }
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