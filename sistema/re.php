
<?php
session_start();
if (empty($_SESSION["active"])) {
    //para que no regres a la pagina osea si existe la secion no regres al index de tienda
    header("location: ../"); //retrocedemos al login
}

include "../conexion.php";

if (!empty($_POST)) {
    $alert = "";
    if (
        empty($_POST["nombre"]) ||
        empty($_POST["correo"]) ||
        empty($_POST["usuario"]) ||
        empty($_POST["clave"])
    ) {
        $alert = '<p class="msg_error"> Todos los campos son obligatorios <p/>';
    } else {
        $nombre = $_POST["nombre"];
        $emailn = $_POST["correo"];
        $usern = $_POST["usuario"];
        $clave = md5($_POST["clave"]);

        $query = mysqli_query(
            $conection,
            " SELECT * FROM usuario WHERE usuario = '$usern' OR correo = '$emailn' "
        ); //selecciona toda la fila de tab ususarios donde el campo usuario = al usern y pass
        $res = mysqli_fetch_array($query); //devuele un numero

        if ($res > 0) {
            $alert =
                '<p class="msg_error"> El usuario o cuenta de correo ya existe <p/>';
        } else {
            $query_insert = mysqli_query(
                $conection,
                "INSERT INTO usuario(nombre,correo,usuario,clave) VALUES('$nombre','$emailn','$usern','$clave')"
            );

            if ($query_insert) {
                $alert =
                    '<p class="msg_save"> El usuario a sido creado correctamente <p/>';
            } else {
                $alert = '<p class="msg_error"> Error al crear el usuario <p/>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php include "includes/scripts.php"; ?>
        <title>Registro de usuario</title>
    </head>
    <body>
        <?php include "includes/header.php"; ?>
        <section id="container">
            <div class="form_register">
                <h1>Registro usuario</h1>
                <hr>
                <div class="alert">
                    <?php echo isset($alert) ? $alert : ""; ?>
                </div>
                <form action="" method="post">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" >
                    <label for="correo">E-mail</label>
                    <input type="emailn" name="correo" id="correo" placeholder="E-mail" >
                    <label for="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario" >
                    <label for="clave">Contraseña</label>
                    <input type="password" name="clave" id="clave" placeholder="Contraseña">
                    <input type="submit" value="Crear usuario" class="btn_save" >
                </form>
            </div>
        </section>
        <?php include "includes/footer.php"; ?>
    </body>
</html>