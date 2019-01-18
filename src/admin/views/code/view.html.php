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

class StaffValidatorViewCode extends JViewLegacy {

    protected $form = null;

    public function display($template = null) {

        // Populate
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        // Error checking
        $errors = $this->get('Errors');
        
        if (count($errors)) {
            JError::raiseError(500, implode('<br>', $errors));
            return false;
        }

        $this->addToolbar();

        parent::display($template);

    }

    protected function addToolbar() {

        $input = JFactory::getApplication()->input;
        $input->set('hidemainmenu', true);


        $isNew = ($this->item->id == 0);

        if ($isNew) {
            $title = JText::_('COM_STAFFVALIDATOR_MANAGER_TITLE_CODE_NEW');
        } else {
            $title = JText::_('COM_STAFFVALIDATOR_MANAGER_TITLE_CODE_EDIT');
        }

        JToolbarHelper::title($title, 'code');
        JToolbarHelper::save('code.save');
        JToolbarHelper::cancel(
            'codes',
            $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
        );

    }

}