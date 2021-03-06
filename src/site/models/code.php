<?php

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Site
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Staff Validator Code Model
 */
class GregsStaffValidatorModelCode extends AdminModel {

    /**
     * Fetches a table object, loads it if it is
     * not already loaded
     * 
     * @param string $type The table name. Optional.
     * @param string $prefix The class prefix. Optional.
     * @param array $config Configuration array for model. Optional.
     * @return Table The loaded table object
     */
    public function getTable($type = 'Code', $prefix = 'GregsStaffValidatorTable', $config = []) {
        return Table::getInstance($type, $prefix, $config);    
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
            'com_gregsstaffvalidator.code.create',
            'create',
            [
                'control' => 'jform',
                'load_data' => $loadData
            ]
        );

        return (empty($form)) ? false : $form;
    }
    
    public function getValidationForm($data = [], $loadData = true) {
        $form = $this->loadForm(
            'com_gregsstaffvalidator.code.validate',
            'validate',
            [
                'control' => 'jform',
                'load_data' => $loadData
            ]
        );

        return (empty($form)) ? false : $form;
    }
    
    public function getCode(string $code) {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        
        $query->select(['codes.*', 'users.name', 'users.username'])
              ->from($db->qn('#__gregsstaffvalidator_codes', 'codes'))
              ->innerJoin($db->qn('#__users', 'users') . ' ON ' . $db->qn('codes.user_id') . ' = ' . $db->qn('users.id'))
              ->where($db->qn('codes.code'). ' = ' . $db->q(trim($code)));
        
        $db->setQuery($query);

        return $db->loadObject();
    }

    public function getValidCode(string $code) {
        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        $query->select(['codes.*', 'users.name', 'users.username'])
              ->from($db->qn('#__gregsstaffvalidator_codes', 'codes'))
              ->innerJoin($db->qn('#__users', 'users') . ' ON ' . $db->qn('codes.user_id') . ' = ' . $db->qn('users.id'))
              ->where(
                      $db->qn('codes.code') . ' = ' . $db->q(trim($code)) . 
                      ' AND (' . $db->qn('codes.time_expires') . ' IS NULL' . 
                      ' OR ' . $db->qn('codes.time_expires') . ' = 0' .
                      ' OR ' . $db->qn('codes.time_expires') . ' > ' . time() . ')');
        
        $db->setQuery($query);

        return $db->loadObject();
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
     * @param GregsStaffValidatorTableCode $table Table to prepare
     */
    protected function prepareTable($table) {
        $binds = [
            'user_id' => Factory::getUser()->id            
        ];
        
        $binds['time_updated'] = time();
        $binds['updated_by'] = Factory::getUser()->get('id', 0);

        if (isset($table->time_expires) && !is_numeric($table->time_expires)) {
            $unixTime = strtotime($table->time_expires);
            $binds['time_expires'] = ($unixTime > 0) ? $unixTime : null;
        }
        
        if (empty($table->id)) {
            $binds['time_generated'] = time();
            $binds['created_by'] = $binds['updated_by'];
        }
        
        $table->bind($binds);
    }

}
