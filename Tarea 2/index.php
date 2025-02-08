<?php
// Cargar la librería y aplicar la plantilla (como en panel.php)
require("libreria/motor.php");
Plantilla::aplicar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Torneo de la Fuerza</title>
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

    .lead {
      text-align: center;
      margin-bottom: 30px;
      font-size: 1.2em;
      color: #555;
    }

    /* Contenedor para los botones centrados */
    .text-registro {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 20px; /* Espacio entre botones */
      margin: 20px 0;
      transform: translateX(40px); /* Mueve los botones 40px a la derecha */
    }

    .boton {
      display: inline-block;
      padding: 12px 20px;
      background: #3498db;
      color: #fff;
      text-decoration: none;
      border-radius: 5px;
      transition: background 0.3s;
    }

    .boton:hover {
      background: #2980b9;
    }

    h3 {
      margin-top: 40px;
      margin-bottom: 20px;
      text-align: center;
      font-weight: 600;
    }

    /* Estilos para la tabla moderna */
    .tabla-moderna {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
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

    .tabla-moderna img {
      border-radius: 50%;
      width: 60px;
      height: 60px;
      object-fit: cover;
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

  <!-- Contenido principal de index.php -->
  <div class="contenedor">
    <h1>¡Bienvenido al Torneo de la Fuerza! 🍃</h1>
    <p class="lead">🔥 ¡Demuestra tu poder! Inscríbete en nuestro torneo 🔥</p>

    <!-- Contenedor de botones centrado -->
    <div class="text-registro">
      <a href="Registro.php" class="boton">Registrar Participante 📋</a>
      <a href="panel.php" class="boton">Estadísticas 📊</a>
    </div>

    <h3>Participantes Registrados 📝</h3>

    <table class="tabla-moderna">
      <thead>
        <tr>
          <th>Foto</th>
          <th>Nombre</th>
          <th>Edad</th>
          <th>Signo Zodiacal</th>
          <th>Habilidades</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Obtener la lista de participantes
        $datos = lista_Dregistro();
        foreach ($datos as $peleador) {
          echo "
            <tr>
              <td data-label='Foto'><img src='{$peleador->foto}' alt='{$peleador->nombre}'></td>
              <td data-label='Nombre'>{$peleador->nombre} {$peleador->apellido}</td>
              <td data-label='Edad'>{$peleador->edad()}</td>
              <td data-label='Signo Zodiacal'>{$peleador->signos_zodiacal()}</td>
              <td data-label='Habilidades'>{$peleador->n_habilidades()}</td>
              <td data-label='Acciones'><a href='Registro.php?codigo={$peleador->id}' class='boton'>🔍 Ver</a></td>
            </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
