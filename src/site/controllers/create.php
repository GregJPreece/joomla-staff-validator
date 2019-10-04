<?php

use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Factory;

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
class StaffValidatorControllerCreate extends FormController {
    public function cancel($key = null) {
        parent::cancel($key);
        
        // set up the redirect back to the same form
        $this->setRedirect(
            (string) Uri::getInstance(), 
            Text::_('COM_STAFFVALIDATOR_CREATE_CANCELLED')
        );
    }
    
    /*
     * Function handing the save for adding a new validation code
     * Based on the save() function in the JControllerForm class
     */
    public function save($key = null, $urlVar = null) {

        // Check for request forgeries.
        Session::checkToken() or jexit(Text::_('JINVALID_TOKEN'));

        $app = Factory::getApplication(); 
        $input = $app->input; 
        $model = $this->getModel('create');

        $currentUri = (string) Uri::getInstance();

        // Check that this user is allowed to add a new record
        if (!Factory::getUser()->authorise( "core.create", "com_staffvalidator")) {
            $app->enqueueMessage(Text::_('JERROR_ALERTNOAUTHOR'), 'error');
            $app->setHeader('status', 403, true);
            return;
        }

        $saveContext = "$this->option.edit.$this->context";
        $data  = $input->get('jform', [], 'array');
        $form = $model->getForm($data, false);

        if (!$form) {
            $app->enqueueMessage($model->getError(), 'error');
            return false;
        }

        $validData = $model->validate($form, $data);

        // Handle the case where there are validation errors
        if ($validData === false) {
            $errors = $model->getErrors();

            // Display up to three validation messages to the user.
            for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
                if ($errors[$i] instanceof Exception) {
                    $app->enqueueMessage($errors[$i]->getMessage(), 'warning');
                } else {
                    $app->enqueueMessage($errors[$i], 'warning');
                }
            }

            $app->setUserState($saveContext . '.data', $data);
            $this->setRedirect($currentUri);

            return false;
        }

        $validData['created_by'] = Factory::getUser()->get('id', 0);
        $validData['updated_by'] = $validData['created_by'];
        $validData['time_generated'] = time();
        
        if ($validData['time_expires'] == 0) {
            $validData['time_expires'] = null;
        }

        // Attempt to save the data.
        if (!$model->save($validData)) {
            // Handle the case where the save failed

            // Save the data in the session.
            $app->setUserState($saveContext . '.data', $validData);

            // Redirect back to the edit screen.
            $this->setError(Text::sprintf('JLIB_APPLICATION_ERROR_SAVE_FAILED', $model->getError()));
            $this->setMessage($this->getError(), 'error');

            $this->setRedirect($currentUri);

            return false;
        }

        // clear the data in the form
        $app->setUserState($saveContext . '.data', null);

        $this->setRedirect(
            $currentUri,
            Text::_('COM_STAFFVALIDATOR_CREATE_SUCCESS')
        );

        return true;
        
    }

}