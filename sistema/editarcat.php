
 <?php 
    session_start();
    if($_SESSION['rol'] != 1 and $_SESSION['rol'] !=2)
    {
        header("location: ./");
    }

 
 
    include "../conexion.php";

    if(!empty($_POST))
    {
        $alert = '';
        if(empty($_POST['categoria'])  || empty($_POST['caracteristica']) || empty($_POST['descripcion']) )
        {
            $alert='<p class="msg_error"> Todos los campos son obligatorios <p/>';
        } 
        else
        {
            $idcat = $_POST['id'];
            $categoria = $_POST['categoria'];
            $caracteristica = $_POST['caracteristica'];
            $descripcion = $_POST['descripcion'];

         

            $sql_update = mysqli_query($conection,"UPDATE proveedor SET categoria = '$categoria', caracteristica = '$caracteristica', descripcion = '$descripcion'
                                             WHERE idcat = $idcat ");
    

                if($sql_update)
                {
                    $alert='<p class="msg_save"> La categoria a sido actualizado correctamente <p/>';
                }

                else
                {
                      $alert='<p class="msg_error"> Error al actualizar la categoria <p/>';
                }
            }

        }
    //mostrar ñps datos a modificar
    if(empty($_REQUEST['id']))
    {
        header('Location: listcat.php');
        mysqli_close($conection);
    }

    $idcat= $_REQUEST['id'];

    $query = mysqli_query($conection, "SELECT * FROM proveedor WHERE  idcat = $idcat and estatus=1");
    mysqli_close($conection);
    $res_sql = mysqli_num_rows($query); 


    if($res_sql == 0)
    {
        header('Location: listatra.php');
    }

    else
    {
        $option = '';
        while ($data = mysqli_fetch_array($query))
        {
            $idcat = $data['idcat'];
            $categoria = $data['categoria'];
            $caracteristica = $data['caracteristica'];
            $descripcion = $data['descripcion'];   
     
        }
    }



?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar de Categoria</title>
</head>
<body>
	<?php include "includes/header.php"; ?>

	
	<section class="container pad-top-10">
        
        <div class="form_register">

            <h1>Actualizar Categoria</h1>
            <hr>
            <div class="alert"><?php echo isset($alert) ? $alert : '';  ?></div>

              <form class="form" action="" method="post">
                
                <input class="input"  type="hidden" name="id" value=<?php echo $idcat; ?>>

                <label for="categoria">Categoria</label>
                <input class="input" type="text" name="categoria" id="categoria" placeholder="Genero del videojuego" value="<?php echo $categoria;  ?>" >

                <label for="caracteristica">Caracteristica</label>
                <input class="input" type="text" name="caracteristica" id="caracteristica" placeholder="Caracteristica videjuego" value="<?php echo $caracteristica;  ?>">

                <label for="descripcion">Otros datos</label>
                <input class="input" type="text" name="descripcion" id="descripcion" placeholder="descripcion Completa" value="<?php echo $descripcion;  ?>">
                
                <input class="input" type="submit" value="Actualizar categoria" class="btn-primary" >
                
            

            </form>
        
        
        </div>



	</section>

	<?php include "includes/footer.php"; ?>



</body>
</html>