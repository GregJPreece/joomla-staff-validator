<?php

namespace GregJPreece\Component\GregsStaffValidator\Administrator\View\Code;

defined('_JEXEC') or die;

use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

class HtmlView extends BaseHtmlView {

    protected $form = null;

    public function display($template = null) {

        // Populate
        $this->form = $this->get('Form');
        $this->item = $this->get('Item');

        // Error checking
        $errors = $this->get('Errors');
        
        if ($errors && count($errors)) {
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
        $title = ($isNew)
            ? Text::_('COM_GREGSSTAFFVALIDATOR_MANAGER_TITLE_CODE_NEW')
            : Text::_('COM_GREGSSTAFFVALIDATOR_MANAGER_TITLE_CODE_EDIT')  . ' (' . $this->item->code . ')';

        ToolbarHelper::title($title, 'code');
        ToolbarHelper::save('code.save');
        ToolbarHelper::cancel(
            'code.cancel',
            $isNew ? 'JTOOLBAR_CANCEL' : 'JTOOLBAR_CLOSE'
        );

    }
    
    protected function setupDocument() {
        HTMLHelper::_('behavior.core');
        HTMLHelper::_('behavior.formvalidator');
        
        $isNew = ($this->item->id == 0);
        $document = Factory::getDocument();
        $document->setTitle(($isNew)
                ? Text::_('COM_GREGSSTAFFVALIDATOR_MANAGER_TITLE_CODE_NEW')
                : Text::_('COM_GREGSSTAFFVALIDATOR_MANAGER_TITLE_CODE_EDIT') . ' (' . $this->item->code . ')');
        $document->addScript(Uri::root() . 
                '/administrator/components/com_gregsstaffvalidator/views/code/js/submit.js');
        Text::script('COM_GREGSSTAFFVALIDATOR_MANAGER_CODE_EDIT_VALIDATION_FAIL');
    }

}