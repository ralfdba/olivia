# ************************************************************
# Sequel Ace SQL dump
# Versión 20050
#
# https://sequel-ace.com/
# https://github.com/Sequel-Ace/Sequel-Ace
#
# Equipo: 192.168.100.54 (MySQL 5.5.5-10.5.19-MariaDB-0+deb11u2)
# Base de datos: saga
# Tiempo de generación: 2023-07-31 13:37:33 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE='NO_AUTO_VALUE_ON_ZERO', SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla acl
# ------------------------------------------------------------

DROP TABLE IF EXISTS `acl`;

CREATE TABLE `acl` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `roles` longtext DEFAULT NULL,
  `controllers` longtext DEFAULT NULL,
  `actions` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



# Volcado de tabla comunas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comunas`;

CREATE TABLE `comunas` (
  `comuna_id` int(11) NOT NULL AUTO_INCREMENT,
  `comuna_nombre` varchar(64) NOT NULL,
  `provincia_id` int(11) NOT NULL,
  PRIMARY KEY (`comuna_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

LOCK TABLES `comunas` WRITE;
/*!40000 ALTER TABLE `comunas` DISABLE KEYS */;

INSERT INTO `comunas` (`comuna_id`, `comuna_nombre`, `provincia_id`)
VALUES
	(1,'Arica',1),
	(2,'Camarones',1),
	(3,'General Lagos',2),
	(4,'Putre',2),
	(5,'Alto Hospicio',3),
	(6,'Iquique',3),
	(7,'Camiña',4),
	(8,'Colchane',4),
	(9,'Huara',4),
	(10,'Pica',4),
	(11,'Pozo Almonte',4),
	(12,'Antofagasta',5),
	(13,'Mejillones',5),
	(14,'Sierra Gorda',5),
	(15,'Taltal',5),
	(16,'Calama',6),
	(17,'Ollague',6),
	(18,'San Pedro de Atacama',6),
	(19,'María Elena',7),
	(20,'Tocopilla',7),
	(21,'Chañaral',8),
	(22,'Diego de Almagro',8),
	(23,'Caldera',9),
	(24,'Copiapó',9),
	(25,'Tierra Amarilla',9),
	(26,'Alto del Carmen',10),
	(27,'Freirina',10),
	(28,'Huasco',10),
	(29,'Vallenar',10),
	(30,'Canela',11),
	(31,'Illapel',11),
	(32,'Los Vilos',11),
	(33,'Salamanca',11),
	(34,'Andacollo',12),
	(35,'Coquimbo',12),
	(36,'La Higuera',12),
	(37,'La Serena',12),
	(38,'Paihuaco',12),
	(39,'Vicuña',12),
	(40,'Combarbalá',13),
	(41,'Monte Patria',13),
	(42,'Ovalle',13),
	(43,'Punitaqui',13),
	(44,'Río Hurtado',13),
	(45,'Isla de Pascua',14),
	(46,'Calle Larga',15),
	(47,'Los Andes',15),
	(48,'Rinconada',15),
	(49,'San Esteban',15),
	(50,'La Ligua',16),
	(51,'Papudo',16),
	(52,'Petorca',16),
	(53,'Zapallar',16),
	(54,'Hijuelas',17),
	(55,'La Calera',17),
	(56,'La Cruz',17),
	(57,'Limache',17),
	(58,'Nogales',17),
	(59,'Olmué',17),
	(60,'Quillota',17),
	(61,'Algarrobo',18),
	(62,'Cartagena',18),
	(63,'El Quisco',18),
	(64,'El Tabo',18),
	(65,'San Antonio',18),
	(66,'Santo Domingo',18),
	(67,'Catemu',19),
	(68,'Llaillay',19),
	(69,'Panquehue',19),
	(70,'Putaendo',19),
	(71,'San Felipe',19),
	(72,'Santa María',19),
	(73,'Casablanca',20),
	(74,'Concón',20),
	(75,'Juan Fernández',20),
	(76,'Puchuncaví',20),
	(77,'Quilpué',20),
	(78,'Quintero',20),
	(79,'Valparaíso',20),
	(80,'Villa Alemana',20),
	(81,'Viña del Mar',20),
	(82,'Colina',21),
	(83,'Lampa',21),
	(84,'Tiltil',21),
	(85,'Pirque',22),
	(86,'Puente Alto',22),
	(87,'San José de Maipo',22),
	(88,'Buin',23),
	(89,'Calera de Tango',23),
	(90,'Paine',23),
	(91,'San Bernardo',23),
	(92,'Alhué',24),
	(93,'Curacaví',24),
	(94,'María Pinto',24),
	(95,'Melipilla',24),
	(96,'San Pedro',24),
	(97,'Cerrillos',25),
	(98,'Cerro Navia',25),
	(99,'Conchalí',25),
	(100,'El Bosque',25),
	(101,'Estación Central',25),
	(102,'Huechuraba',25),
	(103,'Independencia',25),
	(104,'La Cisterna',25),
	(105,'La Granja',25),
	(106,'La Florida',25),
	(107,'La Pintana',25),
	(108,'La Reina',25),
	(109,'Las Condes',25),
	(110,'Lo Barnechea',25),
	(111,'Lo Espejo',25),
	(112,'Lo Prado',25),
	(113,'Macul',25),
	(114,'Maipú',25),
	(115,'Ñuñoa',25),
	(116,'Pedro Aguirre Cerda',25),
	(117,'Peñalolén',25),
	(118,'Providencia',25),
	(119,'Pudahuel',25),
	(120,'Quilicura',25),
	(121,'Quinta Normal',25),
	(122,'Recoleta',25),
	(123,'Renca',25),
	(124,'San Miguel',25),
	(125,'San Joaquín',25),
	(126,'San Ramón',25),
	(127,'Santiago',25),
	(128,'Vitacura',25),
	(129,'El Monte',26),
	(130,'Isla de Maipo',26),
	(131,'Padre Hurtado',26),
	(132,'Peñaflor',26),
	(133,'Talagante',26),
	(134,'Codegua',27),
	(135,'Coínco',27),
	(136,'Coltauco',27),
	(137,'Doñihue',27),
	(138,'Graneros',27),
	(139,'Las Cabras',27),
	(140,'Machalí',27),
	(141,'Malloa',27),
	(142,'Mostazal',27),
	(143,'Olivar',27),
	(144,'Peumo',27),
	(145,'Pichidegua',27),
	(146,'Quinta de Tilcoco',27),
	(147,'Rancagua',27),
	(148,'Rengo',27),
	(149,'Requínoa',27),
	(150,'San Vicente de Tagua Tagua',27),
	(151,'La Estrella',28),
	(152,'Litueche',28),
	(153,'Marchihue',28),
	(154,'Navidad',28),
	(155,'Peredones',28),
	(156,'Pichilemu',28),
	(157,'Chépica',29),
	(158,'Chimbarongo',29),
	(159,'Lolol',29),
	(160,'Nancagua',29),
	(161,'Palmilla',29),
	(162,'Peralillo',29),
	(163,'Placilla',29),
	(164,'Pumanque',29),
	(165,'San Fernando',29),
	(166,'Santa Cruz',29),
	(167,'Cauquenes',30),
	(168,'Chanco',30),
	(169,'Pelluhue',30),
	(170,'Curicó',31),
	(171,'Hualañé',31),
	(172,'Licantén',31),
	(173,'Molina',31),
	(174,'Rauco',31),
	(175,'Romeral',31),
	(176,'Sagrada Familia',31),
	(177,'Teno',31),
	(178,'Vichuquén',31),
	(179,'Colbún',32),
	(180,'Linares',32),
	(181,'Longaví',32),
	(182,'Parral',32),
	(183,'Retiro',32),
	(184,'San Javier',32),
	(185,'Villa Alegre',32),
	(186,'Yerbas Buenas',32),
	(187,'Constitución',33),
	(188,'Curepto',33),
	(189,'Empedrado',33),
	(190,'Maule',33),
	(191,'Pelarco',33),
	(192,'Pencahue',33),
	(193,'Río Claro',33),
	(194,'San Clemente',33),
	(195,'San Rafael',33),
	(196,'Talca',33),
	(197,'Arauco',34),
	(198,'Cañete',34),
	(199,'Contulmo',34),
	(200,'Curanilahue',34),
	(201,'Lebu',34),
	(202,'Los Álamos',34),
	(203,'Tirúa',34),
	(204,'Alto Biobío',35),
	(205,'Antuco',35),
	(206,'Cabrero',35),
	(207,'Laja',35),
	(208,'Los Ángeles',35),
	(209,'Mulchén',35),
	(210,'Nacimiento',35),
	(211,'Negrete',35),
	(212,'Quilaco',35),
	(213,'Quilleco',35),
	(214,'San Rosendo',35),
	(215,'Santa Bárbara',35),
	(216,'Tucapel',35),
	(217,'Yumbel',35),
	(218,'Chiguayante',36),
	(219,'Concepción',36),
	(220,'Coronel',36),
	(221,'Florida',36),
	(222,'Hualpén',36),
	(223,'Hualqui',36),
	(224,'Lota',36),
	(225,'Penco',36),
	(226,'San Pedro de La Paz',36),
	(227,'Santa Juana',36),
	(228,'Talcahuano',36),
	(229,'Tomé',36),
	(230,'Bulnes',37),
	(231,'Chillán',37),
	(232,'Chillán Viejo',37),
	(233,'Cobquecura',37),
	(234,'Coelemu',37),
	(235,'Coihueco',37),
	(236,'El Carmen',37),
	(237,'Ninhue',37),
	(238,'Ñiquen',37),
	(239,'Pemuco',37),
	(240,'Pinto',37),
	(241,'Portezuelo',37),
	(242,'Quillón',37),
	(243,'Quirihue',37),
	(244,'Ránquil',37),
	(245,'San Carlos',37),
	(246,'San Fabián',37),
	(247,'San Ignacio',37),
	(248,'San Nicolás',37),
	(249,'Treguaco',37),
	(250,'Yungay',37),
	(251,'Carahue',38),
	(252,'Cholchol',38),
	(253,'Cunco',38),
	(254,'Curarrehue',38),
	(255,'Freire',38),
	(256,'Galvarino',38),
	(257,'Gorbea',38),
	(258,'Lautaro',38),
	(259,'Loncoche',38),
	(260,'Melipeuco',38),
	(261,'Nueva Imperial',38),
	(262,'Padre Las Casas',38),
	(263,'Perquenco',38),
	(264,'Pitrufquén',38),
	(265,'Pucón',38),
	(266,'Saavedra',38),
	(267,'Temuco',38),
	(268,'Teodoro Schmidt',38),
	(269,'Toltén',38),
	(270,'Vilcún',38),
	(271,'Villarrica',38),
	(272,'Angol',39),
	(273,'Collipulli',39),
	(274,'Curacautín',39),
	(275,'Ercilla',39),
	(276,'Lonquimay',39),
	(277,'Los Sauces',39),
	(278,'Lumaco',39),
	(279,'Purén',39),
	(280,'Renaico',39),
	(281,'Traiguén',39),
	(282,'Victoria',39),
	(283,'Corral',40),
	(284,'Lanco',40),
	(285,'Los Lagos',40),
	(286,'Máfil',40),
	(287,'Mariquina',40),
	(288,'Paillaco',40),
	(289,'Panguipulli',40),
	(290,'Valdivia',40),
	(291,'Futrono',41),
	(292,'La Unión',41),
	(293,'Lago Ranco',41),
	(294,'Río Bueno',41),
	(295,'Ancud',42),
	(296,'Castro',42),
	(297,'Chonchi',42),
	(298,'Curaco de Vélez',42),
	(299,'Dalcahue',42),
	(300,'Puqueldón',42),
	(301,'Queilén',42),
	(302,'Quemchi',42),
	(303,'Quellón',42),
	(304,'Quinchao',42),
	(305,'Calbuco',43),
	(306,'Cochamó',43),
	(307,'Fresia',43),
	(308,'Frutillar',43),
	(309,'Llanquihue',43),
	(310,'Los Muermos',43),
	(311,'Maullín',43),
	(312,'Puerto Montt',43),
	(313,'Puerto Varas',43),
	(314,'Osorno',44),
	(315,'Puero Octay',44),
	(316,'Purranque',44),
	(317,'Puyehue',44),
	(318,'Río Negro',44),
	(319,'San Juan de la Costa',44),
	(320,'San Pablo',44),
	(321,'Chaitén',45),
	(322,'Futaleufú',45),
	(323,'Hualaihué',45),
	(324,'Palena',45),
	(325,'Aisén',46),
	(326,'Cisnes',46),
	(327,'Guaitecas',46),
	(328,'Cochrane',47),
	(329,'O\'higgins',47),
	(330,'Tortel',47),
	(331,'Coihaique',48),
	(332,'Lago Verde',48),
	(333,'Chile Chico',49),
	(334,'Río Ibáñez',49),
	(335,'Antártica',50),
	(336,'Cabo de Hornos',50),
	(337,'Laguna Blanca',51),
	(338,'Punta Arenas',51),
	(339,'Río Verde',51),
	(340,'San Gregorio',51),
	(341,'Porvenir',52),
	(342,'Primavera',52),
	(343,'Timaukel',52),
	(344,'Natales',53),
	(345,'Torres del Paine',53);

/*!40000 ALTER TABLE `comunas` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla copublicacion
# ------------------------------------------------------------

DROP TABLE IF EXISTS `copublicacion`;

CREATE TABLE `copublicacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(10) DEFAULT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `cuerpo` longtext DEFAULT NULL,
  `estado` varchar(45) DEFAULT '0' COMMENT '0 = Activo, 1 = Inactivo',
  `fecha` datetime DEFAULT current_timestamp(),
  `extracto` varchar(150) DEFAULT NULL,
  `imagen_url` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `copublicacion` WRITE;
/*!40000 ALTER TABLE `copublicacion` DISABLE KEYS */;

INSERT INTO `copublicacion` (`id`, `categoria_id`, `titulo`, `cuerpo`, `estado`, `fecha`, `extracto`, `imagen_url`)
VALUES
	(1,1,'Noticia Blog Demo','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean mollis quis nisi et ullamcorper. Sed fermentum ligula a enim placerat elementum. Curabitur eu nisi molestie odio efficitur tincidunt vitae non nunc. Suspendisse nec magna felis. Aliquam erat volutpat. Duis nunc nisl, mollis eget tristique non, condimentum sit amet quam. Nunc sit amet eleifend magna. Fusce ligula arcu, mattis ut lorem at, fringilla lacinia metus. Curabitur eget eros lorem.</p>\r\n<p>&nbsp;</p>\r\n<p>Phasellus eleifend quam vel arcu varius, vel tristique nisl efficitur. Fusce venenatis, lorem id porta luctus, elit dolor sodales lorem, aliquet commodo libero dolor ac sapien. Donec efficitur nisi risus, fermentum semper felis consequat tempor. Vivamus ac lacinia purus. Etiam porta sem vel massa ultrices fringilla. Mauris risus magna, feugiat et turpis nec, elementum vestibulum odio. Aliquam ac facilisis massa. Sed suscipit justo sed metus elementum, fermentum congue justo porta. Maecenas suscipit justo eu facilisis feugiat. Phasellus nec odio et tortor accumsan pharetra sed at quam. Mauris rhoncus orci sem, eu auctor arcu porta ac. Proin egestas elit at lobortis suscipit.</p>\r\n<p>&nbsp;</p>\r\n<p>Praesent malesuada molestie dignissim. Nulla maximus laoreet consectetur. Vestibulum ac nisl vitae nisi sagittis dictum at id magna. Vivamus porta nisl et augue posuere, in congue lectus porttitor. Nulla eget enim tincidunt, congue turpis id, tempus elit. Sed euismod, eros at pellentesque porttitor, tellus est accumsan ante, ut porta massa nisi quis nisi. In interdum mattis libero, eget rutrum elit laoreet nec. Nullam congue, augue eget lobortis viverra, urna massa facilisis lectus, vel rhoncus sem ligula sit amet erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ut neque libero. Phasellus aliquet ut libero tincidunt luctus. Pellentesque egestas finibus nisl ac pulvinar. Maecenas faucibus, purus et dignissim eleifend, odio mauris mattis elit, a mollis leo eros ut est. Nam lobortis nibh eu enim maximus aliquam. Aliquam erat volutpat. Aliquam erat volutpat.</p>','0','2019-01-09 09:39:33','<p>Lorem ipsum dolor sit amet</p>','');

/*!40000 ALTER TABLE `copublicacion` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla empresas
# ------------------------------------------------------------

DROP TABLE IF EXISTS `empresas`;

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `empresa` varchar(200) DEFAULT NULL,
  `rut` varchar(12) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `nombre_fantasia` varchar(210) DEFAULT NULL,
  `estado_pago` smallint(2) DEFAULT 0,
  `email_notificacion` varchar(120) DEFAULT NULL,
  `is_lab` smallint(3) DEFAULT 0 COMMENT '0 No, 1 Si',
  PRIMARY KEY (`id`),
  KEY `idx_empresas` (`rut`,`estado_pago`,`nombre_fantasia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `empresas` WRITE;
/*!40000 ALTER TABLE `empresas` DISABLE KEYS */;

INSERT INTO `empresas` (`id`, `empresa`, `rut`, `direccion`, `nombre_fantasia`, `estado_pago`, `email_notificacion`, `is_lab`)
VALUES
	(1,'NETSTREAM','99581960-0','Monjitas 90',NULL,0,'info@netstream.cl',0);

/*!40000 ALTER TABLE `empresas` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla geo_countries
# ------------------------------------------------------------

DROP TABLE IF EXISTS `geo_countries`;

CREATE TABLE `geo_countries` (
  `name` varchar(100) NOT NULL,
  `abv` char(2) NOT NULL DEFAULT '' COMMENT 'ISO 3661-1 alpha-2',
  `abv3` char(3) DEFAULT NULL COMMENT 'ISO 3661-1 alpha-3',
  `abv3_alt` char(3) DEFAULT NULL,
  `code` char(3) DEFAULT NULL COMMENT 'ISO 3661-1 numeric',
  `slug` varchar(100) NOT NULL,
  PRIMARY KEY (`abv`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

LOCK TABLES `geo_countries` WRITE;
/*!40000 ALTER TABLE `geo_countries` DISABLE KEYS */;

INSERT INTO `geo_countries` (`name`, `abv`, `abv3`, `abv3_alt`, `code`, `slug`)
VALUES
	('Afghanistan','AF','AFG',NULL,'4','afghanistan'),
	('Aland Islands','AX','ALA',NULL,'248','aland-islands'),
	('Albania','AL','ALB',NULL,'8','albania'),
	('Algeria','DZ','DZA',NULL,'12','algeria'),
	('American Samoa','AS','ASM',NULL,'16','american-samoa'),
	('Andorra','AD','AND',NULL,'20','andorra'),
	('Angola','AO','AGO',NULL,'24','angola'),
	('Anguilla','AI','AIA',NULL,'660','anguilla'),
	('Antigua and Barbuda','AG','ATG',NULL,'28','antigua-and-barbuda'),
	('Argentina','AR','ARG',NULL,'32','argentina'),
	('Armenia','AM','ARM',NULL,'51','armenia'),
	('Aruba','AW','ABW',NULL,'533','aruba'),
	('Australia','AU','AUS',NULL,'36','australia'),
	('Austria','AT','AUT',NULL,'40','austria'),
	('Azerbaijan','AZ','AZE',NULL,'31','azerbaijan'),
	('Bahamas','BS','BHS',NULL,'44','bahamas'),
	('Bahrain','BH','BHR',NULL,'48','bahrain'),
	('Bangladesh','BD','BGD',NULL,'50','bangladesh'),
	('Barbados','BB','BRB',NULL,'52','barbados'),
	('Belarus','BY','BLR',NULL,'112','belarus'),
	('Belgium','BE','BEL',NULL,'56','belgium'),
	('Belize','BZ','BLZ',NULL,'84','belize'),
	('Benin','BJ','BEN',NULL,'204','benin'),
	('Bermuda','BM','BMU',NULL,'60','bermuda'),
	('Bhutan','BT','BTN',NULL,'64','bhutan'),
	('Bolivia','BO','BOL',NULL,'68','bolivia'),
	('Bosnia and Herzegovina','BA','BIH',NULL,'70','bosnia-and-herzegovina'),
	('Botswana','BW','BWA',NULL,'72','botswana'),
	('Brazil','BR','BRA',NULL,'76','brazil'),
	('British Virgin Islands','VG','VGB',NULL,'92','british-virgin-islands'),
	('Brunei Darussalam','BN','BRN',NULL,'96','brunei-darussalam'),
	('Bulgaria','BG','BGR',NULL,'100','bulgaria'),
	('Burkina Faso','BF','BFA',NULL,'854','burkina-faso'),
	('Burundi','BI','BDI',NULL,'108','burundi'),
	('Cambodia','KH','KHM',NULL,'116','cambodia'),
	('Cameroon','CM','CMR',NULL,'120','cameroon'),
	('Canada','CA','CAN',NULL,'124','canada'),
	('Cape Verde','CV','CPV',NULL,'132','cape-verde'),
	('Cayman Islands','KY','CYM',NULL,'136','cayman-islands'),
	('Central African Republic','CF','CAF',NULL,'140','central-african-republic'),
	('Chad','TD','TCD',NULL,'148','chad'),
	('Chile','CL','CHL','CHI','152','chile'),
	('China','CN','CHN',NULL,'156','china'),
	('Colombia','CO','COL',NULL,'170','colombia'),
	('Comoros','KM','COM',NULL,'174','comoros'),
	('Congo','CG','COG',NULL,'178','congo'),
	('Cook Islands','CK','COK',NULL,'184','cook-islands'),
	('Costa Rica','CR','CRI',NULL,'188','costa-rica'),
	('Cote d\'Ivoire','CI','CIV',NULL,'384','cote-divoire'),
	('Croatia','HR','HRV',NULL,'191','croatia'),
	('Cuba','CU','CUB',NULL,'192','cuba'),
	('Cyprus','CY','CYP',NULL,'196','cyprus'),
	('Czech Republic','CZ','CZE',NULL,'203','czech-republic'),
	('Democratic Republic of the Congo','CD','COD',NULL,'180','democratic-republic-of-congo'),
	('Denmark','DK','DNK',NULL,'208','denmark'),
	('Djibouti','DJ','DJI',NULL,'262','djibouti'),
	('Dominica','DM','DMA',NULL,'212','dominica'),
	('Dominican Republic','DO','DOM',NULL,'214','dominican-republic'),
	('Ecuador','EC','ECU',NULL,'218','ecuador'),
	('Egypt','EG','EGY',NULL,'818','egypt'),
	('El Salvador','SV','SLV',NULL,'222','el-salvador'),
	('Equatorial Guinea','GQ','GNQ',NULL,'226','equatorial-guinea'),
	('Eritrea','ER','ERI',NULL,'232','eritrea'),
	('Estonia','EE','EST',NULL,'233','estonia'),
	('Ethiopia','ET','ETH',NULL,'231','ethiopia'),
	('Faeroe Islands','FO','FRO',NULL,'234','faeroe-islands'),
	('Falkland Islands','FK','FLK',NULL,'238','falkland-islands'),
	('Fiji','FJ','FJI',NULL,'242','fiji'),
	('Finland','FI','FIN',NULL,'246','finland'),
	('France','FR','FRA',NULL,'250','france'),
	('French Guiana','GF','GUF',NULL,'254','french-guiana'),
	('French Polynesia','PF','PYF',NULL,'258','french-polynesia'),
	('Gabon','GA','GAB',NULL,'266','gabon'),
	('Gambia','GM','GMB',NULL,'270','gambia'),
	('Georgia','GE','GEO',NULL,'268','georgia'),
	('Germany','DE','DEU',NULL,'276','germany'),
	('Ghana','GH','GHA',NULL,'288','ghana'),
	('Gibraltar','GI','GIB',NULL,'292','gibraltar'),
	('Greece','GR','GRC',NULL,'300','greece'),
	('Greenland','GL','GRL',NULL,'304','greenland'),
	('Grenada','GD','GRD',NULL,'308','grenada'),
	('Guadeloupe','GP','GLP',NULL,'312','guadeloupe'),
	('Guam','GU','GUM',NULL,'316','guam'),
	('Guatemala','GT','GTM',NULL,'320','guatemala'),
	('Guernsey','GG','GGY',NULL,'831','guernsey'),
	('Guinea','GN','GIN',NULL,'324','guinea'),
	('Guinea-Bissau','GW','GNB',NULL,'624','guinea-bissau'),
	('Guyana','GY','GUY',NULL,'328','guyana'),
	('Haiti','HT','HTI',NULL,'332','haiti'),
	('Holy See','VA','VAT',NULL,'336','holy-see'),
	('Honduras','HN','HND',NULL,'340','honduras'),
	('Hong Kong','HK','HKG',NULL,'344','hong-kong'),
	('Hungary','HU','HUN',NULL,'348','hungary'),
	('Iceland','IS','ISL',NULL,'352','iceland'),
	('India','IN','IND',NULL,'356','india'),
	('Indonesia','ID','IDN',NULL,'360','indonesia'),
	('Iran','IR','IRN',NULL,'364','iran'),
	('Iraq','IQ','IRQ',NULL,'368','iraq'),
	('Ireland','IE','IRL',NULL,'372','ireland'),
	('Isle of Man','IM','IMN',NULL,'833','isle-of-man'),
	('Israel','IL','ISR',NULL,'376','israel'),
	('Italy','IT','ITA',NULL,'380','italy'),
	('Jamaica','JM','JAM',NULL,'388','jamaica'),
	('Japan','JP','JPN',NULL,'392','japan'),
	('Jersey','JE','JEY',NULL,'832','jersey'),
	('Jordan','JO','JOR',NULL,'400','jordan'),
	('Kazakhstan','KZ','KAZ',NULL,'398','kazakhstan'),
	('Kenya','KE','KEN',NULL,'404','kenya'),
	('Kiribati','KI','KIR',NULL,'296','kiribati'),
	('Kuwait','KW','KWT',NULL,'414','kuwait'),
	('Kyrgyzstan','KG','KGZ',NULL,'417','kyrgyzstan'),
	('Laos','LA','LAO',NULL,'418','laos'),
	('Latvia','LV','LVA',NULL,'428','latvia'),
	('Lebanon','LB','LBN',NULL,'422','lebanon'),
	('Lesotho','LS','LSO',NULL,'426','lesotho'),
	('Liberia','LR','LBR',NULL,'430','liberia'),
	('Libyan Arab Jamahiriya','LY','LBY',NULL,'434','libyan-arab-jamahiriya'),
	('Liechtenstein','LI','LIE',NULL,'438','liechtenstein'),
	('Lithuania','LT','LTU',NULL,'440','lithuania'),
	('Luxembourg','LU','LUX',NULL,'442','luxembourg'),
	('Macao','MO','MAC',NULL,'446','macao'),
	('Macedonia','MK','MKD',NULL,'807','macedonia'),
	('Madagascar','MG','MDG',NULL,'450','madagascar'),
	('Malawi','MW','MWI',NULL,'454','malawi'),
	('Malaysia','MY','MYS',NULL,'458','malaysia'),
	('Maldives','MV','MDV',NULL,'462','maldives'),
	('Mali','ML','MLI',NULL,'466','mali'),
	('Malta','MT','MLT',NULL,'470','malta'),
	('Marshall Islands','MH','MHL',NULL,'584','marshall-islands'),
	('Martinique','MQ','MTQ',NULL,'474','martinique'),
	('Mauritania','MR','MRT',NULL,'478','mauritania'),
	('Mauritius','MU','MUS',NULL,'480','mauritius'),
	('Mayotte','YT','MYT',NULL,'175','mayotte'),
	('Mexico','MX','MEX',NULL,'484','mexico'),
	('Micronesia','FM','FSM',NULL,'583','micronesia'),
	('Moldova','MD','MDA',NULL,'498','moldova'),
	('Monaco','MC','MCO',NULL,'492','monaco'),
	('Mongolia','MN','MNG',NULL,'496','mongolia'),
	('Montenegro','ME','MNE',NULL,'499','montenegro'),
	('Montserrat','MS','MSR',NULL,'500','montserrat'),
	('Morocco','MA','MAR',NULL,'504','morocco'),
	('Mozambique','MZ','MOZ',NULL,'508','mozambique'),
	('Myanmar','MM','MMR','BUR','104','myanmar'),
	('Namibia','NA','NAM',NULL,'516','namibia'),
	('Nauru','NR','NRU',NULL,'520','nauru'),
	('Nepal','NP','NPL',NULL,'524','nepal'),
	('Netherlands','NL','NLD',NULL,'528','netherlands'),
	('Netherlands Antilles','AN','ANT',NULL,'530','netherlands-antilles'),
	('New Caledonia','NC','NCL',NULL,'540','new-caledonia'),
	('New Zealand','NZ','NZL',NULL,'554','new-zealand'),
	('Nicaragua','NI','NIC',NULL,'558','nicaragua'),
	('Niger','NE','NER',NULL,'562','niger'),
	('Nigeria','NG','NGA',NULL,'566','nigeria'),
	('Niue','NU','NIU',NULL,'570','niue'),
	('Norfolk Island','NF','NFK',NULL,'574','norfolk-island'),
	('North Korea','KP','PRK',NULL,'408','north-korea'),
	('Northern Mariana Islands','MP','MNP',NULL,'580','northern-mariana-islands'),
	('Norway','NO','NOR',NULL,'578','norway'),
	('Oman','OM','OMN',NULL,'512','oman'),
	('Pakistan','PK','PAK',NULL,'586','pakistan'),
	('Palau','PW','PLW',NULL,'585','palau'),
	('Palestine','PS','PSE',NULL,'275','palestine'),
	('Panama','PA','PAN',NULL,'591','panama'),
	('Papua New Guinea','PG','PNG',NULL,'598','papua-new-guinea'),
	('Paraguay','PY','PRY',NULL,'600','paraguay'),
	('Peru','PE','PER',NULL,'604','peru'),
	('Philippines','PH','PHL',NULL,'608','philippines'),
	('Pitcairn','PN','PCN',NULL,'612','pitcairn'),
	('Poland','PL','POL',NULL,'616','poland'),
	('Portugal','PT','PRT',NULL,'620','portugal'),
	('Puerto Rico','PR','PRI',NULL,'630','puerto-rico'),
	('Qatar','QA','QAT',NULL,'634','qatar'),
	('Reunion','RE','REU',NULL,'638','reunion'),
	('Romania','RO','ROU','ROM','642','romania'),
	('Russian Federation','RU','RUS',NULL,'643','russian-federation'),
	('Rwanda','RW','RWA',NULL,'646','rwanda'),
	('Saint Helena','SH','SHN',NULL,'654','saint-helena'),
	('Saint Kitts and Nevis','KN','KNA',NULL,'659','saint-kitts-and-nevis'),
	('Saint Lucia','LC','LCA',NULL,'662','saint-lucia'),
	('Saint Pierre and Miquelon','PM','SPM',NULL,'666','saint-pierre-and-miquelon'),
	('Saint Vincent and the Grenadines','VC','VCT',NULL,'670','saint-vincent-and-grenadines'),
	('Saint-Barthelemy','BL','BLM',NULL,'652','saint-barthelemy'),
	('Saint-Martin','MF','MAF',NULL,'663','saint-martin'),
	('Samoa','WS','WSM',NULL,'882','samoa'),
	('San Marino','SM','SMR',NULL,'674','san-marino'),
	('Sao Tome and Principe','ST','STP',NULL,'678','sao-tome-and-principe'),
	('Saudi Arabia','SA','SAU',NULL,'682','saudi-arabia'),
	('Senegal','SN','SEN',NULL,'686','senegal'),
	('Serbia','RS','SRB',NULL,'688','serbia'),
	('Seychelles','SC','SYC',NULL,'690','seychelles'),
	('Sierra Leone','SL','SLE',NULL,'694','sierra-leone'),
	('Singapore','SG','SGP',NULL,'702','singapore'),
	('Slovakia','SK','SVK',NULL,'703','slovakia'),
	('Slovenia','SI','SVN',NULL,'705','slovenia'),
	('Solomon Islands','SB','SLB',NULL,'90','solomon-islands'),
	('Somalia','SO','SOM',NULL,'706','somalia'),
	('South Africa','ZA','ZAF',NULL,'710','south-africa'),
	('South Korea','KR','KOR',NULL,'410','south-korea'),
	('South Sudan','SS','SSD',NULL,'728','south-sudan'),
	('Spain','ES','ESP',NULL,'724','spain'),
	('Sri Lanka','LK','LKA',NULL,'144','sri-lanka'),
	('Sudan','SD','SDN',NULL,'729','sudan'),
	('Suriname','SR','SUR',NULL,'740','suriname'),
	('Svalbard and Jan Mayen Islands','SJ','SJM',NULL,'744','svalbard-and-jan-mayen-islands'),
	('Swaziland','SZ','SWZ',NULL,'748','swaziland'),
	('Sweden','SE','SWE',NULL,'752','sweden'),
	('Switzerland','CH','CHE',NULL,'756','switzerland'),
	('Syrian Arab Republic','SY','SYR',NULL,'760','syrian-arab-republic'),
	('Tajikistan','TJ','TJK',NULL,'762','tajikistan'),
	('Tanzania','TZ','TZA',NULL,'834','tanzania'),
	('Thailand','TH','THA',NULL,'764','thailand'),
	('Timor-Leste','TP','TLS',NULL,'626','timor-leste'),
	('Togo','TG','TGO',NULL,'768','togo'),
	('Tokelau','TK','TKL',NULL,'772','tokelau'),
	('Tonga','TO','TON',NULL,'776','tonga'),
	('Trinidad and Tobago','TT','TTO',NULL,'780','trinidad-and-tobago'),
	('Tunisia','TN','TUN',NULL,'788','tunisia'),
	('Turkey','TR','TUR',NULL,'792','turkey'),
	('Turkmenistan','TM','TKM',NULL,'795','turkmenistan'),
	('Turks and Caicos Islands','TC','TCA',NULL,'796','turks-and-caicos-islands'),
	('Tuvalu','TV','TUV',NULL,'798','tuvalu'),
	('U.S. Virgin Islands','VI','VIR',NULL,'850','us-virgin-islands'),
	('Uganda','UG','UGA',NULL,'800','uganda'),
	('Ukraine','UA','UKR',NULL,'804','ukraine'),
	('United Arab Emirates','AE','ARE',NULL,'784','united-arab-emirates'),
	('United Kingdom','UK','GBR',NULL,'826','united-kingdom'),
	('United States','US','USA',NULL,'840','united-states'),
	('Uruguay','UY','URY',NULL,'858','uruguay'),
	('Uzbekistan','UZ','UZB',NULL,'860','uzbekistan'),
	('Vanuatu','VU','VUT',NULL,'548','vanuatu'),
	('Venezuela','VE','VEN',NULL,'862','venezuela'),
	('Viet Nam','VN','VNM',NULL,'704','viet-nam'),
	('Wallis and Futuna Islands','WF','WLF',NULL,'876','wallis-and-futuna-islands'),
	('Western Sahara','EH','ESH',NULL,'732','western-sahara'),
	('Yemen','YE','YEM',NULL,'887','yemen'),
	('Zambia','ZM','ZMB',NULL,'894','zambia'),
	('Zimbabwe','ZW','ZWE',NULL,'716','zimbabwe');

/*!40000 ALTER TABLE `geo_countries` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `groups`;

CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;

INSERT INTO `groups` (`id`, `name`, `description`)
VALUES
	(1,'admin','Administrator'),
	(4,'Admin Empresa','Admin Empresa');

/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla login_attempts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `login_attempts`;

CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;



# Volcado de tabla macategorias
# ------------------------------------------------------------

DROP TABLE IF EXISTS `macategorias`;

CREATE TABLE `macategorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL COMMENT 'Nombre de la categoría, sirve para publicación de contenidos',
  `tipo_muestra` smallint(3) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `macategorias` WRITE;
/*!40000 ALTER TABLE `macategorias` DISABLE KEYS */;

INSERT INTO `macategorias` (`id`, `nombre`, `tipo_muestra`)
VALUES
	(1,'Blog',1);

/*!40000 ALTER TABLE `macategorias` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla maestros
# ------------------------------------------------------------

DROP TABLE IF EXISTS `maestros`;

CREATE TABLE `maestros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(120) NOT NULL,
  `estado` smallint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `idx_estado` (`estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

LOCK TABLES `maestros` WRITE;
/*!40000 ALTER TABLE `maestros` DISABLE KEYS */;

INSERT INTO `maestros` (`id`, `nombre`, `estado`)
VALUES
	(1,'Todos',0);

/*!40000 ALTER TABLE `maestros` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla provincias
# ------------------------------------------------------------

DROP TABLE IF EXISTS `provincias`;

CREATE TABLE `provincias` (
  `provincia_id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia_nombre` varchar(64) NOT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`provincia_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

LOCK TABLES `provincias` WRITE;
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;

INSERT INTO `provincias` (`provincia_id`, `provincia_nombre`, `region_id`)
VALUES
	(1,'Arica',1),
	(2,'Parinacota',1),
	(3,'Iquique',2),
	(4,'El Tamarugal',2),
	(5,'Antofagasta',3),
	(6,'El Loa',3),
	(7,'Tocopilla',3),
	(8,'Chañaral',4),
	(9,'Copiapó',4),
	(10,'Huasco',4),
	(11,'Choapa',5),
	(12,'Elqui',5),
	(13,'Limarí',5),
	(14,'Isla de Pascua',6),
	(15,'Los Andes',6),
	(16,'Petorca',6),
	(17,'Quillota',6),
	(18,'San Antonio',6),
	(19,'San Felipe de Aconcagua',6),
	(20,'Valparaiso',6),
	(21,'Chacabuco',7),
	(22,'Cordillera',7),
	(23,'Maipo',7),
	(24,'Melipilla',7),
	(25,'Santiago',7),
	(26,'Talagante',7),
	(27,'Cachapoal',8),
	(28,'Cardenal Caro',8),
	(29,'Colchagua',8),
	(30,'Cauquenes',9),
	(31,'Curicó',9),
	(32,'Linares',9),
	(33,'Talca',9),
	(34,'Arauco',10),
	(35,'Bio Bío',10),
	(36,'Concepción',10),
	(37,'Ñuble',10),
	(38,'Cautín',11),
	(39,'Malleco',11),
	(40,'Valdivia',12),
	(41,'Ranco',12),
	(42,'Chiloé',13),
	(43,'Llanquihue',13),
	(44,'Osorno',13),
	(45,'Palena',13),
	(46,'Aisén',14),
	(47,'Capitán Prat',14),
	(48,'Coihaique',14),
	(49,'General Carrera',14),
	(50,'Antártica Chilena',15),
	(51,'Magallanes',15),
	(52,'Tierra del Fuego',15),
	(53,'Última Esperanza',15);

/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla regiones
# ------------------------------------------------------------

DROP TABLE IF EXISTS `regiones`;

CREATE TABLE `regiones` (
  `region_id` int(11) NOT NULL AUTO_INCREMENT,
  `region_nombre` varchar(64) NOT NULL,
  `region_ordinal` varchar(4) NOT NULL,
  PRIMARY KEY (`region_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

LOCK TABLES `regiones` WRITE;
/*!40000 ALTER TABLE `regiones` DISABLE KEYS */;

INSERT INTO `regiones` (`region_id`, `region_nombre`, `region_ordinal`)
VALUES
	(1,'Arica y Parinacota','XV'),
	(2,'Tarapacá','I'),
	(3,'Antofagasta','II'),
	(4,'Atacama','III'),
	(5,'Coquimbo','IV'),
	(6,'Valparaiso','V'),
	(7,'Metropolitana de Santiago','RM'),
	(8,'Libertador General Bernardo O\'Higgins','VI'),
	(9,'Maule','VII'),
	(10,'Biobío','VIII'),
	(11,'La Araucanía','IX'),
	(12,'Los Ríos','XIV'),
	(13,'Los Lagos','X'),
	(14,'Aisén del General Carlos Ibáñez del Campo','XI'),
	(15,'Magallanes y de la Antártica Chilena','XII');

/*!40000 ALTER TABLE `regiones` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` int(10) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `rut` varchar(12) NOT NULL,
  `direccion` longtext DEFAULT NULL,
  PRIMARY KEY (`id`,`rut`),
  KEY `rut_idx` (`rut`,`first_name`,`last_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `rut`, `direccion`)
VALUES
	(1,'127.0.0.1','administrator','$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36','','admin@admin.com','','hueVxkTAJkT2mrBd6rclue9a9716fd942064c452',1676821471,'j51640.chl6K2vkj0NF1De',1268889823,1690809915,1,'Admin','istrator',1,'0','1-1',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla users_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users_groups`;

CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`)
VALUES
	(1,1,1);

/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
