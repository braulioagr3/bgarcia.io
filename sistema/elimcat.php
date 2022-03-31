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
        if(empty($_POST['idcat']))
        {
            header("location: listcat.php");
            mysqli_close($conection);


        }

        $idcat = $_POST['idcat'];
       // $query_deleta = mysqli_query($conection,"DELETE FROM usuario WHERE idtra = $idtra "); eliminar completamente
        $query_deleta = mysqli_query($conection,"UPDATE proveedor SET estatus = 0 WHERE idcat = $idcat");
 

       

        if($query_deleta)
        {
             header("location: listcat.php");
    
        }
        else
        {
            echo "error al eliminar";
        }
        
    }

    //recumerar los datos
    if(empty($_REQUEST['id']))
    {
        header("location: listcat.php");
    

    }
    else
    {


         $idcat = $_REQUEST['id'];
         $query = mysqli_query($conection,"SELECT * FROM proveedor WHERE idcat  = $idcat ");

         $res = mysqli_num_rows($query);

         if($res > 0)
         {
             while($data = mysqli_fetch_array($query))
             {

                $categoria = $data['categoria'];
                
             }
         }
         else
         {
            header("location:listcat.php");
         }
    } 



?>




<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Categoria</title>
</head>
<body>
	<?php include "includes/header.php"; ?>

	
	<section class="container pad-top-10">
		<div class="data_delete">
            <h2>¿Esta seguro que desea eliminar?<h2>

            <p>Nombre de la categoria: <span> <?php echo $categoria;?> </span> </p>
        
         

            <form method="post" action="">
                <input type="hidden" name="idcat" value="<?php echo $idcat; ?>">
                <a href="listcat.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>

        </div>
	</section>

	<?php include "includes/footer.php"; ?>



</body>
</html>