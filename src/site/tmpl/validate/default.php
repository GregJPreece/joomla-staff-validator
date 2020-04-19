<?php

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

/**
 * @package     Joomla.Site
 * @subpackage  com_gregsstaffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

defined('_JEXEC') or die('Restricted access');

?>
<form action="<?= Route::_('index.php?option=com_gregsstaffvalidator'); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate">
    <input type="hidden" name="option" value="com_gregsstaffvalidator" />
    <input type="hidden" name="task" value="code.validate" />
    <input type="hidden" name="layout" value="<?= htmlspecialchars($this->getLayout(), ENT_COMPAT, 'UTF-8'); ?>" />
    <?= HTMLHelper::_('form.token'); ?>

    <div class="form-horizontal">
        <fieldset class="adminform">
            <legend><?= Text::_('COM_GREGSSTAFFVALIDATOR_VALIDATE_LEGEND') ?></legend>
            <?php if (!empty($this->validatePreamble)): ?>
                <div class="row-fluid">
                    <p class="validation-preamble">
                        <?= $this->validatePreamble ?>
                    </p>
                </div>
            <?php endif; ?>    
            <div class="row-fluid">
                <div class="span6">
                    <?= $this->form->renderFieldset('validate');  ?>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="btn-toolbar">
        <div class="btn-group">
            <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('code.validate')">
                <span class="icon-ok"></span><?= Text::_('COM_GREGSSTAFFVALIDATOR_BUTTON_CODE_VALIDATE') ?>
            </button>
        </div>
        <div class="btn-group">
            <button type="button" class="btn" onclick="Joomla.submitbutton('code.cancel')">
                <span class="icon-cancel"></span><?= Text::_('JCANCEL') ?>
            </button>
        </div>
    </div>
</form>