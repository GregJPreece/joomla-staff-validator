<?php

namespace GregJPreece\Component\GregsStaffValidator\Administrator\View\Codes;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Factory;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

/**
 * Main Staff Validator Admin View
 */
class HtmlView extends BaseHtmlView {
    
    /**
     * Display the main Staff Validator view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     * @return  void
     */
    function display($tpl = null) {

        $state = $this->get('State');

        // Get data from the model/state
        $this->items      = $this->get('Items');
        $this->pagination = $this->get('Pagination');
        $this->sortColumn = ($state) ? $state->get('list.ordering') : null;
        $this->sortDirection = ($state) ? $state->get('list.direction') : null;

        // Check for errors.
        $errors = $this->get('Errors');
        
        if ($errors && count($errors)) {
            throw new RuntimeException(implode('<br />', $errors), 500);
        }

        // Set up the document
        $this->addToolbar();
        $this->setupDocument();

        // Display the template
        parent::display($tpl);
    }

    protected function addToolbar(): void {
        $title = Text::_('COM_GREGSSTAFFVALIDATOR_MANAGER_TITLE');
        $title .= ($this->pagination->total) ? ' (<span class="list-count">' . $this->pagination->total . '</span>)' : '';

        ToolbarHelper::title($title);
        ToolbarHelper::addNew('code.add');
        ToolbarHelper::editList('code.edit');
        ToolbarHelper::deleteList('COM_GREGSSTAFFVALIDATOR_MANAGER_DELETE_CONFIRM', 'codes.delete');
        
        if (Factory::getUser()->authorise('core.admin', 'com_gregsstaffvalidator')) {
            ToolbarHelper::preferences('com_gregsstaffvalidator');
        }
    }

    protected function setupDocument(): void {
        $document = Factory::getDocument();
        $document->setTitle(Text::_('COM_GREGSSTAFFVALIDATOR_MANAGER_TITLE'));
    }

}