<?php
	session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
	include "../conexion.php";		
?>


<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "includes/scripts.php"; ?>
	<title>Listas de usuarios</title>
</head>
<body>
	<?php include "includes/header.php"; ?>

	
	<section class="container pad-top-10">
		<h1>Usuarios registrados</h1>

		<a href="regi_usr.php" class="btn btn-success">Crear usuario</a>

		<form action="busqUsr.php" method="get" class="form_search">
			<input  type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn btn_search">
	
		</form>


		<table class="table">
			<tr>
				<th class="display-none">Nombre</th>
				<th class="display-none">Correo</th>
				<th>Usuario</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>

			<?php
				//paginador
			

				$sql_regis = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM usuario WHERE estatus = 1");
				$res_regs = mysqli_fetch_array($sql_regis);
				$total_red = $res_regs['total_registro'];

				$x_pag = 5;

				if(empty($_GET['pag']))
				{
					$pag = 1;
				}
				
				else
				{
					$pag = $_GET['pag'];
				}

				$desde = ($pag-1) * $x_pag;
				$total_pag = ceil($total_red / $x_pag);
				
				$query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol 
				                       FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE estatus = 1  ORDER BY u.idusuario ASC LIMIT $desde,$x_pag");
				
				mysqli_close($conection);				
				$result = mysqli_num_rows($query);

				if($result > 0)
				{

					while($data = mysqli_fetch_array($query))
					{
						?>			
						<tr>
							<td class="display-none"><?php echo $data['nombre']; ?></td>
							<td class="display-none"><?php echo $data['correo']; ?></td>
							<td><?php echo $data['usuario']; ?></td>
							<td><?php echo $data['rol']; ?></td>
							<td class="display-block">
								<a class="btn btn-secundary" href="editarusr.php?id=<?php echo $data['idusuario']; ?>">Editar</a>
								<?php if($data["idusuario"]!= 2) { ?>
									<br>
									<a class="btn btn-warning mar-top-1" href="elimusr.php?id=<?php echo $data['idusuario'] ;?>">Eliminar</a>
								<?php } ?>
							</td>
						</tr>
						<?php
					}

				}

			?> 


		</table>
		
		<div class="paginador">
				<ul>
					<?php
						if($pag !=2)
						{
					?>

						<li><a href="?pag = <?php echo 1; ?>">|<</a> </li> 
						<li><a href="?pag = <?php echo $pag - 1; ?>"><<</a></li>

					<?php
						} 
						for($i=1; $i <= $total_pag; $i++)
						{
							if($i == $pag)
							{
								echo '<li class = "pageSelected" >'.$i.'</li>' ;
							}
							else
							{
								echo '<li><a href="?pag='.$i.'">'.$i.'</a></li>' ;
							}
						}
						if($pag != $total_pag)
						{
					?>


						<li><a href="?pag=<?php echo $pag + 1; ?>">>></a></li>
						<li><a href="?pag=<?php echo $total_pag; ?>">>|</a></li>
					<?php } ?>
				</ul>	

		</div>


	</section>

	<?php include "includes/footer.php"; ?>



</body>
</html>