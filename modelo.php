<?php 
require_once __DIR__.'/includes/conexion.php';

class modelo{

    private $CNX;

    public function __construct()
    {
        $this->CNX=conexion::mysql();
    }

    public function Login($usuario,$clave){
        $sql="select User from users where User='".$usuario."' and Password='".$clave."'";
        $sql=$this->CNX->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()==0){
            return false;
        }else{
            return $sql->fetch(PDO::FETCH_NAMED);
        }
    }

    public function actualizarFoto($nombre,$id){
        try {
            $sql="UPDATE paciente set img='".$nombre."' where id='".$id."'";
            $sql=$this->CNX->prepare($sql);
            $sql->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function SelectDepartamentos(){
        $sql="SELECT * from departamentos order by nombre asc";
        $sql=$this->CNX->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_NAMED);
    }

    public function SelectMunicipios($data){
        $sql="SELECT * from municipios 
        where departamento_id='".$data['Dep']."'
        order by nombre asc";
        $sql=$this->CNX->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_NAMED);
    }

    public function SelectGeneros(){
        $sql="SELECT * from genero";
        $sql=$this->CNX->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_NAMED);
    }

    public function SelectTipoDocumento(){
        $sql="SELECT * from tipos_documento";
        $sql=$this->CNX->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_NAMED); 
    }

    public function ListarPacientes(){
        $sql="SELECT 
        p.id,td.nombre tipo_documento,p.numero_documento,concat(p.nombre1,' ',p.nombre2,' ',p.apellido1,' ',p.apellido2) nombres,
        g.nombre genero,d.nombre departamento,m.nombre municipio
        FROM paciente p
        inner join tipos_documento td on td.id=p.tipo_documento_id
        inner join genero g on g.id=p.genero_id
        inner join departamentos d on d.id=p.departamento_id
        inner join municipios m on m.id=p.municipio_id";
        $sql=$this->CNX->prepare($sql);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_NAMED); 
    }

    public function RegistrarPaciente($data){
        try {
            $sql="INSERT INTO paciente (tipo_documento_id,numero_documento,nombre1,nombre2,apellido1,apellido2,genero_id,departamento_id,municipio_id)
            values(:tipo_documento_id,:numero_documento,:nombre1,:nombre2,:apellido1,:apellido2,:genero_id,:departamento_id,:municipio_id)";
            $sql=$this->CNX->prepare($sql);
            $sql->execute(array(
                ':tipo_documento_id' => $data['Tip'],
                ':numero_documento' => $data['Doc'],
                ':nombre1' => $data['nombre1'],
                ':nombre2' => $data['nombre2'],
                ':apellido1' => $data['apellido1'],
                ':apellido2' => $data['apellido2'],
                ':genero_id' => $data['Gen'],
                ':departamento_id' => $data['Dep'],
                ':municipio_id' => $data['Mun'],
            ));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function EditarPaciente($data){
        try {
            $sql="UPDATE paciente SET 
            tipo_documento_id=:tipo_documento_id,
            numero_documento=:numero_documento,
            nombre1=:nombre1,
            nombre2=:nombre2,
            apellido1=:apellido1,
            apellido2=:apellido2,
            genero_id=:genero_id,
            departamento_id=:departamento_id,
            municipio_id=:municipio_id
            where id='".$data['id']."'";
            $sql=$this->CNX->prepare($sql);
            $sql->execute(array(
                ':tipo_documento_id' => $data['Tip'],
                ':numero_documento' => $data['Doc'],
                ':nombre1' => $data['nombre1'],
                ':nombre2' => $data['nombre2'],
                ':apellido1' => $data['apellido1'],
                ':apellido2' => $data['apellido2'],
                ':genero_id' => $data['Gen'],
                ':departamento_id' => $data['Dep'],
                ':municipio_id' => $data['Mun'],
            ));
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function EliminarPaciente($data){
        try {
            $sql="DELETE FROM paciente where id='".$data['id']."'";
            $sql=$this->CNX->prepare($sql);
            $sql->execute();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function DatosPaciente($data){
        try {
            $sql="SELECT * FROM paciente where id='".$data['id']."'";
        $sql=$this->CNX->prepare($sql);
        $sql->execute();
        if ($sql->rowCount()==0){
            return false;
        }else{
            return $sql->fetch(PDO::FETCH_NAMED);
        }
        } catch (Exception $e) {
         var_dump($e);   
        }
    }
}
?>