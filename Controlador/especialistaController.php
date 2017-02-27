<?php
session_start();
require_once (__DIR__.'/../Modelo/Especialista.php');

if(!empty($_GET['action'])){
    EspecialistaController::main($_GET['action']);
}else{
    echo "No se encontro ninguna accion...";
}

class EspecialistaController{

    static function main($action){
        if ($action == "crear"){
            EspecialistaController::crear();
        }else if ($action == "editar"){
            EspecialistaController::editar();
        }else if ($action == "selectEspecialista"){
            EspecialistaController::selectEspecialista();
        }else if ($action == "adminTableEspecialista"){
            EspecialistaController::adminTableEspecialista();
        }
        else if ($action == "InactivarEspecialista"){
           EspecialistaController::CambiarEstado("Inactivo");
        }else if ($action == "ActivarEspecialista"){
            EspecialistaController::CambiarEstado("Activo");
        }
        /*
        else if ($action == "buscarID"){
            EspecialistaController::buscarID(1);
        }*/
    }

    static public function crear (){
        try {
            $arrayEspecialista = array();
            $arrayEspecialista['Tipo'] = $_POST['Tipo'];
            $arrayEspecialista['Nombres'] = $_POST['Nombres'];
            $arrayEspecialista['Apellidos'] = $_POST['Apellidos'];

            $arrayEspecialista['TipoDocumento'] = $_POST['TipoDocumento'];
            $arrayEspecialista['Documento'] = $_POST['Documento'];
            $arrayEspecialista['Email'] = $_POST['Email'];
            $arrayEspecialista['Direccion'] = $_POST['Direccion'];
            $arrayEspecialista['Genero'] = $_POST['Genero'];
            $arrayEspecialista['Telefono'] = $_POST['Telefono'];
            $arrayEspecialista['Estado'] = "Activo";

            $Especialista = new Especialista ($arrayEspecialista);
            $Especialista->insertar();
           header("Location: ../Vista/pages/registroEspecialista.php?respuesta=correcto");
        } catch (Exception $e) {
           header("Location: ../Vista/pages/registroEspecialista.php?respuesta=error");
           //var_dump($e);
        }
    }

    static public function selectEspecialista ($isRequired=true, $id="idEspecialista", $nombre="idEspecialista", $class=""){
        $arrEspecialista = Especialista::getAll(); /*  */
        $htmlSelect = "<select ".(($isRequired) ? "required" : "")." id= '".$id."' name='".$nombre."' class='".$class."'>";
        $htmlSelect .= "<option >Seleccione el Especialista </option>";
        if(count($arrEspecialista) > 0){
            foreach ($arrEspecialista as $especialista)
                $htmlSelect .= "<option value='".$especialista->getidEspecialista()."'>".$especialista->getNombres()." ".$especialista->getApellidos()."</option>";
        }
        $htmlSelect .= "</select>";
        return $htmlSelect;
    }
    static public function adminTableEspecilista (){
        $arrEspecialista =Especialista ::getAll(); /*  */
        $tmpEspecialista = new Especialista();
        $arrColumnas = [/*"idEspecialista",*/"Tipo","Nombre","Apellido","Documento"/*"TipoDocumento",*/,"Email","Direccion","Genero","Telefono","Estado"];
        $htmlTable = "<thead>";
        $htmlTable .= "<tr>";
        foreach ($arrColumnas as $NameColumna){
            $htmlTable .= "<th>".$NameColumna."</th>";
        }
        $htmlTable .= "<th>Acciones</th>";
        $htmlTable .= "</tr>";
        $htmlTable .= "</thead>";

        $htmlTable .= "<tbody>";
        foreach ($arrEspecialista as $ObjEspecialista){
            $htmlTable .= "<tr>";
            //$htmlTable .= "<td>".$ObjEspecialista->getIdEspecialista()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getTipo()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getNombres()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getApellidos()."</td>";
            //$htmlTable .= "<td>".$ObjEspecialista->getTipoDocumento()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getDocumento()."</td>";

            $htmlTable .= "<td>".$ObjEspecialista->getEmail()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getDireccion()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getGenero()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getTelefono()."</td>";
            $htmlTable .= "<td>".$ObjEspecialista->getEstado()."</td>";

            $icons = "";
            if($ObjEspecialista->getEstado() == "Activo"){
                $icons .= "<a data-toggle='tooltip' title='Inactivar Usuario' data-placement='top' class='btn btn-social-icon btn-danger newTooltip' href='../../Controlador/especialistaController.php?action=InactivarEspecialista&IdEspecialista=".$ObjEspecialista->getidEspecialista()."'><i class='fa fa-times'></i></a>";
            }else{
                $icons .= "<a data-toggle='tooltip' title='Activar Usuario' data-placement='top' class='btn btn-social-icon btn-success newTooltip' href='../../Controlador/especialistaController.php?action=ActivarEspecialista&IdEspecialista=".$ObjEspecialista->getidEspecialista()."'><i class='fa fa-check'></i></a>";
            }
            $icons .= "<a data-toggle='tooltip' title='Actualizar Usuario' data-placement='top' class='btn btn-social-icon btn-primary newTooltip' href='actualizarEspecialista.php?IdEspecialista=".$ObjEspecialista->getidEspecialista()."'><i class='fa fa-pencil'></i></a>";
            $icons .= "<a data-toggle='tooltip' title='Ver Usuario' data-placement='top' class='btn btn-social-icon btn-warning newTooltip' href='../../Controlador/especialistaController.php?action=InactivarPaciente&Especialista=".$ObjEspecialista->getidEspecialista()."'><i class='fa fa-eye'></i></a>";
            $htmlTable .= "<td>".$icons."</td>";

            $htmlTable .= "</tr>";
        }
        $htmlTable .= "</tbody>";




        return $htmlTable;
    }

    static public function editar (){
        try {
            $TmpObject = especialista::buscarForId($_SESSION["IdEspecialista"]);
            $Estado = $TmpObject->getEstado();
            $arrayEspecialista = array();
            $arrayEspecialista['Tipo'] = $_POST['Tipo'];
            $arrayEspecialista['Nombres'] = $_POST['Nombres'];
            $arrayEspecialista['Apellidos'] = $_POST['Apellidos'];
            $arrayEspecialista['TipoDocumento'] = $_POST['TipoDocumento'];
            $arrayEspecialista['Documento'] = $_POST['Documento'];
            $arrayEspecialista['Email'] = $_POST['Email'];
            $arrayEspecialista['Direccion'] = $_POST['Direccion'];
            $arrayEspecialista['Genero'] = $_POST['Genero'];
            $arrayEspecialista['Telefono'] = $_POST['Telefono'];
            $arrayEspecialista['Estado'] = $Estado;
            $arrayEspecialista['idEspecialista'] = $_SESSION["IdEspecialista"];
            $Especialista = new Especialista ($arrayEspecialista);
            $Especialista->editar();
            //var_dump($Especialista);
            unset($_SESSION["IdEspecialista"]);
            header("Location: ../Vista/pages/actualizarEspecialista.php?respuesta=correcto&Especialista=".$arrayEspecialista['idEspecilista']);

        } catch (Exception $e) {
            //var_dump($e);
            $txtMensaje = $e->getMessage();
            header("Location: ../Vista/pages/actualizarEspecialista.php?respuesta=error&Mensaje=".$txtMensaje);
        }
    }
    static public function CambiarEstado ($Estado){
        try {
            $idEspecialista = $_GET["IdEspecialista"];
            $ObjEspecialista = especialista::buscarForId($idEspecialista);
            $ObjEspecialista->setEstado($Estado);
            $ObjEspecialista->editar();
            header("Location: ../Vista/pages/adminEspecialistas.php?respuesta=correcto");
        }catch (Exception $e){
            $txtMensaje = $e->getMessage();
            header("Location: ../Vista/pages/adminEspecialistas.php?respuesta=error&Mensaje=".$txtMensaje);
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