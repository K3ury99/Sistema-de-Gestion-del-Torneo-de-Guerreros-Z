<?php

class Plantilla{

    static $instancia = null;

    public static function aplicar(){
        if (self::$instancia == null) {
            self::$instancia = new Plantilla();
        }
    
    }

    public function __construct(){
        ?>
        <!DOCTYPE html>
<html lang ="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Torneo de la fuerza 🥷🏿🤜🏿🔥</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
            padding: 20px;
            container: 100%;
        }

        h1 {
            color: #333;
            margin-top: 50px;
        }

        p {
            color: #666;
            font-size: 20px;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #333;
            padding: 4px;
            text-align: left;
        }

        .text-registro {
            text-align: right;
            width: 90%;
            margin-top: 20px;
        }

        .boton {
            background-color:rgb(62, 150, 198);
            color: #fff;
            padding: 9px 15px;
            text-decoration: none;
            border-radius: 5px;
        }

        label,input{
            font-size: 1.5em;
        }
    </style>

</head>
<body>
     <div class="container"></div>
      
        <?php

}

public function _destruct(){

    ?>
      </div>

</body>

</html>

    <?php

}

}