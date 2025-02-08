<?php
require("libreria/motor.php");

$peleador = new peleador();
$peleador -> id = $_POST["id"];
$peleador -> nombre = $_POST["nombre"];
$peleador -> apellido = $_POST["apellido"];
$peleador -> fecha_nacimiento = $_POST["fecha_nacimiento"];
$peleador -> foto = $_POST["foto"];

foreach ($_POST["habilidades"]["nombre"] as $i => $nombre) {
    $habilidad = new Habilidades();
    $habilidad -> nombre = $nombre;
    $habilidad -> tipo = $_POST["habilidades"]["tipo"][$i];
    $habilidad -> nivel = $_POST["habilidades"]["nivel"][$i];
    $peleador -> habilidades[] = $habilidad;
}

guardar_datos($peleador->id, $peleador);

plantilla::aplicar();

?>

<h1> 📀Datos guardados </h1>

<div class="d-derecha">
    <a href="index.php" class="boton">Volver</a>
</div>


