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
  PRIMARY KEY (`id_artikel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- tabela Prodajalec
DROP TABLE IF EXISTS `prodajalec`;
CREATE TABLE `prodajalec` (
  `id_prodajalec` int(11) NOT NULL AUTO_INCREMENT,
  `ime` text,
  `priimek` text,
  `email` text,
  `geslo` text,
  PRIMARY KEY (`id_prodajalec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- tabela Prodajalec
DROP TABLE IF EXISTS `stranka`;
CREATE TABLE `stranka` (
  `id_stranka` int(11) NOT NULL AUTO_INCREMENT,
  `ime` text,
  `priimek` text,
  `ulica` text,
  `hisna_stevilka` int,
  `postna_stevilka` int,
  `posta` text,
  `email` text,
  `geslo` text,
  PRIMARY KEY (`id_stranka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO artikel VALUES (1, "kruh", 0.95);
INSERT INTO artikel VALUES (2, "voda", 0.33);
INSERT INTO artikel VALUES (3, "burek", 2.40);

INSERT INTO prodajalec VALUES (1, "Janez", "Novak", "janez.novak@gmail.com", "geslo1");

INSERT INTO stranka VALUES (1, "Bojan", "Breg", "dol", 11, 1000, "Ljubljana", "BB@gmail.com", "geslo321");