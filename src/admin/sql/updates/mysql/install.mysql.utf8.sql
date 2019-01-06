CREATE TABLE IF NOT EXISTS `#_staffvalidator_codes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `code` VARCHAR(10) NOT NULL,
  `time_generated` INT UNSIGNED NOT NULL,
  `time_expires` INT UNSIGNED NULL,
  `note` TEXT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC),
  CONSTRAINT `fk_#_staffvalidator_codes_user_id`
    FOREIGN KEY (user_id)
    REFERENCES `#_users` (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
)
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;
