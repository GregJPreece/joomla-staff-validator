<?php

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_staffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<form action="<?= Route::_('index.php?option=com_staffvalidator&layout=edit&id=' . (int) $this->item->id); ?>"
      method="post" name="adminForm" id="adminForm" class="form-validate">
    <?= HTMLHelper::_('form.token'); ?>
    <input type="hidden" name="task" value="code.edit">
    <div class="form-horizontal">
        <fieldset class="adminform">
            <?php if ((int) $this->item->id > 0): ?>
            <legend>
                <?= Text::_('COM_STAFFVALIDATOR_MANAGER_DETAILS_CODE_EDIT'); ?>
            </legend>
            <?php endif; ?>
            <div class="row-fluid">
                <div class="span6">
                    <?php 
                        foreach($this->form->getFieldset() as $field) {
                            echo $field->renderField();        
                        }
                    ?>
                </div>
            </div>
        </fieldset>
    </div>
</form>