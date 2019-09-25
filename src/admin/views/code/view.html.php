<?php

use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\HTML\HTMLHelper;

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
        $this->setupDocument();

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
            'code.cancel',
            $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
        );

    }
    
    protected function setupDocument() {
        HTMLHelper::_('behavior.framework');
        HTMLHelper::_('behavior.formvalidator');
        
        $isNew = ($this->item->id == 0);
        $document = Factory::getDocument();
        $document->setTitle(($isNew)
                ? Text::_('COM_STAFFVALIDATOR_MANAGER_TITLE_CODE_NEW')
                : Text::_('COM_STAFFVALIDATOR_MANAGER_TITLE_CODE_EDIT'));
        $document->addScript(Uri::root() . 
                '/administrator/components/com_staffvalidator/views/code/js/submit.js');
        Text::script('COM_STAFFVALIDATOR_MANAGER_CODE_EDIT_VALIDATION_FAIL');
    }

}