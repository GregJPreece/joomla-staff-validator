<?php

use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Factory;

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
class StaffValidatorViewCodes extends HtmlView {
    
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
        $this->sortColumn = $state->get('list.ordering');
        $this->sortDirection = $state->get('list.direction');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new RuntimeException(implode('<br />', $errors), 500);
        }

        // Set up the document
        $this->addToolbar();
        $this->setupDocument();

        // Display the template
        parent::display($tpl);
    }

    protected function addToolbar(): void {
        $title = Text::_('COM_STAFFVALIDATOR_MANAGER_TITLE');
        $title .= ($this->pagination->total) ? ' (<span class="list-count">' . $this->pagination->total . '</span>)' : '';

        ToolbarHelper::title($title);
        ToolbarHelper::addNew('code.add');
        ToolbarHelper::editList('code.edit');
        ToolbarHelper::deleteList('', 'codes.delete');
        
        if (Factory::getUser()->authorise('core.admin', 'com_staffvalidator')) {
            ToolbarHelper::preferences('com_staffvalidator');
        }
    }

    protected function setupDocument(): void {
        $document = Factory::getDocument();
        $document->setTitle(JText::_('COM_STAFFVALIDATOR_MANAGER_TITLE'));
    }

}