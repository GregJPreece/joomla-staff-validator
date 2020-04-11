<?php

use Joomla\CMS\Form\FormRule;

/**
 * @package     Joomla.Site
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2020 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Form rule for validating validation codes as they are entered
 */
class JFormRuleCode extends FormRule {
    
    protected $regex = '[a-zA-Z0-9]{4,10}';
    
}