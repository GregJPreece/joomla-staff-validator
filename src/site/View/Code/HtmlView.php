<?php

namespace GregJPreece\Component\GregsStaffValidator\Site\View\Code;

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

/**
 * @package     Joomla.Site
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

class HtmlView extends BaseHtmlView {

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
        $this->item = $this->get('Item');

        // Check that the user has permissions to create a new code
        $this->canDo = ContentHelper::getActions('com_gregsstaffvalidator');
        if (!($this->canDo->get('core.create'))) {
            $app = Factory::getApplication(); 
            $app->enqueueMessage(Text::_('JERROR_ALERTNOAUTHOR'), 'error');
            $app->setHeader('status', 403, true);
            return;
        }

        $this->checkCodeLimit();
        
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
        HTMLHelper::_('behavior.core');
        HTMLHelper::_('behavior.formvalidator');
        
        $title = ($this->item->id == 0)
            ? $title = Text::_('COM_GREGSSTAFFVALIDATOR_CREATE_TITLE')
            : $title = Text::_('COM_GREGSSTAFFVALIDATOR_EDIT_TITLE')  . ' (' . $this->item->code . ')';
        
        $document = Factory::getDocument();
        $document->setTitle($title);
        $document->addScript(Uri::root() . $this->script);
        $document->addScript(Uri::root() . "/administrator/components/com_gregsstaffvalidator"
                                          . "/views/code/js/submit.js");
        Text::script('COM_GREGSSTAFFVALIDATOR_CREATE_ERROR_UNACCEPTABLE');
    }
    
    protected function checkCodeLimit() {
        
        // Ignore code limit when editing
        if ($this->item->id > 0) {
            return;
        }
        
        $db = Factory::getDbo();
        $myId = Factory::getUser()->id;        
        
        $query = $db->getQuery(true)
            ->select('COUNT(*) as count')
            ->from($db->qn('#__gregsstaffvalidator_codes', 'codes'))
            ->where([$db->qn('codes.user_id') . ' = ' . $db->q($myId)]);
        
        $itemCount = $db->setQuery($query)->loadResult();
        
        // Check the user is allowed to make more codes
        $params = ComponentHelper::getParams("com_gregsstaffvalidator");
        $codeLimit = $params->get('maxCodesPerUser', null);
        $overCodeLimit = ($codeLimit !== null) && (intval($codeLimit) <= $itemCount);
        
        if ($overCodeLimit) {
            Factory::getApplication()->redirect(
                Route::_('index.php?option=com_gregsstaffvalidator&view=codes')
            );
        }
        
    }

}
