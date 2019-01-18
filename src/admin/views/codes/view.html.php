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
 * Main Staff Validator Admin View
 */
class StaffValidatorViewCodes extends JViewLegacy {
    
    /**
     * Display the main Staff Validator view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     * @return  void
     */
    function display($tpl = null) {

        // Get data from the model
        $this->items      = $this->get('Items');
        $this->pagination = $this->get('Pagination');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode('<br />', $errors));

            return false;
        }

        // Add the standard toolbar
        $this->addToolbar();

        // Display the template
        parent::display($tpl);
    }

    protected function addToolbar() {
        JToolbarHelper::title(JText::_('COM_STAFFVALIDATOR_MANAGER_TITLE'));
        JToolbarHelper::addNew('codes.add');
        JToolbarHelper::editList('codes.edit');
        JToolbarHelper::deleteList('', 'codes.delete');
    }

}