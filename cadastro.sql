
CREATE TABLE `pessoas` (
  `id` int NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;


INSERT INTO `pessoas` (`nome`, `telefone`, `email`) VALUES
('Ana Maria', '(11) 91234-5678', 'ana.maria@example.com'),
('João Silva', '(21) 92345-6789', 'joao.silva@example.com'),
('Carlos Alberto', '(31) 93456-7890', 'carlos.alberto@example.com'),
('Mariana Souza', '(41) 94567-8901', 'mariana.souza@example.com'),
('Fernanda Lima', '(51) 95678-9012', 'fernanda.lima@example.com'),
('Roberto Gomes', '(61) 96789-0123', 'roberto.gomes@example.com'),
('Luciana Oliveira', '(71) 97890-1234', 'luciana.oliveira@example.com'),
('Bruno Rocha', '(81) 98901-2345', 'bruno.rocha@example.com'),
('Patrícia Menezes', '(91) 99012-3456', 'patricia.menezes@example.com'),
('Ricardo Fonseca', '(85) 90123-4567', 'ricardo.fonseca@example.com');
