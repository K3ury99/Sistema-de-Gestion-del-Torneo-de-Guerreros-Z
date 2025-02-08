<?php
require("libreria/motor.php");
Plantilla::aplicar();

$datos = lista_Dregistro();

// Calcular estadísticas
$total_participantes = count($datos);
$total_habilidades    = 0;
$total_edades         = 0;

foreach ($datos as $peleador) {
    // Habilidades: Verificar que 'habilidades' exista y sea un array
    if (isset($peleador->habilidades) && is_array($peleador->habilidades)) {
        $total_habilidades += count($peleador->habilidades);
    }
    
    // Edad: utilizar fecha_nacimiento para calcular la edad actual
    if (!empty($peleador->fecha_nacimiento)) {
        try {
            $nacimiento = new DateTime($peleador->fecha_nacimiento);
            $hoy = new DateTime();
            $edad = $hoy->diff($nacimiento)->y;
            $total_edades += $edad;
        } catch (Exception $e) {
            error_log("Fecha inválida para: " . $peleador->id);
        }
    }
}

$promedio_habilidades = $total_participantes > 0 ? $total_habilidades / $total_participantes : 0;
$promedio_edad        = $total_participantes > 0 ? $total_edades / $total_participantes : 0;

// Signos zodiacales
$signos = [
    "aries"       => 0,
    "tauro"       => 0,
    "geminis"     => 0,
    "cancer"      => 0,
    "leo"         => 0,
    "virgo"       => 0,
    "libra"       => 0,
    "escorpio"    => 0,
    "sagitario"   => 0,
    "capricornio" => 0,
    "acuario"     => 0,
    "piscis"      => 0
];

foreach ($datos as $peleador) {
    // Normalizar el signo a minúsculas para que coincida con las claves del array
    $signo = strtolower($peleador->signos_zodiacal());
    if (isset($signos[$signo])) {
        $signos[$signo]++;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel de Estadísticas - Torneo de la Fuerza</title>
  <!-- Importar la fuente moderna desde Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <style>
    /* Reinicio de márgenes y paddings */
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f7f8;
      color: #333;
      line-height: 1.6;
      padding-top: 70px; /* Espacio para el header fijo */
    }

    /* Menú de navegación fijo */
    header {
      background: #3498db;
      padding: 10px 20px;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      max-width: 1200px;
      margin: 0 auto;
    }

    .navbar .logo a {
      font-size: 2em;
      text-decoration: none;
      color: #fff;
    }

    .navbar nav ul {
      list-style: none;
      display: flex;
    }

    .navbar nav ul li {
      margin-left: 20px;
    }

    .navbar nav ul li a {
      text-decoration: none;
      color: #fff;
      font-size: 1em;
      transition: color 0.3s;
    }

    .navbar nav ul li a:hover {
      color: #dfe6e9;
    }

    /* Contenedor principal */
    .contenedor {
      max-width: 1200px;
      margin: 10px auto 30px;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: 600;
      font-size: 2.5em;
      color: #222;
    }

    h2 {
      color: #3498db;
      margin-bottom: 15px;
    }

    /* Tarjetas de estadística */
    .tarjeta-estadistica {
      background: #f4f7f8;
      padding: 20px;
      border-radius: 6px;
      text-align: center;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .tarjeta-estadistica:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .tarjeta-estadistica h2 {
      font-size: 2em;
      margin-bottom: 5px;
      color: #333;
    }

    .tarjeta-estadistica p {
      font-size: 1em;
      color: #FF5722;
    }

    /* Grid para las tarjetas */
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 20px;
      margin: 30px 0;
    }

    /* Estilos para la tabla moderna */
    .tabla-moderna {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    .tabla-moderna thead {
      background: #3498db;
      color: #fff;
    }

    .tabla-moderna th, 
    .tabla-moderna td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }

    .tabla-moderna tbody tr:hover {
      background: #f1f1f1;
    }

    /* Estilos responsivos para la tabla */
    @media (max-width: 768px) {
      .tabla-moderna thead {
        display: none;
      }
      
      .tabla-moderna,
      .tabla-moderna tbody,
      .tabla-moderna tr,
      .tabla-moderna td {
        display: block;
        width: 100%;
      }
      
      .tabla-moderna tr {
        margin-bottom: 15px;
      }
      
      .tabla-moderna td {
        text-align: right;
        padding-left: 50%;
        position: relative;
        border: none;
        border-bottom: 1px solid #ddd;
      }
      
      .tabla-moderna td::before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 45%;
        padding-left: 15px;
        font-weight: 600;
        text-align: left;
      }
    }
  </style>
</head>
<body>
  <!-- Menú de navegación fijo -->
  <header>
    <div class="navbar">
      <div class="logo">
        <a href="index.php">🏔️</a>
      </div>
      <nav>
        <ul>
          <li><a href="index.php">Inicio</a></li>
          <li><a href="Registro.php">Registrar participante</a></li>
          <li><a href="panel.php">Estadística</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Contenido del panel de estadísticas -->
  <div class="contenedor">
    <h1>📊 Estadísticas del Torneo 📊</h1>
    
    <div class="grid">
      <!-- Participantes -->
      <div class="tarjeta-estadistica">
        <h2><?= $total_participantes ?></h2>
        <p>Participantes 👤👤</p>
      </div>
      <!-- Habilidades -->
      <div class="tarjeta-estadistica">
        <h2><?= $total_habilidades ?></h2>
        <p>Habilidades ⚡</p>
      </div>
      <!-- H x Guerrero -->
      <div class="tarjeta-estadistica">
        <h2><?= number_format($promedio_habilidades, 2) ?></h2>
        <p>🤼‍♂️ H x Guerrero</p>
      </div>
      <!-- Edad Promedio -->
      <div class="tarjeta-estadistica">
        <h2><?= number_format($promedio_edad, 1) ?></h2>
        <p>⌛ Edad Promedio</p>
      </div>
    </div>

    <h2>Signos Zodiacales</h2>
    
    <table class="tabla-moderna">
      <thead>
        <tr>
          <th>Signo</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($signos as $signo => $cantidad): ?>
        <tr>
          <td data-label="Signo"><?= ucfirst($signo) ?></td>
          <td data-label="Cantidad"><?= $cantidad ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
