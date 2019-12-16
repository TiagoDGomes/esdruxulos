-- MySQL dump 10.13  Distrib 5.1.37, for Win32 (ia32)
--
-- Host: localhost    Database: esdruxulos
-- ------------------------------------------------------
-- Server version	5.1.37

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anunciante`
--

DROP TABLE IF EXISTS `anunciante`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anunciante` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `razaoSocial` varchar(30) DEFAULT NULL,
  `endereco` varchar(60) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `telefone` varchar(26) DEFAULT NULL,
  `website` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anunciante`
--

LOCK TABLES `anunciante` WRITE;
/*!40000 ALTER TABLE `anunciante` DISABLE KEYS */;
INSERT INTO `anunciante` VALUES (1,'Lalalalala','','lalal@lalala.com','5454151521','http://www.google.com');
/*!40000 ALTER TABLE `anunciante` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentario`
--

DROP TABLE IF EXISTS `comentario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idUsuario` bigint(20) DEFAULT NULL,
  `idHistoria` bigint(20) DEFAULT NULL,
  `conteudo` varchar(600) DEFAULT NULL,
  `dataPost` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `nota` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
INSERT INTO `comentario` VALUES (1,5,1,'muito legal!!','2010-07-16 21:46:02',5);
/*!40000 ALTER TABLE `comentario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado`
--

DROP TABLE IF EXISTS `estado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` char(2) DEFAULT NULL,
  `nome` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado`
--

LOCK TABLES `estado` WRITE;
/*!40000 ALTER TABLE `estado` DISABLE KEYS */;
INSERT INTO `estado` VALUES (1,'ZZ','Desconhecido'),(2,'AC','Acre'),(3,'AL','Alagoas'),(4,'AP','AmapÃ¡'),(5,'AM','Amazonas'),(6,'BA','Bahia'),(7,'CE','CearÃ¡'),(8,'ES','EspÃ­rito Santo'),(9,'GO','GoiÃ¡s'),(10,'MA','MaranhÃ£o'),(11,'MT','Mato Grosso'),(12,'MS','Mato Grosso do Sul'),(13,'MG','Minas Gerais'),(14,'PA','ParÃ¡'),(15,'PB','ParaÃ­ba'),(16,'PR','ParanÃ¡'),(17,'PE','Pernambuco'),(18,'PI','PiauÃ­'),(19,'RJ','Rio de Janeiro'),(20,'RN','Rio Grande do Norte'),(21,'RS','Rio Grande do Sul'),(22,'RO','RondÃ´nia'),(23,'RR','Roraima'),(24,'SC','Santa Catarina'),(25,'SP','SÃ£o Paulo'),(26,'SE','Sergipe'),(27,'TO','Tocantins'),(28,'DF','Distrito Federal');
/*!40000 ALTER TABLE `estado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formato`
--

DROP TABLE IF EXISTS `formato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `formato` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(15) DEFAULT NULL,
  `layout` varchar(450) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formato`
--

LOCK TABLES `formato` WRITE;
/*!40000 ALTER TABLE `formato` DISABLE KEYS */;
INSERT INTO `formato` VALUES (1,'Quadrinho',NULL),(2,'Tira',NULL);
/*!40000 ALTER TABLE `formato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historiahumor`
--

DROP TABLE IF EXISTS `historiahumor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historiahumor` (
  `idHistoria` bigint(20) NOT NULL DEFAULT '0',
  `idHumor` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idHistoria`,`idHumor`),
  KEY `idHumor` (`idHumor`),
  CONSTRAINT `historiahumor_ibfk_1` FOREIGN KEY (`idHistoria`) REFERENCES `quadrinho` (`id`),
  CONSTRAINT `historiahumor_ibfk_2` FOREIGN KEY (`idHumor`) REFERENCES `humor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historiahumor`
--

LOCK TABLES `historiahumor` WRITE;
/*!40000 ALTER TABLE `historiahumor` DISABLE KEYS */;
INSERT INTO `historiahumor` VALUES (2,1),(1,3),(1,4);
/*!40000 ALTER TABLE `historiahumor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historiapersonagem`
--

DROP TABLE IF EXISTS `historiapersonagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historiapersonagem` (
  `idHistoria` bigint(20) NOT NULL DEFAULT '0',
  `idPersonagem` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idHistoria`,`idPersonagem`),
  KEY `idPersonagem` (`idPersonagem`),
  CONSTRAINT `historiapersonagem_ibfk_1` FOREIGN KEY (`idHistoria`) REFERENCES `quadrinho` (`id`),
  CONSTRAINT `historiapersonagem_ibfk_2` FOREIGN KEY (`idPersonagem`) REFERENCES `personagem` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historiapersonagem`
--

LOCK TABLES `historiapersonagem` WRITE;
/*!40000 ALTER TABLE `historiapersonagem` DISABLE KEYS */;
INSERT INTO `historiapersonagem` VALUES (1,1),(2,1);
/*!40000 ALTER TABLE `historiapersonagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `humor`
--

DROP TABLE IF EXISTS `humor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `humor` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `descricao` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `humor`
--

LOCK TABLES `humor` WRITE;
/*!40000 ALTER TABLE `humor` DISABLE KEYS */;
INSERT INTO `humor` VALUES (1,'Todos','Caracteriza todos os tipos de humor'),(2,'Inteligente','Caracteriza humor do tipo inteligente'),(3,'Sem-noÃ§Ã£o','Caracteriza humor do tipo sem-noÃ§Ã£o'),(4,'SarcÃ¡stico','Caracteriza humor do tipo sarcÃ¡stico'),(5,'Violento','Caracteriza humor do tipo violento');
/*!40000 ALTER TABLE `humor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `humorpropaganda`
--

DROP TABLE IF EXISTS `humorpropaganda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `humorpropaganda` (
  `idHumor` bigint(20) NOT NULL DEFAULT '0',
  `idPropaganda` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idHumor`,`idPropaganda`),
  KEY `idPropaganda` (`idPropaganda`),
  CONSTRAINT `humorpropaganda_ibfk_1` FOREIGN KEY (`idHumor`) REFERENCES `humor` (`id`),
  CONSTRAINT `humorpropaganda_ibfk_2` FOREIGN KEY (`idPropaganda`) REFERENCES `propaganda` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `humorpropaganda`
--

LOCK TABLES `humorpropaganda` WRITE;
/*!40000 ALTER TABLE `humorpropaganda` DISABLE KEYS */;
/*!40000 ALTER TABLE `humorpropaganda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `opcoessite`
--

DROP TABLE IF EXISTS `opcoessite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `opcoessite` (
  `propriedade` varchar(25) NOT NULL,
  `valor` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`propriedade`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `opcoessite`
--

LOCK TABLES `opcoessite` WRITE;
/*!40000 ALTER TABLE `opcoessite` DISABLE KEYS */;
/*!40000 ALTER TABLE `opcoessite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagina`
--

DROP TABLE IF EXISTS `pagina`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagina` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idHistoria` bigint(20) DEFAULT NULL,
  `indice` int(11) DEFAULT NULL,
  `caminho` varchar(40) DEFAULT NULL,
  `tipo` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idHistoria` (`idHistoria`),
  CONSTRAINT `pagina_ibfk_1` FOREIGN KEY (`idHistoria`) REFERENCES `quadrinho` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagina`
--

LOCK TABLES `pagina` WRITE;
/*!40000 ALTER TABLE `pagina` DISABLE KEYS */;
INSERT INTO `pagina` VALUES (1,1,0,'84179baa1526d9b9439ee06d22a4b0b2.PNG','image/png'),(2,1,1,'1ecd85b4da969a80e33be9c283eb6f66.png','image/png'),(3,1,2,'1cf852704d1571dc6a45542386dc5776.gif','image/gif'),(4,1,3,'9d9ae0a2fb1a8167291b34323b7f30f4.gif','image/gif'),(5,1,4,'be9a827f0387191d35427280cb9d3087.gif','image/gif'),(6,1,5,'8f43c412719e2fe5380701613c6e5fc0.gif','image/gif'),(7,1,6,'1f9b07a6905e5f8fc1f5ad73d9e32c9c.gif','image/gif'),(8,1,7,'865a5fcedaee30a0dd93c4476afd6abd.gif','image/gif'),(9,1,8,'3b56fa77188c7f9a0330194bcd10cfac.gif','image/gif'),(10,1,9,'d2a2c2f87b6ea617f9def3f7024623b1.gif','image/gif'),(11,1,10,'6b21f39f382b2e8d261cacacfaea8e04.gif','image/gif'),(12,2,0,'5dd449423b7838415bd4380395be381b.png','image/png');
/*!40000 ALTER TABLE `pagina` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personagem`
--

DROP TABLE IF EXISTS `personagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personagem` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) DEFAULT NULL,
  `descricao` varchar(600) DEFAULT NULL,
  `imagem` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personagem`
--

LOCK TABLES `personagem` WRITE;
/*!40000 ALTER TABLE `personagem` DISABLE KEYS */;
INSERT INTO `personagem` VALUES (1,'National Kid','Super herÃ³i japonÃªs revivido dos anos 60, quando os avÃ³s dos esdrÃºxulos ainda nem sabiam quem era o Jaspion, National Kid jÃ¡ fazia a cabeÃ§a da mulherada com seus super poderes e  suas tÃ©cnicas de batalha extremamente inusitadas. Hoje, National ajuda a por ordem ou tentar nas histÃ³rinhas da turma.','276c9a5d95df4e693acf6090c0c6e372.png');
/*!40000 ALTER TABLE `personagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `propaganda`
--

DROP TABLE IF EXISTS `propaganda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `propaganda` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(40) DEFAULT NULL,
  `conteudo` varchar(1024) DEFAULT NULL,
  `preco` float DEFAULT NULL,
  `idAnunciante` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idAnunciante` (`idAnunciante`),
  CONSTRAINT `propaganda_ibfk_1` FOREIGN KEY (`idAnunciante`) REFERENCES `anunciante` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propaganda`
--

LOCK TABLES `propaganda` WRITE;
/*!40000 ALTER TABLE `propaganda` DISABLE KEYS */;
/*!40000 ALTER TABLE `propaganda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quadrinho`
--

DROP TABLE IF EXISTS `quadrinho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quadrinho` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) DEFAULT NULL,
  `descricao` varchar(600) DEFAULT NULL,
  `idFormato` int(11) DEFAULT '1',
  `dataInsercao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idFormato` (`idFormato`),
  CONSTRAINT `quadrinho_ibfk_1` FOREIGN KEY (`idFormato`) REFERENCES `formato` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quadrinho`
--

LOCK TABLES `quadrinho` WRITE;
/*!40000 ALTER TABLE `quadrinho` DISABLE KEYS */;
INSERT INTO `quadrinho` VALUES (1,'Deu B.O.D.E.','Quem nÃ£o curte um bom mangÃ¡? Que tal ainda um mangÃ¡ estilo cartunizado a la EsdrÃºxulos?!\r\nOs ninjas recÃ©m-formados no Ensino MÃ©dio de uma escola pÃºblica saem para sua primeira missÃ£o. PorÃ©m nÃ£o contavam que um inimigo antigo viesse causar problemas...',1,'2010-06-24 19:56:36'),(2,'[nome da tira]','descricao simples',2,'2010-07-21 20:51:43');
/*!40000 ALTER TABLE `quadrinho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setorprofissional`
--

DROP TABLE IF EXISTS `setorprofissional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setorprofissional` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setorprofissional`
--

LOCK TABLES `setorprofissional` WRITE;
/*!40000 ALTER TABLE `setorprofissional` DISABLE KEYS */;
INSERT INTO `setorprofissional` VALUES (1,'Desconhecido'),(2,'Estudante');
/*!40000 ALTER TABLE `setorprofissional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `endereco` varchar(65) DEFAULT NULL,
  `bairro` varchar(25) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `idEstado` int(11) DEFAULT NULL,
  `telefone` varchar(26) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `dataNascimento` date DEFAULT NULL,
  `cookie` varchar(32) DEFAULT NULL,
  `login` varchar(15) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `sexo` char(1) DEFAULT NULL,
  `idSetorProfissional` bigint(20) DEFAULT NULL,
  `ultimoIP` varchar(32) DEFAULT NULL,
  `ultimoAcesso` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `numeroDeVisitas` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cookie` (`cookie`),
  UNIQUE KEY `login` (`login`),
  KEY `idEstado` (`idEstado`),
  KEY `idSetorProfissional` (`idSetorProfissional`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`id`),
  CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idSetorProfissional`) REFERENCES `setorprofissional` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'','','','',1,'','','0000-00-00','62baf7629ffcc5b9f5a2aaa74da584e4','c4ca4238a0b9238','','','',1,'127.0.0.1','2010-06-24 21:23:30',512),(2,'','','','',1,'','','0000-00-00','cf091b3534ca65188b5785c193ca3a6a','c81e728d9d4c2f6','','','',1,'127.0.0.1','2010-06-24 21:22:30',45),(3,'','','','',1,'','','0000-00-00','370fb2b33d19284eabdf0e7358298804','eccbc87e4b5ce2f','','','',1,'127.0.0.1','2010-07-23 18:24:24',21),(4,'','','','',1,'','','0000-00-00','2d579dc29360d8bbfbb4aa541de5afa9','a87ff679a2f3e71','','','',1,'127.0.0.1','2010-07-23 22:22:01',14),(5,'Tiago Donizetti Gomes','Rua Adolpho Corradello, 204','Jardim Sao Salvador','SÃ£o JoÃ£o da Boa Vista',25,'93149793','','1984-03-10','0f9d99f598cb439e8e733a3c7bb9892c','tiagodg','7f975a56c761db6506eca0b37ce6ec87','tiagodgomes@ymail.com','M',1,'127.0.0.1','2010-07-23 18:24:38',241),(6,'','','','',1,'','','0000-00-00','','','','','',1,'127.0.0.1','2010-08-05 21:16:57',41),(7,'','','','',1,'','','0000-00-00','95c7dfc5538e1ce71301cf92a9a96bd0','8f14e45fceea167','','','',1,'127.0.0.1','2012-11-10 18:03:00',17);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuariohumor`
--

DROP TABLE IF EXISTS `usuariohumor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuariohumor` (
  `idUsuario` bigint(20) NOT NULL DEFAULT '0',
  `idHumor` bigint(20) NOT NULL DEFAULT '0',
  `numeroDeVisitas` int(11) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`,`idHumor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuariohumor`
--

LOCK TABLES `usuariohumor` WRITE;
/*!40000 ALTER TABLE `usuariohumor` DISABLE KEYS */;
INSERT INTO `usuariohumor` VALUES (1,3,14),(1,4,14),(2,3,5),(2,4,5),(3,1,1),(3,3,1),(3,4,1),(4,1,1),(4,3,2),(4,4,2),(5,1,4),(5,3,30),(5,4,30),(6,1,4),(6,3,14),(6,4,14);
/*!40000 ALTER TABLE `usuariohumor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-11-10 16:07:44
