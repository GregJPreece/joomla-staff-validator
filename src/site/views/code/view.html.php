<?php

use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_staffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

class StaffValidatorViewCreate extends HtmlView {

    protected $form = null;

    protected $canDo;

    /**
     * Display the view
     *
     * @param   string  $template  The name of the layout file to parse.
     * @return  void
     */
    public function display($template = null) {

        $this->form = $this->get('Form');
        $this->script = $this->get('Script'); 

        // Check that the user has permissions to create a new code
        $this->canDo = JHelperContent::getActions('com_staffvalidator');
        if (!($this->canDo->get('core.create'))) {
            $app = JFactory::getApplication(); 
            $app->enqueueMessage(JText::_('JERROR_ALERTNOAUTHOR'), 'error');
            $app->setHeader('status', 403, true);
            return;
        }

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors), 500);
        }

        // Set properties of the html document
        $this->setupDocument();

        // Call the parent display to display the layout file
        parent::display($template);

    }

    protected function setupDocument() {
        HTMLHelper::_('behavior.framework');
        HTMLHelper::_('behavior.formvalidator');
        
        $document = JFactory::getDocument();
        $document->setTitle(JText::_('COM_STAFFVALIDATOR_CREATE_TITLE'));
        $document->addScript(JURI::root() . $this->script);
        $document->addScript(JURI::root() . "/administrator/components/com_staffvalidator"
                                          . "/views/code/js/submit.js");
        JText::script('COM_STAFFVALIDATOR_CREATE_ERROR_UNACCEPTABLE');
    }

}