<?php

namespace GregJPreece\Component\GregsStaffValidator\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

/**
 * Staff Validator Code Model
 */
class CodeModel extends AdminModel {

    /**
     * Fetches a table object, loads it if it is
     * not already loaded
     * 
     * @param string $type The table name. Optional.
     * @param string $prefix The class prefix. Optional.
     * @param array $config Configuration array for model. Optional.
     * @return Table The loaded table object
     */
    public function getTable($type = 'code', $prefix = '', $config = []) {
        
        if ($table = $this->_createTable($type, $prefix, $config)) {
            return $table;
        }
        
        throw new \Exception(Text::sprintf('JLIB_APPLICATION_ERROR_TABLE_NAME_NOT_SUPPORTED', $name), 0);        
        
    }
    
    /**
     * Fetches the form object
     * 
     * @param array $data Data for the form
     * @param boolean $loadData Whether the form should load its own data
     * @return mixed \Joomla\CMS\Form\Form object on success, false on failure
     */
    public function getForm($data = [], $loadData = true) {
        $form = $this->loadForm(
            'com_gregsstaffvalidator.code',
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
        $data = Factory::getApplication()->getUserState(
            'com_gregsstaffvalidator.edit.code.data', []
        );

        if (empty($data)) {
            $data = $this->getItem();
        }

        return $data;
    }
    
    /**
     * Preps the table row data for saving.
     * @param CodeTable $table Table to prepare
     */
    protected function prepareTable($table) {        
        $table->time_updated = time();
        $table->updated_by = Factory::getUser()->get('id', 0);

        if (isset($table->time_expires) && !is_numeric($table->time_expires)) {
            $unixTime = strtotime($table->time_expires);
            $table->time_expires = ($unixTime > 0) ? $unixTime : null;
        } else {
            $table->time_expires = null;
        }
        
        if (empty($table->id)) {
            $table->time_generated = time();
            $table->created_by = $table->updated_by;
        }
        
    }

}
