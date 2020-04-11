<?php

use Joomla\CMS\MVC\View\HtmlView;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Component\ComponentHelper;

/**
 * @package     Joomla.Site
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * View for the user identity validation form
 */
class GregsStaffValidatorViewValidate extends HtmlView {

    protected $form = null;

    protected $canDo;

    /**
     * Display the view
     *
     * @param   string  $template  The name of the layout file to parse.
     * @return  void
     */
    public function display($template = null) {
        $this->setModel($this->getModel('Code'), true);
        $this->form = $this->get('ValidationForm');
        $this->script = $this->get('Script'); 
        
        $app = Factory::getApplication();
        if ($this->getLayout() == 'success' && 
                empty($app->getUserState('com_gregsstaffvalidator.validate.data'))) {
            $this->setLayout('default');
        }
        
        $this->populateCommonData();
        
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
        
        $document = Factory::getDocument();
        $document->setTitle(JText::_('COM_GREGSSTAFFVALIDATOR_CREATE_TITLE'));
        $document->addScript(JURI::root() . $this->script);
        $document->addScript(JURI::root() . "/components/com_gregsstaffvalidator/views/validate/js/submit.js");
        Text::script('COM_GREGSSTAFFVALIDATOR_CREATE_ERROR_UNACCEPTABLE');
    }

    protected function populateCommonData(): void {
        $componentParams = ComponentHelper::getParams('com_gregsstaffvalidator');
        $this->validatePreamble = $componentParams->get('validatePreamble', '');
        $this->validatePostamble = $componentParams->get('validatePostamble', '');
        
        $app = Factory::getApplication();
        $successObj = $app->getUserState('com_gregsstaffvalidator.validate.data');
    
        if ($successObj) {
            $this->successObject = $successObj;
            $app->setUserState('com_gregsstaffvalidator.validate.data', null);
        }
    }

}