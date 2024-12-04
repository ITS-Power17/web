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
    $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : '';
    $ano = isset($_POST['ano']) ? $_POST['ano'] : '';
    $motor = isset($_POST['motor']) ? $_POST['motor'] : '';
    $color = isset($_POST['color']) ? $_POST['color'] : '';

    if (empty($modelo)) {
        $mensaje = '<div class="alert alert-danger" role="alert">Ingrese modelo del auto.</div>';
    } elseif (empty($ano)) {
        $mensaje = '<div class="alert alert-danger" role="alert">Ingrese año del auto.</div>';
    } elseif (empty($motor)) {
        $mensaje = '<div class="alert alert-danger" role="alert">Inserte el motor del auto.</div>';
    } elseif (empty($color)) {
        $mensaje = '<div class="alert alert-danger" role="alert">Inserte el color del auto.</div>';
    } else {
        $query = "INSERT INTO coche (modelo, ano, motor, color) VALUES ('$modelo', '$ano', '$motor', '$color')";
        $result = mysqli_query($conexion, $query);

        if ($result) {
            $mensaje = '<div class="alert alert-success" role="alert">Auto añadido exitosamente.</div>';
        } else {
            $mensaje = '<div class="alert alert-danger" role="alert">Error al añadir el auto: ' . mysqli_error($conexion) . '</div>';
        }
    }
}

mysqli_close($conexion);
?>


<section class="page-section" id="contact">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Personaliza</h2>
            <h3 class="section-subheading text-warning ">Personaliza tu Lamborghini.</h3>
        </div>

        <?php echo $mensaje; ?>

        <form id="contactForm" action="auto.php" method="post" data-sb-form-api-token="API_TOKEN">
            <div class="row align-items-stretch mb-5">
                <div class="col-md-6">
                    <div class="form-group">

                        <input class="form-control" name="modelo" type="text" placeholder="Modelo del auto *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="name:required">Modelo requerido.</div>
                    </div>
                    <div class="form-group">

                        <input class="form-control" type="text" name="ano" placeholder="Año del auto *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="email:required">Año del auto requerido.</div>
                    </div>
                    <div class="form-group mb-md-0">

                        <input class="form-control" type="text" name="motor" placeholder="Motor del auto *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="phone:required">El motor es requerido.</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-md-0">

                        <input class="form-control" type="text" name="color" placeholder="Color del auto *" data-sb-validations="required" />
                        <div class="invalid-feedback" data-sb-feedback="phone:required">Color requerido.</div>
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