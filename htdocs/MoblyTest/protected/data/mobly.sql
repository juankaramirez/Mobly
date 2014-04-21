-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.5.32 - MySQL Community Server (GPL)
-- SO del servidor:              Win32
-- HeidiSQL Versión:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para mobly
CREATE DATABASE IF NOT EXISTS `mobly` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci */;
USE `mobly`;


-- Volcando estructura para tabla mobly.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`prod_id`),
  KEY `FK_cart_product` (`prod_id`),
  CONSTRAINT `FK_cart_product` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`),
  CONSTRAINT `FK_cart_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- Volcando datos para la tabla mobly.cart: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;


-- Volcando estructura para tabla mobly.category
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

-- Volcando datos para la tabla mobly.category: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`cat_id`, `name`) VALUES
	(1, 'Automotive'),
	(2, 'Home'),
	(3, 'Electronics');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;


-- Volcando estructura para tabla mobly.category_product
CREATE TABLE IF NOT EXISTS `category_product` (
  `cat_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`,`prod_id`),
  KEY `prod_id` (`prod_id`),
  CONSTRAINT `category_product_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`),
  CONSTRAINT `category_product_ibfk_2` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

-- Volcando datos para la tabla mobly.category_product: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `category_product` DISABLE KEYS */;
INSERT INTO `category_product` (`cat_id`, `prod_id`) VALUES
	(3, 1),
	(3, 2),
	(1, 3),
	(2, 4),
	(1, 5);
/*!40000 ALTER TABLE `category_product` ENABLE KEYS */;


-- Volcando estructura para tabla mobly.order
CREATE TABLE IF NOT EXISTS `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `FK_order_user` (`user_id`),
  CONSTRAINT `FK_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- Volcando datos para la tabla mobly.order: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
INSERT INTO `order` (`order_id`, `user_id`, `date`) VALUES
	(34, 4, '2014-04-21 05:25:46');
/*!40000 ALTER TABLE `order` ENABLE KEYS */;


-- Volcando estructura para tabla mobly.order_product
CREATE TABLE IF NOT EXISTS `order_product` (
  `order_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`order_id`,`prod_id`),
  KEY `FK_order_product_product` (`prod_id`),
  CONSTRAINT `FK_order_product_order` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  CONSTRAINT `FK_order_product_product` FOREIGN KEY (`prod_id`) REFERENCES `product` (`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- Volcando datos para la tabla mobly.order_product: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `order_product` DISABLE KEYS */;
INSERT INTO `order_product` (`order_id`, `prod_id`, `quantity`) VALUES
	(34, 1, 1);
/*!40000 ALTER TABLE `order_product` ENABLE KEYS */;


-- Volcando estructura para tabla mobly.product
CREATE TABLE IF NOT EXISTS `product` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `description` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `image` varchar(100) CHARACTER SET utf8 NOT NULL,
  `price` double NOT NULL,
  `features` varchar(500) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

-- Volcando datos para la tabla mobly.product: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` (`prod_id`, `name`, `description`, `image`, `price`, `features`) VALUES
	(1, 'Samsung Galaxy Note 3', 'This Brand New Samsung Galaxy Note 3 N9000 Black factory Unlocked phone comes in Original box with all Original accessories in the box. This is GSM version of the phone and will NOT work on CDMA networks such as Sprint or Verizon.', 'galaxynote3.jpg', 550, '*CPU: 1.9 GHz Cortex-A15 & quad-core 1.3 GHz Cortex-A7 (3G model) *3G: HSDPA 850 / 900 / 1900 / 2100 *AMOLED Display: 1080 x 1920 pixels, 5.7 inches (~386 ppi pixel density) *Camera: 13 MP, 4128 x 3096 pixels, autofocus, LED flash *Internal Memory: 32GB storage, 3 GB RAM'),
	(2, 'PlayStation 4 Console', 'PlayStation 4 is the best place to play with dynamic, connected gaming, powerful graphics and speed, intelligent personalization, deeply integrated social capabilities, and innovative second-screen features. Combining unparalleled content, immersive gaming experiences, all of your favorite digital entertainment apps, and PlayStation exclusives, PS4 centers on gamers, enabling them to play when, where and how they want. PS4 enables the greatest game developers in the world to unlock their creativity and push the boundaries of play through a system that is tuned specifically to their needs. ', 'ps4.jpg', 399, 'The PlayStation 4 was released on November 15, 2013. PS4 enables the greatest game developers in the world to unlock their creativity and push the boundaries of play through a platform that is tuned specifically to their needs Engage in endless personal challenges between you and your community, and share your epic moments for the world to see Gamers can share their epic triumphs by hitting the "SHARE button" on the controller, scan through the last few minutes of gameplay, tag it and return to '),
	(3, 'Britax 2 Pack EZ-Cling Sun Shades', '*Shades and protects from UV rays and sun glare with easy on and off design.\r\n*Unique cling design with a lightweight, reinforced frame simplifies application and repositioning.\r\n*UPF 30 plus sun protection blocks UV sun rays.\r\n*Mesh screen reduces sun glare and keeps your child cool while maintaining driver visibility.\r\n*19" x 12" size for an optimal fit on most vehicle rear side windows.', 'BritaxSunShades.jpg', 9.99, 'The BRITAX EZ-Cling Window Shades shield children from UV rays, sun glare, and heat while they\'re riding in the rear seat of the car. You can easily attach, reposition, remove and reuse the shades, which have a unique cling design with a lightweight, reinforced frame. The mesh-like fabric offers an ultraviolet protection factor (UPF) of 30+ while still providing visibility for the driver.'),
	(4, 'Pinzon Basics Body Pillow with Cover', '*Full-length body pillow with zip-off cover.\r\n*77.5 ounces of down-alternative hypoallergenic polyester fiber.\r\n*100% cotton, 230-thread-count shell.\r\n*Machine washable.\r\n*Measures 20 by 54 inches.', 'PinzonPillow.jpg', 32.99, 'Curl up in relaxed style with this Basics body pillow from Pinzon. Placed on the bed, the body pillow helps ensure a peaceful night\'s sleep, night after night. It can also be used on the couch when watching tv or lounging with a good book on a Sunday afternoon.'),
	(5, 'Rain-X Weatherbeater Wiper Blade, 16" (Pack of 1)', '*Long lasting durability defined by a galvanized steel frame that prevents rust and corrosion.\r\n*All natural squeegee rubber resists cracking, splitting and tearing caused by heat, cold, windshield wiper fluid and salt.\r\n*Helps prevent and remove sleet, snow, ice, bugs, and road spray from sticking to glass.\r\n*Multiple pressure points to hug the window to provide a smooth and streak free wipe.\r\n*Quick and easy to install.', 'Rain-XWeatherbeater.jpg', 3.55, 'The Rain-X Weatherbeater Wiper Blade provides a smooth, clean, streak-free wipe by using embedded friction reducers and multiple pressure points to hug the windshield.');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;


-- Volcando estructura para tabla mobly.user
CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) COLLATE utf8_estonian_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8_estonian_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `address` varchar(100) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;

-- Volcando datos para la tabla mobly.user: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `lastname`, `email`, `address`) VALUES
	(1, 'Yoda', '123456', 'Minch', 'Yoda', 'jedi@lightside', 'Galactic Republic'),
	(2, 'Anakin', '456789', 'Anakin', 'Skywalker', 'jedi@greyside', 'Galactic Empire'),
	(4, 'juankaramirez', 'j123456', 'Juan', 'Ramirez', 'juan.ramirezpadilla@gmail.com', 'Cartagena, Colombia');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
