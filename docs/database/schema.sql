CREATE TABLE `produtora` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `logo` blob,
  `descricao` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

CREATE TABLE `genero` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(60) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

CREATE TABLE `filme` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(128) NOT NULL,
  `produtora_id` int(10) NOT NULL,
  `genero_id` int(10) NOT NULL,
  `ano` int(4) DEFAULT NULL,
  `sinopse` varchar(255),
  `poster` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

CREATE TABLE `nome_filme` (
  `id` int(10) NOT NULL,
  `filme_id` int(10) NOT NULL,
  `nome_alternativo` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;