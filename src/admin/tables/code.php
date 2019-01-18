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

class StaffValidatorTableCode extends JTable {
    public function __construct(&$db) {
        parent::__construct('#__staffvalidator_codes', 'id', $db);
    }
}
