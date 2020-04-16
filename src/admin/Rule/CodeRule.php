<?php

namespace GregJPreece\Component\GregsStaffValidator\Administrator\Rule;

defined('_JEXEC') or die;

use Joomla\CMS\Form\FormRule;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2020 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

/**
 * Form rule for validating validation codes as they are entered
 */
class CodeRule extends FormRule {
    
    protected $regex = '[a-zA-Z0-9]{4,10}';
    
}