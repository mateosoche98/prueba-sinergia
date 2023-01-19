$("#Dep").select2({
    placeholder: "Departamentos",
    allowClear: true
});
$("#Mun").select2({
    placeholder: "Municipios",
    allowClear: true
});

$("#Tip").select2({
    placeholder: "Tipo Documento",
    allowClear: true
});

$("#Gen").select2({
    placeholder: "Genero",
    allowClear: true
});

function Validar() {
    if ($('#Doc').val() == '') {
        msg("Documento No puede ser nulo", "info");
        return false;
    }
    if ($('#Tip').val() == '') {
        msg("Tipo No puede ser nulo", "info");
        return false;
    }
    if ($('#nombre1').val() == '') {
        msg("Primer Nombre No puede ser nulo", "info");
        return false;
    }
    // if ($('#nombre2').val() == '') {
    //     msg("Segundo Nombre No puede ser nulo", "info");
    //     return false;
    // }
    if ($('#apellido1').val() == '') {
        msg("Primer Apellido No puede ser nulo", "info");
        return false;
    }
    if ($('#apellido2').val() == '') {
        msg("Segundo Apellido No puede ser nulo", "info");
        return false;
    }
    if ($('#Dep').val() == '') {
        msg("Departamento No puede ser nulo", "info");
        return false;
    }
    if ($('#Mun').val() == '') {
        msg("Municipio No puede ser nulo", "info");
        return false;
    }
    if ($('#Gen').val() == '') {
        msg("Genero No puede ser nulo", "info");
        return false;
    }

}

async function RegistrarPaciente() {
    if (Validar() == false) {
        return false;
    }
    let formulario = new FormData();
    formulario.append("ruta", "RegistrarPaciente");
    formulario.append("Doc", $('#Doc').val());
    formulario.append("nombre1", $('#nombre1').val());
    formulario.append("nombre2", $('#nombre2').val());
    formulario.append("apellido1", $('#apellido1').val());
    formulario.append("apellido2", $('#apellido2').val());
    formulario.append("Dep", $('#Dep').val());
    formulario.append("Mun", $('#Mun').val());
    formulario.append("Gen", $('#Gen').val());
    formulario.append("Tip", $('#Tip').val());
    try {
        let req2 = await fetch("controller.php", {
            method: "POST",
            body: formulario,
        });
        let res2 = await req2.json();
        if (res2.msg == "ok") {
            msg("Paciente Registrado correctamente", "success");
            $('#modalpaciente').modal('hide');
            LimpiarRegistro();
            ListarPacientes();
        } else {
            msg("Error al registrar", "error");
        }
    } catch (error) {
        msg("Error al registrar", "error");
    }
}

async function DatosPaciente(id) {
    let formulario = new FormData();
    formulario.append("ruta", "DatosPaciente");
    formulario.append("id", id);
    try {
        let req2 = await fetch("controller.php", {
            method: "POST",
            body: formulario,
        });
        let res2 = await req2.json();
        console.log(res2);
        if (res2.msg == "ok") {
            $('#Tip').val(res2.data.tipo_documento_id).trigger('change');
            $('#Gen').val(res2.data.genero_id).trigger('change');
            $('#Dep').val(res2.data.departamento_id).trigger('change');
            SelectMunicipios(res2.data.municipio_id);
            $('#Doc').val(res2.data.numero_documento);
            $('#nombre1').val(res2.data.nombre1);
            $('#nombre2').val(res2.data.nombre2);
            $('#apellido1').val(res2.data.apellido1);
            $('#apellido2').val(res2.data.apellido2);
            $('#Mun').val(res2.data.municipio_id).trigger('change');
            $('#btn-pac').attr("onclick", `EditarPaciente(${id})`).html('Actualizar Paciente');
            $('#modalpaciente').modal('show');
        } else {
            msg("Error al editar paciente", "error");
        }
    } catch (error) {
        msg("Error al editar paciente", "error");
    }
}

async function EditarPaciente(id) {
    if (Validar() == false) {
        return false;
    }
    let formulario = new FormData();
    formulario.append("ruta", "EditarPaciente");
    formulario.append("Doc", $('#Doc').val());
    formulario.append("nombre1", $('#nombre1').val());
    formulario.append("nombre2", $('#nombre2').val());
    formulario.append("apellido1", $('#apellido1').val());
    formulario.append("apellido2", $('#apellido2').val());
    formulario.append("Dep", $('#Dep').val());
    formulario.append("Mun", $('#Mun').val());
    formulario.append("Gen", $('#Gen').val());
    formulario.append("Tip", $('#Tip').val());
    formulario.append("id", id);
    try {
        let req2 = await fetch("controller.php", {
            method: "POST",
            body: formulario,
        });
        let res2 = await req2.json();
        if (res2.msg == "ok") {
            msg("Paciente Registrado correctamente", "success");
            $('#modalpaciente').modal('hide');
            LimpiarRegistro();
            ListarPacientes();
        } else {
            msg("Error al registrar", "error");
        }
    } catch (error) {
        msg("Error al registrar", "error");
    }
}

async function EliminarPaciente(id) {
    if (window.confirm("¿Seguro de eliminar Paciente?") === false) {
        return;
    }
    let formulario = new FormData();
    formulario.append("ruta", "EliminarPaciente");
    formulario.append("id", id);
    try {
        let req2 = await fetch("controller.php", {
            method: "POST",
            body: formulario,
        });
        let res2 = await req2.json();
        if (res2.msg == "ok") {
            msg("Paciente Eliminado correctamente", "success");
            ListarPacientes();
        } else {
            msg("Error al eliminar paciente", "error");
        }
    } catch (error) {
        msg("Error al eliminar paciente", "error");
    }
}


function LimpiarRegistro() {
    $('#Doc').val('');
    $('#nombre1').val('');
    $('#nombre2').val('');
    $('#apellido1').val('');
    $('#apellido2').val('');
    $('#Tip').val('').trigger('change');
    $('#Dep').val('').trigger('change');
    $('#Mun').val('').trigger('change');
    $('#Gen').val('').trigger('change');

}

ListarPacientes();
async function ListarPacientes() {
    let formulario = new FormData();
    formulario.append("ruta", "ListarPacientes");
    try {
        let req2 = await fetch("controller.php", {
            method: "POST",
            body: formulario,
        });
        let res2 = await req2.text();
        $('#responsepacientes').html(res2);
        $('#example1').DataTable({
            scrollY: '50vh',
            scrollX: true,
            order: [[0, 'desc']],
            lengthMenu: [
                [50, -1],
                [50, 'All'],
            ],
        });
    } catch (error) {
        $('#responsepacientes').html("Error inesperado");
    }
}

async function SelectMunicipios(opt) {
    $('#Mun').val('').trigger('change');
    let formulario = new FormData();
    formulario.append("ruta", "SelectMunicipios");
    formulario.append("Dep", $('#Dep').val());
    try {
        let req2 = await fetch("controller.php", {
            method: "POST",
            body: formulario,
        });
        let res2 = await req2.text();
        $('#Mun').html(`<option value=""></option>${res2}`);
        if (opt != 0) {
            $('#Mun').val(opt).trigger('change');
        }
    } catch (error) {
        $('#Mun').html(`<option value=""></option>`);
    }
}