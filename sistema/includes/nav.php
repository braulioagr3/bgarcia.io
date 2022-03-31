<nav class="navbar">
	<div class="nav-collapse">
		<ul class="navbar-nav">
			<li><a class="navbar-brand" href="indexshop.php"><i class="fas fa-home"></i> Inicio</a></li>
			<li class="nav-item">
			<?php if($_SESSION['rol']==1){?>
					<a><i class="fas fa-users"></i> Usuarios</a>
					<ul class="dropdown-menu">
						<li><a href="regi_usr.php" class="nav-link dropdown-item"><i class="fas fa-user-plus"></i>  Nuevo Usuario</a></li>
						<li><a href="lista_usuarios.php" class="nav-link dropdown-item"><i class="fas fa-address-card"></i> Lista de Usuarios</a></li>
					</ul>
				</li>
			<?php }?> 

			<?php if($_SESSION['rol']==1 || $_SESSION['rol']==2 ) { ?>
				<li class="nav-item">
					<a><i class="fas fa-briefcase"></i> Trabajadores</a>
					<ul class="dropdown-menu">
						<li><a href="regiclien.php" class="nav-link dropdown-item"><i class="fas fa-user-plus"></i> Nuevo Trabajador</a></li>
						<li><a href="listatra.php" class="nav-link dropdown-item"><i class="fas fa-address-card"></i> Lista de Trabajadors</a></li>
					</ul>
				</li>
			<?php } ?>

			<?php if($_SESSION['rol']==1 || $_SESSION['rol']==2 ){ ?>
				<li class="nav-item">
					<a>Categorias</a>
					<ul class="dropdown-menu">
						<li><a href="regispro.php" class="nav-link dropdown-item">Nuevo Categoria</a></li>
						<li><a href="listcat.php" class="nav-link dropdown-item">Lista de Categorias</a></li>
					</ul>
				</li>
			<?php } ?>
			<li class="nav-item">
				<a>Productos</a>
				<ul class="dropdown-menu">
					<?php if($_SESSION['rol']==1){ ?>
					<li><a href="regisprod.php" class="nav-link dropdown-item">Nuevo Producto</a></li>
					<?php } ?>
					<li><a href="listaprod.php" class="nav-link dropdown-item">Lista de Productos</a></li>
				</ul>
				<li class="nav-item">
					<a class="nav-link dropdown-item" href="mostrarcar.php">Carrito(<?php echo (empty($_SESSION['carrito']))?0:count($_SESSION['carrito']);       ?>)</a>
			</li>
		</ul>
	</div>
</nav>