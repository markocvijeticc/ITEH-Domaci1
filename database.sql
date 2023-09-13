
CREATE DATABASE `iteh-domaci1` ;

USE `iteh-domaci1`;



DROP TABLE IF EXISTS `ucenik`;

CREATE TABLE `ucenik` (
  `ime` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



insert  into `ucenik`(`ime`,`email`,`username`,`password`) values ('Филип','filip@gmail.com','filip','filip'),
('Кузман','kuzman@gmail.com','kuzman','kuzman'),
('Грегор','gregor@gmail.hu','magas','magas'),
('Андрија','andrija@gmail.com','cvijetic','cvijetic'),
('Новица','novke.brate@gmail.com','novke','novke'),
('Павле','covpa@yahoo.com','pacov','pacov');



DROP TABLE IF EXISTS `ucitelj`;

CREATE TABLE `ucitelj` (
  `ime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `iskustvo` int(5) NOT NULL DEFAULT 0,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


insert  into `ucitelj`(`ime`,`username`,`password`,`iskustvo`) values ('Јоцке','jocke','jocke123',123),('Кови','kovi','kovi123',20),('Борис','boreli','boreli123',350),('Ћазим','vidramdk','cazim',1070);



DROP TABLE IF EXISTS `cas`;

CREATE TABLE `cas` (
  `datum` date NOT NULL,
  `vreme` int(5) NOT NULL,
  `ucenik` varchar(50) NOT NULL,
  `ucitelj` varchar(50) NOT NULL,
  PRIMARY KEY (`datum`,`vreme`,`ucitelj`),
  KEY `ucenik` (`ucenik`),
  KEY `cas_ibfk_2` (`ucitelj`),
  CONSTRAINT `cas_ibfk_1` FOREIGN KEY (`ucenik`) REFERENCES `ucenik` (`username`),
  CONSTRAINT `cas_ibfk_2` FOREIGN KEY (`ucitelj`) REFERENCES `ucitelj` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



insert  into `cas`(`datum`,`vreme`,`ucenik`,`ucitelj`) values ('2023-06-21',12,'magas','jocke');
