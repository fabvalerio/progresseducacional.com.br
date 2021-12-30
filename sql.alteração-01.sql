
ALTER TABLE `aluno` ADD `aluno_complemento` VARCHAR(150) NULL AFTER `aluno_num`;
ALTER TABLE `escola` ADD `esc_complemento` VARCHAR(150) NULL AFTER `esc_num`;
ALTER TABLE `curso` ADD `curso_validade_dias` INT NULL AFTER `curso_registro`, ADD `curso_validade_data_inicio` DATE NULL AFTER `curso_validade_dias`, ADD `curso_validade_data_fim` DATE NULL AFTER `curso_validade_data_inicio`;
ALTER TABLE `aluno` ADD `aluno_telefone` VARCHAR(20) NULL AFTER `aluno_celular`;
ALTER TABLE `escola` ADD `esc_cargo` VARCHAR(200) NULL AFTER `esc_responsavel`;
ALTER TABLE `curso` ADD `curso_descricao` LONGTEXT NULL AFTER `curso_nome`;
ALTER TABLE `aluno_cursos` ADD `cursos_data_inicio` DATE NULL AFTER `cursos_registro`, ADD `cursos_data_fim` DATE NULL AFTER `cursos_data_inicio`, ADD `cursos_data_dias` INT(5) NULL AFTER `cursos_data_fim`;