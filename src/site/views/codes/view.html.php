<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Uri\Uri;

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

        $loggedIn = Factory::getUser()->id != 0;
        
        // Check that the user has permissions to list codes
        if (!$loggedIn) {
            $app = Factory::getApplication(); 
            $app->redirect(Route::_('index.php?option=com_users&view=login'));
            return;
        }
        
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
        $this->setupDocument();

        // Display the template
        parent::display($tpl);
    }

    protected function renderToolbar(): string {
        $this->canDo = ContentHelper::getActions('com_staffvalidator');
        $title = Text::_('COM_STAFFVALIDATOR_LIST_TITLE');
        $title .= ($this->pagination->total) ? ' (<span class="list-count">' . $this->pagination->total . '</span>)' : '';

        ToolbarHelper::title($title);

        if ($this->canDo->get('core.create')) {
            ToolbarHelper::addNew('code.add', 'COM_STAFFVALIDATOR_BUTTON_CODE_NEW');
        }
        
        if ($this->canDo->get('core.edit') || $this->canDo->get('core.edit.own')) {
            ToolbarHelper::editList('code.edit', 'COM_STAFFVALIDATOR_BUTTON_CODE_EDIT');
        }
        
        if ($this->canDo->get('core.delete')) {
            ToolbarHelper::deleteList('COM_STAFFVALIDATOR_DELETE_CONFIRM', 'codes.delete', 'COM_STAFFVALIDATOR_BUTTON_CODE_DELETE');
        }
        
        return Toolbar::getInstance()->render();
    }

    protected function setupDocument(): void {
        HTMLHelper::_('formbehavior.chosen', 'select');
        
        $document = Factory::getDocument();
        $document->setTitle(Text::_('COM_STAFFVALIDATOR_LIST_TITLE'));
        $document->addStyleSheet(Uri::root() . '/components/com_staffvalidator/views/codes/css/toolbar.css');
    }

}