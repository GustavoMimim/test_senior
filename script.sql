-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.17-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para teste
CREATE DATABASE IF NOT EXISTS `teste` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `teste`;

-- Copiando estrutura para tabela teste.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `active` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela teste.products: ~18 rows (aproximadamente)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `description`, `price`, `active`) VALUES
	(19, 'Teclado', 50.00, 1),
	(20, 'Monitor', 100.00, 1),
	(21, 'Mouse', 19.99, 1),
	(22, 'Fone de ouvido', 60.95, 0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Copiando estrutura para tabela teste.sales
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `confirm` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela teste.sales: ~9 rows (aproximadamente)
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` (`id`, `confirm`, `created_at`, `updated_at`) VALUES
	(38, 0, '2020-12-14 13:04:21', '2020-12-14 13:04:39'),
	(39, 1, '2020-12-14 13:04:51', '2020-12-14 13:05:00');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;

-- Copiando estrutura para tabela teste.sale_items
CREATE TABLE IF NOT EXISTS `sale_items` (
  `id_sale` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `quantity` decimal(12,4) DEFAULT NULL,
  KEY `FK_item_sales_products` (`id_product`),
  KEY `FK_item_sales_sales` (`id_sale`),
  CONSTRAINT `FK_item_sales_products` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_item_sales_sales` FOREIGN KEY (`id_sale`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela teste.sale_items: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `sale_items` DISABLE KEYS */;
INSERT INTO `sale_items` (`id_sale`, `id_product`, `price`, `quantity`) VALUES
	(38, 20, 100.00, 2.0000),
	(39, 21, 19.99, 1.0000);
/*!40000 ALTER TABLE `sale_items` ENABLE KEYS */;

-- Copiando estrutura para tabela teste.type_users
CREATE TABLE IF NOT EXISTS `type_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela teste.type_users: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `type_users` DISABLE KEYS */;
INSERT INTO `type_users` (`id`, `description`) VALUES
	(1, 'Administrador'),
	(2, 'Vendedor');
/*!40000 ALTER TABLE `type_users` ENABLE KEYS */;

-- Copiando estrutura para tabela teste.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `id_type_user` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `FK_users_type_users` (`id_type_user`),
  CONSTRAINT `FK_users_type_users` FOREIGN KEY (`id_type_user`) REFERENCES `type_users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela teste.users: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `id_type_user`) VALUES
	(1, 'gustavo', '123456789', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
