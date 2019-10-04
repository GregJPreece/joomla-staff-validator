<?php

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_staffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

?>
<form action="<?= Route::_('index.php?option=com_staffvalidator'); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">
    <input type="hidden" name="option" value="com_staffvalidator" />
    <input type="hidden" name="task" value="create.save" />
    <input type="hidden" name="layout" value="<?= htmlspecialchars($this->getLayout(), ENT_COMPAT, 'UTF-8'); ?>" />
    <?= HTMLHelper::_('form.token'); ?>

    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend><?= Text::_('COM_STAFFVALIDATOR_CREATE_LEGEND') ?></legend>
            <div class="row-fluid">
                <div class="span6">
                    <?= $this->form->renderFieldset('validation-code');  ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="btn-toolbar">
        <div class="btn-group">
            <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('create.save')">
                <span class="icon-ok"></span><?= Text::_('JSAVE') ?>
            </button>
        </div>
        <div class="btn-group">
            <button type="button" class="btn" onclick="Joomla.submitbutton('create.cancel')">
                <span class="icon-cancel"></span><?= Text::_('JCANCEL') ?>
            </button>
        </div>
    </div>
</form>