CREATE TABLE IF NOT EXISTS `#__staffvalidator_codes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `created_by` INT NOT NULL,
  `updated_by` INT NOT NULL,
  `code` VARCHAR(10) NOT NULL,
  `time_generated` INT UNSIGNED NOT NULL,
  `time_expires` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `code_UNIQUE` (`code` ASC)
)
ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `#__staffvalidator_codes` 
    ADD CONSTRAINT `fk___codes_user_id`
    FOREIGN KEY (user_id)
    REFERENCES `#__users` (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;

ALTER TABLE `#__staffvalidator_codes` 
    ADD CONSTRAINT `fk___created_user_id`
    FOREIGN KEY (created_by)
    REFERENCES `#__users` (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;

ALTER TABLE `#__staffvalidator_codes` 
    ADD CONSTRAINT `fk___updated_user_id`
    FOREIGN KEY (updated_by)
    REFERENCES `#__users` (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION;