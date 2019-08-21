<?php

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ListModel;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_staffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

 /**
 * Staff Validator code list Model
 */
class StaffValidatorModelCodes extends ListModel {

    public function __construct($config = []) {
        $config['filter_fields'] = [
            'time_expires',
            'code'
        ];
        parent::__construct($config);
    }

    /**
     * Method to build an SQL query to load the list data.
     *
     * @return string An SQL query
     */
    protected function getListQuery() {
        // Initialize variables.
        $db    = Factory::getDbo();
        $query = $db->getQuery(true);

        // Create the base select statement.
        $query->select('*')
                ->from($db->quoteName('#__staffvalidator_codes'));

        $query->order(
            $db->escape($this->getState('list.ordering', 'time_expires'))
            . ' ' .
            $db->escape($this->getState('list.direction', 'DESC'))
        );

        return $query;
    }

    protected function populateState($ordering = 'time_expires', $direction = 'DESC') {
        parent::populateState($ordering, $direction);
    }
}