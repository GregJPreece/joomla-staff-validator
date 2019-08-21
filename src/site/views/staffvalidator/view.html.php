<?php

use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Log\Log;

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
 * HTML View class for the StaffValidator Component
 *
 * @since  0.0.1
 */
class StaffValidatorViewStaffValidator extends HtmlView {
    
    /**
     * Display the Staff Validator view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  void
     */
    function display($tpl = null) {
        
        // Assign data to the view
        $this->msg = $this->get('Msg');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            Log::add(implode('<br />', $errors), Log::WARNING, 'jerror');

            return false;
        }    

        // Display the view
        parent::display($tpl);
    }

}
