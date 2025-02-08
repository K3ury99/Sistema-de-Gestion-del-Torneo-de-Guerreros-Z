<?php

function the_input($nombre, $label, $valor = "", $extra=[]){
    $type = "text";
    $required = "";
    extract($extra);

    return <<<HTML
<div style ="margin: 10px;">
        <label for="{$nombre}">{$label}:</label><br>
        <input {$required} type="{$type}"  style="width: 350px;" value="{$valor}" name="{$nombre}" id="ID">


    </div>

HTML;

}


function guardar_datos($codigo,$datos){

    if(!is_dir("datos")){
        mkdir("datos");
    }


    file_put_contents("datos/{$codigo}.dat", serialize($datos));
}

function cargar_datos($codigo){
    if(!is_file("datos/{$codigo}.dat")){
        return false;
    }

    $datos = file_get_contents("datos/{$codigo}.dat");
    return unserialize($datos);
}

function lista_Dregistro(){

    // Se inicializa un array vacío donde se almacenarán los registros
    $registros = [];

    // Se obtienen los nombres de los archivos en el directorio "datos"
    $archivos = scandir("datos");

    // Se recorren los archivos encontrados
    foreach($archivos as $archivo){

        // Se verifica si el archivo es realmente un archivo y no un directorio
        if(!is_file("datos/{$archivo}")){
            continue;
        }

        // Se cargan los datos del archivo eliminando la extensión ".dat"
        $datos = cargar_datos(str_replace(".dat", "", $archivo));

        // Se añaden los datos al array de registros
        $registros[] = $datos;
    }

    // Se devuelve el array con todos los registros
    return $registros;
}