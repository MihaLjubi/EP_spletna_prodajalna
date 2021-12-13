-- shema spletnaProdajalna
DROP DATABASE IF EXISTS spletna_prodajalna;
CREATE DATABASE spletna_prodajalna;
USE spletna_prodajalna;

-- table Artikel
DROP TABLE IF EXISTS `artikel`;
CREATE TABLE `artikel` (
  `id_artikel` int(11) NOT NULL AUTO_INCREMENT,
  `ime` text,
  `cena` double NOT NULL,
  `izbrisan` int, 
  PRIMARY KEY (`id_artikel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- tabela Prodajalec
DROP TABLE IF EXISTS `prodajalec`;
CREATE TABLE `prodajalec` (
  `id_prodajalec` int(11) NOT NULL AUTO_INCREMENT,
  `ime` text NOT NULL,
  `priimek` text NOT NULL,
  `email` text NOT NULL,
  `geslo` text NOT NULL,
  PRIMARY KEY (`id_prodajalec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- tabela Prodajalec
DROP TABLE IF EXISTS `stranka`;
CREATE TABLE `stranka` (
  `id_stranka` int(11) NOT NULL AUTO_INCREMENT,
  `ime` text NOT NULL,
  `priimek` text NOT NULL,
  `ulica` text NOT NULL,
  `hisna_stevilka` int NOT NULL,
  `postna_stevilka` int NOT NULL,
  `posta` text NOT NULL,
  `email` text NOT NULL,
  `geslo` text NOT NULL,
  PRIMARY KEY (`id_stranka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO artikel VALUES (1, "kruh", 0.95, 0);
INSERT INTO artikel VALUES (2, "voda", 0.33, 0);
INSERT INTO artikel VALUES (3, "burek", 2.40, 0);

INSERT INTO prodajalec VALUES (1, "Janez", "Novak", "janez.novak@gmail.com", "geslo1");

INSERT INTO stranka VALUES (1, "Bojan", "Breg", "dol", 11, 1000, "Ljubljana", "BB@gmail.com", "geslo321");