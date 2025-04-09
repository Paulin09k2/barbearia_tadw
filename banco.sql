-- MySQL Script generated by MySQL Workbench
-- qua 09 abr 2025 09:30:22
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema barbearia
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema barbearia
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `barbearia` DEFAULT CHARACTER SET utf8mb4 ;
USE `barbearia` ;

-- -----------------------------------------------------
-- Table `barbearia`.`cliente`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `barbearia`.`cliente` (
  `id_cliente` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `endereco` VARCHAR(255) NULL DEFAULT NULL,
  `data_nascimento` DATE NULL DEFAULT NULL,
  `data_cadastro` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id_cliente`),
  UNIQUE INDEX `email` (`email` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `barbearia`.`barbeiro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `barbearia`.`barbeiro` (
  `id_barbeiro` INT(11) NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `data_nascimento` DATE NULL DEFAULT NULL,
  `data_admissao` DATE NULL DEFAULT NULL,
  PRIMARY KEY (`id_barbeiro`),
  UNIQUE INDEX `email` (`email` ASC) VISIBLE,
  UNIQUE INDEX `cpf` (`cpf` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `barbearia`.`servico`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `barbearia`.`servico` (
  `id_servico` INT(11) NOT NULL AUTO_INCREMENT,
  `nome_servico` VARCHAR(100) NOT NULL,
  `descricao` TEXT NULL DEFAULT NULL,
  `preco` DECIMAL(10,2) NOT NULL,
  `tempo_estimado` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_servico`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `barbearia`.`agendamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `barbearia`.`agendamento` (
  `id_agendamento` INT(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` INT(11) NULL DEFAULT NULL,
  `id_barbeiro` INT(11) NULL DEFAULT NULL,
  `id_servico` INT(11) NULL DEFAULT NULL,
  `data_agendamento` DATETIME NULL DEFAULT NULL,
  `status` ENUM('pendente', 'confirmado', 'cancelado') NULL DEFAULT 'pendente',
  PRIMARY KEY (`id_agendamento`),
  INDEX `id_cliente` (`id_cliente` ASC) VISIBLE,
  INDEX `id_barbeiro` (`id_barbeiro` ASC) VISIBLE,
  INDEX `id_servico` (`id_servico` ASC) VISIBLE,
  CONSTRAINT `agendamento_ibfk_1`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `barbearia`.`cliente` (`id_cliente`)
    ON DELETE CASCADE,
  CONSTRAINT `agendamento_ibfk_2`
    FOREIGN KEY (`id_barbeiro`)
    REFERENCES `barbearia`.`barbeiro` (`id_barbeiro`)
    ON DELETE CASCADE,
  CONSTRAINT `agendamento_ibfk_3`
    FOREIGN KEY (`id_servico`)
    REFERENCES `barbearia`.`servico` (`id_servico`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
