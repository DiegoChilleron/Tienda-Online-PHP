<?php
include("../model/panel_perfil.php");

$title = "Mi Perfil";
include("header.php");

?>

<body class="container-fluid">
	<main class="row">
		<section class="col-12 p-5">
			<h1>Mi perfil</h1>
			<div class="h5 text-center"> <?php echo $mensaje_error; ?></div>
			<h2>Detalles de tu cuenta:</h2>
			<table>
				<tr>
					<td>Nombre de usuario:</td>
					<td><?= ($USR) ?></td>
				</tr>
				<tr>
					<td>Correo Electronico:</td>
					<td><?= ($MAIL) ?></td>
				</tr>
				<tr>
					<td>DNI:</td>
					<td><?= ($DNI) ?></td>
				</tr>
				<tr>
					<td>Nombre:</td>
					<td><?= ($NOM) ?></td>
				</tr>
				<tr>
					<td>Apellidos:</td>
					<td><?= ($APE) ?></td>
				</tr>
				<tr>
					<td>Dirección:</td>
					<td><?= ($DIR) ?></td>
				</tr>
				<tr>
					<td>Localidad:</td>
					<td><?= ($LOC) ?></td>
				</tr>
				<td>Provincia:</td>
				<td><?= ($PRO) ?></td>
				</tr>
				<td>Pais:</td>
				<td><?= ($PAI) ?></td>
				</tr>
				<td>Sexo:</td>
				<td><?= ($SEX) ?></td>
				</tr>
				<td>Teléfono:</td>
				<td><?= ($TEL) ?></td>
				</tr>
				<td>Rol:</td>
				<td><?= ($ROL) ?></td>
				</tr>
				<td>Estado de la cuenta:</td>
				<td><?= ($ACT) ?></td>
				</tr>
			</table>
		</section>
		<section class="col-12">
			<h2 class="p-4">Historial de compras</h2>

			<?php if ($stmt->rowCount() == 0) : ?>
				<hr>
				<p colspan="5" class="text-center">No tienes productos añadidos a tu carrito</p>
				<hr>
			<?php else : ?>

				<div class="table-responsive ">
					<table class="table table-bordered">
						<tr class="text-center ">
							<td class="bg-warning">Número de Pedido</td>
							<td class="bg-warning">DNI del Cliente</td>
							<td class="bg-warning">DNI de envio</td>
							<td class="bg-warning">Nombre</td>
							<td class="bg-warning">Apellidos</td>
							<td class="bg-warning">Dirección</td>
							<td class="bg-warning">Localidad</td>
							<td class="bg-warning">Provincia</td>
							<td class="bg-warning">País</td>
							<td class="bg-warning">ID de Producto</td>
							<td class="bg-warning">Cantidad</td>
							<td class="bg-warning">Precio Total</td>
							<td class="bg-warning">Método de pago</td>
							<td class="bg-warning">Estado</td>

							<?php
							while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

								switch ($fila["metodo_de_pago"]) {
									case 1:
										$fila["metodo_de_pago"] = 'Tarjeta de Débito';
										break;
									case 2:
										$fila["metodo_de_pago"] = 'Pago con PayPal';
										break;
									case 3:
										$fila["metodo_de_pago"] = 'Google Pay';
										break;
									case 4:
										$fila["metodo_de_pago"] = 'Apple Pay';
										break;
									case 5:
										$fila["metodo_de_pago"] = 'Transferencia Bancaria';
										break;
									default:
										$fila["metodo_de_pago"] = 'Pago con Ethereum';
										break;
								}

								switch ($fila["estado"]) {
									case 1:
										$fila["estado"] = 'Cancelado';
										break;
									case 2:
										$fila["estado"] = 'Pendiente de Pago';
										break;
									case 3:
										$fila["estado"] = 'Aceptado';
										break;
									case 4:
										$fila["estado"] = 'Enviado';
										break;
									default:
										$fila["estado"] = 'Sin Estado';
										break;
								}

								echo "<tr>";
								echo "<td>{$fila["numpedido"]}</td>";
								echo "<td>{$fila["dnicuenta"]}</td>";
								echo "<td>{$fila["dni"]}</td>";
								echo "<td>{$fila["nombre"]}</td>";
								echo "<td>{$fila["apellidos"]}</td>";
								echo "<td>{$fila["direccion"]}</td>";
								echo "<td>{$fila["localidad"]}</td>";
								echo "<td>{$fila["provincia"]}</td>";
								echo "<td>{$fila["pais"]}</td>";
								echo "<td>{$fila["producto_id"]}</td>";
								echo "<td>{$fila["cantidad"]}</td>";
								echo "<td>{$fila["precio_total"]}</td>";
								echo "<td>{$fila["metodo_de_pago"]}</td>";
								echo "<td>{$fila["estado"]}</td>";
								echo "</tr>";
							}
							?>

					</table>
				</div>
			<?php endif; ?>

		</section>
		<section class="row justify-content-center pt-5 pb-5">

			<button type="button" class="col-10 col-md-1 btn btn-color-primary rounded-0 m-2" onclick="goBack()">Atrás</button>
			<a href='form_editar_usuario.php?id=<?php echo $DNI; ?>' type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Editar Perfil</a>
			<a href='form_recuperarcontrasena.php' type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Modificar Contraseña</a>
			<a href='conf_borrar_usuario.php?id=<?php echo $DNI; ?>' type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Desactivar Cuenta</a>
			<a href="/controller/logout.php" type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Cerrar Sesión</a>

		</section>
	</main>
	<?php
	include("../view/footer.php");
	?>
</body>

</html>