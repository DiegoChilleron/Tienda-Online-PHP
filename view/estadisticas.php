<?=
include("../model/consultas.php");
include("../controller/sesiones.php");
minAdministrador();
include("../controller/estadisticas.php");

$title = "Estadisticas";
include("header.php");

?>

<body class="container-fluid bg-body-secondary">
    <main class="row text-center p-5 ">
        <div class="col-12 text-end ">
            <a href="../controller/logout.php"><button type="button" class="btn btn-secondary rounded-0 mb-4">Cerrar Sesión</button></a>
        </div>
        <h1 class="h3 pb-4">Estadisticas</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Usuarios</th>
                    <th>Productos</th>
                    <th>Pedidos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Numero de usuarios: <?php echo $numero_usuarios ?><br />
                        <hr>
                        Numero de usuarios activos: <?php echo $numero_usuarios_act ?><br />
                        Numero de usuarios activos: <?php echo $numero_usuarios_des ?>
                        <hr>
                        - Roles de los usuarios<br /><br />
                        Administradores: <?php echo $numero_rol_adm ?><br />
                        Empleados: <?php echo $numero_rol_emp ?><br />
                        Usuarios: <?php echo $numero_rol_usr ?><br />
                    </td>
                    <td>
                        Numero de productos: <?php echo $numero_productos ?>
                    </td>
                    <td>
                        Numero de pedidos: <?php echo $numero_pedidos ?><br />
                        <hr>
                        - Estado del pedido<br /><br />
                        Cancelados: <?php echo $numero_pedidos_canc ?><br />
                        Pendientes de pago: <?php echo $numero_pedidos_pend ?><br />
                        Aceptados: <?php echo $numero_pedidos_acpt ?><br />
                        Enviados: <?php echo $numero_pedidos_nva2 ?>
                        <hr>

                        - Método de Pago<br /><br />
                        Tarjeta de Crédito / Débito: <?php echo $numero_pago_1 ?><br />
                        PayPal: <?php echo $numero_pago_2 ?><br />
                        Apple Pay: <?php echo $numero_pago_3 ?><br />
                        Google Pay: <?php echo $numero_pago_4 ?><br />
                        Transferencia Bancaria: <?php echo $numero_pago_5 ?><br />
                        Ethereum: <?php echo $numero_pago_6 ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="text-center">
            <button type="button" class="col-10 col-md-1 btn btn-color-primary rounded-0 m-2" onclick="goBack()">Atrás</button>
        </div>
    </main>
    <?php
    include("footer.php");
    ?>
</body>

</html>