<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_staffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Staff Validator Code Model
 */
class StaffValidatorModelCode extends JModelAdmin {

    /**
     * Fetches a table object, loads it if it is
     * not already loaded
     * 
     * @param string $type The table name. Optional.
     * @param string $prefix The class prefix. Optional.
     * @param array $config Configuration array for model. Optional.
     * @return JTable The loaded table object
     */
    public function getTable($type = 'Code', $prefix = 'StaffValidatorTable', $config = []) {
        return JTable::getInstance($type, $prefix, $config);    
    }

    /**
     * Fetches the form object
     * 
     * @param array $data Data for the form
     * @param boolean $loadData Whether the form should load its own data
     * @return mixed JForm object on success, false on failure
     */
    public function getForm($data = [], $loadData = true) {
        $form = $this->loadForm(
            'com_staffvalidator.code',
            'code',
            [
                'control' => 'jform',
                'load_data' => $loadData
            ]
        );

        return (empty($form)) ? false : $form;
    }

    /**
     * Returns the data that should be injected in the form
     * @return mixed Data for the form
     */
    protected function loadFormData() {
        $data = JFactory::getApplication()->getUserState(
            'com_staffvalidator.edit.code.data', []
        );

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }

}
