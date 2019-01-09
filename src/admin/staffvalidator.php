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

// Get an instance of the controller prefixed by StaffValidator
$controller = JControllerLegacy::getInstance('StaffValidator');

// Perform the Request task
$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();