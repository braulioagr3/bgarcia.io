<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
</head>
<body>
<?php 
// Llamamos al archivo de conexión a la base de datos
require("conexion.php");

 
//Creamos las variables con los nombres de los campos del formulario
$usuario = $_POST["usuario"];
$email = $_POST["email"];
$website = $_POST["website"];
$comentario = $_POST["comentario"];

// Codigo de insercion a la base de datos
$insertar = mysqli_query($conection,"INSERT INTO comentarios (usuario, email, website, comentario) VALUES ('$usuario','$email','$website','$comentario')");

if (!$insertar) {
 echo "Error al guardar";
} else {
 echo "Guardado con éxito";
}

mysqli_close($conection);
?>
<br/>
<a href="form.php">ver comentarios</a>
</body>

</html>

y finalmente, creamos el siguiente archivo, recuerda sustituir nuevamente los datos del usuario de MySQL como lo pide el código, de manera que se puedan conectar mutuamente.
comentarios.php
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Comentarios</title> 
</head> 
<body> 
<?php 
  // Se conecta al SGBD 
  if(!($conection = mysql_connect("localhost", "usuario", "password"))) 
    die("Error: No se pudo conectar");
 
  // Selecciona la base de datos 
  if(!mysql_select_db("comentarios", $conection)) 
    die("Error: No existe la base de datos");
 
  // Sentencia SQL: muestra todo el contenido de la tabla "books" 
  $sentencia = "SELECT * FROM comentarios"; 
  // Ejecuta la sentencia SQL 
  $resultado = mysql_query($sentencia, $conection); 
  if(!$resultado) 
    die("Error: no se pudo realizar la consulta");

 echo "<div id='comentarios'>";
  while($fila = mysql_fetch_assoc($resultado)) 
  { 
   echo "<div class='user'>";
    echo "<a href='" . $fila['website'] . "'>" . $fila['usuario'] . "</a><br/> <div class='tiempo'>" . $fila['fecha'] . "</div>";
   echo "</div>";
   echo "<div class='comment'>";
    echo $fila['comentario'] . '<br/>';
   echo "</div>";
  } 
 echo "</div><br/>";
  // Libera la memoria del resultado
  mysql_free_result($resultado);
  
  // Cierra la conexión con la base de datos 
  mysql_close($conection); 
?> 
</body> 
</html> 