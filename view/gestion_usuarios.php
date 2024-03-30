<?=
include("../model/consultas.php");
include("../controller/sesiones.php");
minAdministrador();
$stmt = ordenar_usuarios($con, $order);

$title = "Consultas";
include("header.php");
?>

<body class="container-fluid bg-body-secondary">
    <main class="row d-flex justify-content-center pb-5 pt-5 ">
        <div class="h2 text-center"> <?php echo $mensaje_error; ?></div>
        <article class="bg-white col-12 rounded-0">
            <div class="col-12 text-end ">
                <a href="../controller/logout.php"><button type="button" class="btn btn-secondary rounded-0 m-4">Cerrar Sesión</button></a>
            </div>
            <h1 class="h1 text-center pb-4">GESTIÓN DE USUARIOS</h1>
            <div class="table-responsive">
                <table class="table table-bordered pb-4">
                    <tr class="text-center ">
                        <td class="bg-warning">DNI</td>
                        <td class="bg-warning">Usuario</td>
                        <td class="bg-warning">Nombre</td>
                        <td class="bg-warning">Apellidos</td>
                        <td class="bg-warning">Dirección</td>
                        <td class="bg-warning">Localidad</td>
                        <td class="bg-warning">Provincia</td>
                        <td class="bg-warning">País</td>
                        <td class="bg-warning">Sexo</td>
                        <td class="bg-warning">Teléfono</td>
                        <td class="bg-warning">Correo electrónico</td>
                        <td class="bg-warning">Rol</td>
                        <td class="bg-warning">Estado</td>
                        <td class="bg-success">Editar</td>
                        <td class="bg-danger">Borrar</td>
                    </tr>

                    <?php
                    while ($fila = $stmt->fetch()) {

                        switch ($fila["rol"]) {
                            case 1:
                                $fila["rol"] = 'Administrador';
                                break;
                            case 2:
                                $fila["rol"] = 'Empleado';
                                break;
                            case 3:
                                $fila["rol"] = 'Usuario';
                                break;
                            case 4:
                                $fila["rol"] = 'Reservado';
                                break;
                            default:
                                $fila["rol"] = 'Sin Rol';
                                break;
                        }

                        switch ($fila["activo"]) {
                            case 0:
                                $fila["activo"] = 'Desactivado';
                                break;
                            case 1:
                                $fila["activo"] = 'Activo';
                                break;
                            default:
                                $fila["activo"] = 'Error';
                                break;
                        }

                        echo "<tr>";
                        echo "<td>{$fila["dni"]}</td>";
                        echo "<td>{$fila["usuario"]}</td>";
                        echo "<td>{$fila["nombre"]}</td>";
                        echo "<td>{$fila["apellidos"]}</td>";
                        echo "<td>{$fila["direccion"]}</td>";
                        echo "<td>{$fila["localidad"]}</td>";
                        echo "<td>{$fila["provincia"]}</td>";
                        echo "<td>{$fila["pais"]}</td>";
                        echo "<td>{$fila["sexo"]}</td>";
                        echo "<td>{$fila["telefono"]}</td>";
                        echo "<td>{$fila["email"]}</td>";
                        echo "<td>{$fila["rol"]}</td>";
                        echo "<td>{$fila["activo"]}</td>";
                        echo "<td><a href='form_editar_usuario.php?id=" . $fila["0"] . "'><img src='/public/img/edit.svg' width='20' height='20' alt='Imagen de editar'/></a></td>";
                        echo "<td><a href='conf_borrar_usuario.php?id=" . $fila["0"] . "'><img src='/public/img/delete.svg' width='20' height='20' alt='Imagen de eliminar'/> </a></td>";
                        echo "</tr>";
                    }
                    ?>

                </table>
            </div>
            <div class="text-center p-2 mb-4">
                <a href="/view/panel_administrador.php" class="col-10 col-md-3 btn btn-color-primary m-2 rounded-0">Volver al Panel de Administrador</a>
                <a href="form_registro_usuario.php">
                    <button type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Nuevo usuario</button>
                </a>
                <a href="?order=<?php echo $order == 'asc' ? 'desc' : 'asc'; ?>">
                    <button type="button" class="col-10 col-md-2 btn btn-color-primary rounded-0 m-2">Ordenar por nombre</button>
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