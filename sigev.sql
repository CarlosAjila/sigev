SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `bd_sigev` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci ;
USE `bd_sigev` ;

-- -----------------------------------------------------
-- Table `bd_sigev`.`dpa_ecuador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`dpa_ecuador` (
  `cod_dpa` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo de autoincremento',
  `cod_pro` CHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo del código de la provincia',
  `cod_can` CHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo del código del cantón de la provincia',
  `cod_par` CHAR(2) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo del código de la parroquia de un cantón',
  `nom_pro` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo del nombre de la provincia',
  `nom_can` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo del nombre del cantón',
  `nom_par` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo del nombre de la parroquia',
  PRIMARY KEY (`cod_dpa`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`georeferenciacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`georeferenciacion` (
  `id_geo` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo de autoincremento ',
  `lat_geo` DOUBLE NOT NULL COMMENT 'Campo de latitud referente al punto de ubicación',
  `lon_geo` DOUBLE NOT NULL COMMENT 'Campo de longitud referente al punto de ubicación',
  `est_geo` CHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL DEFAULT 'A' COMMENT 'Campo de estado A activo o I inactivo',
  PRIMARY KEY (`id_geo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`paciente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`paciente` (
  `id_pac` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Campo del código del paciente',
  `id_geo` INT NOT NULL COMMENT 'Campo de clave foránea de la tabla georeferenciación',
  `cod_dpa` INT NOT NULL COMMENT 'Campo para obtener el cantón, barrio y parroquia',
  `ced_pac` CHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de cédula del paciente',
  `pno_pac` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de primer nombre del paciente',
  `sno_pac` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de segundo nombre del paciente',
  `app_pac` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de apellido paterno',
  `apm_pac` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de apellido materno',
  `fna_pac` DATE NULL COMMENT 'Campo de la fecha de nacimiento',
  `tel_pac` VARCHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL COMMENT 'Campo de teléfono o celular',
  `oex_pac` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de lugar en el cual se realizó los exámenes',
  `fre_pac` DATETIME NOT NULL COMMENT 'Campo de fecha en la cual se registro la ficha del paciente',
  `cas_pac` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo para el tipo de caso el cual puede ser:presuntivo o confirmado',
  `dir_pac` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de dirección del domicilio',
  `sex_pac` CHAR(1) NOT NULL COMMENT 'Campo de sexo del paciente M o F',
  `ref_pac` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL COMMENT 'Campo de referencia de ubicación del domicilio',
  `ofi_pac` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo que indica el trabajo del paciente',
  `dof_pac` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de dirección del lugar de trabajo',
  `emi_pac` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de quien le diagnostico la enfermedad (médico, enfermera, laboratorista)',
  `fat_pac` DATE NOT NULL COMMENT 'Campo de la fecha en la cual se hizo atender',
  `fis_pac` DATE NOT NULL COMMENT 'Campo de fecha de inicio de síntomas',
  `est_pac` CHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL DEFAULT 'A' COMMENT 'Campo de estado A activo I inactivo',
  PRIMARY KEY (`id_pac`),
  INDEX `fk_paciente_georeferenciacion1_idx` (`id_geo` ASC),
  INDEX `fk_paciente_dpa_ecuador1_idx` (`cod_dpa` ASC),
  CONSTRAINT `fk_paciente_georeferenciacion1`
    FOREIGN KEY (`id_geo`)
    REFERENCES `bd_sigev`.`georeferenciacion` (`id_geo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_paciente_dpa_ecuador1`
    FOREIGN KEY (`cod_dpa`)
    REFERENCES `bd_sigev`.`dpa_ecuador` (`cod_dpa`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`cargo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`cargo` (
  `id_car` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo ',
  `nom_car` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo del nombre del cargo',
  `est_car` CHAR CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL DEFAULT 'A' COMMENT 'Campo de estado del cargo el cual puede ser activo o inactivo',
  PRIMARY KEY (`id_car`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`usuario` (
  `id_usu` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'Clave primaria autoincrementada',
  `id_car` INT NOT NULL COMMENT 'Campo de clave foranea para el tipo de cargo (visitador, fumigador, inspector)',
  `ced_usu` CHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo para la solicitud de la cédula',
  `pno_usu` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo para el primer nombre',
  `sno_usu` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo para el segundo nombre del usuario',
  `pap_usu` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo para el apellido paterno',
  `sap_usu` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo para el apellido materno',
  `fna_usu` DATE NOT NULL COMMENT 'Campo para la fecha y añio',
  `cel_usu` CHAR(10) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL DEFAULT NULL COMMENT 'Campo para el ingreso del # de celular',
  `tel_usu` CHAR(7) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL DEFAULT NULL COMMENT 'Campo para el ingreso del # de teléfono',
  `fot_usu` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo para la foto del usuario',
  `nus_usu` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo para el nombre de usuario',
  `con_usu` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo para la contraseña del usuario',
  `ema_usu` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo para el email del usuario',
  `ffc_usu` DATE NOT NULL COMMENT 'Campo para la fecha de fin de contrato',
  `est_usu` CHAR(1) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo para especificar el estado (activo, inactivo o vacaciones)',
  PRIMARY KEY (`id_usu`),
  INDEX `fk_usuario_cargo1_idx` (`id_car` ASC),
  CONSTRAINT `fk_usuario_cargo1`
    FOREIGN KEY (`id_car`)
    REFERENCES `bd_sigev`.`cargo` (`id_car`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`enfemedad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`enfemedad` (
  `id_enf` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo del código autoincrementado ',
  `nom_enf` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo del nombre de la enfermedad',
  `pri_enf` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de la prioridad de la enfermedad',
  PRIMARY KEY (`id_enf`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`sintoma_paciente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`sintoma_paciente` (
  `id_spa` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo autoincrementado',
  `id_pac` INT NOT NULL COMMENT 'Campo de código de paciente',
  `id_enf` INT NOT NULL COMMENT 'Campo del id de la tabla enfermedad',
  `nsi_spa` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL COMMENT 'Campo del nombre del síntoma',
  PRIMARY KEY (`id_spa`),
  INDEX `fk_sintoma_paciente_paciente1_idx` (`id_pac` ASC),
  INDEX `fk_sintoma_paciente_enfemedad1_idx` (`id_enf` ASC),
  CONSTRAINT `fk_sintoma_paciente_paciente1`
    FOREIGN KEY (`id_pac`)
    REFERENCES `bd_sigev`.`paciente` (`id_pac`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_sintoma_paciente_enfemedad1`
    FOREIGN KEY (`id_enf`)
    REFERENCES `bd_sigev`.`enfemedad` (`id_enf`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`representante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`representante` (
  `id_rep` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo de autoincremento',
  `ced_rep` CHAR(10) NOT NULL COMMENT 'Campo de cédula',
  `pno_rep` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo para el primer nombre',
  `sno_rep` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo del segundo nombre ',
  `app_rep` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo del apellido paterno',
  `apm_rep` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo del apellido materno',
  `tel_rep` CHAR(10) NOT NULL COMMENT 'Campo de # de teléfono',
  `dit_rep` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de dirección del trabajo del representante',
  PRIMARY KEY (`id_rep`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`paciente_representante`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`paciente_representante` (
  `id_pre` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo de autoincremento',
  `id_pac` INT NOT NULL COMMENT 'Campo de clave foránea de la tabla paciente',
  `id_rep` INT NOT NULL COMMENT 'Campo de clave foránea de la tabla representante',
  PRIMARY KEY (`id_pre`),
  INDEX `fk_paciente_representante_paciente1_idx` (`id_pac` ASC),
  INDEX `fk_paciente_representante_representante1_idx` (`id_rep` ASC),
  CONSTRAINT `fk_paciente_representante_paciente1`
    FOREIGN KEY (`id_pac`)
    REFERENCES `bd_sigev`.`paciente` (`id_pac`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_paciente_representante_representante1`
    FOREIGN KEY (`id_rep`)
    REFERENCES `bd_sigev`.`representante` (`id_rep`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`trabajo_campo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`trabajo_campo` (
  `id_tca` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo de autoincremento',
  `npe_tca` INT NOT NULL COMMENT 'Campo de número de personas enfermas',
  `tcr_tca` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de tipo de criadero (aedes, cules y anofeles)',
  `sen_tca` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de sector endémico',
  `obs_tca` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de observación',
  `maq_tca` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de tipo de máquina implementada en la fumigación',
  `qui_tca` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de tipo de químico implementado en la fumigación',
  `cqu_tca` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de cantidad de químico implementado',
  `cte_tca` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NULL COMMENT 'Campo de criterio técnico',
  `est_tca` CHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Campo de estado A activo o I inactivo',
  PRIMARY KEY (`id_tca`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`ficha_paciente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`ficha_paciente` (
  `id_fpa` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo de autoincremento',
  `id_pac` INT NOT NULL COMMENT 'Campo de clave foránea de la tabla paciente',
  `id_tca` INT NOT NULL COMMENT 'Campo de clave foránea de la tabla trabajo de campo',
  `est_fpa` VARCHAR(45) NOT NULL DEFAULT 'A' COMMENT 'Campo de estado',
  PRIMARY KEY (`id_fpa`),
  INDEX `fk_ficha_paciente_paciente1_idx` (`id_pac` ASC),
  INDEX `fk_ficha_paciente_trabajo_campo1_idx` (`id_tca` ASC),
  CONSTRAINT `fk_ficha_paciente_paciente1`
    FOREIGN KEY (`id_pac`)
    REFERENCES `bd_sigev`.`paciente` (`id_pac`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ficha_paciente_trabajo_campo1`
    FOREIGN KEY (`id_tca`)
    REFERENCES `bd_sigev`.`trabajo_campo` (`id_tca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`asigna_caso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`asigna_caso` (
  `id_aca` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo autoincrementado',
  `id_pac` INT NOT NULL COMMENT 'Clave foranea de la tabla paciente',
  `id_usu` INT NOT NULL COMMENT 'Clave foranea de la tabla usuario',
  `tip_aca` CHAR(2) NOT NULL COMMENT 'Campo de tipo de asignación, por ejemplo (F=fumigador, FC=fumigador de cronograma, V=visitador, J=jefe departamento)',
  `est_aca` CHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Campo de estado A activo I inactivo',
  PRIMARY KEY (`id_aca`),
  INDEX `fk_asigna_caso_paciente1_idx` (`id_pac` ASC),
  INDEX `fk_asigna_caso_usuario1_idx` (`id_usu` ASC),
  CONSTRAINT `fk_asigna_caso_paciente1`
    FOREIGN KEY (`id_pac`)
    REFERENCES `bd_sigev`.`paciente` (`id_pac`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_asigna_caso_usuario1`
    FOREIGN KEY (`id_usu`)
    REFERENCES `bd_sigev`.`usuario` (`id_usu`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`cronograma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`cronograma` (
  `id_cro` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo de autoincremento',
  `fe1_cro` DATE NOT NULL COMMENT 'Campo de fecha 1 del cronograma',
  `fe2_cro` DATE NOT NULL COMMENT 'Campo de fecha 2 del cronograma',
  `fe3_cro` DATE NOT NULL COMMENT 'Campo de fecha 3 del cronograma',
  `maq_cro` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de máquina implementada',
  `cqu_cro` INT NOT NULL COMMENT 'Campo de cantidad de químico implementado',
  `bar_cro` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_spanish_ci' NOT NULL COMMENT 'Campo de nombre de barrio',
  `est_cro` CHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Campo de estado A activo o I inactivo',
  PRIMARY KEY (`id_cro`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `bd_sigev`.`ac_cronograma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `bd_sigev`.`ac_cronograma` (
  `id_acc` INT NOT NULL AUTO_INCREMENT COMMENT 'Campo de autoincremento',
  `id_aca` INT NOT NULL COMMENT 'Campo de clave foranea de la tabla asignar caso',
  `id_cro` INT NOT NULL COMMENT 'Campo de clave foranea de la tabala cronograma',
  `est_acc` CHAR(1) NOT NULL DEFAULT 'A' COMMENT 'Campo de estado  A activo o I inactivo',
  PRIMARY KEY (`id_acc`),
  INDEX `fk_ac_cronograma_asigna_caso1_idx` (`id_aca` ASC),
  INDEX `fk_ac_cronograma_cronograma1_idx` (`id_cro` ASC),
  CONSTRAINT `fk_ac_cronograma_asigna_caso1`
    FOREIGN KEY (`id_aca`)
    REFERENCES `bd_sigev`.`asigna_caso` (`id_aca`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_ac_cronograma_cronograma1`
    FOREIGN KEY (`id_cro`)
    REFERENCES `bd_sigev`.`cronograma` (`id_cro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
