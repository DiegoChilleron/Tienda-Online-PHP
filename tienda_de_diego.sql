-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-03-2024 a las 21:56:03
-- Versión del servidor: 11.2.2-MariaDB
-- Versión de PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tienda_de_diego`
--
CREATE DATABASE IF NOT EXISTS `tienda_de_diego` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `tienda_de_diego`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `codigo` int(2) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `cat_padre` int(2) NOT NULL,
  `activo` tinyint(2) NOT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`codigo`, `nombre`, `cat_padre`, `activo`) VALUES
(0, 'Categoria Padre', 0, 0),
(1, 'Google', 0, 1),
(2, 'Apple', 0, 1),
(3, 'Samsung', 0, 1),
(4, 'Xiaomi', 0, 1),
(5, 'Oppo', 0, 1),
(6, 'Siemens', 0, 1),
(7, 'Pixel', 1, 1),
(8, 'Nexus', 1, 1),
(9, 'iPhone', 2, 1),
(10, 'iPhoneSE', 2, 1),
(11, 'Galaxy', 3, 1),
(12, 'ASeries', 3, 1),
(13, 'Mi', 4, 1),
(14, 'Redmi', 4, 1),
(15, 'Pocophone', 4, 1),
(16, 'Reno', 5, 1),
(17, 'Find', 5, 1),
(18, 'Siemens', 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_pedido`
--

DROP TABLE IF EXISTS `estado_pedido`;
CREATE TABLE IF NOT EXISTS `estado_pedido` (
  `id` int(2) NOT NULL,
  `estado` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estado_pedido`
--

INSERT INTO `estado_pedido` (`id`, `estado`) VALUES
(1, 'cancelado'),
(2, 'pendientePago'),
(3, 'aceptado'),
(4, 'enviado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_de_pago`
--

DROP TABLE IF EXISTS `metodos_de_pago`;
CREATE TABLE IF NOT EXISTS `metodos_de_pago` (
  `id` int(2) NOT NULL,
  `metodoDePago` varchar(25) NOT NULL,
  `activo` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `metodos_de_pago`
--

INSERT INTO `metodos_de_pago` (`id`, `metodoDePago`, `activo`) VALUES
(1, 'tarjeta', 1),
(2, 'paypal', 1),
(3, 'googlePlay', 1),
(4, 'applePay', 1),
(5, 'transferencia_bancaria', 1),
(6, 'ethereum', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `numpedido` varchar(100) NOT NULL,
  `dnicuenta` varchar(9) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellidos` varchar(75) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `localidad` varchar(50) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `pais` varchar(50) NOT NULL,
  `producto_id` int(15) NOT NULL,
  `cantidad` varchar(15) NOT NULL,
  `precio_total` decimal(65,0) NOT NULL,
  `metodo_de_pago` int(2) NOT NULL,
  `estado` int(2) NOT NULL,
  PRIMARY KEY (`numpedido`),
  KEY `dniCuenta` (`dnicuenta`),
  KEY `producto_id` (`producto_id`),
  KEY `estado` (`estado`),
  KEY `metodoDePago` (`metodo_de_pago`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de pedidos realizados';

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`numpedido`, `dnicuenta`, `dni`, `nombre`, `apellidos`, `direccion`, `localidad`, `provincia`, `pais`, `producto_id`, `cantidad`, `precio_total`, `metodo_de_pago`, `estado`) VALUES
('20240307164912', '68968797P', '68968797P', 'Admin', 'Admin', 'Cuenta de Administrador', 'directorio raiz', 'root', 'es', 2, '1', 849, 3, 3),
('20240307165043', '68968797P', '68968797P', 'Admin', 'Admin', 'Cuenta de Administrador', 'directorio raiz', 'root', 'es', 1, '1', 1099, 6, 2),
('20240308001243', '68968797P', '68968797P', 'Admin', 'Admin', 'Cuenta de Administrador', 'directorio raiz', 'root', 'es', 2, '1', 849, 3, 3),
('20240308142237', '34556678Y', '34556678Y', 'empleado', 'empleado', 'Av.Novelda', 'Elche', 'Alicante', 'es', 1, '1', 1099, 5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `producto_id` int(15) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(1000) NOT NULL,
  `precio` decimal(7,2) NOT NULL,
  `precio_recomendado` decimal(7,2) NOT NULL,
  `cantidad` int(15) NOT NULL,
  `img` varchar(200) NOT NULL,
  `categoria` int(2) NOT NULL,
  `fecha_producto` datetime(6) NOT NULL,
  PRIMARY KEY (`producto_id`),
  KEY `categoria` (`categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=10000000 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de producto a la venta';

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`producto_id`, `nombre`, `descripcion`, `precio`, `precio_recomendado`, `cantidad`, `img`, `categoria`, `fecha_producto`) VALUES
(1, 'Google Pixel 8 Pro 128GB+12GB RAM', 'La potencia y la inteligencia de Pixel 8 Pro: El chip Google Tensor G3 se ha diseÃ±ado a medida con la IA de Google para ofrecerte funciones vanguardistas de fotografÃ­a y vÃ­deo, asÃ­ como formas mÃ¡s inteligentes de ayudarte a lo largo del dÃ­a.\r\n\r\nLa resoluciÃ³n mÃ¡s alta hasta la fecha de la cÃ¡mara ultra gran angular de Pixel. AmplÃ­a aÃºn mÃ¡s la imagen gracias a la funciÃ³n Enfoque Macro mejorada. O redÃºcela todavÃ­a mÃ¡s en astrofotografÃ­a.', 1099.00, 1200.00, 20, 'pixel8pro.avif', 7, '2024-02-02 00:00:00.000000'),
(2, 'Apple iPhone 15 128GB', 'Dynamic Island. Para todo lo que surja:\r\n\r\nLa Dynamic Island sabe quÃ© es importante y te muestra alertas y actividades en tiempo real para que no se te escape nada mientras sigues a lo tuyo. PodrÃ¡s controlar tu mÃºsica, comprobar el estado de tu vuelo, ver quiÃ©n te llama y muchas mÃ¡s cosas. Ojo con ella.\r\n\r\nTintado por dentro. DurÃ­simo por fuera:\r\n\r\nEl novedoso diseÃ±o del iPhone 15 incorpora una parte trasera fabricada con vidrio tintado en masa. Gracias a la estructura de aluminio de calidad aeroespac', 849.00, 959.00, 20, 'iphone15-128.avif', 9, '2024-02-22 00:00:00.000000'),
(3, 'Xiaomi Redmi Note 12 5G 128GB+6GB RAM', 'Redmi Note 12 5G estÃ¡ preparado para el futuro con la compatibilidad con Dual 5G de nueva generaciÃ³n. Descargue una temporada completa para mirar sin conexiÃ³n, cargue archivos grandes en segundos, vea videos de alta resoluciÃ³n sin bÃºfer, no se demore en el campo de batalla y disfrute de videollamadas nÃ­tidas con la revoluciÃ³n 5G.\r\n\r\nLa pantalla Super AMOLED de 16,94 cm (6,67) y 120 Hz', 189.00, 299.00, 20, 'xiaomiredmi.avif', 14, '2024-02-07 00:00:00.000000'),
(4, 'OPPO Reno 10 5G 256GB+8GB RAM', 'vEl OPPO Reno 10 5G incorpora una pantalla AMOLED con un tamaÃ±o de 6,7 pulgadas con una resoluciÃ³n de 2412x1080 que te permitirÃ¡ disfrutar de tus series favoritas con la mÃ¡xima resoluciÃ³n.\r\n\r\nEn el apartado fotogrÃ¡fico destaca por su triple cÃ¡mara trasera de 64MP+8MP+32MP para que puedas inmortalizar tus mejores momentos, junto con una cÃ¡mara frontal de 32MP perfecta para tus videollamadas.\r\n\r\nDispone de un procesador de 8 nÃºcleos, permite el desbloqueo mediante huella en pantalla y mediante reconocimiento facial, tiene una baterÃ­a de gran capacidad de 5000mAh con carga rÃ¡pida, resistencia IPX4 y conectividad 5G.\r\n', 350.00, 400.00, 200, 'oppo-reno.avif', 16, '2024-01-30 00:00:00.000000'),
(5, 'Samsung Galaxy A34 5G 128GB+6GB', 'Gracias a su nueva cÃ¡mara principal con estabilizador\r\nÃ³ptico de imagen mejorado Galaxy A34 da un gran salto\r\nen calidad de imagen. Corrige los movimientos y\r\nvibraciones para que tus fotos y videos salgan siempre\r\nnÃ­tidos y definidos, incluso en interiores o con mucho\r\nmovimiento.', 269.00, 399.00, 30, 'samsung-galaxy.avif', 12, '2024-03-07 16:04:25.000000'),
(6, 'Samsung Galaxy S24 Ultra 5G 512GB + 12GB RAM', 'Bienvenido a la nueva era de la inteligencia artificial con Galaxy S24 Series, el primer AI Phone de Samsung. Los Galaxy S24 Series han sido creados para revolucionar la industria, iniciando una nueva era para la telefonÃ­a. Gracias a la exclusiva tecnologÃ­a Galaxy AI, cambiarÃ¡ la forma de usar tu dispositivo, haciendo todas las tareas diarias sin esfuerzo.\r\n', 1579.00, 1600.00, 20, 'samsungs24ultra.avif', 11, '2024-01-31 00:00:00.000000'),
(7, 'Samsung Galaxy Z Flip3 5G 128GB+8GB RAM', 'Galaxy Z Flip3 es todo lo que necesitas:\r\nEl Galaxy Z Flip3 cumple hasta con los mÃ¡s exigentes. Es mÃ¡s ligero que una taza de cafÃ© y ocupa la mitad que un smartphone convencional, pero sin renunciar a su pantalla de 6,7â€. AdemÃ¡s, desde su pantalla exterior de 1,9â€ puedes controlar tu mÃºsica o consultar tus notificaciones, sin desplegarlo.', 899.00, 980.00, 3, 'galaxy-z-flip.avif', 11, '2024-02-09 00:00:00.000000'),
(8, 'Samsung Galaxy S24 5G 256GB+8GB RAM', 'Bienvenido a la nueva era de la inteligencia artificial con Galaxy S24 Series, el primer AI Phone de Samsung. Los Galaxy S24 Series han sido creados para revolucionar la industria, iniciando una nueva era para la telefonÃ­a. Gracias a la exclusiva tecnologÃ­a Galaxy AI, cambiarÃ¡ la forma de usar tu dispositivo, haciendo todas las tareas diarias sin esfuerzo.\r\n', 969.00, 980.00, 5, 'samsung-s24.avif', 11, '2024-02-01 00:00:00.000000'),
(9, 'Google Pixel 7 Pro 5G 128GB+12GB RAM', 'Toda la ayuda que necesitas, personalizada para ti.\r\nCombina los telÃ©fonos y los auriculares de botÃ³n Pixel para obtener ayuda personalizada a lo largo del dÃ­a.\r\n\r\nGoogle Tensor G2, el cerebro de Pixel 7 Pro.\r\nGoogle Tensor G2 hace que Pixel 7 Pro sea mÃ¡s rÃ¡pido, eficiente y seguro, y ofrece la mejor calidad de foto y vÃ­deo en Pixel hasta la fecha.', 620.00, 699.00, 20, 'google7pro.avif', 7, '2024-01-31 00:00:00.000000'),
(10, 'Google Pixel Fold 5G 12GB/256GB Negro', 'Google se lanza al mundo de los telÃ©fonos plegables.El Google Pixel Fold destaca por contar con dos pantallas OLED de gran calidad, con la segunda generaciÃ³n de procesadores creados por Samsung para la Gran G, el Tensor G2 y con un sistema de cÃ¡maras similar al que vimos en el Pixel 7 Pro..A nivel de diseÃ±o, el Google PIxel Fold hereda la estÃ©tica de la serie Pixel 7, ya que cuenta con el caracterÃ­stico mÃ³dulo de cÃ¡maras traseras en forma de barra, aunque en esta ocasiÃ³n este no ocuparÃ¡ todo el ancho hasta la bisagra porque no llegarÃ¡ a los extremos. Se trata de un terminal de tipo libro, por lo que hablaremos de dos pantallas: una rectangular y una cuadrada en su interior ', 2039.00, 2664.00, 20, 'googlepixelfold.avif', 7, '2024-01-30 00:00:00.000000'),
(11, 'Google Pixel 8 128GB+8GB RAM', 'Cada momento, aÃºn mejor de lo que recordabas:\r\nLa cÃ¡mara de Pixel 8 se ha mejorado totalmente y usa la IA de Google para ayudarte a hacer fotos y vÃ­deos memorables, de dÃ­a o de noche.\r\n\r\nEdita fotos y vÃ­deos. AsÃ­ de fÃ¡cil:\r\nCon la ayuda de la IA de Google, puedes eliminar distracciones, hacer modificaciones personalizadas y mÃ¡s con solo unos toques.\r\n\r\nAdiÃ³s, llamadas de spam:\r\nCon Filtro de Llamadas, ahora el Asistente de Google detecta y filtra aÃºn mÃ¡s llamadas de spam. En las demÃ¡s llamadas, te dice quiÃ©n llama y por quÃ© antes de que respondas.\r\n\r\nNo te pierdas ni una palabra:\r\nLlamadas NÃ­tidas realza la voz de la persona que te llama y elimina el alboroto de las multitudes o el ruido del viento.\r\n', 596.00, 650.00, 20, 'pixel8rosa.avif', 7, '2024-02-13 00:00:00.000000'),
(12, 'Xiaomi 13T Pro 5G 512GB+12GB RAM', 'CÃ¡maras profesionales Leica Summicron y zoom Ã³ptico:\r\n\r\nXiaomi 13T Pro revoluciona la fotografÃ­a con su impresionante conjunto de lentes Leica Summicron, llevando la experiencia fotogrÃ¡fica a un nivel profesional sin precedentes. Cada captura se transforma en una obra maestra con imÃ¡genes nÃ­tidas y un impresionante contraste. Esta innovadora cÃ¡mara cuenta con una nueva lente de 50 mm de distancia focal, permitiÃ©ndonos acercarnos a objetos', 650.00, 630.00, 20, 'xiaomi13t.avif', 13, '2024-02-07 00:00:00.000000'),
(13, 'Xiaomi 13 Lite 5G 256GB+8GB RAM', 'Tres cÃ¡maras con estilo:\r\nXiaomi 13 Lite cuenta con 3 cÃ¡mara que marcan estilo, disfrutando de una cÃ¡mara principal de 50MP y gran percepciÃ³n de luz, consiguiendo la mejor foto o video en prÃ¡cticamente cualquier situaciÃ³n, su gran variedad de modos serÃ¡n el perfecto aliado en los momentos mas creativos, consiguiendo sacar tanto en fotos como videos. Sus cÃ¡maras selfies no permiten que se escape ningÃºn detalle, con una resoluciÃ³n de 32MP en su cÃ¡mara principal', 549.00, 590.00, 20, 'xiaomi13lite.avif', 13, '2024-02-06 00:00:00.000000'),
(14, 'Apple iPhone 15 128GB', 'Dynamic Island. Para todo lo que surja:\r\n\r\nLa Dynamic Island sabe quÃ© es importante y te muestra alertas y actividades en tiempo real para que no se te escape nada mientras sigues a lo tuyo. PodrÃ¡s controlar tu mÃºsica, comprobar el estado de tu vuelo, ver quiÃ©n te llama y muchas mÃ¡s cosas. Ojo con ella.\r\n\r\nTintado por dentro. DurÃ­simo por fuera:\r\n\r\nEl novedoso diseÃ±o del iPhone 15 incorpora una parte trasera fabricada con vidrio tintado en masa. Gracias a la estructura de aluminio de calidad aeroespacial y al proceso de doble intercambio iÃ³nico que aplicamos al vidrio, este iPhone aguanta, aguanta y aguanta.', 849.00, 899.00, 8, 'appleiphone15ve.avif', 9, '2024-02-06 00:00:00.000000'),
(15, 'Google Nexus 5 16GB Negro', 'ConstrucciÃ³n en policarbonato similar al del Nexus 7 en colores negro, blanco y rojo.\r\nPanel capacitivo True IPS de 4.95 pulgadas y resoluciÃ³n Full HD (445 pÃ­xeles por pulgada).\r\nProtecciÃ³n Corning Gorilla Glass 3.\r\nProcesador de cuatro nÃºcleos Qualcomm Snapdragon 800 a 2.26 GHz.\r\n2 GB de memoria MemoriaRAM.\r\n16 o 32 GB de almacenamiento interno (posibilidad de expansiÃ³n por MicroSD.\r\nUnidad grÃ¡fica (GPU) Android 330 de 450 MHz.\r\nCÃ¡mara trasera de 8 MP con autofoco, flash LED y estabilizaciÃ³n Ã³ptica de imagen (idS); frontal de 1,3 MP.\r\nSensores de proximidad e iluminaciÃ³n ambiental, presiÃ³n, brÃºjula, GPS, acelerÃ³metro, giroscopio.\r\nBaterÃ­a de polÃ­mero de litio de 2300 mAh.\r\nRecarga inalÃ¡mbrica por inducciÃ³n con el sistema ui.\r\nNFC.', 150.00, 350.00, 5, 'Nexus_5.avif', 8, '2024-02-14 00:00:00.000000'),
(16, 'Siemens C60', 'Red	GSM 900 / GSM 1800 / GSM 1900\r\nAnunciado	2003, 3Q\r\nStatus	Disponible\r\nTAMAÃ‘O	Dimensiones	110 x 47 x 23 mm\r\nPeso	85 g\r\nDISPLAY	Tipo	CSTN, 4096 colores\r\nTamaÃ±o	101 x 80 pixels, 5 lineas\r\n 	- Tecla Navy\r\nRINGTONES	Tipo	PolifÃ³nico (16 canales)\r\nCantidad	38 + 4 propios\r\nCustomizaciÃ³n	Download Comprar\r\nVibraciÃ³n	Si\r\nMEMORIA	Agenda telefÃ³nica	100 entradas, grupos de contactos\r\nRegistro de llamadas	10 marcadas, 10 recibidas, 10 perdidas\r\nSlot de tarjeta	No\r\n 	- Total 1.86 MB\r\nCARACTERÃSTICAS	GPRS	Clase 8 (4+1 slots)\r\nVelocidad de datos	32 - 40 kbps\r\nMensajerÃ­a	SMS, MMS\r\nReloj	Si\r\nAlarma	Si\r\nPuerto infrarrojo	No\r\n', 5.00, 10.00, 200, 'siemens.avif', 18, '2024-02-08 00:00:00.000000'),
(17, 'Nexus 4', 'El Nexus 4 es un telÃ©fono inteligente de gama alta desarrollado por Google en la colaboraciÃ³n con LG. Es la cuarta generaciÃ³n de la gama Nexus. Se caracteriza por poseer una cÃ¡mara de 8 MP, pantalla IPS LCD capacitiva y procesador de cuatro nÃºcleos. SaliÃ³ al mercado con la versiÃ³n de Android 4.2 y se actualizÃ³ a Android 4.4 KitKat, mÃ¡s tarde a Android 4.4.2 KitKat, despuÃ©s a Android 4.4.4 KitKat, posteriormente a Android 5.0 Lollipop, luego a Android 5.1 Lollipop y por Ãºltimo a android 5.1.1 (LMY47V) lollipop.', 50.00, 299.00, 40, 'Nexus_4.avif', 8, '2024-02-05 00:00:00.000000'),
(18, 'Xiaomi POCO X4 Pro 5G 256GB+8GB RAM', 'La serie POCO X ahora utiliza una pantalla AMOLED compatible con DCI-P3. La gama de colores ampliada produce detalles ricos, lo que proporciona un aspecto cinematogrÃ¡fico. La apertura de la cÃ¡mara frontal es de solo 2,96 mm, lo que amplÃ­a el campo de visiÃ³n.\r\n\r\nEl procesador 5G Snapdragon de alto rendimiento ofrece una eficiencia energÃ©tica superior y una velocidad de descarga mÃ¡xima de 2,5 Gbps. Admite las principale', 199.00, 229.00, 10, 'xiaomi_poco.avif', 15, '2024-01-29 00:00:00.000000'),
(19, 'Google Pixel 4a 4G 128GB+6GB RAM', 'Haz fotos como un profesional.Haz fotos increÃ­bles sin necesidad de pagar un precio desorbitado. La cÃ¡mara de Pixel 4a incluye funciones como HDR+, VisiÃ³n Nocturna y muchas mÃ¡s.Carga menos. Vive mÃ¡s.La baterÃ­a inteligente aprende cuÃ¡les son tus aplicaciones favoritas y reduce el consumo de las que apenas usas. La baterÃ­a inteligente de Pixel 4a aprende cuÃ¡les son tus aplicaciones favoritas y reduce el consumo de las que apenas usas. La baterÃ­a de carga rÃ¡pida se ha diseÃ±ado para que puedas seguir', 187.00, 349.00, 15, 'pixel4a.avif', 7, '2024-02-15 00:00:00.000000'),
(20, 'Apple iPhone 14 128GB', 'Espectacular pantalla Super Retina XDR: La tecnologÃ­a OLED ofrece un contraste increÃ­ble con blancos luminosos y negros absolutos. La alta resoluciÃ³n y la precisiÃ³n cromÃ¡tica hacen que todo se vea nÃ­tido y real como la vida misma. La tecnologÃ­a True Tone adapta la pantalla a la luz ambiental. Tus ojos te lo agradecerÃ¡n.\r\n\r\nEn iOS 16 la pantalla de bloqueo te da mucha libertad. Puedes superponer tus fotos al texto para que tengan el', 759.00, 1009.00, 15, 'iPhone14.avif', 9, '2024-01-30 00:00:00.000000'),
(21, 'Apple iPhone 12 128GB', 'TecnologÃ­a 5G. Chip A14 Bionic, el mÃ¡s veloz en un smartphone. Pantalla OLED de borde a borde. Ceramic Shield, cuatro veces mÃ¡s resistente a las caÃ­das. Modo Noche en cada una de las cÃ¡maras. Y dos tamaÃ±os: ideal y perfecto. SÃ­, el iPhone 12 lo tiene todo.', 799.00, 804.00, 15, 'iPhone12.avif', 9, '2024-02-01 00:00:00.000000'),
(22, 'Apple iPhone 11 Pro 64GB', 'Si eliges este mÃ³vil de Apple te lo pasarÃ¡s en grande con su procesador de altas prestaciones, pantalla de gran tamaÃ±o y ademÃ¡s podrÃ¡s sacar instantÃ¡neas de calidad gracias a su cÃ¡mara de alta definiciÃ³n.\r\n\r\nCuenta con un poderoso procesador firmado por Apple de 6 nÃºcleos para que saques el mÃ¡ximo partido de las aplicaciones mÃ¡s recientes en este terminal. Este telÃ©fono dispone de una pantalla de gran formato de 5,8 pulgadas', 449.00, 450.00, 15, 'iPhone11.avif', 9, '2024-02-02 00:00:00.000000'),
(23, 'Google Nexus 6P 32GB', 'El Google Nexus 6P 32GB Plata tiene una pantalla AMOLED con resoluciÃ³n WQHD de 5,7&quot;.\r\n\r\nTiene una potente cÃ¡mara posterior de 12.3 mpx con pÃ­xeles de 1,55 Âµm que son mÃ¡s grandes y absorben mucha mÃ¡s luz, incluso en los ambientes mÃ¡s oscuros para que tus fotos brillen y captura de vÃ­deo de 4K (30 fps), lleva tambiÃ©n una cÃ¡mara frontal de 8 mpx con pÃ­xeles de 1,4 Âµm y captura de vÃ­deo en HD (30 fps)', 189.00, 199.00, 20, 'nexus_6p.avif', 8, '2024-03-19 00:00:00.000000'),
(24, 'Google Pixel 7 5G 128GB+8GB RAM', 'El chip detrÃ¡s de todo.\r\nGoogle Tensor G2 hace que Pixel sea mÃ¡s rÃ¡pido, eficiente y seguro. TambiÃ©n te ofrece funciones que te ayudan mÃ¡s, asÃ­ como la mejor calidad de foto y vÃ­deo en Pixel hasta la fecha de su lanzamiento.\r\n\r\nLa funciÃ³n BaterÃ­a Inteligente de Pixel permite que la baterÃ­a pueda durar mÃ¡s de 24 horas.', 440.00, 480.00, 189, 'pixel7green.avif', 7, '2024-02-07 00:00:00.000000'),
(25, 'Samsung Galaxy A25 5G 128GB+6GB RAM Oferta Top!', 'Pantalla\r\nTamaÃ±o de pantalla6.5 &quot; / 16,51 cm\r\nResoluciÃ³n pantallaFHD+ (2340x1080)\r\nTipo de pantallaSuper AMOLED\r\nCÃ¡mara\r\nResoluciÃ³n cÃ¡mara principal50 Mpx\r\nApertura cÃ¡mara principalf/1.8\r\nEstabilizador cÃ¡mara principalÃ“ptico (OIS)\r\nResoluciÃ³n cÃ¡mara principal secundaria8 Mpx\r\nApertura cÃ¡mara principal secundariaf/2.2\r\nResoluciÃ³n cÃ¡mara tercera2 Mpx\r\nApertura cÃ¡mara terceraf/2.4\r\nResoluciÃ³n cÃ¡mara frontal13 Mpx\r\nApertura cÃ¡mara frontalf/2.2\r\nMemoria y almacenamiento\r\nMemoria RAM6GB\r\nMemoria Interna128 GB\r\nLector de tarjetasSecure Digital (microSD)\r\nCapacidad tarjeta de memoria1TB\r\nProcesador', 289.00, 245.00, 45, 'SamsungA25.avif', 12, '2024-03-04 00:00:00.000000'),
(26, ' Samsung A54 5G 256GB+8GB RAM', 'Inspirado en la sencillez:\r\nCon un acabado premium en cristal, un mÃ³dulo de cÃ¡mara con un diseÃ±o elegante y colores que transmiten energÃ­a, Galaxy A54 5G lleva inscrita su identidad Awesome en su aspecto conseguido y minimalista.\r\n\r\nCaptura tus momentos mÃ¡s Awesome con sus mÃºltiples cÃ¡maras:\r\nDispone de una cÃ¡mara para selfies de 32MP mientras que', 399.00, 435.00, 34, 'Samsung_A54.avif', 12, '2024-03-12 00:00:00.000000'),
(27, 'Xiaomi Redmi 12 256GB+8GB RAM', 'Gran potencia y eficiencia:\r\nEquipado con un procesador mÃ³vil Mediatek G88, Redmi 12 brinda una experiencia multitarea eficiente y sin problemas en fotografÃ­a, juegos, audio y multimedia. Fabricado en 12nm, esto aumenta la eficiencia energÃ©tica de la CPU de 2.0GHz.\r\n\r\nTriple cÃ¡mara con hasta 50MP:\r\nCon una impresionante configuraciÃ³n de cÃ¡mara triple de', 179.00, 189.00, 45, 'redmi_12.avif', 14, '2024-03-05 00:00:00.000000'),
(28, 'Xiaomi 14 Ultra 5G 512GB+16GB RAM', 'SÃ³lida como la roca con el doble de fiabilidad:\r\nEl Xiaomi 14 Ultra cuenta con un nuevo marco de aluminio 6M42 de una sola pieza, cristal de protecciÃ³n Xiaomi y una nueva generaciÃ³n de piel vegana con nanotecnologÃ­a de Xiaomi. La triple protecciÃ³n garantiza durabilidad y fiabilidad.\r\n\r\nBrillante y claro, sÃ³lido y resistente al desgaste', 1499.00, 1545.00, 34, 'xiaomi_mi14.avif', 13, '2024-03-12 00:00:00.000000'),
(29, 'Xiaomi 14 5G 512GB+12GB RAM', 'Ã“pticas Leica de Ãºltima generaciÃ³n:\r\nEl nuevo Xiaomi 14 introduce una experiencia fotogrÃ¡fica excepcional con sus lentes Leica VARIO-SUMMILUX. Esta configuraciÃ³n de cÃ¡mara, sin precedentes en el mundo de los smartphones, ofrece una apertura de f/1.6 a f/2.2 y una longitud focal de 14mm a 75mm, asegurando versatilidad y calidad superior en cada disparo. Con estas lentes Leica, Xiaomi establece un nuevo estÃ¡ndar en fotografÃ­a mÃ³vil, presentando una herramienta potente y versÃ¡til', 1099.00, 1199.00, 34, 'xiaomi_mi.avif', 13, '2024-03-12 00:00:00.000000'),
(30, 'Apple iPhone SE (2022) 64GB', 'Todo va gas a fondo con el chip A15 Bionic. Las apps se cargan en un pispÃ¡s y funcionan con absoluta fluidez. AdemÃ¡s, las prestaciones avanzadas de fotografÃ­a hacen que las caras, lugares y detalles de tus fotos se vean de lujo.\r\n\r\nUn chip muy eficiente, una baterÃ­a optimizada y iOS 15 se unen para dar alas a la autonomÃ­a. Cuando tengas que cargar el iPhone SE, simplemente colÃ³calo sobre un', 410.00, 445.00, 45, 'iphonese.avif', 10, '2024-03-20 00:00:00.000000'),
(31, 'OPPO Find X5 Pro 256GB+12GB RAM', 'Un diseÃ±o extraordinario, sofisticado y natural bajado directamente del espacio. Disfruta de la nitidez y los mil millones de colores en cualquier lugar con la mejor pantalla AMOLED de 6.7&quot; y resoluciÃ³n WQHD+. Sus 120Hz de tasa de refresco de pantalla y su sonido Dolby Panoramic Sound te darÃ¡n una experiencia totalmente inmersiva.\r\n\r\nÂ¡Siempre listo! Con su gran baterÃ­a de 5000mAh y su impresionante carga rÃ¡pida de 80W SUPERVOOC', 949.00, 1000.00, 45, 'oppofind.avif', 17, '2024-03-05 00:00:00.000000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(2) NOT NULL,
  `rol` varchar(15) NOT NULL,
  `activo` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de roles de los usuarios';

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol`, `activo`) VALUES
(1, 'administrador', 1),
(2, 'empleado', 1),
(3, 'usuario', 1),
(4, 'reservado', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `dni` varchar(9) NOT NULL,
  `usuario` varchar(40) NOT NULL,
  `clave` varchar(70) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidos` varchar(75) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `localidad` varchar(30) NOT NULL,
  `provincia` varchar(30) NOT NULL,
  `pais` varchar(30) NOT NULL,
  `sexo` varchar(7) NOT NULL,
  `telefono` int(9) NOT NULL,
  `email` varchar(30) NOT NULL,
  `rol` int(2) NOT NULL,
  `activo` tinyint(2) NOT NULL,
  PRIMARY KEY (`dni`),
  KEY `rol` (`rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabla de usuarios';

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dni`, `usuario`, `clave`, `nombre`, `apellidos`, `direccion`, `localidad`, `provincia`, `pais`, `sexo`, `telefono`, `email`, `rol`, `activo`) VALUES
('00000000T', 'usuario_invitado', '$2y$10$TvHqL4K148drns/Bi23QbeJAzbCPc8a0e/Hi79ofiG2OLAeJHF25G', 'Invitado', 'nada', 'nada', 'nada', 'nada', 'es', '', 677352415, 'nada@gmail.com', 4, 1),
('12345678Z', 'desactivado', '$2y$10$kyh9xvtgpZNDbmhErF9wGe2efysvXRLFwH1fHCj0/lT1Wdn7aExQm', 'desactivado', 'nada', 'nada', 'Elche', 'Alicante', 'es', 'hombre', 677889933, 'ddsfu@gmail.com', 3, 0),
('13231231K', 'Kojima', '$2y$10$yBzqvVEg/IBCVoAW6do4Gu2xrUoCwYqcMwWg8gp24PiRwn0YYgfFa', 'Hideo', 'Kojima', 'Tokio Street', 'Tokio', 'Japan', 'es', 'hombre', 655768798, 'sdsdfsdf@gmail.com', 3, 1),
('34556678Y', 'empleado', '$2y$10$dr884fNpyu/r6hmsJ8P.1eCXeu6vsJ/g/fKj4Zs1n4m8RN.7OkahW', 'empleado', 'empleado', 'Av.Novelda', 'Elche', 'Alicante', 'es', 'hombre', 788656454, 'afad@gmail.com', 2, 1),
('45654556Q', 'ErenYeager', '$2y$10$QptcKcqghPieVLKujA5HWeXuG0aP0G5l.j1bE9IBG.hETSXVHYbJi', 'Eren', 'Yeager', 'shiganshina', 'Paradais', 'Muro Maria', 'pr', 'hombre', 655456778, 'dgsgewfd@gmail.com', 3, 1),
('45666677Q', 'Bieber', '$2y$10$fIIBZw9VKtKK63znlKUpQ.zWM9KSaXBvLR04K7HfeyXKndtcWTkNi', 'Justin', 'Bieber', 'Miami', 'Miami', 'EEUU', 'fr', 'hombre', 677980956, 'afafaf@gmail.com', 3, 0),
('68968797P', 'admin', '$2y$10$0Yu3lTPglNvzN2w1R9ZoseWSgWVZqEfq7BZbadBo.rMSzZBl1AHXK', 'Admin', 'Admin', 'Cuenta de Administrador', 'directorio raiz', 'root', 'es', 'hombre', 677453423, '0000000@gmail.com', 1, 1),
('74352381M', 'usuario', '$2y$10$Taql/.j5LsAq4rEf8LqmB..3vnD1R5UciMyPv8C9LSVd8B3nDRNky', 'usuario', 'Sin apellido', 'sin direccion', 'Madrid', 'Madrid', 'es', 'hombre', 677098765, 'sgfg@gmail.com', 3, 1),
('76456775Z', 'SolidSnake', '$2y$10$AL0oWe9EjgJT8uBJhTKz8Oj0lQb.OgTPwogLKtnTbeYxjp1L6gthu', 'Solid', 'Snake', 'Shadow Moses 1', 'Shadow Moses', 'Alaska', 'gr', 'hombre', 788453423, 'afakfkafa@gmail.com', 3, 1),
('76567667T', 'Naruto', '$2y$10$tOQt6OGHk.yHgxn2Q6tozeC3ZVQ1BWpjqyc.lm5NOtfJqtEBDrXva', 'Naruto', 'Uzumaki', 'Villa', 'Konoha', 'Albacete', 'es', 'hombre', 899786756, 'naruto@gmail.com', 3, 1),
('87565882Y', 'Mikasa', '$2y$10$QUbeoXLNiKySjWHC3IYZoew1Quxt0XhCJzLrQDPkIQR5Cxh6w.Ojm', 'Mikasa', 'Akerman', 'Junto a Eren :)', 'Shiganshina', 'Muro Maria', 'fr', 'mujer', 677564534, 'esdvd@gmail.com', 3, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`dnicuenta`) REFERENCES `usuarios` (`dni`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`producto_id`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`estado`) REFERENCES `estado_pedido` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_4` FOREIGN KEY (`metodo_de_pago`) REFERENCES `metodos_de_pago` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`codigo`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
