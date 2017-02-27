<?php require "../../Controlador/especialistaController.php";?>
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

</head>

<body>

<div id="wrapper">

    <?php include ("includes/barra-navegacion.php"); ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Administrar Especialistas</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <!-- /.row -->
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Datos de Especialista
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <?php echo especialistaController::adminTableEspecilista(); ?>
                        </table>
                        <!-- /.table-responsive -->
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
