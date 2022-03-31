<?php

session_start();
if($_SESSION['rol'] != 1)
{
	header("location: ./");
}


	include "../conexion.php";		
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "includes/scripts.php"; ?>
	<title>Listas de usuarios</title>
</head>

<body>
	<?php include "includes/header.php"; ?>


	<section id="container">

		<?php
			$busq = strtolower($_REQUEST['busqueda']);
			if(empty($busq))
			{
				header("location: lista_usuarios.php");
				mysqli_close($conection);
			}
		?>

		<h1>Usuarios registrados</h1>

		<a href="regi_usr.php" class="btn_new">Crear usuario</a>

		<form action="busqUsr.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busq;?>">
			<input type="submit" value="Buscar" class="btn_search">

		</form>


		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Correo</th>
				<th>Usuario</th>
				<th>Rol</th>
				<th>Acciones</th>
			</tr>

			<?php
			//paginador
			$rol = '';
			if($busq == 'administrador')
			{
				$rol = "OR rol LIKE '%1%'";
			}
			else if($busq == 'supervisor')
			{
				$rol = "OR rol LIKE '%2%'";
			}
			else if($busq == 'vendedor')
			{
				$rol = "OR rol LIKE '%3%'";
			}

			$sql_regis = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM usuario WHERE (idusuario LIKE '%$busq%' or nombre 
			                                                   LIKE '%$busq%' or correo LIKE '%$busq%' or usuario LIKE '%$busq%' $rol ) AND estatus = 1 ");
			$res_regs = mysqli_fetch_array($sql_regis);
			$total_red = $res_regs['total_registro'];

			$x_pag = 5;

			if (empty($_GET['pag'])) {
				$pag = 1;
			} else {
				$pag = $_GET['pag'];
			}

			$desde = ($pag - 1) * $x_pag;
			$total_pag = ceil($total_red / $x_pag);

			$query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.rol 
				                       FROM usuario u INNER JOIN rol r ON u.rol = r.idrol WHERE (u.idusuario LIKE '%$busq%' or u.nombre 
			                            LIKE '%$busq%' or u.correo LIKE '%$busq%' or u.usuario LIKE '%$busq%' or r.rol LIKE '%$busq%'  ) AND estatus = 1
										ORDER BY u.idusuario ASC LIMIT $desde,$x_pag");
		    mysqli_close($conection);
										
			$result = mysqli_num_rows($query);

			if ($result > 0) {

				while ($data = mysqli_fetch_array($query)) {
					?>

					<tr>
						<td><?php echo $data['idusuario'] ?></td>
						<td><?php echo $data['nombre'] ?></td>
						<td><?php echo $data['correo'] ?></td>
						<td><?php echo $data['usuario'] ?></td>
						<td><?php echo $data['rol'] ?></td>
						<td>
							<a class="link_edit" href="editarusr.php?id=<?php echo $data['idusuario']; ?>">Editar</a>

							<?php if ($data["idusuario"] != 2) { ?>
								<a class="link_delete" href="elimusr.php?id=<?php echo $data['idusuario']; ?>">Eliminar</a>

							<?php } ?>
						</td>


					</tr>
				<?php
			}
		}

		?>


		</table>

		<?php
			if($total_red != 0)
			{ 
		?>

		<div class="paginador">
			<ul>
				<?php
				if ($pag != 2) {



					?>

					<li><a href="?pag = <?php echo 1; ?> &busq=<?php echo $busq; ?>">|<</a> </li> 
					<li><a href="?pag = <?php echo $pag - 1; ?> &busq=<?php echo $busq; ?>"><<</a></li>

									<<</a> </li> <?php
											}
											for ($i = 1; $i <= $total_pag; $i++) {
												if ($i == $pag) {
													echo '<li class = "pageSelected" >'.$i.'</li>';
												}
												echo '<li><a href="?pag='.$i.'&busq='.$busq.'">'.$i.'</a></li>';
											}
											if ($pag != $total_pag) {
												?> 
												<li><a href="?pag=<?php echo $pag + 1; ?>&busq=<?php echo $busq;?>">>></a></li>
												<li><a href="?pag=<?php echo $total_pag; ?>&busq=<?php echo $busq;?>">>|</a></li>
										<?php } ?>
			</ul>

		</div>
<?php } ?>


	</section>

	<?php include "includes/footer.php"; ?>



</body>

</html>