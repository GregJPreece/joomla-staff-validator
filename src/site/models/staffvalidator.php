<?php

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ItemModel;

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
 * StaffValidator Model
 *
 * @since  0.0.1
 */
class StaffValidatorModelStaffValidator extends ItemModel {

    /**
     * @var string message
     */
    protected $message;

    /**
     * Get the message
         *
     * @return  string  The message to be displayed to the user
     */
    public function getMsg() {

        if (!isset($this->message)){

            $jinput = Factory::getApplication()->input;
            $id     = $jinput->get('id', 1, 'INT');

            switch ($id) {
            
                case 2:
                    $this->message = 'Good bye World!';
                    break;
                default:
                case 1:
                    $this->message = 'Hello World!';
                    break;
            }

        }

        return $this->message;
    }

}
