<?php
      session_start();
      if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2)
      {
          header("location: ./");
      }
  

    include "../conexion.php";

    //para eluinar 
    if(!empty($_POST))
    {
        if(empty($_POST['codproducto']))
        {
            header("location: listaprod.php");

        }

        $idtra = $_POST['codproducto'];
       // $query_deleta = mysqli_query($conection,"DELETE FROM usuario WHERE idtra = $idtra "); eliminar completamente
        $query_deleta = mysqli_query($conection,"UPDATE producto SET estatus = 0 WHERE codproducto = $idtra");
       

        if($query_deleta)
        {
             header("location: listaprod.php");
    
        }
        else
        {
            echo "error al eliminar";
        }
        
    }

    //recumerar los datos
    if(empty($_REQUEST['id']))
    {
        header("location: listaprod.php");
        mysqli_close($conection);

    }
    else
    {


         $idtra = $_REQUEST['id'];
         $query = mysqli_query($conection,"SELECT * FROM producto WHERE codproducto = $idtra ");

         mysqli_close($conection);
         $res = mysqli_num_rows($query);

         if($res > 0)
         {
             while($data = mysqli_fetch_array($query))
             {

                $nit = $data['categoria'];
                $nombre = $data['descripcion'];
                
             }
         }
         else
         {
            header("location: listaprod.php");
         }
    } 



?>




<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Trabajador</title>
</head>
<body>
	<?php include "includes/header.php"; ?>

	
	<section class="container pad-top-10">
		<div class="data_delete">
            <h2>¿Esta seguro que desea eliminar?<h2>

            <p>Nombre: <span> <?php echo $nombre;?> </span> </p>
            <p>categoria: <span> <?php echo $nit;?> </span> </p>
         

            <form method="post" action="">
                <input type="hidden" name="codproducto" value="<?php echo $idtra; ?>">
                <a href="listaprod.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>

        </div>
	</section>

	<?php include "includes/footer.php"; ?>



</body>
</html>