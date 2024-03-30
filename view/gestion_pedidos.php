<?=
include("../model/consultas.php");
include("../controller/sesiones.php");
minEmpleado();
$stmt = ordenar_pedidos($con, $order);

$title = "Consultas";
include("header.php");
?>

<body class="container-fluid bg-body-secondary">
    <main class="row d-flex justify-content-center pb-5 pt-5 ">
        <div class="h2 text-center"><?php echo $mensaje_error; ?></div>
        <article class="bg-white mb-3 col-12 rounded-0 p-4">
            <div class="col-12 text-end ">
                <a href="../controller/logout.php"><button type="button" class="btn btn-secondary rounded-0 mb-4">Cerrar Sesión</button></a>
            </div>
            <h1 class="h1 text-center pb-4">GESTIÓN DE PEDIDOS</h1>
            <div class="table-responsive">
                <table class="table table-bordered pb-4">
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
                        <td class="bg-warning">Editar</td>
                        <td class="bg-warning">Borrar</td>

                        <?php
                        while ($fila = $stmt->fetch()) {

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
                            echo "<td><a href='form_editar_pedido.php?id=" . $fila["0"] . "'><img src='/public/img/edit.svg' width='20' height='20' alt=''/> </a></td>";
                            echo "<td><a href='conf_borrar_pedido.php?id=" . $fila["0"] . "'><img src='/public/img/delete.svg' width='20' height='20' alt=''/> </a></td>";
                            echo "</tr>";
                        }
                        ?>
                </table>
            </div>
            <div class="text-center p-2">
                <a href="/view/panel_administrador.php" class="col-4 col-md-1 btn btn-color-primary m-2 rounded-0">Volver</a>
                <a href="?order=<?php echo $order == 'asc' ? 'desc' : 'asc'; ?>">
                    <button type="button" class="col-10 col-md-3 btn btn-color-primary rounded-0 m-2">Ordenar por Número de Pedido</button>
                </a>
            </div>
            </div>
        </article>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>