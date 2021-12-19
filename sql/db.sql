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
  `izbrisan` text, 
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
  `izbrisan` text,
  PRIMARY KEY (`id_prodajalec`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- tabela Stranka
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
  `izbrisan` text,
  PRIMARY KEY (`id_stranka`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- table Narocilo
DROP TABLE IF EXISTS `narocilo`;
CREATE TABLE `narocilo` (
  `id_narocilo` int(11) NOT NULL AUTO_INCREMENT,
  `cena` double,
  `status` text,
  PRIMARY KEY (`id_narocilo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*
-- table Vozicek
DROP TABLE IF EXISTS `vozicek`;
CREATE TABLE `vozicek` (
  `id_narocilo` int NOT NULL,
  `id_artikel` int NOT NULL,
  `kolicina` int,
  PRIMARY KEY (`id_narocilo`, `id_artikel`),
  FOREIGN KEY (`id_narocilo`) REFERENCES narocilo(`id_narocilo`),
  FOREIGN KEY (`id_artikel`) REFERENCES artikel(`id_artikel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

INSERT INTO artikel VALUES (1, "kruh", 0.95, "ne");
INSERT INTO artikel VALUES (2, "voda", 0.33, "ne");
INSERT INTO artikel VALUES (3, "burek", 2.40, "ne");

INSERT INTO prodajalec VALUES (999, "Admin", "", "admin@admin", "$2y$10$j0/k1IJ.9rQkyPMiO///pOk1.ts7rXjhjgbAeXnoBANC/V60kszlG", "ne");
INSERT INTO prodajalec VALUES (1, "Janez", "Novak", "janez.novak@gmail.com", "$2y$10$co3uQbO4Fy2By9kXJ58HguDQI9ZPuN2qaj7V5M2Bi0ZQlx6fZrqnK", "ne");

INSERT INTO stranka VALUES (1, "Bojan", "Breg", "dol", 11, 1000, "Ljubljana", "BB@gmail.com", "$2y$10$wZPtsVvUoWHRPsS35jOw5.riBZqXgzReKlP07w57OW6jqZNHWGOvm", "ne");

INSERT INTO narocilo VALUES (1, 15.32, "potrjeno");
INSERT INTO narocilo VALUES (2, 9.78, "neobdelano");

/*
INSERT INTO vozicek VALUES (1, 1, 2);
INSERT INTO vozicek VALUES (1, 2, 1);
INSERT INTO vozicek VALUES (1, 3, 3);
INSERT INTO vozicek VALUES (2, 2, 1);
INSERT INTO vozicek VALUES (2, 3, 2);
*/