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
      method="post" name="adminForm" id="adminForm">
    <?= HTMLHelper::_('form.token'); ?>
    <input type="hidden" name="task" value="code.edit">
    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend>
                <?= Text::_('COM_STAFFVALIDATOR_MANAGER_DETAILS_CODE_EDIT'); ?>
            </legend>
            <div class="row-fluid">
                <div class="span6">
                    <?php foreach($this->form->getFieldset() as $field): ?>
                        <div class="control-group">
                            <div class="control-label"><?= $field->label; ?></div>
                            <div class="controls"><?= $field->input; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </fieldset>
    </div>
</form>