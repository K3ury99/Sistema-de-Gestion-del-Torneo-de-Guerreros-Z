<?php

class Habilidades{
    var $nombre = "";
    var $tipo = "";
    var $nivel = 0;
}
class peleador{
    var $id ="";
    var $nombre = "";
    var $apellido = "";
    var $fecha_nacimiento = "";
    var $foto = "";
    var $habilidades =[];

    function edad(){
        $fecha_nac = !empty($this->fecha_nacimiento) ? strtotime($this->fecha_nacimiento) : 0;
        $fecha_actual = time();
        $edad = ($fecha_actual - $fecha_nac) / 60 / 60 / 24 / 365.25;
        return floor ($edad);
    }

    function n_habilidades(){
        return count($this->habilidades);
    }


    function signos_zodiacal(){
        $fecha = strtotime($this->fecha_nacimiento);
        $mes = date("m", $fecha);
        $dia = date("d", $fecha);

       if (($mes == 1 && $dia >= 20) || ($mes == 2 && $dia <= 18)) {
           return "acuario";
       } else if(($mes == 2 && $dia >= 19) || ($mes == 3 && $dia <= 20)){
           return "piscis";
       } else if(($mes == 3 && $dia >= 21) || ($mes == 4 && $dia <= 19)){
           return "aries";
       } else if(($mes == 4 && $dia >= 20) || ($mes == 5 && $dia <= 20)){
           return "tauro";
       } else if(($mes == 5 && $dia >= 21) || ($mes == 6 && $dia <= 20)){
           return "geminis";
       } else if(($mes == 6 && $dia >= 21) || ($mes == 7 && $dia <= 22)){
           return "cancer";
       } else if(($mes == 7 && $dia >= 23) || ($mes == 8 && $dia <= 22)){
           return "leo";
       } else if(($mes == 8 && $dia >= 23) || ($mes == 9 && $dia <= 22)){
           return "virgo";
       } else if(($mes == 9 && $dia >= 23) || ($mes == 10 && $dia <= 22)){
           return "libra";
       } else if(($mes == 10 && $dia >= 23) || ($mes == 11 && $dia <= 21)){
           return "escorpio";
       } else if(($mes == 11 && $dia >= 22) || ($mes == 12 && $dia <= 21)){
           return "sagitario";
       } else if(($mes == 12 && $dia >= 22) || ($mes == 1 && $dia <= 19)){
           return "capricornio";

       }


    }
}