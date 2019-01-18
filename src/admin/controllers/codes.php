<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_staffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

class StaffValidatorControllerCodes extends JControllerAdmin {

    /**
     * Proxy for getModel.
     *
     * @param   string  $name    The model name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  object  The model.

     */
    public function getModel($name = 'Codes', $prefix = 'StaffValidatorModel', 
                             $config = ['ignore_request' => true]) {
        $model = parent::getModel($name, $prefix, $config);

        return $model;
    }

}
