ALTER TABLE `j_staffvalidator_codes` ADD `note` TEXT NULL DEFAULT NULL AFTER `code`; 
ALTER TABLE `j_staffvalidator_codes` ADD `time_updated` INT UNSIGNED NOT NULL AFTER `time_generated`; 
