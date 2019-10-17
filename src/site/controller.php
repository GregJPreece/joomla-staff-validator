<?php

use Joomla\CMS\MVC\Controller\BaseController;

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
 * StaffValidator Component Controller
 *
 * @since  0.0.1
 */
class StaffValidatorController extends BaseController {
    
    public function display($cachable = false, $urlparams = array()) {        
        $document = JFactory::getDocument();
        $viewName = $this->input->getCmd('view', 'login');
        $viewFormat = $document->getType();
        $layoutName = $this->input->getCmd('layout', 'default');
        
        $view = $this->getView($viewName, $viewFormat);
        $view->setModel($this->getModel('Code'), true);
        $view->setLayout($layoutName);
        $view->document = $document;
        $view->display();
    }
    
}