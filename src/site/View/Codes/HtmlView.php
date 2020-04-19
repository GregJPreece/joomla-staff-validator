<?php

namespace GregJPreece\Component\GregsStaffValidator\Site\View\Codes;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Uri\Uri;

/**
 * @package     Joomla.Site
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
     * Whether the user has reached the allowed codes limit
     * @var bool
     */
    public $overCodeLimit = false;
    
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
        $this->sortColumn = ($state) ? $state->get('list.ordering') : null;
        $this->sortDirection = ($state) ? $state->get('list.direction') : null;

        $params = ComponentHelper::getParams("com_gregsstaffvalidator");
        $codeLimit = $params->get('maxCodesPerUser', null);
        $this->overCodeLimit = ($codeLimit !== null) && (intval($codeLimit) <= count($this->items));
        
        // Check for errors.
        $errors = $this->get('Errors');
        
        if ($errors && count($errors)) {
            throw new RuntimeException(implode('<br />', $errors), 500);
        }

        // Set up the document        
        $this->setupDocument();

        // Display the template
        parent::display($tpl);
    }

    protected function renderToolbar(): string {
        $this->canDo = ContentHelper::getActions('com_gregsstaffvalidator');
        $title = Text::_('COM_GREGSSTAFFVALIDATOR_LIST_TITLE');
        $title .= ($this->pagination->total) ? ' (<span class="list-count">' . $this->pagination->total . '</span>)' : '';

        ToolbarHelper::title($title);

        if ($this->canDo->get('core.create') && !$this->overCodeLimit) {
            ToolbarHelper::addNew('code.add', 'COM_GREGSSTAFFVALIDATOR_BUTTON_CODE_NEW');
        }
        
        if ($this->canDo->get('core.edit') || $this->canDo->get('core.edit.own')) {
            ToolbarHelper::editList('code.edit', 'COM_GREGSSTAFFVALIDATOR_BUTTON_CODE_EDIT');
        }
        
        if ($this->canDo->get('core.delete')) {
            ToolbarHelper::deleteList('COM_GREGSSTAFFVALIDATOR_DELETE_CONFIRM', 'codes.delete', 'COM_GREGSSTAFFVALIDATOR_BUTTON_CODE_DELETE');
        }
        
        return Toolbar::getInstance()->render();
    }

    protected function setupDocument(): void {
        HTMLHelper::_('formbehavior.chosen', 'select');
        
        $document = Factory::getDocument();
        $document->setTitle(Text::_('COM_GREGSSTAFFVALIDATOR_LIST_TITLE'));
        $document->addStyleSheet(Uri::root() . '/components/com_gregsstaffvalidator/views/codes/css/toolbar.css');
        
        if ($this->overCodeLimit) {
            Factory::getApplication()->enqueueMessage(Text::_('COM_GREGSSTAFFVALIDATOR_LIST_CODE_LIMIT'), 'notice');
        }
    }

}