<?php
class conexion{
	public static function mysql(){
		$x = new PDO("mysql:host=127.0.0.1;dbname=sinergia;charset=utf8","root","");
		$x->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $x;
	}
}
?>