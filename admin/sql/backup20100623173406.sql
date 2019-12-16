-- MySQL dump 10.13  Distrib 5.1.37, for Win32 (ia32)
--
-- Host: localhost    Database: esdruxulos
-- ------------------------------------------------------
-- Server version	5.1.34-community

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
INSERT INTO `anunciante` VALUES (1,'Submarino','','submarino@submarino.com.br','65456456456','http://www.submarino.com.br');
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentario`
--

LOCK TABLES `comentario` WRITE;
/*!40000 ALTER TABLE `comentario` DISABLE KEYS */;
INSERT INTO `comentario` VALUES (1,1,2,'legal','2010-06-21 22:54:33',4),(2,3,2,'muito legal','2010-06-23 20:25:22',5),(3,3,2,'mÃ³ loko','2010-06-23 20:27:26',5),(4,3,2,'mÃ³ loko','2010-06-23 20:28:05',5),(5,3,2,'muito doido','2010-06-23 20:29:54',2),(6,3,2,'muito doido','2010-06-23 20:30:09',2),(7,3,2,'kkkkkkkkkkkkkkkkk','2010-06-23 20:30:35',3);
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
-- Table structure for table `historia`
--

DROP TABLE IF EXISTS `historia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historia` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(60) DEFAULT NULL,
  `descricao` varchar(600) DEFAULT NULL,
  `idFormato` int(11) DEFAULT '1',
  `dataInsercao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idFormato` (`idFormato`),
  CONSTRAINT `historia_ibfk_1` FOREIGN KEY (`idFormato`) REFERENCES `formato` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historia`
--

LOCK TABLES `historia` WRITE;
/*!40000 ALTER TABLE `historia` DISABLE KEYS */;
INSERT INTO `historia` VALUES (1,'Deu B.O.D.E.','Quem nÃ£o curte um bom mangÃ¡? Que tal ainda um mangÃ¡ estilo cartunizado a la EsdrÃºxulos?!\r\nOs ninjas recÃ©m-formados no Ensino MÃ©dio de uma escola pÃºblica saem para sua primeira missÃ£o. PorÃ©m nÃ£o contavam que um inimigo antigo viesse causar problemas...',1,'2010-06-21 22:31:52'),(2,'Haruto','Um rapaz levemente mamado resolve dar problemas para alguns policiais.\r\nPor sorte, um ilustre herÃ³i dos anos 60 aparece para dar uma forcinha com seus super poderes da Ã©poca da TV preta e branca.',1,'2010-06-21 22:34:30'),(3,'CartÃ£o para deputado','Por que sÃ³ deputados podem comprar com dinheiro ilÃ­cito?',2,'2010-06-22 00:15:05');
/*!40000 ALTER TABLE `historia` ENABLE KEYS */;
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
  CONSTRAINT `historiahumor_ibfk_1` FOREIGN KEY (`idHistoria`) REFERENCES `historia` (`id`),
  CONSTRAINT `historiahumor_ibfk_2` FOREIGN KEY (`idHumor`) REFERENCES `humor` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historiahumor`
--

LOCK TABLES `historiahumor` WRITE;
/*!40000 ALTER TABLE `historiahumor` DISABLE KEYS */;
INSERT INTO `historiahumor` VALUES (1,2),(2,3),(3,4);
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
  CONSTRAINT `historiapersonagem_ibfk_1` FOREIGN KEY (`idHistoria`) REFERENCES `historia` (`id`),
  CONSTRAINT `historiapersonagem_ibfk_2` FOREIGN KEY (`idPersonagem`) REFERENCES `personagem` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historiapersonagem`
--

LOCK TABLES `historiapersonagem` WRITE;
/*!40000 ALTER TABLE `historiapersonagem` DISABLE KEYS */;
INSERT INTO `historiapersonagem` VALUES (1,2),(2,5),(3,5);
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
INSERT INTO `humorpropaganda` VALUES (2,1),(3,3);
/*!40000 ALTER TABLE `humorpropaganda` ENABLE KEYS */;
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
  CONSTRAINT `pagina_ibfk_1` FOREIGN KEY (`idHistoria`) REFERENCES `historia` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagina`
--

LOCK TABLES `pagina` WRITE;
/*!40000 ALTER TABLE `pagina` DISABLE KEYS */;
INSERT INTO `pagina` VALUES (1,1,0,'84179baa1526d9b9439ee06d22a4b0b2.PNG','image/x-png'),(2,1,1,'1ecd85b4da969a80e33be9c283eb6f66.png','image/x-png'),(3,1,2,'1cf852704d1571dc6a45542386dc5776.gif','image/gif'),(4,1,3,'1cf852704d1571dc6a45542386dc5776.gif','image/gif'),(5,1,4,'be9a827f0387191d35427280cb9d3087.gif','image/gif'),(6,1,5,'8f43c412719e2fe5380701613c6e5fc0.gif','image/gif'),(7,1,6,'1f9b07a6905e5f8fc1f5ad73d9e32c9c.gif','image/gif'),(8,1,7,'865a5fcedaee30a0dd93c4476afd6abd.gif','image/gif'),(9,1,8,'3b56fa77188c7f9a0330194bcd10cfac.gif','image/gif'),(10,1,9,'d2a2c2f87b6ea617f9def3f7024623b1.gif','image/gif'),(11,1,10,'6b21f39f382b2e8d261cacacfaea8e04.gif','image/gif'),(12,2,0,'f3712be4654fd4ad0515f5bdf5172c80.PNG','image/x-png'),(13,2,1,'429169bf86815511347df19aff9dc662.png','image/x-png'),(14,2,2,'8126373b416298a8cc35455b83e6212f.gif','image/gif'),(15,2,3,'c20fab4b4b871067d38e75b54fdb47d3.gif','image/gif'),(16,2,4,'cba7e66053ff60bc3926f08c3008be3c.gif','image/gif'),(17,2,5,'2eb4dd57f22ce361c990c0416befee9d.gif','image/gif'),(18,2,6,'925696b4dd6c1ac749749d44a9bfdb4d.gif','image/gif'),(19,2,7,'d07678da2b66c6334250b5c5f6469a9e.gif','image/gif'),(20,2,8,'7263f53ecf40e13f5c6678aa83e488a2.gif','image/gif'),(21,2,9,'6237a5cdff6b688331791f1992782dbe.gif','image/gif'),(22,2,10,'a9d6cacec89929d9f24faa3ef8ae3535.png','image/x-png'),(23,2,11,'e8b3aaf4bcf66007c162f2857615cf07.gif','image/gif'),(24,2,12,'dadc3e35623b57894f38042787608f07.gif','image/gif'),(25,2,13,'378284dea4f0e2a024844ac5ce757c5f.gif','image/gif'),(26,2,14,'6bc6e0b9eccd59fdca56a9e2219cad51.gif','image/gif'),(28,3,0,'5dd449423b7838415bd4380395be381b.png','image/x-png');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personagem`
--

LOCK TABLES `personagem` WRITE;
/*!40000 ALTER TABLE `personagem` DISABLE KEYS */;
INSERT INTO `personagem` VALUES (1,'H','H Ã© um personagem que odeia a polÃ­tica nacional. Nem Esquerda, nem Direita, mas sim Centrista. Ele apÃ³ia tanto a liberdade do capitalismo, quanto a nÃ£o exploraÃ§Ã£o do trabalhador segundo os moldes socialistas. Contudo, apesar de ser muito centrado, algumas vezes acaba exagerando em suas atitudes, o que o leva cair em situaÃ§Ãµes esdrÃºxulas.','a30999f912df497ddccf4b3010ab5726.png'),(2,'National Kid','Super herÃ³i japonÃªs revivido dos anos 60, quando os avÃ³s dos esdrÃºxulos ainda nem sabiam quem era o Jaspion, National Kid jÃ¡ fazia a cabeÃ§a da mulherada com seus super poderes e  suas tÃ©cnicas de batalha extremamente inusitadas. Hoje, National ajuda a por ordem ou tentar) nas histÃ³rinhas da turma.','276c9a5d95df4e693acf6090c0c6e372.png'),(5,'Zumbigia','Professora quase aposentada, ZumbÃ­gia Ã© uma tÃ­pica funcionÃ¡ria pÃºblica estressada com seu salÃ¡rio.\r\nPor detestar tanto o seu trabalho, odiar os jovens e viver nervosa com a vida, acaba descontando tudo em seus alunos, que nÃ£o tem nada a ver com o assunto.\r\nIndignados, os EsdrÃºxulos sempre acabam confrontando com essa vilÃ£. ','ccc1185cdef2336a7e8a55d7b873cab4.png');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `propaganda`
--

LOCK TABLES `propaganda` WRITE;
/*!40000 ALTER TABLE `propaganda` DISABLE KEYS */;
INSERT INTO `propaganda` VALUES (1,'Livro Servlet','<div class=\"product\">								 								\r\n  <a href=\"http://www.submarino.com.br/produto/1/21489846/use+a+cabeca%21+servlets+e+jsp?menuId=1060\" class=\"link\">									\r\n    <img class=\"image\" src=\"/propagandas/pq21489846.jpg\" alt=\"Use a CabeÃ§a! Servlets &amp; JSP\">									\r\n    <span class=\"info\">										\r\n      <span class=\"name\">\r\n      <strong>Use a CabeÃ§a! Servlets &amp; JSP - BRYAN BASHAM</strong>										\r\n      </span>									\r\n    </span>								</a>									\r\n  <div class=\"price\">											\r\n    <span class=\"from\">R$ 99,70\r\n    </span>											\r\n    <span class=\"parcel\">ou 3X de R$ 33,23\r\n    </span>											\r\n    <span class=\"condition\">sem juros no cartÃ£o\r\n    </span>									\r\n  </div>																\r\n</div>',0,1),(3,'vademecum','<div class=\"product\">								 								\r\n  <a href=\"http://www.submarino.com.br/produto/1/21784130/vade+mecum+academico+de+direito+rideel?menuId=1060\" class=\"link\">									\r\n    <img class=\"image\" src=\"/propagandas/pq21784130.jpg\" alt=\"Vade Mecum AcadÃªmico de Direito Rideel\">									\r\n    <span class=\"info\">										\r\n      <span class=\"name\">												<strong>Vade Mecum AcadÃªmico de Direito Rideel -  RIDEEL (ED.)</strong>										\r\n      </span>									\r\n    </span>								</a>									\r\n  <div class=\"price\">											\r\n    <span class=\"from\">R$ 39,90\r\n    </span>									\r\n  </div>									\r\n  <span class=\"stamps\">									\r\n  </span>							\r\n</div>',0,1);
/*!40000 ALTER TABLE `propaganda` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'hell','1','fdslkfh','dsdfjoi',7,'413241564','','2009-05-11','443cb001c138b2561a0d90720d6ce111','hell','202cb962ac59075b964b07152d234b70','asdlfjoisdj@ggg','M',1,'10.0.11.19','2010-06-21 23:42:23',96),(2,'','','','',1,'','','0000-00-00','6d2bb9eb2c15945e521e74f65e846d1d','c81e728d9d4c2f6','','','',1,'127.0.0.1','2010-06-22 00:25:19',12),(3,'Tiago','Rua do Sobe e desce','Vila Brasil','SÃ£o JoÃ£o da Boa Vista',25,'56214521','','1984-03-10','8daf77e334fd4230bec1dd51f47c8b77','tiago','202cb962ac59075b964b07152d234b70','meuemail@email.com','M',1,'127.0.0.1','2010-06-23 20:34:36',24);
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
INSERT INTO `usuariohumor` VALUES (1,2,2),(1,3,11),(2,4,1),(2,5,1),(3,2,1),(3,3,6),(3,4,2);
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

-- Dump completed on 2010-06-23 17:34:44
