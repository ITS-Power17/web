<?php
include_once("header.php");

$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_de_datos = "bkf_db_20231149";

$conexion = mysqli_connect($servidor, $usuario, $contraseña, $base_de_datos);

if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$mensaje = '';

if (isset($_POST['add'])) {
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : '';

    if (empty($nombre)) {
        $mensaje = '<div class="alert alert-danger" role="alert">Ingrese un nnombre.</div>';
    } elseif (empty($apellido)) {
        $mensaje = '<div class="alert alert-danger" role="alert">Ingrese un apellido.</div>';
    } elseif (empty($telefono)) {
        $mensaje = '<div class="alert alert-danger" role="alert">Inserte un telefono.</div>';
    } elseif (empty($email)) {
        $mensaje = '<div class="alert alert-danger" role="alert">Inserte una direcion de correo.</div>';
    } elseif (empty($comentario)) {
        $mensaje = '<div class="alert alert-danger" role="alert">Ingrese un comentario.</div>';
    } else {
        $query = "INSERT INTO contacto (nombre, apellido, telefono, email, comentario) VALUES ('$nombre', '$apellido', '$telefono', '$email','$comentario')";
        $result = mysqli_query($conexion, $query);

        if ($result) {
            $mensaje = '<div class="alert alert-success" role="alert">Registro añadido exitosamente.</div>';
        } else {
            $mensaje = '<div class="alert alert-danger" role="alert">Error al añadir el registro: ' . mysqli_error($conexion) . '</div>';
        }
    }
}

mysqli_close($conexion);
?>


<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Contacto</h2>
            <h3 class="section-subheading text-warning ">Te escuchamos.</h3>
        </div>

        <?php echo $mensaje; ?>

        <form id="contactForm" action="contacto.php" method="post" data-sb-form-api-token="API_TOKEN">
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">

                        <input class="form-control" name="nombre" type="text" placeholder="Ingresa tu nombre *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="name:required">Nombre requerido.</div>
                    </div>
                    <div class="form-group">

                        <input class="form-control" type="text" name="apellido" placeholder="Ingresa tu apellido *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="name:required">Apellido requerido.</div>
                    </div>
                    <div class="form-group">

                        <input class="form-control" type="tel" name="telefono" placeholder="Telefono *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="phone:required">Telefono requerido.</div>
                    </div>
                    <div class="form-group mb-md-0">

                        <input class="form-control" type="email" name="email" placeholder="Ingrese Gmail *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="email:required">El correo es requerido.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-group-textarea mb-md-0">

                        <textarea class="form-control" id="message" name="comentario" placeholder="Ingresa mensaje *" data-sb-validations="required"></textarea>
                        <div class="invalid-feedback" data-sb-feedback="message:required">Mnesaje requerido.</div>
                    </div>
                </div>
            </div>

            <div class="text-center send_bt">
                <button class="btn btn-primary btn-xl" name="add" type="submit">Enviar</button>
            </div>
        </form>
    </div>
</section>

<?php
include_once("footer.php");
?>