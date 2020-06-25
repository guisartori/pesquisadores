CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
