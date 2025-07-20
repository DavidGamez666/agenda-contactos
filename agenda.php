<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agenda de Contactos</title>
    <!-- Estilos básicos para el formulario -->
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
        <label>Tipo de Contacto:</label>
    <select name="tipo" required onchange="toggleCampos(this.value)">
        <option value="base">General</option>
        <option value="personal">Personal</option>
        <option value="profesional">Profesional</option>
    </select>
    
    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Teléfono:</label>
    <input type="text" name="telefono" required>

    <label>Email:</label>
    <input type="email" name="email" required>

        <div id="campos_personal" style="display:none;">
        <label>Cumpleaños:</label>
        <input type="date" name="cumpleaños">
    </div>

    <div id="campos_profesional" style="display:none;">
        <label>Empresa:</label>
        <input type="text" name="empresa">
        <label>Puesto:</label>
        <input type="text" name="puesto">
    </div>

    <input type="submit" value="Guardar Contacto">
</form>

<script>
function toggleCampos(tipo) {
    document.getElementById('campos_personal').style.display = tipo === 'personal' ? 'block' : 'none';
    document.getElementById('campos_profesional').style.display = tipo === 'profesional' ? 'block' : 'none';
}
</script>

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

// Subclase: Personal
class ContactoPersonal extends Contacto {
    public $cumpleaños;
    public function __construct($nombre, $telefono, $email, $cumpleaños) {
        parent::__construct($nombre, $telefono, $email);
        $this->cumpleaños = $cumpleaños;
    }
    public function mostrarContacto() {
        return parent::mostrarContacto() . "<br>Cumpleaños: $this->cumpleaños";
    }
}

// Subclase: Profesional
class ContactoProfesional extends Contacto {
    public $empresa, $puesto;
    public function __construct($nombre, $telefono, $email, $empresa, $puesto) {
        parent::__construct($nombre, $telefono, $email);
        $this->empresa = $empresa;
        $this->puesto = $puesto;
    }
    public function mostrarContacto() {
        return parent::mostrarContacto() . "<br>Empresa: $this->empresa<br>Puesto: $this->puesto";
    }
}


// Procesamiento del formulario al enviar datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validación de los datos recibidos
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];

    if ($tipo == "personal") {
        $cumpleaños = htmlspecialchars($_POST["cumpleaños"]);
        $contacto = new ContactoPersonal($nombre, $telefono, $email, $cumpleaños);
    } elseif ($tipo == "profesional") {
        $empresa = htmlspecialchars($_POST["empresa"]);
        $puesto = htmlspecialchars($_POST["puesto"]);
        $contacto = new ContactoProfesional($nombre, $telefono, $email, $empresa, $puesto);

    } else {
        $contacto = new Contacto($nombre, $telefono, $email);
    }

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
