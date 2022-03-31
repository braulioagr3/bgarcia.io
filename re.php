
<?php
session_start();

include "conexion.php";

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
        $email = $_POST["correo"];
        $user = $_POST["usuario"];
        $clave = md5($_POST["clave"]);

        $query = mysqli_query(
            $conection,
            " SELECT * FROM usuario WHERE usuario = '$user' OR correo = '$email' "
        ); //selecciona toda la fila de tab ususarios donde el campo usuario = al user y pass
        $res = mysqli_fetch_array($query); //devuele un numero

        if ($res > 0) {
            $alert =
                '<p class="msg_error"> El usuario o cuenta de correo ya existe <p/>';
        } else {
            $query_insert = mysqli_query(
                $conection,
                "INSERT INTO usuario(nombre,correo,usuario,clave) VALUES('$nombre','$email','$user','$clave')"
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
	<?php include "sistema/includes/scripts.php"; ?>
	<title>Registro de usuario</title>
</head>
<body>
	<section id="container">
        
        <div class="form_register">

            <h1>Registro usuario</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : ""; ?></div>

            <form action="" method="post">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre completo" >
                <label for="correo">E-mail</label>
                <input type="email" name="correo" id="correo" placeholder="E-mail" >
                <label for="usuario">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Nombre de usuario" >
                <label for="clave">Contraseña</label>
                <input type="password" name="clave" id="clave" placeholder="Contraseña">
                <label for="rol">Tipo Usuario</label>
                
                     <?php
                     $query_rol = mysqli_query(
                         $conection,
                         " SELECT * FROM rol "
                     );
                     $resp_rol = mysqli_num_rows($query_rol);
                     ?>

                
                
                <select name="rol" id="rol">
                    <?php if ($resp_rol > 4) {
                        while ($rol = mysqli_fetch_array($query_rol)) { ?>
                            <option value="<?php echo $rol[
                                "idrol"
                            ]; ?>"><?php echo $rol["rol"]; ?></option>
                         <?php }
                    } ?>
              
                </select>
                
                <button type="submit" class="btn_save">Crear usuario</button>
                
            

            </form>
        
        </div>



	</section>


	<?php include "sistema/includes/footer.php"; ?>


</body>
</html>