-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2014 a las 06:39:47
-- Versión del servidor: 5.5.32
-- Versión de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `turismo`
--
CREATE DATABASE IF NOT EXISTS `turismo` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `turismo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) DEFAULT NULL,
  `descripcion` text,
  `img1` varchar(200) DEFAULT NULL,
  `img2` varchar(200) DEFAULT NULL,
  `sitios_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_actividades_sitios_idx` (`sitios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitios`
--

CREATE TABLE IF NOT EXISTS `sitios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(70) DEFAULT NULL,
  `descripcion` text,
  `temperatura` varchar(40) DEFAULT NULL,
  `historia` text,
  `ubicacion` varchar(70) DEFAULT NULL,
  `contacto` text,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `img_min` varchar(200) DEFAULT NULL,
  `img1` varchar(200) DEFAULT NULL,
  `img2` varchar(200) DEFAULT NULL,
  `img3` varchar(200) DEFAULT NULL,
  `img4` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `sitios`
--

INSERT INTO `sitios` (`id`, `nombre`, `descripcion`, `temperatura`, `historia`, `ubicacion`, `contacto`, `lat`, `lng`, `img_min`, `img1`, `img2`, `img3`, `img4`) VALUES
(1, 'Primer sitio', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit, ipsum enim illo expedita optio commodi eaque ab quas animi non eum exercitationem deleniti quo distinctio asperiores tempore magni impedit nobis.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Velit, impedit voluptates alias quam eveniet. Id, velit, ab, fugiat quod neque odit minima voluptates similique odio ex rerum cupiditate sequi veniam.', '20', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit, ipsum enim illo expedita optio commodi eaque ab quas animi non eum exercitationem deleniti quo distinctio asperiores tempore magni impedit nobis.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Velit, impedit voluptates alias quam eveniet. Id, velit, ab, fugiat quod neque odit minima voluptates similique odio ex rerum cupiditate sequi veniam.', 'Nariño', 'esteEsUnCorreo@contacto.com', 1111.000000, 3333.000000, '1_min.jpg', NULL, NULL, NULL, NULL),
(2, 'Santuario de Las Lajas', 'La edificación actual, construida al principio del siglo XX, sustituyó una capilla que databa del Siglo XVIII y es una iglesia de piedra gris y blanca de estilo Neogótico, a imitación del Gótico del siglo XIV, compuesta de tres naves construidas sobre un puente de dos arcos que cruza sobre el río y que hace de atrio o plaza de la basílica uniéndola con el otro lado del cañón.\r\n\r\nLa altura del templo, desde su base hasta la torre es de 100 metros, y el puente mide 50 metros de alto por 17 metros de ancho y 20 metros de largo.', '30', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit, ipsum enim illo expedita optio commodi eaque ab quas animi non eum exercitationem deleniti quo distinctio asperiores tempore magni impedit nobis.\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Velit, impedit voluptates alias quam eveniet. Id, velit, ab, fugiat quod neque odit minima voluptates similique odio ex rerum cupiditate sequi veniam.', 'Nariño', 'esteEsUnCorreo@contacto.com', 1111.000000, 3333.000000, '2_min.jpg', '', '', '', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `fk_actividades_sitios` FOREIGN KEY (`sitios_id`) REFERENCES `sitios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
