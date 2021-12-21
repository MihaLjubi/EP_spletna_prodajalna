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
  `opis` text,
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

INSERT INTO artikel VALUES (1, "Specialized Gorsko kolo", 1450, "Žensko gorsko kolo Specialized Rockhopper Expert 29 opišejo pridevniki vzdržljiv, lahek in izredno zmogljiv.  Z novim Rockhopperjem Expertom so pri Specializedu zopet premaknili meje. Resnična XC zverina za premagovanje trailov, katere nakup ne pomeni nujno konkretnega manjka na tvojem tekočem računu. RH Expert je rezultat 30 letnega razmerja med ceno in zmogljivostmi. Premium A1 aluminijastem okvirju z moderno geometrijo je bila posvečena izjemna pozornost in tako tvori trdo osnovo za najboljšega RH dosedaj. Če temu dodaš še seznam odličnih komponent, dobiš kolo, ki je pripravljeno poleteti!.", "ne");
INSERT INTO artikel VALUES (2, "FISCHER F18 smuči", 414.5, "Smuči se ponašajo s sistemom Dual Radius System – prvi del smuči ima polmer kroga (manjši radij), slalomski lok, ki omogoča enostaven in hiter vstop v ovinek, medtem ko ima drugi del smuči polmer elipse ( večji radij), veleslalomski lok, ki zagotavlja odlično stabilnost pri velikih hitrostih in daljših zavojih.", "ne");
INSERT INTO artikel VALUES (3, "Babolat Pure Aero", 174.95, "Opremljen je z Novim Cortex Pure Feel sistemom, ki odlično duši vibracije, obenem pa omogoča tudi neverjeten zvok in še izboljšan občutek pri udarcu. Rezultat nove generacije kvalitetnih karbonskih vlaken, vgrajenih v strukturo loparja (CARBON PLY STABILIZER), je izboljšana stabilnost in veliko večja kontrola kot pri prejšnjem modelu.", "ne");

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