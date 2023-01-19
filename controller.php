<?php
require_once __DIR__ . '/modelo.php';

class controller
{

    private $MODEL;

    public function __construct()
    {
        $this->MODEL = new modelo();
    }

    public function SelectDepartamentos()
    {
        return $this->MODEL->SelectDepartamentos();
    }

    public function SelectMunicipios()
    {
        $datos = $this->MODEL->SelectMunicipios($_POST);
        foreach ($datos as $row) :
            echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
        endforeach;
    }

    public function SelectGeneros()
    {
        return $this->MODEL->SelectGeneros();
    }

    public function SelectTipoDocumento()
    {
        return $this->MODEL->SelectTipoDocumento();
    }

    public function ListarPacientes()
    {
        $datos = $this->MODEL->ListarPacientes();
        if (!is_array($datos)) {
            echo '0 resultados para la busqueda';
        } else {
            include 'tables/tablepacientes.php';
        }
    }

    public function RegistrarPaciente()
    {
        $datos = $this->MODEL->RegistrarPaciente($_POST);
        if ($datos===true) {
            echo json_encode(array("msg" => "ok"));
        } else {
            echo json_encode(array("msg" => "error"));
        }
    }

    public function EditarPaciente()
    {
        $datos = $this->MODEL->EditarPaciente($_POST);
        if ($datos === true) {
            echo json_encode(array("msg" => "ok"));
        } else {
            echo json_encode(array("msg" => "error"));
        }
    }

    public function EliminarPaciente()
    {
        $datos = $this->MODEL->EliminarPaciente($_POST);
        if ($datos === true) {
            echo json_encode(array("msg" => "ok"));
        } else {
            echo json_encode(array("msg" => "error"));
        }
    }

    public function DatosPaciente()
    {
        $datos = $this->MODEL->DatosPaciente($_POST);
        if (is_array($datos)) {
            echo json_encode(array("msg" => "ok", "data" => $datos));
        } else {
            echo json_encode(array("msg" => "error"));
        }
    }

    public function Login($usuario, $clave)
    {
        $datos = $this->MODEL->Login($usuario, $clave);
        if (!is_array($datos)) {
            return array("msg" => false);
        } else {
            return array("msg" => true, "datos" => $datos);
        }
    }
}

if (isset($_POST['ruta'])) {
    call_user_func(array(new controller, $_POST['ruta']));
}
