<?php

namespace GregJPreece\Component\GregsStaffValidator\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

/**
 * General Controller of StaffValidator component
 *
 * @package     Joomla.Administrator
 * @subpackage  com_gregsstaffvalidator
 */
class DisplayController extends BaseController {
    /**
     * The default view for the display method.
     *
     * @var string
     */
    protected $default_view = 'codes';
    
    public function display($cachable = false, $urlparams = array()) {
        return parent::display();
    }
    
}