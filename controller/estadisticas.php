<?php

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM usuarios');
$stmt->execute();
$usuarios = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_usuarios = $usuarios['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM usuarios WHERE activo = 1');
$stmt->execute();
$usuarios_act = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_usuarios_act = $usuarios_act['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM usuarios WHERE activo = 0');
$stmt->execute();
$usuarios_des = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_usuarios_des = $usuarios_des['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM usuarios WHERE rol = 1');
$stmt->execute();
$rol_adm = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_rol_adm = $rol_adm['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM usuarios WHERE rol = 2');
$stmt->execute();
$rol_emp = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_rol_emp = $rol_emp['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM usuarios WHERE rol = 3');
$stmt->execute();
$rol_usr = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_rol_usr = $rol_usr['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM productos');
$stmt->execute();
$productos = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_productos = $productos['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM pedidos');
$stmt->execute();
$pedidos = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_pedidos = $pedidos['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM pedidos WHERE estado = 1');
$stmt->execute();
$pedidos_canc = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_pedidos_canc = $pedidos_canc['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM pedidos WHERE estado = 2');
$stmt->execute();
$pedidos_pend = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_pedidos_pend = $pedidos_pend['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM pedidos WHERE estado = 3');
$stmt->execute();
$pedidos_acpt = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_pedidos_acpt = $pedidos_acpt['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM pedidos WHERE estado = 4');
$stmt->execute();
$pedidos_nva2 = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_pedidos_nva2 = $pedidos_nva2['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM pedidos WHERE metodo_de_pago = 1');
$stmt->execute();
$pago_1 = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_pago_1 = $pago_1['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM pedidos WHERE metodo_de_pago = 2');
$stmt->execute();
$pago_2 = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_pago_2 = $pago_2['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM pedidos WHERE metodo_de_pago = 3');
$stmt->execute();
$pago_3 = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_pago_3 = $pago_3['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM pedidos WHERE metodo_de_pago = 4');
$stmt->execute();
$pago_4 = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_pago_4 = $pago_4['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM pedidos WHERE metodo_de_pago = 5');
$stmt->execute();
$pago_5 = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_pago_5 = $pago_5['total'];

$stmt = $con->prepare('SELECT COUNT(*) AS total FROM pedidos WHERE metodo_de_pago = 6');
$stmt->execute();
$pago_6 = $stmt->fetch(PDO::FETCH_ASSOC);
$numero_pago_6 = $pago_6['total'];

?>