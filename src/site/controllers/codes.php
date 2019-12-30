<?php

use Joomla\CMS\Language\Text;
use Joomla\CMS\Log\Log;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Session\Session;
use Joomla\Utilities\ArrayHelper;

/**
 * @package     Joomla.Site
 * @subpackage  com_staffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

/**
 * Front-end code-creation controller
 *
 * @package     Joomla.Site
 * @subpackage  com_staffvalidator
 */
class StaffValidatorControllerCodes extends BaseController {
    
    /**
     * Removes an item.
     * (Swiped from Joomla's AdminController class)
     * @return  void
     * @since   1.6
     */    
    public function delete() {
        
        // Check for request forgeries
        Session::checkToken() or jexit(Text::_('JINVALID_TOKEN'));

        // Get items to remove from the request.
        $ids = $this->input->get('cid', array(), 'array');

        if (!is_array($ids) || count($ids) < 1) {
            Log::add(Text::_('COM_STAFFVALIDATOR_DELETE_NOTHING_SELECTED'), Log::WARNING, 'jerror');
        } else {
            // Get the model.
            $model = $this->getModel('Codes');

            // Make sure the item ids are integers
            $ids = ArrayHelper::toInteger($ids);

            // Remove the items.
            if ($model->delete($ids)) {
                $this->setMessage(Text::plural('COM_STAFFVALIDATOR_DELETE_N_DELETED', count($ids)));
            } else {
                $this->setMessage($model->getError(), 'error');
            }

            // Invoke the postDelete method to allow for the child class to access the model.
            $this->postDeleteHook($model, $ids);
        }

        $this->setRedirect(Route::_('index.php?option=com_staffvalidator&view=codes', false));
        
    }
    
    /**
     * Function that allows child controller access to model data
     * after the item has been deleted.
     * (Swiped from Joomla's AdminController class)
     *
     * @param   \JModelLegacy  $model  The data model object.
     * @param   integer        $id     The validated data.
     * @return  void
     * @since   3.1
     */
    protected function postDeleteHook(\JModelLegacy $model, $id = null) {}    
    
}
