<?php
session_start();
include __DIR__ . '/header.php';
require_once __DIR__ . '/controller.php';
$control = new controller();
if (!isset($_SESSION['usuario'])){
    header('location: ./index.php');
}
?>
<br>
<div class="container">
    <section class="row">
        <section class="col-md-12" >
            <h2 class="text-center"  style="box-shadow: 0px 0px 10px 0px #545454;padding: 10px;margin: 10px;margin-bottom: 5px;">Pacientes Sinergia</h2>
        </section>
    </section>
    <hr>
    <section class="row">
        <section class="col-md-2">
            <button class="btn btn-primary btn-block" onclick=" LimpiarRegistro();$('#btn-pac').attr('onclick',`RegistrarPaciente()`).html('Registrar');$('#modalpaciente').modal('show')">Crear Paciente</button>
        </section>
        <section class="col-md-8"></section>
        <section class="col-md-2">
            <button class="btn btn-danger btn-block" onclick="window.location.href=`./logout.php`">Cerrar Sesión</button>
        </section>
    </section>
    <hr>
    <section class="row">
        <section class="col-md-12">
            <div id="responsepacientes" style="box-shadow: 0px 0px 10px 0px #545454;padding: 20px;margin: 10px;margin-bottom: 5px;"></div>
        </section>
    </section>
</div>
<!-- modal crear paciente -->
<div class="modal fade" id="modalpaciente" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title text-center" id="titulomodalgraficas" style="width: 100%;">Crear Paciente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <section class="row">
                    <section class="col-md-6">
                        <select id="Tip" class="form-control" style="width: 100%;">
                            <option value=""></option>
                            <?php foreach ($control->SelectTipoDocumento() as $row) : ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </section>
                    <section class="col-md-6">
                        <input type="number" id="Doc" maxlength="10" class="form-control" placeholder="Documento de Identidad">
                    </section>

                </section>
                <br>
                <section class="row">
                    <section class="col-md-6">
                        <input type="text" id="nombre1" class="form-control" placeholder="Primer Nombre">
                    </section>
                    <section class="col-md-6">
                        <input type="text" id="nombre2" class="form-control" placeholder="Segundo Nombre">
                    </section>
                </section>
                <br>
                <section class="row">
                    <section class="col-md-6">
                        <input type="text" id="apellido1" class="form-control" placeholder="Primer Apellido">
                    </section>
                    <section class="col-md-6">
                        <input type="text" id="apellido2" class="form-control" placeholder="Segundo Apellido">
                    </section>
                </section>
                <br>
                <section class="row">
                    <section class="col-md-6">
                        <select id="Dep" class="form-control" style="width: 100%;" onchange="SelectMunicipios(0)">
                            <option value=""></option>
                            <?php foreach ($control->SelectDepartamentos() as $row) : ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </section>
                    <section class="col-md-6">
                        <select id="Mun" class="form-control" style="width: 100%;">
                            <option value=""></option>
                        </select>
                    </section>
                </section>
                <br>
                <section class="row">
                    <section class="col-md-6">
                        <select id="Gen" class="form-control" style="width: 100%;">
                            <option value=""></option>
                            <?php foreach ($control->SelectGeneros() as $row) : ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </section>
                </section>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="btn-pac" onclick="RegistrarPaciente()">Registrar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!--termina  modal crear paciente -->
<script src="control.js"></script>
