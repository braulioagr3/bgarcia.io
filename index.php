<?php
$alert = "";
session_start(); //iniciamos la secion
if (!empty($_SESSION["active"])) {
    //para que no regres a la pagina osea si existe la secion no regres al index de tienda
    header("location: sistema/");
} else {
    if (!empty($_POST)) {
        //ingresa
        if (empty($_POST["usuario"]) || empty($_POST["clave"])) {
            $alert =
                "Ingrese su usuario y contraeña, si los a olvidado contacte con el administrador: ankealm@gmail.com";
        } else {
            require_once "conexion.php";
            $user = mysqli_real_escape_string($conection, $_POST["usuario"]);
            $pass = md5(mysqli_real_escape_string($conection, $_POST["clave"]));

            $query = mysqli_query(
                $conection,
                " SELECT * FROM usuario WHERE usuario = '$user' AND clave = '$pass' "
            ); //selecciona toda la fila de tab ususarios donde el campo usuario = al user y pass
            mysqli_close($conection); //cerramos la conexxion
            $res = mysqli_num_rows($query); //devuele un numero

            if ($res > 0) {
                $data = mysqli_fetch_array($query); //guardamos la consulta

                $_SESSION["active"] = true; //la activamos
                $_SESSION["idUser"] = $data["idusuario"]; //creamos la secion con el id del usuario por medio de data que es la consulta guardada
                $_SESSION["nombre"] = $data["nombre"];
                $_SESSION["email"] = $data["correo"];
                $_SESSION["user"] = $data["usuario"];
                $_SESSION["rol"] = $data["rol"];

                header("location: sistema/");
            } else {
                $alert = "El usuario o contraseña son incorrectas";
                session_destroy();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>    
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="text/html; charset=utf-8" http-equiv="Content-Type">
    <title> Login </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <section id = "container" >
        <form action="" method="post">
        
            <h3>Inicio de Sesion</h3>
            <img src = "img/login.png" alt="Login">
            <input type="text" name="usuario" placeholder="Usuario">
            <input type="password" name="clave" placeholder="Contraseña">
            <div class="alert"> 
                <?php echo isset($alert) ? $alert : ""; ?>
            </div>
            <input type="submit" value="Ingresar">	
            <a href="re.php">Registro</a>
        </form>
    </section>
    
</body>
</html>