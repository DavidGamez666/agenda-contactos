<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agenda de Contactos</title>

     /* Estilo básico para el formulario */
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        form { background: white; padding: 20px; border-radius: 10px; width: 300px; margin-bottom: 20px; }
        input { margin-bottom: 10px; width: 100%; padding: 8px; }
        .resultado { background: #e0ffe0; padding: 10px; border: 1px solid #b2ffb2; }
    </style>
</head>
<body>

<h2>Agenda de Contactos</h2>

<!-- Formulario para ingresar datos del contacto -->
<form method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Teléfono:</label>
    <input type="text" name="telefono" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <input type="submit" value="Guardar Contacto">
</form>

<?php

// Declaración de la clase "Contacto"
class Contacto {
    public $nombre;
    public $telefono;
    public $email;

    // Constructor para inicializar los atributos
    public function __construct($nombre, $telefono, $email) {
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->email = $email;
    }

    // Método para mostrar los detalles del contacto
    public function mostrarContacto() {
        return "<strong>$this->nombre</strong><br>Tel: $this->telefono<br>Email: $this->email";
    }
}

// Procesamiento del formulario al enviar datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validación de los datos recibidos
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];

    //Instanciacion de un nuevo objeto "Contacto"
    $nuevoContacto = new Contacto($nombre, $telefono, $email);

    //Método para mostrar el contacto guardado
    echo "<div class='resultado'>";
    echo "<h4>Contacto Guardado:</h4>";
    echo $nuevoContacto->mostrarContacto();
    echo "</div>";
}
?>
</body>
</html>
