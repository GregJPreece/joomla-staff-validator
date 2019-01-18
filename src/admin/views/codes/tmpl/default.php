<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_staffvalidator
 *
 * @copyright   Copyright (C) 2019 Greg J Preece. All rights reserved.
 * @license     GNU General Public License version 3; see LICENSE
 */

 // No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<form action="index.php?option=com_staffvalidator&view=codes" method="post" id="adminForm" name="adminForm">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="1%"><?= JText::_('COM_STAFFVALIDATOR_NUM'); ?></th>
            <th width="2%">
                <?= JHtml::_('grid.checkall'); ?>
            </th>
            <th>
                <?= JText::_('COM_STAFFVALIDATOR_FIELD_CODE_ID_LABEL'); ?>
            </th>
            <th>
                <?= JText::_('COM_STAFFVALIDATOR_FIELD_CODE_USER_LABEL'); ?>
            </th>
            <th>
                <?= JText::_('COM_STAFFVALIDATOR_FIELD_CODE_VALUE_LABEL') ;?>
            </th>
            <th>
                <?= JText::_('COM_STAFFVALIDATOR_FIELD_CODE_TIME_EXPIRES_LABEL'); ?>
            </th>
        </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="5">
                    <?= $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php foreach ($this->items as $i => $row) : 
                    $link = JRoute::_('index.php?option=com_staffvalidator&task=code.edit&id=' . $row->id);    
                ?>
                    <tr>
                        <td>
                            <?= $this->pagination->getRowOffset($i); ?>
                        </td>
                        <td>
                            <?= JHtml::_('grid.id', $i, $row->id); ?>
                        </td>
                        <td>
                            <a href="<?= $link ?>" title="<?= JText::_('COM_STAFFVALIDATOR_MANAGER_LIST_CODE_EDIT'); ?>">
                                <?= $row->id; ?>
                            </a>
                        </td>
                        <td><?= $row->user_id; ?></td>
                        <td>
                            <a href="<?= $link ?>" title="<?= JText::_('COM_STAFFVALIDATOR_MANAGER_LIST_CODE_EDIT'); ?>">
                                <?= $row->code; ?>
                            </a>
                        </td>
                        <td>
                            <?= $row->time_expires; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <input type="hidden" name="task" value="" />
    <input type="hidden" name="boxchecked" value="0" />
    <?= JHtml::_('form.token'); ?>
</form>