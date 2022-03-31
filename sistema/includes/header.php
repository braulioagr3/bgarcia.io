<?php
    if(empty($_SESSION['active'])) //para que no regres a la pagina osea si existe la secion no regres al index de tienda 
    {
        header('location: ../');//retrocedemos al login 
    }

?>
<header>
	<div class="header">
		<h2>La guarida del lector</h2>
		<div class="optionsBar">
			<span>Mexico, <?php echo fechaC(); ?></span>
			<span>|</span>                    
			<span class="user"><?php echo $_SESSION['user'].' - '.$_SESSION['rol'].' - '.$_SESSION['email']; ?></span>
			<a href="listacomp.php"><img class="photouser" src="img/user.png" alt="Usuario"></a>
			<a href="salir.php"><img class="close" src="img/salir.png" alt="Salir del sistema" title="Salir"></a>
		</div>
	</div>
	<div>
		<?php include "nav.php"; ?>
	</div>
	
</header>