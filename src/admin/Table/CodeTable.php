<?php

namespace GregJPreece\Component\GregsStaffValidator\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Table\Table;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

/**
 * Bog standard database table wrapper for staff validation codes
 */
class CodeTable extends Table {
    public function __construct(&$db) {
        parent::__construct('#__gregsstaffvalidator_codes', 'id', $db);
    }
}
