<?php

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_staffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class StaffValidatorViewCode extends HtmlView {

    protected $form = null;

    public function display($template = null) {

        // Populate
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        // Error checking
        $errors = $this->get('Errors');
        
        if (count($errors)) {
            throw new RuntimeException(implode('<br>', $errors), 500);
        }

        $this->addToolbar();

        parent::display($template);

    }

    protected function addToolbar() {

        $input = Factory::getApplication()->input;
        $input->set('hidemainmenu', true);


        $isNew = ($this->item->id == 0);

        if ($isNew) {
            $title = Text::_('COM_STAFFVALIDATOR_MANAGER_TITLE_CODE_NEW');
        } else {
            $title = Text::_('COM_STAFFVALIDATOR_MANAGER_TITLE_CODE_EDIT');
        }

        ToolbarHelper::title($title, 'code');
        ToolbarHelper::save('code.save');
        ToolbarHelper::cancel(
            'codes',
            $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
        );

    }

}