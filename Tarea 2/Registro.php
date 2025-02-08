<?php
require("libreria/motor.php");
Plantilla::aplicar();

$peleador = new peleador();

if (isset($_GET["codigo"])) {
    $peleador = cargar_datos($_GET["codigo"]);
    if (!$peleador) {
        echo "<h1>⚠️ Lo sentimos</h1>";
        echo "<p>El participante no existe</p>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registro de Participante - Torneo de la Fuerza</title>
  <!-- Importar la fuente moderna desde Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <style>
    /* Reinicio general */
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
      text-align: center;
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
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: left;
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
      max-width: 1000px;
      margin: 10px auto 30px;
      background: #fff;
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0 0 25px rgba(0,0,0,0.1);
      text-align: left;
    }
    /* Título y descripción */
    .contenedor h1 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: 600;
      font-size: 2.2em;
      color: #222;
    }
    .lead {
      text-align: center;
      margin-bottom: 20px;
      font-size: 1.1em;
      color: #555;
    }
    /* Layout del formulario en 2 filas */
    .form-grid {
      display: flex;
      flex-direction: column;
      gap: 5px;  /* Espacio vertical aún más reducido */
      margin-bottom: 20px;
    }
    .form-row {
      display: flex;
      gap: 5px;  /* Espacio horizontal reducido entre campos */
      flex-wrap: wrap;
    }
    .form-group {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .form-group label {
      margin-bottom: 4px;
      font-weight: 600;
      color: #555;
    }
    .form-group input {
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1em;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    .form-group input:focus {
      border-color: #3498db;
      box-shadow: 0 0 8px rgba(52,152,219,0.3);
      outline: none;
    }
    /* Sección de habilidades */
    .form-section {
      margin-bottom: 20px;
    }
    .form-section h3 {
      margin-bottom: 10px;
      font-size: 1.4em;
      color: #3498db;
      border-bottom: 1px solid #ddd;
      padding-bottom: 5px;
    }
    /* Tabla de habilidades */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    table thead {
      background: #3498db;
      color: #fff;
    }
    table th,
    table td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
      font-size: 0.95em;
    }
    table tbody tr:hover {
      background: #f1f1f1;
    }
    /* Botones */
    .boton {
      display: inline-block;
      padding: 8px 16px;
      background: #3498db;
      color: #fff;
      border: none;
      border-radius: 6px;
      font-size: 1em;
      cursor: pointer;
      transition: background 0.3s, transform 0.2s;
      text-decoration: none;
    }
    .boton:hover {
      background: #2980b9;
      transform: translateY(-2px);
    }
    .button-small {
      padding: 4px 8px;
      font-size: 0.85em;
      border-radius: 4px;
    }
  
    /* Contenedor para el botón de envío */
    .boton-submit {
      text-align: center;
      margin-top: 5px;  /* Espacio aún menor encima del botón */
    }

    /* Nuevos estilos para el botón de "Guardar" */
    .boton-submit input[type="submit"] {
      background: #28a745; /* Verde */
      width: 100%;         /* Ancho completo */
      border: none;
      border-radius: 6px;
      padding: 8px 16px;
      font-size: 1em;
      cursor: pointer;
      color: #fff;
      transition: background 0.3s, transform 0.2s;
    }
    .boton-submit input[type="submit"]:hover {
      background: #218838; /* Verde un poco más oscuro para el hover */
      transform: translateY(-2px);
    }
    /* Estilos para inputs de la tabla (habilidades) */
    table tbody input {
      padding: 6px;
      width: 95%;
      border: 1px solid #ccc;
      border-radius: 4px;
      transition: border-color 0.3s, box-shadow 0.3s;
    }
    table tbody input:focus {
      border-color: #3498db;
      box-shadow: 0 0 5px rgba(52,152,219,0.3);
      outline: none;
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
          <li><a href="panel.php">Estadistica</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- Contenedor principal -->
  <div class="contenedor">
    <h1>Registro de Participante 🐱‍👤</h1>
    <p class="lead">Ingrese los datos necesarios</p>
    <form method="post" action="Guardar.php">
      <!-- Agrupación de campos en 2 filas -->
      <div class="form-grid">
        <!-- Primera fila: 4 campos -->
        <div class="form-row">
          <div class="form-group">
            <?php echo the_input("id", "ID", $peleador->id, ["required" => "required"]); ?>
          </div>
          <div class="form-group">
            <?php echo the_input("nombre", "Nombre", $peleador->nombre, ["required" => "required"]); ?>
          </div>
          <div class="form-group">
            <?php echo the_input("apellido", "Apellido", $peleador->apellido, ["required" => "required"]); ?>
          </div>
          <div class="form-group">
            <?php echo the_input("foto", "Foto (URL)", $peleador->foto, ["type" => "url"]); ?>
          </div>
        </div>
        <!-- Segunda fila: 1 campo -->
        <div class="form-row">
          <div class="form-group">
            <?php echo the_input("fecha_nacimiento", "Fecha de Nacimiento", $peleador->fecha_nacimiento, ["type" => "date"]); ?>
          </div>
        </div>
      </div>

      <!-- Sección de habilidades -->
      <div class="form-section">
        <h3>Habilidades</h3>
        <table>
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Tipo</th>
              <th>Nivel</th>
              <th>
                <button type="button" class="boton button-small" onclick="AgregarHabilidad()">➕</button>
              </th>
            </tr>
          </thead>
          <tbody id="tdhabilidades">
            <?php
            foreach ($peleador->habilidades as $habilidad) {
              echo "<tr>";
              echo "<td><input type='text' name='habilidades[nombre][]' value='{$habilidad->nombre}'></td>";
              echo "<td><input type='text' name='habilidades[tipo][]' value='{$habilidad->tipo}'></td>";
              echo "<td><input type='text' name='habilidades[nivel][]' value='{$habilidad->nivel}'></td>";
              echo "<td><button type='button' class='boton button-small' onclick='QuitarFila(this)'>❌</button></td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Botón de envío -->
      <div class="boton-submit">
        <input type="submit" class="boton" value="Guardar">
      </div>
    </form>
  </div>

  <script>
    function AgregarHabilidad() {
      var tr = document.createElement("tr");

      var td1 = document.createElement("td");
      var input1 = document.createElement("input");
      input1.type = "text";
      input1.name = "habilidades[nombre][]";
      td1.appendChild(input1);
      tr.appendChild(td1);

      var td2 = document.createElement("td");
      var input2 = document.createElement("input");
      input2.type = "text";
      input2.name = "habilidades[tipo][]";
      td2.appendChild(input2);
      tr.appendChild(td2);

      var td3 = document.createElement("td");
      var input3 = document.createElement("input");
      input3.type = "text";
      input3.name = "habilidades[nivel][]";
      td3.appendChild(input3);
      tr.appendChild(td3);

      var td4 = document.createElement("td");
      var button = document.createElement("button");
      button.type = "button";
      button.className = "boton button-small";
      button.innerHTML = "❌";
      button.setAttribute("onclick", "QuitarFila(this)");
      td4.appendChild(button);
      tr.appendChild(td4);

      document.getElementById("tdhabilidades").appendChild(tr);
    }

    function QuitarFila(boton) {
      if (confirm("¿Estás seguro de eliminar esta habilidad?")) {
        boton.parentElement.parentElement.remove();
      }
    }
  </script>
</body>
</html>
