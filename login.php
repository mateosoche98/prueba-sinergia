<?php 
require_once __DIR__.'/controller.php';
$control = new controller();
$datos=$control->Login($_POST['usuario'], $_POST['clave']);

if ($datos["msg"]===true){
    session_start();
    $_SESSION['usuario'] = $datos['datos']['User'];
    echo ('<script>alert("Bienvenido");window.location.href=`vprincipal.php`</script>');
}else{
    echo ('<script>alert("Usuario o contraseña invalida");window.location.href=`./`</script>');
}
?>