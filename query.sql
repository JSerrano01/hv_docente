SELECT `usuarios`.`numero_documento`,`perfiles`.`primer_nombre`,`perfiles`.`primer_apellido`,`maestra_materias`.`codigo`,`maestra_materias`.`Programa`, `maestra_materias`.`Materia`  FROM `materias`
JOIN `usuarios` ON `materias`.`usuario_id` = `usuarios`.`id`
JOIN `maestra_materias` ON `materias`.`materia_id` = `maestra_materias`.`codigo`
JOIN `perfiles` ON `perfiles`.`usuario_id` = `usuarios`.`id`