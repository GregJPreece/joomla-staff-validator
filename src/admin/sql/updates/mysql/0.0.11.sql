ALTER TABLE `#__staffvalidator_codes` 
    ADD `created_by` INT NOT NULL AFTER `user_id`, 
    ADD `updated_by` INT NOT NULL AFTER `created_by`; 

ALTER TABLE `#__staffvalidator_codes` 
    ADD CONSTRAINT fk___created_user_id 
    FOREIGN KEY (created_by) 
    REFERENCES #__users(id);

ALTER TABLE `#__staffvalidator_codes` 
    ADD CONSTRAINT fk___updated_user_id 
    FOREIGN KEY (updated_by)
    REFERENCES #__users(id);