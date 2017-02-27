<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Inicio</title>

    <?php include ("includes/imports.php"); ?>
    <?php include ("../../Controlador/pacienteController.php"); ?>
    <?php include ("../../Controlador/especialistaController.php"); ?>

</head>

<body>


<div id="wrapper">

    <?php include ("includes/barra-navegacion.php"); ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Registro Citas</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Datos Basicos de la Cita
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div id="alertas">
                                <?php if(!empty($_GET["respuesta"]) && $_GET["respuesta"] == "correcto"){ ?>
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        La informacion de la Cita se ha registrado correctamente. Puede administrar las Citas desde <a href="adminCita.php" class="alert-link">Aqui</a> .
                                    </div>
                                <?php } ?>
                                <?php if(!empty($_GET["respuesta"]) && $_GET["respuesta"] == "error"){ ?>
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        No se pudo registrar la Cita. <a href="#" class="alert-link">Error: <?php echo $_GET["Mensaje"] ?></a> .
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-lg-12">
                                <form role="form" method="post" action="../../Controlador/citaController.php?action=crear">


                                    <div class="form-group">

                                        <label>Fecha</label>
                                        <input type="datetime-local" required maxlength="60" id="Fecha" name="Fecha" minlength="10" class="form-control" placeholder="Ingrese fecha de la cita">
                                    </div>
                                    <div class="form-group">
                                        <label>Codigo</label>
                                        <input required maxlength="40" id="Codigo" name="Codigo" minlength="2" class="form-control" placeholder="Ingrese Codigo de la cita ">
                                    </div>
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select required id="Estado" name="Estado" class="form-control">
                                            <option value=Null>Seleccione estado de la cita</option>
                                            <option value="Solicitada">Solicitada</option>
                                            <option value="Cancelado">Cancelado</option>
                                            <option value="Activa">Activa</option>
                                            <option value="Suspendida">Suspendida</option>
                                            <option value="Finalizado">Finalizado</option>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Valor</label>
                                        <input type="number" required maxlength="60" id="Valor" name="Valor" minlength="7" class="form-control" placeholder="Ingrese el valor de la cita">
                                    </div>



                                    <div class="form-group">
                                        <label>NConsultorio</label>
                                        <input type="number" required max="2000" min="1" maxlength="12" id="NConsultorio" name="NConsultorio" minlength="1" class="form-control" placeholder="Ingrese el numero de consultorio">
                                    </div>

                                    <label>Observaciones</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">O</span>
                                        <input type="text" required maxlength="45000000000" id="Observaciones" name="Observaciones" minlength="20" class="form-control" placeholder="Observaciones de la cita">
                                    </div>

                                    <label>Motivo</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">M</span>
                                        <textarea type="text" required maxlength="4500000000" id="Motivo" name="Motivo" minlength="10" class="form-control" placeholder="Ingrese el motivo de la Cita"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Paciente</label>
                                        <?php echo pacienteController:: selectPacientes(true,"idPaciente","idPaciente","form-control"); ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Especialista</label>
                                        <?php echo EspecialistaController::selectEspecialista (true,"idEspecialista","idEspecialista","form-control"); ?>
                                    </div>
                                    <br>

                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                    <button type="reset" class="btn btn-warning">Cancelar</button>
                                </form>
                            </div>
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->

</div>

<?php include ("includes/includes-footer.php"); ?>

</body>

</html>
